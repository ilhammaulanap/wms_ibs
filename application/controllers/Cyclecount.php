<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;

class cyclecount extends CI_Controller
{

    public function __construct()
    {
		parent::__construct();
        check_login();
        $this->load->model('m_inbound');
        $this->load->model('m_product');
        $this->load->model('m_cyclecount');
        $this->load->model('m_locator');
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        date_default_timezone_set("Asia/Bangkok");
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function save_cycle_count_h()
    {
        $data = [
            'tgl_cycle_count' => $this->input->post('tgl_cycle_count'),
            'id_warehouse' => $this->input->post('id_warehouse'),
            'id_user_submit' => $this->input->post('id_user_submit'),
            // 'id_user_submit' => get_id_user(),
            'id_locator' => $this->input->post('id_locator'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];
        foreach ($data as $key => $cch) {
            if (empty(trim($data[$key]))) {
                echo json_encode(array('code' => 500, 'message' => $key . ' is required'));
                return;
            }
        }
        if (!$this->validateDate($this->input->post('tgl_cycle_count'))) {
            echo json_encode(array('code' => 500, 'message' => 'tgl_cycle_count is Must be a date (Y-m-d)'));
        }
        $warehouse = $this->m_app->select_global('tb_warehouse', array('id' => $data['id_warehouse'], 'deletedate' => NULL));
        $id_locator = explode(',', $data['id_locator']);
        if ($warehouse->num_rows() > 0) {
            $warehouse = $warehouse->row_array();
            if (empty($warehouse['code']) || $warehouse['code'] == null) {
                echo json_encode(array('code' => 500, 'message' => 'code wh not found'));
                return;
            }
            $code_wh = $warehouse['code'];
        } else {
            echo json_encode(array('code' => 500, 'message' => 'wh not found'));
            return;
        }
        foreach ($id_locator as $i => $locator) {
            $check_locator = $this->m_app->select_global('tb_warehouse_locator', array('id' => $id_locator[$i], 'id_warehouse' => $data['id_warehouse'], 'deletedate' => NULL));
            if ($check_locator->num_rows() < 1) {
                echo json_encode(array('code' => 500, 'message' => 'id_locator ' . $id_locator[$i] . ' not found'));
                return;
            }
        }


        $this->db->trans_start();
        // if ($this->input->post('id_cycle_count_h') != null) {
        //     $check_cc = $this->m_app->select_global('tb_cycle_count_h', array('id_cycle_count_h' => $this->input->post('id_cycle_count_h'), 'deleted_at' => NULL));
        // 	if ($check_cc->num_rows() <= 0) {
        // 		echo json_encode(
        // 			[
        // 				'code' => 500,
        // 				'message' => 'Data Cycle Count Not Found'
        // 			]
        // 		);
        // 		return false;
        // 	}
        // 	$save = $this->m_app->update_global('tb_cycle_count_h', array('id_cycle_count_h' => $this->input->post('id_cycle_count_h')), $data);

        // 	if ($save < 0) {
        // 		echo json_encode(
        // 			[
        // 				'code' => 500,
        // 				'message' => 'Data Cycle Count Gagal Diupdate'
        // 			]
        // 		);
        // 		return false;
        // 	}
        // 	sumbit_log('Update Cycle Count : ' . $this->input->post('id_cycle_count_h'), get_id_user());
        // 	$data = $this->m_app->select_global('tb_cycle_count_h', array('id_cycle_count_h' => $this->input->post('id_cycle_count_h'), 'deleted_at' => NULL));
        // }else{
        $save = $this->m_app->insert_global('tb_cycle_count_h', $data);
        if ($save <= 0) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Data Cycle Count Gagal Disimpan'
                ]
            );
            return false;
        } else {

            foreach ($id_locator as $l => $loc) {
                $data_inventory_product = $this->m_inbound->get_detail_product_inbound(array('tid.id_locator' => $id_locator[$l]))->result_array();
                foreach ($data_inventory_product as $key => $product) {
                    // var_dump($data_inventory_product[$key]);
                    // die();
                    $data_product = [
                        'id_product' => $data_inventory_product[$key]['id_product'],
                        'id_product_status' => $data_inventory_product[$key]['id_product_status'],
                        'id_locator' => $data_inventory_product[$key]['id_locator'],
                        'qty_inventory' => $data_inventory_product[$key]['available'],
                        'id_cycle_count_h' => $save,
                        'created_at' => date('Y-m-d'),
                    ];
                    $save_detail = $this->m_app->insert_global('tb_cycle_count_d', $data_product);
                }
            }
        }
        sumbit_log('Cycle Count : ' . $save, get_id_user());
        // $data = $this->m_app->select_global('tb_cycle_count_h', array('id_cycle_count_h' => $save, 'deleted_at' => NULL));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(
                [
                    'code' => 400,
                    'message' => 'Data Cycle Count failed saved',
                    'data' => NULL
                ]
            );
            return;
        } else {
            $this->db->trans_commit();
            $data = $this->m_cyclecount->get_cycle_count_header(array('ch.id_cycle_count_h' => $save))->result_array();
            foreach ($data as $key => $value) {
                $where2 = array();
                $where2['cd.id_cycle_count_h'] = $data[$key]['id_cycle_count_h'];
                $data_locator = $this->m_locator->get_locator_in(explode(',', $data[$key]['id_locator']))->result_array();
                $data_detail = $this->m_cyclecount->get_cycle_count_detail($where2)->result_array();
                $data[$key]['locator'] = $data_locator;
                $data[$key]['detail'] = $data_detail;
            }
            echo json_encode(
                [
                    'code' => 200,
                    'message' => 'Data Cycle Count Success saved',
                    'data' => $data
                ]
            );
            return;
        }
    }

    public function get_cycle_count()
    {
        try {
            $where = array();
            $term = '';
            if (!empty($this->input->get('id_cycle_count_h'))) {
                $where['ch.id_cycle_count_h'] =  $this->input->get('id_cycle_count_h');
            }
            if (!empty($this->input->get('id_warehouse'))) {
                $where['ch.id_warehouse'] =  $this->input->get('id_warehouse');
            }
            if (!empty($this->input->get('id_user_submit'))) {
                $where['ch.id_user_submit'] = $this->input->get('id_user_submit');
            }
            if (!empty($this->input->get('date1'))) {
                if (empty($this->input->get('date2'))) {
                    echo json_encode(array('code' => 500, 'message' => 'date2 is required'));
                    return;
                }
                $where['ch.tgl_cycle_count>='] = $this->input->get('date1');
                $where['ch.tgl_cycle_count<='] = $this->input->get('date2');
            }
            $data = $this->m_cyclecount->get_cycle_count_header($where)->result_array();
            foreach ($data as $key => $value) {
                $where2 = array();
                $where2['cd.id_cycle_count_h'] = $data[$key]['id_cycle_count_h'];
                $data_locator = $this->m_locator->get_locator_in(explode(',', $data[$key]['id_locator']))->result_array();
                $data_detail = $this->m_cyclecount->get_cycle_count_detail($where2)->result_array();
                $data[$key]['locator'] = $data_locator;
                $data[$key]['detail'] = $data_detail;
            }
            echo json_encode(
                [
                    'code' => 200,
                    'message' => 'Data Cycle Count Success loaded',
                    'data' => $data
                ]
            );
            return;
        } catch (Throwable $e) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Oops Something Wrong' . $e,
                ]
            );
            return;
        }
    }

    public function edit_cycle_count_d()
    {
        $data = [
            'id_cycle_count_d' => $this->input->post('id_cycle_count_d'),
            'qty_actual' => $this->input->post('qty_actual'),
            'updated_at' => date('Y-m-d'),
        ];
        foreach ($data as $key => $cch) {
            if (empty(trim($data[$key]))) {
                echo json_encode(array('code' => 500, 'message' => $key . ' is required'));
                return;
            }
        }
        $check_cc = $this->m_app->select_global('tb_cycle_count_d', array('id_cycle_count_d' => $this->input->post('id_cycle_count_d'), 'deleted_at' => NULL));

        if (!is_numeric($this->input->post('qty_actual'))) {
            echo json_encode(array('code' => 500, 'message' => 'qty_actual Must numeric'));
        }
        if ($check_cc->num_rows() <= 0) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Data Cycle Count Not Found'
                ]
            );
            return false;
        }
        $this->db->trans_start();
        $save = $this->m_app->update_global('tb_cycle_count_d', array('id_cycle_count_d' => $this->input->post('id_cycle_count_d')), $data);
        if ($save < 0) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Data Cycle Count Gagal Diupdate'
                ]
            );
            return false;
        }
        sumbit_log('Update Cycle Count : ' . $this->input->post('id_cycle_count_h'), get_id_user());
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(
                [
                    'code' => 400,
                    'message' => 'Data Cycle Count failed saved',
                    'data' => NULL
                ]
            );
            return;
        } else {
            $this->db->trans_commit();
            $data = $this->m_cyclecount->get_cycle_count_detail(array('cd.id_cycle_count_d' => $this->input->post('id_cycle_count_d')));
            echo json_encode(
                [
                    'code' => 200,
                    'message' => 'Data Cycle Count Success saved',
                    'data' => $data->result_array()
                ]
            );
            return;
        }
    }

    public function get_cycle_count_detail()
    {
        try {
            $where = array();
            $term = '';
            if (!empty($this->input->get('id_cycle_count_d'))) {
                $where['cd.id_cycle_count_d'] =  $this->input->get('id_cycle_count_d');
            }
            if (!empty($this->input->get('id_product'))) {
                $where['cd.id_product'] =  $this->input->get('id_product');
            }
            if (!empty($this->input->get('id_locator'))) {
                $where['cd.id_locator'] =  $this->input->get('id_locator');
            }
            if (!empty($this->input->get('id_cycle_count_h'))) {
                $where['ch.id_cycle_count_h'] =  $this->input->get('id_cycle_count_h');
            }
            if (!empty($this->input->get('id_warehouse'))) {
                $where['ch.id_warehouse'] =  $this->input->get('id_warehouse');
            }
            if (!empty($this->input->get('id_user_submit'))) {
                $where['ch.id_user_submit'] = $this->input->get('id_user_submit');
            }
            if (!empty($this->input->get('date1'))) {
                if (empty($this->input->get('date2'))) {
                    echo json_encode(array('code' => 500, 'message' => 'date2 is required'));
                    return;
                }
                $where['ch.tgl_cycle_count>='] = $this->input->get('date1');
                $where['ch.tgl_cycle_count<='] = $this->input->get('date2');
            }
            $data = $this->m_cyclecount->get_cycle_count_detail($where)->result_array();
            echo json_encode(
                [
                    'code' => 200,
                    'message' => 'Data Cycle Count Detail Success loaded',
                    'data' => $data
                ]
            );
            return;
        } catch (Throwable $e) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Oops Something Wrong' . $e,
                ]
            );
            return;
        }
    }

    public function delete_cycle_count()
    {
        try {
            $id_cycle_count = $this->input->post('id_cycle_count_h');
            if ($id_cycle_count == null) {
                echo json_encode(array('code' => 500, 'message' => 'id Cycle count h is required'));
                return;
            }
            $check_cc = $this->m_app->select_global('tb_cycle_count_h', array('id_cycle_count_h' => $id_cycle_count, 'deleted_at' => NULL));
            if ($check_cc->num_rows() <= 0) {
                echo json_encode(
                    [
                        'code' => 500,
                        'message' => 'Data Cycle Count Not Found'
                    ]
                );
                return false;
            }
            $this->db->trans_start();
            $delete = $this->m_app->update_global(
                'tb_cycle_count_h',
                array('id_cycle_count_h' => $this->input->post('id_cycle_count_h')),
                array('deleted_at' => date('Y-m-d'))
            );
            $delete_detail = $this->m_app->update_global(
                'tb_cycle_count_d',
                array('id_cycle_count_h' => $this->input->post('id_cycle_count_h')),
                array('deleted_at' => date('Y-m-d'))
            );
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo json_encode(
                    [
                        'code' => 400,
                        'message' => 'Data Cycle Count failed delete',
                        'data' => NULL
                    ]
                );
                return;
            } else {
                $this->db->trans_commit();
                echo json_encode(
                    [
                        'code' => 200,
                        'message' => 'Data Cycle Count Success deleted',
                        'data' => NULL
                    ]
                );
                return;
            }
        } catch (Throwable $e) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Oops Something Wrong' . $e,
                ]
            );
            return;
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Create Cycle Count - Header',
        ];
        $this->template->load('layout/v_layout', 'cyclecount/v_form_header', $data);
    }

    public function list()
    {
        $data = [
            'title' => 'List Cycle Count',
        ];
        $this->template->load('layout/v_layout', 'cyclecount/v_list', $data);
    }

    public function edit($id = '')
    {
        if (!empty($id)) {
            $data = [
                'title' => 'Edit Cycle Count',
                'id_cycle_count_h' => $id,
            ];
            $this->template->load('layout/v_layout', 'cyclecount/v_form_detail', $data);
            return;
        }

        redirect(site_url('cyclecount/list'));
    }

    public function pdf($id = '')
    {
        $where['ch.id_cycle_count_h'] =  $id;
        $data = $this->m_cyclecount->get_cycle_count_header($where)->row_array();

        if ($data) {
            $where2['cd.id_cycle_count_h'] = $data['id_cycle_count_h'];
            $data_locator = $this->m_locator->get_locator_in(explode(',', $data['id_locator']))->result_array();
            $data_detail = $this->m_cyclecount->get_cycle_count_detail($where2)->result_array();
            $data['locator'] = $data_locator;
            $data['detail'] = $data_detail;

            $html = $this->load->view('cyclecount/v_pdf', $data, TRUE);
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $namefile = 'cyclecount.pdf';
            $mpdf->Output($namefile, 'I');
        } else {
            redirect(site_url('cyclecount/list'));
        }
    }
}
