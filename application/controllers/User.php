<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_user');
    }

    public function index()
    {
        $data = [
            'title' => 'Manage User Data'
        ];

        $this->template->load('layout/v_layout', 'user/v_user', $data);
    }

    //get ajax select2 
    public function get_ajax_data()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_user->get_array_id_level($searchTerm);

        echo json_encode($response);
    }

    public function get_ajax_data_user()
    {
        $data = $this->m_user->get_data_user()->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    //simpan data user
    public function save_data()
    {
        $id = $this->input->post('id');

        $data = [
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'id_level' => $this->input->post('id_level'),
            'status' => $this->input->post('status'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        //check username
        $check_data = $this->m_app->select_global('tb_user', array('username' => $data['username'], 'id!=' => $id, 'deletedate IS NULL' => NULL));
        if ($check_data->num_rows() > 0) {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Username sudah ada',
                'data' => array()
            ));
            return false;
        }

        if ($id == '' || $id == null) {
            //insert new record
            $id = $this->m_app->insert_global('tb_user', $data);
            if ($id > 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data User Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data User Gagal Disimpan',
                    'data' => array()
                ));
            }
        } else {
            //update existing
            if (strlen($this->input->post('password')) == 0) {
                unset($data['password']);
            }
            $update = $this->m_app->update_global('tb_user', array('id' => $id), $data);
            if ($update >= 0) {
                echo json_encode(array(
                    'code' => 200,
                    'message' => 'Data User Berhasil Disimpan',
                    'data' => array()
                ));
            } else {
                echo json_encode(array(
                    'code' => 500,
                    'message' => 'Data User Gagal Disimpan',
                    'data' => array()
                ));
            }
        }
    }

    //hapus data user
    public function delete_data()
    {
        $id = $this->input->post('id');

        $data = array(
            'deletedate' => date('Y-m-d')
        );

        $update = $this->m_app->update_global('tb_user', array('id' => $id), $data);

        if ($update >= 0) {
            echo json_encode(array(
                'code' => 200,
                'message' => 'Data User Berhasil Dihapus',
                'data' => array()
            ));
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'Data User Gagal Dihapus',
                'data' => array()
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

        $baris = 3;

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data User');
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:F1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Username')
            ->setCellValue('B2', 'Nama')
            ->setCellValue('C2', 'Email')
            ->setCellValue('D2', 'Level (1/2/3)')
            ->setCellValue('E2', 'Status (1/0)')
            ->setCellValue('F2', 'Password');

        foreach (range('A', 'F') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_user.xlsx"');
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

                    if ($row['A'] == '' || $row['B'] == '' || $row['C'] == '' || $row['D'] == '' || $row['E'] == '' || $row['F'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah username sudah ada
                        $where['username'] = $row['A'];
                        $select = $this->m_app->select_global('tb_user', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data username sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }

                        //cek email apakah sudah ada
                        $where['email'] = $row['C'];
                        $select = $this->m_app->select_global('tb_user', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, email tidak dapat digunakan.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }

                        //cek apakah data level sudah sesuai
                        if (!in_array($row['D'], array('1', '2', '3'))) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, kolom D data tidak valid.<br>';
                            $numrow++;
                            continue;
                        }

                        //cek apakah data status sudah sesuai
                        if (!in_array($row['E'], array('1', '0'))) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, kolom E data tidak valid.<br>';
                            $numrow++;
                            continue;
                        }

                        $datau = [
                            'username' => $row['A'],
                            'name' => $row['B'],
                            'email' => $row['C'],
                            'id_level' => $row['D'],
                            'status' => $row['E'],
                            'password' => password_hash($row['E'], PASSWORD_DEFAULT),
                        ];

                        $insert = $this->m_app->insert_global('tb_user', $datau);
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
}
