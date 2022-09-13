<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Warehouse extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_warehouse');
        $this->load->model('m_user');
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Data Warehouse'
        ];

        $this->template->load('layout/v_layout', 'warehouse/v_warehouse', $data);
    }

    //
    public function get_ajax_data_warehouse()
    {
        //$data = $this->m_app->select_global('tb_warehouse', array('deletedate IS NULL' => NULL))->result_array();
        $data = $this->m_warehouse->get_data_warehouse()->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data()
    {
        $id = $this->input->post('id');

        $data = array(
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
        );

        if ($id == '' || $id == NULL) {
            $id = $this->m_app->insert_global('tb_warehouse', $data);
            if ($id > 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Warehouse Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Warehouse Gagal Disimpan',
                    'data' => array()
                ));
            }
        } else {
            $update = $this->m_app->update_global('tb_warehouse', array('id' => $id), $data);
            if ($update >= 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Warehouse Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Warehouse Gagal Disimpan',
                    'data' => array()
                ));
            }
        }
    }

    public function delete_data()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_warehouse', array('id' => $id), $data);
        if ($update >= 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data Warehouse Berhasil Dihapus',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Warehouse Gagal Dihapus',
                'data' => array()
            ));
        }
    }

    public function get_ajax_data_select()
    {
        // Search term
        // $searchTerm = $this->input->post('searchTerm');
        // $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm);

        // echo json_encode($response);
        $level = $this->session->userdata('wh_level');
        $id = $this->session->userdata('wh_id_warehouse');
        // echo $level ;
        // die();
        if($level == 3){
            // echo 'check user';
            $searchTerm = $this->m_warehouse->get_warehouse_user($id)->result_array();
            $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm[0]['name']);
            echo json_encode($response);
        }else{
            $searchTerm = $this->m_warehouse->get_warehouse_user($id)->result_array();
            if(empty($searchTerm)){
                $searchTerm = $this->input->post('searchTerm');
                $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm);
            }else{
                $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm[0]['name']);
            }
            // $searchTerm = $this->input->post('searchTerm');
            // $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm);
            echo json_encode($response);
        }
    }

    public function get_ajax_data_select_project()
    {
        // Search term
        // $searchTerm = $this->input->post('searchTerm');
        // $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm);

        // echo json_encode($response);

        $level = $this->session->userdata('wh_level');
        $id = $this->session->userdata('wh_id_warehouse');
        if($level == 3){
            // echo 'check user';
            $searchTerm = $this->m_warehouse->get_warehouse_user($id)->result_array();
            $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm[0]['name']);
            echo json_encode($response);
        }else{
            $searchTerm = $this->m_warehouse->get_warehouse_user($id)->result_array();
            if(empty($searchTerm)){
                $searchTerm = $this->input->post('searchTerm');
                $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm);
            }else{
                $response   = $this->m_warehouse->get_data_warehouse_select($searchTerm[0]['name']);
            }
            // $searchTerm = $this->input->post('searchTerm');
            // $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm);
            echo json_encode($response);
        }
    }

    public function get_ajax_data_select_all()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->m_warehouse->get_data_warehouse_select_all($searchTerm);

        echo json_encode($response);
    }

    //locator

    public function locator($id_warehouse = '')
    {
        $data = [
            'title' => 'Manage Data Locator'
        ];

        if ($id_warehouse != '') {
            $data = [
                'title' => 'Manage Locator',
            ];
            //cari id warehouse
            $where = array(
                'md5(id)' => $id_warehouse,
                'deletedate IS NULL' => NULL
            );
            $data_warehouse = $this->m_app->select_global('tb_warehouse', $where);
            if ($data_warehouse->num_rows() > 0) {
                $data['id_warehouse'] = $data_warehouse->row()->id;
                $data['data_warehouse'] = $data_warehouse->row_array();
                $this->template->load('layout/v_layout', 'warehouse/v_locator', $data);
            } else {
                redirect(site_url());
            }
        } else {
            $data = [
                'title' => 'Choose Warehouse',
                'tipe' => 'locator'
            ];
            if ($this->db->select('wh_level') == '3') {
                redirect(site_url());
            }
            $this->template->load('layout/v_layout', 'warehouse/v_choose_warehouse', $data);
        }
    }

    public function get_ajax_data_locator()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $data = $this->m_app->select_global('tb_warehouse_locator', array('id_warehouse' => $id_warehouse, 'deletedate IS NULL' => NULL))->result_array();
        //$data = $this->m_warehouse->get_data_warehouse()->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data_locator()
    {
        $id = $this->input->post('id');

        $data = array(
            'name' => $this->input->post('name'),
            'id_warehouse' => $this->input->post('id_warehouse'),
        );

        //check duplicate name
        $where = $data;
        $where['deletedate IS NULL'] = NULL;

        $check_data = $this->m_app->select_global('tb_warehouse_locator', $where);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Nama Unit Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }

        if ($id == '' || $id == NULL) {
            $id = $this->m_app->insert_global('tb_warehouse_locator', $data);
            if ($id > 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Gagal Disimpan',
                    'data' => array()
                ));
            }
        } else {
            $update = $this->m_app->update_global('tb_warehouse_locator', array('id' => $id), $data);
            if ($update >= 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Gagal Disimpan',
                    'data' => array()
                ));
            }
        }
    }

    public function delete_data_locator()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_warehouse_locator', array('id' => $id), $data);
        if ($update >= 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data Berhasil Dihapus',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Gagal Dihapus',
                'data' => array()
            ));
        }
    }

    public function get_ajax_data_select_locator()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');

        $response       = $this->m_warehouse->get_data_locator_select($searchTerm, $id_warehouse);

        echo json_encode($response);
    }

    //role warehouse
    public function role($id_warehouse = '')
    {
        $data = [
            'title' => 'Manage Data Warehouse Role'
        ];

        if ($id_warehouse != '') {
            $data = [
                'title' => 'Manage Data Warehouse Role'
            ];
            //cari id warehouse
            $where = array(
                'md5(id)' => $id_warehouse,
                'deletedate IS NULL' => NULL
            );
            $data_warehouse = $this->m_app->select_global('tb_warehouse', $where);
            if ($data_warehouse->num_rows() > 0) {
                $data['id_warehouse'] = $data_warehouse->row()->id;
                $data['data_warehouse'] = $data_warehouse->row_array();
                $this->template->load('layout/v_layout', 'warehouse/v_role', $data);
            } else {
                redirect(site_url('warehouse/role'));
            }
        } else {
            $data = [
                'title' => 'Choose Warehouse',
                'tipe' => 'role'
            ];
            $this->template->load('layout/v_layout', 'warehouse/v_choose_warehouse', $data);
        }
    }

    public function get_ajax_data_role()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        //$data = $this->m_app->select_global('tb_warehouse_user', array('id_warehouse' => $id_warehouse))->result_array();
        $data = $this->m_warehouse->get_data_role(array('id_warehouse' => $id_warehouse))->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data_role()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $id_user = $this->input->post('id_user');

        $data = array(
            'id_warehouse' => $id_warehouse,
            'id_user' => $id_user,
        );

        //check duplicate name

        $check_data = $this->m_app->select_global('tb_warehouse_user', $data);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Role Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }

        //insert data
        $this->m_app->insert_global('tb_warehouse_user', $data);
        $check_data = $this->m_app->select_global('tb_warehouse_user', $data);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data Berhasil Disimpan',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Gagal Disimpan',
                'data' => array()
            ));
        }
    }

    public function delete_data_role()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $id_user = $this->input->post('id_user');
        
        // echo $id_warehouse;
        // echo $id_user;
        // die();
        $data = array(
            'id_warehouse' => $id_warehouse,
            'id_user' => $id_user,
        );

        $delete = $this->m_app->delete_global('tb_warehouse_user', $data);
        if ($delete >= 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data Berhasil Dihapus',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Gagal Dihapus',
                'data' => array()
            ));
        }
    }

    public function get_ajax_data_user()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');

        $response       = $this->m_user->get_user_not_in_warehouse($searchTerm, $id_warehouse);

        echo json_encode($response);
    }

    //export sample data
    public function export_sample_data()
    {
        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);

        $baris = 3;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data Warehouse');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:D1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Code Warehouse')
            ->setCellValue('B2', 'Name Warehouse')
            ->setCellValue('C2', 'Address Warehouse')
            ->setCellValue('D2', 'Latitude')
            ->setCellValue('E2', 'Longitude');

        foreach (range('A', 'E') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_wh.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function save_upload_data()
    {
        $file_trx = $_FILES;
        $config['upload_path'] = 'files/temp/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '200000'; // max_size in kb
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 100;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!($this->upload->do_upload('file_template')) || $file_trx['file_template']['error'] != 0) {
            echo json_encode(array(
                'code'    => 500,
                'message' => 'File gagal diupload',
            ));
        } else {
            $data = $this->upload->data();
            // Load plugin PHPExcel nya
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($config['upload_path'] . $data['file_name']); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getSheet(0)->toArray(null, true, true, true);
            $numrow = 1;
            $message = '';

            foreach ($sheet as $row) {
                if ($numrow > 2) {

                    if ($row['A'] == '' || $row['B'] == '' || $row['C'] == '' || $row['D'] == '' || $row['E'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah username sudah ada
                        $where['name'] = $row['A'];
                        $select = $this->m_app->select_global('tb_warehouse', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data username sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        }

                        $datau = [
                            'code' => $row['A'],
                            'name' => $row['B'],
                            'address' => $row['C'],
                            'latitude' => $row['D'],
                            'longitude' => $row['E'],
                        ];

                        $insert = $this->m_app->insert_global('tb_warehouse', $datau);
                        if ($insert > 0) {
                            $message .= 'Baris ke-' . $numrow . ' berhasil disimpan..<br>';
                        } else {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid.<br>';
                        }
                    }
                }
                $numrow++;
            }
            $file = $config['upload_path'] . $data['file_name'];
            if (file_exists($file)) {
                unlink($file);
            }

            echo json_encode(array(
                'code' => 200,
                'message' => $message
            ));
        }
    }

    public function export_sample_data_locator()
    {
        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);

        // $baris = 3;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data Locator Warehouse');
        // $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:D1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Name Locator');

        // foreach (range('A', 'D') as $columnID) {
        //     $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        // }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_wh_locator.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function save_upload_data_locator()
    {
        $file_trx = $_FILES;
        $config['upload_path'] = 'files/temp/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '200000'; // max_size in kb
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 100;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!($this->upload->do_upload('file_template')) || $file_trx['file_template']['error'] != 0) {
            echo json_encode(array(
                'code'    => 500,
                'message' => 'File gagal diupload',
            ));
        } else {
            $data = $this->upload->data();
            // Load plugin PHPExcel nya
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007()   ;
            $loadexcel = $excelreader->load($config['upload_path'] . $data['file_name']); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getSheet(0)->toArray(null, true, true, true);
            $numrow = 1;
            $message = '';
            $id_warehouse = $this->input->post('id_warehouse');

            foreach ($sheet as $row) {
                if ($numrow > 2) {

                    if ($row['A'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah username sudah ada
                        $where['name'] = $row['A'];
                        $where['id_warehouse'] = $id_warehouse;
                        $select = $this->m_app->select_global('tb_warehouse_locator', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data username sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        }

                        $datau = [
                            'name' => $row['A'],
                            'id_warehouse' => $id_warehouse,
                        ];

                        $insert = $this->m_app->insert_global('tb_warehouse_locator', $datau);
                        if ($insert > 0) {
                            $message .= 'Baris ke-' . $numrow . ' berhasil disimpan..<br>';
                        } else {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid.<br>';
                        }
                    }
                }
                $numrow++;
            }
            $file = $config['upload_path'] . $data['file_name'];
            if (file_exists($file)) {
                unlink($file);
            }

            echo json_encode(array(
                'code' => 200,
                'message' => $message
            ));
        }
    }

    public function project($id_warehouse = '')
    {
        $data = [
            'title' => 'Manage Data Project'
        ];

        if ($id_warehouse != '') {
            $data = [
                'title' => 'Manage Project',
            ];
            // echo $id_warehouse;
            //cari id warehouse
            $where = array(
                'md5(id)' => $id_warehouse,
                'deletedate IS NULL' => NULL
            );
            $data_warehouse = $this->m_app->select_global('tb_warehouse', $where);
            if ($data_warehouse->num_rows() > 0) {
                $data['id_warehouse'] = $data_warehouse->row()->id;
                $data['data_warehouse'] = $data_warehouse->row_array();
                $this->template->load('layout/v_layout', 'warehouse/v_project', $data);
            } else {
                redirect(site_url());
            }
        } else {
            $data = [
                'title' => 'Choose Warehouse',
                'tipe' => 'project'
            ];
            if ($this->db->select('wh_level') == '3') {
                redirect(site_url());
            }
            $this->template->load('layout/v_layout', 'warehouse/v_choose_warehouse', $data);
        }
    
    }

    public function get_ajax_data_project()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $data = $this->m_app->select_global('tb_warehouse_project', array('id_warehouse' => $id_warehouse, 'deletedate IS NULL' => NULL))->result_array();
        
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data_project(){
        $id = $this->input->post('id');

        $data = array(
            'name' => $this->input->post('name'),
            'id_warehouse' => $this->input->post('id_warehouse'),
        );

        //check duplicate name
        $where = $data;
        $where['deletedate IS NULL'] = NULL;

        $check_data = $this->m_app->select_global('tb_warehouse_locator', $where);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Nama Unit Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }

        if ($id == '' || $id == NULL) {
            $id = $this->m_app->insert_global('tb_warehouse_project', $data);
            if ($id > 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Gagal Disimpan',
                    'data' => array()
                ));
            }
        } else {
            $update = $this->m_app->update_global('tb_warehouse_project', array('id' => $id), $data);
            if ($update >= 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data Gagal Disimpan',
                    'data' => array()
                ));
            }
        }
    }
    public function delete_data_project()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_warehouse_project', array('id' => $id), $data);
        if ($update >= 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data Berhasil Dihapus',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data Gagal Dihapus',
                'data' => array()
            ));
        }
    }
}
