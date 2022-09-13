<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_product');
    }

    public function _index($id_warehouse = '')
    {
        if ($id_warehouse != '') {
            $data = [
                'title' => 'Manage Product',
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
                $this->template->load('layout/v_layout', 'product/v_product', $data);
            } else {
                redirect(site_url('product'));
            }
        } else {
            $data = [
                'title' => 'Choose Warehouse',
            ];
            $this->template->load('layout/v_layout', 'product/v_warehouse', $data);
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Product',
        ];
        $this->template->load('layout/v_layout', 'product/v_product', $data);
    }

    public function get_ajax_data()
    {
        //$id_warehouse = $this->input->post('id_warehouse');
        $where = [
            //get_ajax_data'tp.id_warehouse' => $id_warehouse
        ];
        $data = $this->m_product->get_data_product($where)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data()
    {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $data = array(
            'code' => $this->m_product->get_last_code(),
            'name' => $this->input->post('name'),
            'id_uom' => $this->input->post('id_uom'),
            'id_category' => $this->input->post('id_category'),
            'length' => $this->input->post('length'),
            'width' => $this->input->post('width'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            //'id_warehouse' => $this->input->post('id_warehouse'),
        );

        // print_r($id);
        // die();
        //check duplicate name
        $where = array(
            'code' => $code,
            'deletedate IS NULL' => NULL,
            'id !=' => $id,
        );
        // print_r($where);
        // die();

        $check_data = $this->m_app->select_global('tb_product', $where);
        // print_r($check_data->result_array());
        // die();
        if ($check_data->num_rows() > 0) {
            // print_r('ada');
            // die();
            echo json_encode(array(
                'code' => 500,
                'message' => 'Nama Produk Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }


        if ($id == '' || $id == NULL) {
            if ($code != '' && $code != null) {
                $data['code'] = $code;
            }
            $id = $this->m_app->insert_global('tb_product', $data);
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
            // echo 'ada';
            // die();
            // if (strlen($code) > 0) {
            //     unset($data['code']);
            // }
            if ($code != '' && $code != null) {
                $data['code'] = $code;
            }else{
                unset($data['code']);
            }
            // print_r($data);
            // die();
            $update = $this->m_app->update_global('tb_product', array('id' => $id), $data);
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

    public function delete_data()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_product', array('id' => $id), $data);
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

    public function get_ajax_data_select()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_product->get_data_product_select($searchTerm);

        echo json_encode($response);
    }

    public function get_ajax_data_select_wh()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');

        $response       = $this->m_product->get_data_product_select_wh($searchTerm, $id_warehouse);

        echo json_encode($response);
    }

    public function get_ajax_data_select_wh_product()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');

        $response       = $this->m_product->get_data_product_select_wh_product($searchTerm, $id_warehouse);

        echo json_encode($response);
    }

    public function uom()
    {
        $data = [
            'title' => 'Manage Unit Product'
        ];

        $this->template->load('layout/v_layout', 'product/v_product_uom', $data);
    }

    public function category()
    {
        $data = [
            'title' => 'Manage Unit Product'
        ];

        $this->template->load('layout/v_layout', 'product/v_product_category', $data);
    }

    public function get_ajax_data_category()
    {
        $data = $this->m_app->select_global('tb_product_category', array('deletedate IS NULL' => NULL))->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data_category()
    {
        $id = $this->input->post('id');

        $data = array(
            'name_category' => $this->input->post('name_category'),
        );
        //check duplicate name

        $where = array(
            'name_category' => $data['name_category'],
            'deletedate IS NULL' => NULL,
        );
        $check_data = $this->m_app->select_global('tb_product_category', $where);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Nama Category Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }

        if ($id == '' || $id == NULL) {
            
            $id = $this->m_app->insert_global('tb_product_category', $data);
            
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
            $update = $this->m_app->update_global('tb_product_category', array('id' => $id), $data);
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

    public function delete_data_category()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_product_category', array('id' => $id), $data);
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

    //export sample data
    public function export_sample_data_category()
    {
        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);

        $baris = 3;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data Category Product');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:B1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Group Product Code');

        foreach (range('A') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_category_product.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function save_upload_data_category()
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

                    if ($row['A'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah name sudah ada
                        $where['name_category'] = $row['A'];
                        $where['deletedate'] = 'IS NULL';
                        $select = $this->m_app->select_global('tb_product_category', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }
                        $datau = [
                            'name_category' => $row['A'],
                        ];

                        $insert = $this->m_app->insert_global('tb_product_category', $datau);
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

    public function get_ajax_data_select_category()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_product->get_array_id_category($searchTerm);

        echo json_encode($response);
    }


    public function get_ajax_data_uom()
    {
        $data = $this->m_app->select_global('tb_product_uom', array('deletedate IS NULL' => NULL))->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_data_uom()
    {
        $id = $this->input->post('id');

        $data = array(
            'name' => $this->input->post('name'),
            'symbol' => $this->input->post('symbol'),
        );

        //check duplicate name

        $where = array(
            'name' => $data['name'],
            'deletedate IS NULL' => NULL,
        );
        $check_data = $this->m_app->select_global('tb_product_uom', $where);
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Nama Unit Telah Terdaftar',
                'data' => array()
            ));
            return false;
        }

        if ($id == '' || $id == NULL) {
            $id = $this->m_app->insert_global('tb_product_uom', $data);
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
            $update = $this->m_app->update_global('tb_product_uom', array('id' => $id), $data);
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
    

    public function delete_data_uom()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_product_uom', array('id' => $id), $data);
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

    public function get_ajax_data_select_uom()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_product->get_array_id_uom($searchTerm);

        echo json_encode($response);
    }

    public function get_ajax_data_select_product_status()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_product->get_array_id_product_status($searchTerm);

        echo json_encode($response);
    }

    public function inventory()
    {
        $data = [
            'title' => 'Inventory Item',
            'level' => $this->session->userdata('wh_level'),
        ];

        $this->template->load('layout/v_layout', 'product/v_inventory', $data);
    }

    public function ajax_dt_inventory()
    {
        $id_warehouse = $this->input->post('id_warehouse');
        $id_product = $this->input->post('id_product');
        $id_locator = $this->input->post('id_locator');
        $id_project = $this->input->post('id_project');
        $where = array();

        if ($id_warehouse != '') {
            $where['ti.id_warehouse'] = $id_warehouse;
        }

        if ($id_product != '') {
            $where['tp.id'] = $id_product;
        }

        if ($id_locator != '') {
            $where['ti.id_locator'] = $id_locator;
        }
        if ($id_project != ''){
            $where['ti.id_project'] = $id_project;
        }

        if($id_warehouse === '' || $id_warehouse == null){
            $data = [];      
            
        }else{
            $data = $this->m_product->get_inventory_product($where)->result_array();
        }
            $final['draw'] = 1;
            $final['recordsTotal'] = sizeof($data);
            $final['recordsFiltered'] = sizeof($data);
            $final['data'] = $data;
            echo json_encode($final);
    }

    public function get_ajax_data_select_product_inventory()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');
        if($id_warehouse === '' || $id_warehouse == null){
            $response = [];
        }else{
            $response = $this->m_product->get_array_id_product_inventory($searchTerm, $id_warehouse);
        }        
        echo json_encode($response);
    }

    public function get_ajax_data_select_locator_inventory()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_product   = $this->input->post('id_product');
        if($id_product === '' || $id_product == null){
            $response = [];
        }else{
            $response       = $this->m_product->get_array_id_locator_inventory($searchTerm, $id_product);
        }   
        
        echo json_encode($response);
    }

    //export sample data
    public function export_sample_data_uom()
    {
        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);

        $baris = 3;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data UoM Product');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:B1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Name')
            ->setCellValue('B2', 'Symbol');

        foreach (range('A', 'B') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_uom.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    

    public function save_upload_data_uom()
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

                    if ($row['A'] == '' || $row['B'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah name sudah ada
                        $where['name'] = $row['A'];
                        $select = $this->m_app->select_global('tb_product_uom', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }


                        //cek symbol apakah sudah ada
                        $where['symbol'] = $row['B'];
                        $select = $this->m_app->select_global('tb_product_uom', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, symbol tidak dapat digunakan.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }


                        $datau = [
                            'name' => $row['A'],
                            'symbol' => $row['B'],
                        ];

                        $insert = $this->m_app->insert_global('tb_product_uom', $datau);
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

    //export sample data
    public function export_sample_data()
    {
        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data Product');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:G1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Material Code')
            ->setCellValue('B2', 'Materi Name')
            ->setCellValue('C2', 'Product Group Code')
            ->setCellValue('D2', 'Length (m)')
            ->setCellValue('E2', 'Width (m)')
            ->setCellValue('F2', 'Height (m)')
            ->setCellValue('G2', 'Weight (kg)')
            ->setCellValue('H2', 'UoM');

        foreach (range('A', 'H') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_product.xlsx"');
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

                    if ($row['B'] == '' || $row['H'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah nama barang sudah ada
                        $where['code'] = trim($row['A']);
                        $where['deletedate IS NULL'] = NULL;
                        $select = $this->m_app->select_global('tb_product', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data product sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }

                        $uom = trim($row['H']);
                        $select = $this->m_app->select_global('tb_product_uom', array('symbol' => $uom, 'deletedate IS NULL' => NULL));
                        if ($select->num_rows() > 0) {
                            $id_uom = $select->row()->id;
                        } else {
                            $id_uom = $this->m_app->insert_global('tb_product_uom', array('name' => $uom, 'symbol' => $uom));
                            // $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data uom tidak ditemukan di database.<br>';
                            // $numrow++;
                            // continue;
                        }

                        $category = trim($row['C']);
                        
                        $select2 = $this->m_app->select_global('tb_product_category', array('name_category' => $category, 'deletedate IS NULL' => NULL));
                        
                        if ($select2->num_rows() > 0) {
                            $id_category = $select2->row()->id;
                        } else {
                            
                            $id_category = $this->m_app->insert_global('tb_product_category', array('name_category' => $category));
                        die();
                            // $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data uom tidak ditemukan di database.<br>';
                            // $numrow++;
                            // continue;
                        }

                        $datau = [
                            'code' => $this->m_product->get_last_code(),
                            'name' => trim($row['B']),
                            'id_category' => $id_category,
                            'length' => $row['D'],
                            'width' => $row['E'],
                            'height' => $row['F'],
                            'weight' => $row['G'],
                            'id_uom' => $id_uom,
                        ];

                        if (strlen($row['A']) > 0) {
                            $datau['code'] = trim($row['A']);
                        }
                        $insert = $this->m_app->insert_global('tb_product', $datau);
                        if ($insert > 0) {
                            $message .= 'Baris ke-' . $numrow . ' berhasil disimpan.<br>';
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
}
