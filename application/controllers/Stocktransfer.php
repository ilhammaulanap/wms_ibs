<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stocktransfer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_stock_transfer');
    }

    public function index()
    {
        $data = array(
            'title' => 'List Stock Transfer',
            'level' => $this->session->userdata('wh_level'),
        );

        $this->template->load('layout/v_layout', 'stocktransfer/v_index', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Stock Transfer',
            'id_user'   => $this->session->userdata('wh_id'),
            'name_user' => $this->session->userdata('wh_name'),
            'id' => '',
            'mode' => 'add',
        );

        $this->template->load('layout/v_layout', 'stocktransfer/v_form', $data);
    }

    public function edit($id = '')
    {
        $data_outbound = $this->m_app->select_global('tb_stock_transfer', array('md5(id)' => $id));
        if ($data_outbound->num_rows() > 0) {
            $data = [
                'title'     => 'Edit Order Outbound',
                'id'        => $id,
                'id_user'   => $this->session->userdata('wh_id'),
                'name_user' => $this->session->userdata('wh_name'),
                'mode'      => 'edit',
            ];

            $this->template->load('layout/v_layout', 'stocktransfer/v_form', $data);
        } else {
            redirect(site_url('outbound/'));
        }
    }

    public function save_order()
    {
        $id = $this->input->post('id');
        // echo $this->input->post('project_name');
        // die();
        $data = array(
            'stock_transfer_no'       => $this->m_stock_transfer->get_last_no_stock_transfer(),
            'stock_transfer_date'     => $this->input->post('stock_transfer_date'),
            'id_wh_origin'            => $this->input->post('id_wh_origin'),
            'id_wh_destination'       => $this->input->post('id_wh_destination'),
            'id_project'            => $this->input->post('id_project'),
            // 'project_name'            => $this->input->post('project_name'),
            'no_mrf'                  => $this->input->post('no_mrf'),
            'id_wh_destination'       => $this->input->post('id_wh_destination'),
            'stock_transfer_status'   => 'ordered',
            'id_user'                 => $this->session->userdata('wh_id'),
        );
        // print_r($data);
        // die();
        //save header

        if ($id == '' || $id == null) {
            $id = $this->m_app->insert_global('tb_stock_transfer', $data);

            if ($id <= 0) {
                echo json_encode(
                    [
                        'code' => 500,
                        'message' => 'Data Stock Transfer Gagal Disimpan'
                    ]
                );
                return;
            }
        } else {
            unset($data['stock_transfer_no']);
            $this->m_app->update_global('tb_stock_transfer', array('id' => $id), $data);
        }

        //data detail
        $id_detail  = $this->input->post('id_detail');
        $id_detail_inbound = $this->input->post('id_detail_inbound');
        $qty        = $this->input->post('qty');

        for ($i = 0; $i < sizeof($id_detail); $i++) {
            $data_detail = array(
                'id_stock_transfer' => $id,
                'id_inbound_product' => $id_detail_inbound[$i],
                'qty' => $qty[$i]
            );

            if ($id_detail[$i] == '0') {
                $this->m_app->insert_global('tb_stock_transfer_detail', $data_detail);
            } else {
                $this->m_app->update_global('tb_stock_transfer_detail', array('id' => $id_detail[$i]), $data_detail);
            }
        }

        //synchronize data trash
        $id_trash = $this->input->post('id_trash');
        $id_trash = explode(',', $id_trash);
        $this->m_stock_transfer->sync_id_detail($id, $id_trash);

        $data_st = $this->m_app->select_global('tb_stock_transfer', array('id' => $id));

        echo json_encode([
            'code' => 200,
            'message' => 'Data Outbound Berhasil Disimpan',
            'data' => $data_st->row_array(),
        ]);
    }

    public function ajax_stocktransfer()
    {
        $id_warehouse = trim($this->input->post('id_warehouse'));
        // echo $id_warehouse;
        // die
        $where['tst.id_wh_origin'] = $id_warehouse;
        $data = $this->m_stock_transfer->get_stocktransfer($where)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function ajax_stocktransfer_receive()
    {
        $id_warehouse = trim($this->input->post('id_warehouse'));
        $status_transfer = trim($this->input->post('status_transfer'));
        $where['tst.id_wh_destination'] = $id_warehouse;
        switch ($status_transfer) {
            case '1':
                $where['ti.id IS NULL'] = NULL;
                $where['tst.stock_transfer_status'] = 'in_transit';
                break;
            case '2':
                $where['ti.id IS NOT NULL'] = NULL;
                $where['tst.stock_transfer_status'] = 'received';
                break;
            default:
                return;
                break;
        }
        $data = $this->m_stock_transfer->get_stocktransfer($where)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function ajax_list_stocktransfer()
    {
        $term = $this->input->post('term');
        $data = $this->m_stock_transfer->get_list_stocktransfer($term)->result_array();
        $receiver = array();

        foreach ($data as $key => $value) {
            $d = $value;
            $d['value'] = $value['stock_transfer_no'];
            array_push($receiver, $d);
        }

        echo json_encode($receiver);
    }

    public function get_stocktransfer_product()
    {
        $where['tst.id'] = $this->input->post('id_stock_transfer');
        $data = $this->m_stock_transfer->get_stocktransfer_detail($where)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_order_status()
    {
        $data = $this->input->post();
        $status_date = date('Y-m-d', strtotime($data['status_date']));
        $status_datetime = $status_date;

        $data_status = [
            'id_stock_transfer' => $data['id_stock_transfer'],
            'stock_transfer_status' => $data['stock_transfer_status'],
        ];

        $select_status = $this->m_app->select_global('tb_stock_transfer_status', $data_status);
        $data_status_ = $data_status;
        $data_status_['status_date'] = $status_datetime;

        if ($select_status->num_rows() > 0) {
            $this->m_app->update_global('tb_stock_transfer_status', $data_status, $data_status_);
        } else {
            $this->m_app->insert_global('tb_stock_transfer_status', $data_status_);
        }

        //update tb_stock_transfer
        $data_outbound = [
            'stock_transfer_status' => $data['stock_transfer_status'],
        ];

        $this->m_app->update_global('tb_stock_transfer', ['id' => $data['id_stock_transfer']], $data_outbound);

        //update stock
        $id_detail = $this->input->post('id_detail');
        $qty_outbound = $this->input->post('qty_outbound');
        for ($i = 0; $i < sizeof($id_detail); $i++) {
            $this->m_app->update_global('tb_stock_transfer_detail', array('id' => $id_detail[$i]), array('qty' => $qty_outbound[$i]));
        }

        echo json_encode(
            [
                'code' => 200,
                'message' => 'Data Inbound Berhasil disimpan'
            ]
        );
    }

    public function info_order()
    {
        $id = $this->input->get('id');

        $header = $this->m_stock_transfer->get_stocktransfer(['md5(tst.id)' => $id]);
        $body   = $this->m_stock_transfer->get_stocktransfer_detail(['md5(tsd.id_stock_transfer)' => $id]);

        if ($header->num_rows() > 0 && $body->num_rows() > 0) {
            echo json_encode(
                [
                    'code'      => 200,
                    'message'   => 'DATA DITEMUKAN',
                    'header'    => $header->row_array(),
                    'body'      => $body->result_array()
                ]
            );
        } else {
            echo json_encode(
                [
                    'code'      => 404,
                    'message'   => 'DATA TIDAK DITEMUKAN',
                    'header'    => array(),
                    'body'      => array(),
                ]
            );
        }
    }

    public function receipt($id_st = '')
    {
        if ($id_st != '') {
            //check stock transfer data
            $data_st = $this->m_app->select_global('tb_stock_transfer', array('id' => $id_st));

            if ($data_st->num_rows() == 0) {
                echo "<script>";
                echo "alert('Order ST not found.');";
                echo "window.location.href = '" . site_url('inbound/receive_stock_transfer') . "';";
                echo "</script>";
                return;
            }
            //check status stock transfer
            if (!in_array($data_st->row()->stock_transfer_status, array('in_transit'))) {
                echo "<script>";
                echo "alert('Order ST status not `in transit`.');";
                echo "window.location.href = '" . site_url('inbound/receive_stock_transfer') . "';";
                echo "</script>";
                return;
            }
            if (in_array($data_st->row()->stock_transfer_status, array('received'))) {
                echo "<script>";
                echo "alert('Order ST status already `received` cannot load data.');";
                echo "window.location.href = '" . site_url('inbound/receive_stock_transfer') . "';";
                echo "</script>";
                return;
            }
            $data = [
                'title'     => 'New Receive Stock',
                'id'        => '',
                'id_st'     => md5($id_st),
                'id_user'   => $this->session->userdata('wh_id'),
                'name_user' => $this->session->userdata('wh_name'),
                'mode'      => 'add',
            ];
            $this->template->load('layout/v_layout', 'inbound/v_form_receive', $data);
        } else {
            redirect(site_url('inbound/receive_stock_transfer'));
        }
    }

    public function history()
    {
        $data = array(
            'title' => 'History Stock Transfer',
        );

        $this->template->load('layout/v_layout', 'stocktransfer/v_history', $data);
    }

    public function get_ajax_data_select_wh()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->m_stock_transfer->get_array_id_warehouse($searchTerm);
        echo json_encode($response);
    }

    public function get_stocktransfer_history()
    {
        $order = 'tst.stock_Transfer_date DESC';
        $where['tst.stock_transfer_date>='] = $this->input->post('date1');
        $where['tst.stock_transfer_date<='] = $this->input->post('date2');
        $where['tst.id_wh_origin']   = $this->input->post('id_warehouse');
        $data = $this->m_stock_transfer->get_stocktransfer_detail($where, $order)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function pdfdn($id = ''){
        // echo $id;
        // die();
        $order = 'tst.stock_Transfer_date DESC';
        $data = $this->m_stock_transfer->get_stock(array('md5(tst.id)' => $id));
        $data_product = $this->m_stock_transfer->get_stocktransfer_detail( array('md5(tst.id)' => $id), $order);
        
        if ($data_product->num_rows() > 0) {
            $data = array(
                'id' => $id,
                'header' => $data,
                'body' => $data_product
            );
            // print_r($data);
            // $this->load->view('stocktransfer/v_dn_pdf', $data);
            // return;
            $html = $this->load->view('stocktransfer/v_dn_pdf', $data, TRUE);
                    $mpdf = new \Mpdf\Mpdf();
                    $mpdf->WriteHTML($html);
                    $namefile = 'testing.pdf';
                    $mpdf->Output($namefile, 'I');
        } else {
            echo "<script>window.close();</script>";
        }
    }
}
