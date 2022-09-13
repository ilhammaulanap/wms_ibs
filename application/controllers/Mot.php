<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_mot');
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Data MOT'
        ];

        $this->template->load('layout/v_layout', 'mot/v_mot', $data);
    }

    public function get_ajax_data_mot()
    {
        $data = $this->m_app->select_global('tb_mot', array('deletedate IS NULL' => NULL))->result_array();
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
            'name' => strtoupper($this->input->post('name')),
        );

        if ($id == '' || $id == NULL) {
            $id = $this->m_app->insert_global('tb_mot', $data);
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
            $update = $this->m_app->update_global('tb_mot', array('id' => $id), $data);
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

        $update = $this->m_app->update_global('tb_mot', array('id' => $id), $data);
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

    public function get_ajax_data()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');

        $response       = $this->m_mot->get_array_id($searchTerm);

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

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Import Data MOT');
        //$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1');

        //Set Judul Kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nama MOT');

        foreach (range('A', 'A') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="template_data_mot.xlsx"');
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

                    if ($row['A'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek apakah data sudah ada
                        $where['name'] = strtoupper($row['A']);
                        $select = $this->m_app->select_global('tb_mot', $where);
                        if ($select->num_rows() > 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data username sudah ada di database.<br>';
                            $numrow++;
                            continue;
                        } else {
                            $where = array();
                        }

                        $datau = [
                            'name' => strtoupper($row['A']),
                        ];

                        $insert = $this->m_app->insert_global('tb_mot', $datau);
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
