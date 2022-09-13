<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;

class Outbound extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_inbound');
        $this->load->model('m_outbound');
        $this->load->model('m_product');
    }

    public function index()
    {
        $data = array(
            'title' => 'List Request Outbound',
            'level' => $this->session->userdata('wh_level'),
        );

        $this->template->load('layout/v_layout', 'outbound/v_index', $data);
    }

    public function order($mode = 'add', $id_outbound = '')
    {
        switch ($mode) {
            case 'edit':
                $data_outbound = $this->m_app->select_global('tb_outbound', array('md5(id)' => $id_outbound));
                if ($data_outbound->num_rows() > 0) {
                    $data = [
                        'title'     => 'Edit Order Outbound',
                        'id'        => $id_outbound,
                        'id_user'   => $this->session->userdata('wh_id'),
                        'name_user' => $this->session->userdata('wh_name'),
                        'mode'      => $mode,
                    ];

                    $this->template->load('layout/v_layout', 'outbound/v_form_order', $data);
                } else {
                    redirect(site_url('outbound/'));
                }
                break;
            case 'confirm':
                $data_outbound = $this->m_app->select_global('tb_outbound', array('md5(id)' => $id_outbound));

                if ($data_outbound->num_rows() > 0) {
                    $data = [
                        'title'     => 'Confirm Order Outbound',
                        'id'        => $id_outbound,
                        'id_user'   => $this->session->userdata('wh_id'),
                        'name_user' => $this->session->userdata('wh_name'),
                        'mode'      => $mode,
                    ];

                    $this->template->load('layout/v_layout', 'outbound/v_confirm_order', $data);
                } else {
                    redirect(site_url('outbound/confirm'));
                }
                break;
            case 'print_pl':
                $data_outbound = $this->m_app->select_global('tb_outbound', array('md5(id)' => $id_outbound));
                
                if ($data_outbound->num_rows() > 0) {
                    $data = array(
                        'id' => $id_outbound,
                        'header' => $this->m_outbound->get_outbound(['md5(to.id)' => $id_outbound]),
                        'body' => $this->m_outbound->get_outbound_detail(['md5(top.id_outbound)' => $id_outbound])
                    );
                    
                    $this->template->load('layout/v_layout', 'outbound/v_picking_list', $data);
                } else {
                    redirect(site_url('outbound/confirm'));
                }
                break;
            case 'pdf':
                $data_outbound = $this->m_app->select_global('tb_outbound', array('md5(id)' => $id_outbound));

                if ($data_outbound->num_rows() > 0) {
                    $data = array(
                        'header' => $this->m_outbound->get_outbound(['md5(to.id)' => $id_outbound]),
                        'body' => $this->m_outbound->get_outbound_detail(['md5(top.id_outbound)' => $id_outbound])
                    );

                    $html = $this->load->view('outbound/v_pl_pdf', $data, TRUE);
                    $mpdf = new \Mpdf\Mpdf();
                    $mpdf->WriteHTML($html);
                    $namefile = 'testing.pdf';
                    $mpdf->Output($namefile, 'I');
                } else {
                    redirect(site_url('outbound/'));
                }
                break;
            case 'pdfdn':
                $data_outbound = $this->m_app->select_global('tb_outbound', array('md5(id)' => $id_outbound));

                if ($data_outbound->num_rows() > 0) {
                    $data = array(
                        'header' => $this->m_outbound->get_outbound(['md5(to.id)' => $id_outbound]),
                        'body' => $this->m_outbound->get_outbound_detail(['md5(top.id_outbound)' => $id_outbound])
                    );
                    // print_r($data['body']->row());
                    // die();
                    $delivery_data = $this->m_app->select_global('tb_outbound_status', array('md5(id_outbound)' => $id_outbound, 'id_status_outbound' => '4'));
                    if ($delivery_data->num_rows() > 0) {
                        $data['delivery_date'] = date('Y-m-d', strtotime($delivery_data->row()->status_date));
                    } else {
                        $data['delivery_date'] = '';
                    }
                    // return $this->load->view('outbound/v_dn_pdf', $data);
                
                    // $header = $this->m_outbound->get_outbound(['md5(to.id)' => $id_outbound]);
                    // print_r($header->result_array());
                    // die();
                    $html = $this->load->view('outbound/v_dn_pdf', $data, TRUE);
                    $mpdf = new \Mpdf\Mpdf();
                    $mpdf->WriteHTML($html);
                    $namefile = 'testing.pdf';
                    $mpdf->Output($namefile, 'I');
                } else {
                    redirect(site_url('outbound/'));
                }
                break;
            case 'add':
                $data = [
                    'title'     => 'New Order Outbound',
                    'id'        => '',
                    'id_user'   => $this->session->userdata('wh_id'),
                    'name_user' => $this->session->userdata('wh_name'),
                    'mode'      => $mode,
                ];

                $this->template->load('layout/v_layout', 'outbound/v_form_order', $data);
                break;
            default:
                break;
        }
    }

    public function save_order()
    {
        $id = $this->input->post('id');

        $code_wh = '';
        $warehouse = $this->m_app->select_global('tb_warehouse', array('id' => $this->input->post('id_warehouse')));
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

        $data = array(
            'outbound_no'       => $this->m_outbound->get_last_no_outbound('Out', $code_wh),
            'outbound_date'     => $this->input->post('outbound_date'),
            'mr_no'             => $this->input->post('mr_no'),
            'po_no'             => $this->input->post('po_outbound'),
            'wu_no'             => $this->input->post('wu_no'),
            'id_warehouse'      => $this->input->post('id_warehouse'),
            'id_project'        => $this->input->post('id_project'),
            'site_id'           => $this->input->post('site_id'),
            'site_name'         => $this->input->post('site_name'),
            'site_wbs'          => $this->input->post('site_wbs'),
            'receiver_name'     => $this->input->post('receiver_name'),
            'destination'       => $this->input->post('destination'),
            'latitude'          => $this->input->post('latitude'),
            'longitude'         => $this->input->post('longitude'),
            'no_container'      => $this->input->post('no_container'),
            'id_vendor'         => $this->input->post('id_vendor'),
            'id_user'           => $this->session->userdata('wh_id'),
            'link_attach'       => urlencode($this->input->post('link_attach')),
            'lastupdate'        => date('Y-m-d H:i:s'),
        );

        //save header

        if ($id == '' || $id == null) {
            $id = $this->m_app->insert_global('tb_outbound', $data);

            if ($id <= 0) {
                echo json_encode(
                    [
                        'code' => 500,
                        'message' => 'Data Inbound Gagal Disimpan'
                    ]
                );
                return;
            }
        } else {
            unset($data['outbound_no']);
            $this->m_app->update_global('tb_outbound', array('id' => $id), $data);
        }

        //data detail
        $id_detail  = $this->input->post('id_detail');
        $id_detail_inbound = $this->input->post('id_detail_inbound');
        $qty        = $this->input->post('qty');
        $note        = $this->input->post('note');

        for ($i = 0; $i < sizeof($id_detail); $i++) {
           if($id_detail_inbound[$i] != null || $id_detail_inbound[$i] != "" ){
                $data_detail = array(
                    'id_outbound' => $id,
                    'id_inbound_product' => $id_detail_inbound[$i],
                    'qty' => $qty[$i],
                    'note' => $note[$i]
                );
            }else{
                $data_detail = array(
                    'id_outbound' => $id,
                    // 'id_inbound_product' => $id_detail_inbound[$i],
                    'qty' => $qty[$i],
                    'note' => $note[$i]
                );
            }     

            if ($id_detail[$i] == '0') {
                $this->m_app->insert_global('tb_outbound_product', $data_detail);
            } else {
                $this->m_app->update_global('tb_outbound_product', array('id' => $id_detail[$i]), $data_detail);
            }
        }

        //synchronize data trash
        $id_trash = $this->input->post('id_trash');
        $id_trash = explode(',', $id_trash);
        $this->m_outbound->sync_id_detail($id, $id_trash);

        $data_outbound = $this->m_app->select_global('tb_outbound', array('id' => $id));

        echo json_encode([
            'code' => 200,
            'message' => 'Data Outbound Berhasil Disimpan',
            'data' => $data_outbound->row_array(),
        ]);
    }

    public function info_order()
    {
        $id = $this->input->get('id');

        $header = $this->m_outbound->get_outbound(['md5(to.id)' => $id]);
        $body   = $this->m_outbound->get_outbound_detail(['md5(top.id_outbound)' => $id]);

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

    public function ajax_list_outbound()
    {
        $term = $this->input->post('term');
        $data = $this->m_outbound->get_list_outbound($term)->result_array();
        $receiver = array();

        foreach ($data as $key => $value) {
            $d = $value;
            $d['value'] = $value['outbound_no'] . '/' . $value['mr_no'];
            array_push($receiver, $d);
        }

        echo json_encode($receiver);
    }

    public function get_outbound_product()
    {
        $where['tot.id'] = $this->input->post('id_outbound');
        $data = $this->m_outbound->get_outbound_detail($where)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function save_inbound_bts($id_outbound = '', $tanggal_status = '')
    {
        
        //get outbound data
        $tb_outbound = $this->m_app->select_global('tb_outbound', array('id' => $id_outbound, 'deletedate IS NULL' => NULL));
        $tb_outbound_product = $this->m_app->select_global('tb_outbound_product', array('id_outbound' => $id_outbound));
        
        //check apakah data sudah ada atau belum
        $select = $this->m_app->select_global('tb_inbound_product', array('shipment_no' => $tb_outbound->row()->outbound_no));
        
        if ($select->num_rows() > 0) {
            //double check
            $select_detail = $this->m_app->select_global('tb_inbound_product', array('id' => $select->row()->id));
            if ($select_detail->num_rows() > 0) {
                //data sudah ada disimpan
                return true;
            } else {
                //delete data 
                $this->m_app->delete_global('tb_inbound', array('id' => $select->row()->id));
            }
        }

        //save inbound order
        $data = array(
            'inbound_no'        => $this->m_inbound->get_last_no_inbound(),
            'inbound_date'      => $tanggal_status,
            'po_no'             => $tb_outbound->row()->mr_no,
            'truck_no'          => $tb_outbound->row()->truck_no,
            'driver_name'       => $tb_outbound->row()->driver_name,
            'driver_contact'    => $tb_outbound->row()->driver_contact,
            'id_mot'            => $tb_outbound->row()->id_mot,
            'id_supplier'       => NULL,
            'id_warehouse'      => $tb_outbound->row()->id_warehouse,
            'id_user'           => get_id_user(),
            'lastupdate'        => date('Y-m-d H:i:s'),
        );

        $id_inbound = $this->m_app->insert_global('tb_inbound', $data);
        $data_detail = array();

        foreach ($tb_outbound_product->result() as $row) {
            $d_inbound = $this->m_app->select_global('tb_inbound_product', array('id' => $row->id_inbound_product));
            $data_detail[] = array(
                'id_inbound' => $id_inbound,
                'id_product' => $d_inbound->row()->id_product,
                'qty_product' => $row->qty,
                'id_locator' => $d_inbound->row()->id_locator,
                'id_product_status' => $d_inbound->row()->id_product_status,
                'photo' => $d_inbound->row()->photo,
                'shipment_no'       => $tb_outbound->row()->outbound_no,
            );
        }

        $this->m_app->insert_batch_global('tb_inbound_product', $data_detail);
    }

    public function save_order_status()
    {
        $data = $this->input->post();
        // print_r($data);
        // die();

        $check_status =  $this->m_outbound->get_outbound(['to.id' => $data['id_outbound']])->result_array();
        // echo 'status'.$check_status[0]['status_outbound'];
        if($check_status[0]['status_outbound'] == 3){
            echo json_encode(
                [
                    'code' => 400,
                    'message' => 'Data Outbound Gagal disimpan'
                ]
            );
            die();
        }
        else if(($data['status_outbound'] != 4) && ($data['status_outbound'] > ($check_status[0]['status_outbound']+1))){
            echo json_encode(
                [
                    'code' => 400,
                    'message' => 'Data Outbound Gagal disimpan'
                ]
            );
            die();
        }
        
        $status_date = date('Y-m-d', strtotime($data['status_date']));
        $status_time = date('H:i', strtotime($data['status_time']));
        $status_datetime = $status_date . ' ' . $status_time;

        $data_status = [
            'id_outbound' => $data['id_outbound'],
            'id_status_outbound' => $data['status_outbound'],
        ];

        
        $select_status = $this->m_app->select_global('tb_outbound_status', $data_status);
        
        $data_status_ = $data_status;
        $data_status_['status_date'] = $status_datetime;
        // print_r($data_status_);
        // die();
        if ($select_status->num_rows() > 0) {
            $this->m_app->update_global('tb_outbound_status', $data_status, $data_status_);
        } else {
            $this->m_app->insert_global('tb_outbound_status', $data_status_);
        }
        
        //update tb_outbound
        $data_outbound = [
            'status_outbound' => $data['status_outbound'],
            'lastupdate' => date('Y-m-d H:i:s'),
        ];
        
        if ($data['status_outbound'] == '3') {
            $data_outbound['file_dn'] = $this->upload_document('file_dn', './files/dn/');
        } else if ($data['status_outbound'] == '4') {
            //insert inbound baru dengan nomor po = mr no
            $this->save_inbound_bts($data['id_outbound'], $status_date);
            
        } else if ($data['status_outbound'] == '2') {
            $data_outbound['driver_name'] = $data['driver_name'];
            $data_outbound['truck_no'] = $data['truck_no'];
            $data_outbound['driver_contact'] = $data['driver_contact'];
            $data_outbound['id_mot'] = $data['id_mot'];
            // $data_outbound['id_vendor'] = $data['id_vendor'];
        }
        
        $this->m_app->update_outbound('tb_outbound', ['id' => $data['id_outbound']], $data_outbound);
        // print_r($data_outbound);
        // die();
        //update stock
        $id_detail = $this->input->post('id_detail');
        $qty_outbound = $this->input->post('qty_outbound');
        for ($i = 0; $i < sizeof($id_detail); $i++) {
            $this->m_app->update_global('tb_outbound_product', array('id' => $id_detail[$i]), array('qty' => $qty_outbound[$i]));
        }

        echo json_encode(
            [
                'code' => 200,
                'message' => 'Data Outbound Berhasil disimpan'
            ]
        );
    }

    public function ajax_outbound()
    {
        if($this->input->post('id_warehouse') == null){
            $where['to.id_warehouse']   = $_SESSION['wh_id_warehouse'];
        }else{
            $where['to.id_warehouse']   = $this->input->post('id_warehouse');
        }
        // die();
        
        if($where['to.id_warehouse'] != null){
            $data = $this->m_outbound->get_outbound($where)->result_array();
        }else{
            $data = $this->m_outbound->get_outbound()->result_array();
        }
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function history()
    {
        $data = array(
            'title' => 'History Outbound',
        );

        $this->template->load('layout/v_layout', 'outbound/v_history', $data);
    }

    public function get_ajax_data_select_wh()
    {
        $level = $this->session->userdata('wh_level');
        $id = $this->session->userdata('wh_id_warehouse');
        // print_r($level);
        // die();
        if($level == 3){
            // echo 'check user';
            $searchTerm = $this->m_outbound->get_warehouse_user($id)->result_array();
            $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm[0]['name']);
            echo json_encode($response);
        }else{
            // echo 'ada';
            $searchTerm = $this->m_outbound->get_warehouse_user($id)->result_array();
            if($id == null){
                $searchTerm = $this->input->post('searchTerm');
                $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm);
                // $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm);
            }else{
                $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm[0]['name']);
            }
            // $searchTerm = $this->input->post('searchTerm');
            // $response   = $this->m_outbound->get_array_id_warehouse2($searchTerm);
            echo json_encode($response);
        }
        
    }

    public function get_ajax_data_select_product()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');
        // print_r ($id_warehouse);
        $response       = $this->m_outbound->get_array_id_product_outbound($searchTerm, $id_warehouse);
        echo json_encode($response);
    }

    public function get_ajax_data_select_locator()
    {
        // Search term
        $searchTerm     = $this->input->post('searchTerm');
        $id_product     = $this->input->post('id_product');
        // print_r($id_product);
        $response       = $this->m_outbound->get_array_id_locator_outbound($searchTerm, $id_product);
        echo json_encode($response);
    }

    public function get_outbound_history()
    {
        $order = 'tot.lastupdate DESC';
        $where['tot.outbound_date>='] = $this->input->post('date1');
        $where['tot.outbound_date<='] = $this->input->post('date2');
        $where['tot.id_warehouse']   = $this->input->post('id_warehouse');
        $id_product = $this->input->post('id_product');
        $id_locator = $this->input->post('id_locator');

        if ($id_product != null) {
            $where['tip.id_product'] = $id_product;
        }

        if ($id_locator != null) {
            $where['tip.id_locator'] = $id_locator;
        }
        $data = $this->m_outbound->get_outbound_detail($where, $order)->result_array();
        $final['draw'] = 1;
        $final['recordsTotal'] = sizeof($data);
        $final['recordsFiltered'] = sizeof($data);
        $final['data'] = $data;
        echo json_encode($final);
    }

    public function get_outbound_history_single()
    {
        $order = '';
        $where['top.id_inbound_product'] = $this->input->post('id');
        $data = $this->m_outbound->get_outbound_detail($where, $order)->result_array();
        // print_r($data);
        echo json_encode($data);
    }

    public function upload_document($key, $directory = '')
    {
        $dir_path = $directory;
        $config['upload_path'] = $dir_path;
        $config['allowed_types'] = '*';
        $config['max_size'] = '2800';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload');

        $this->upload->initialize($config);
        if (!$this->upload->do_upload($key)) {
            return NULL;
        } else {
            $files_name = $this->upload->data()['file_name'];
            return $files_name;
        }
    }

    public function export_template_import_product_outbound()
    {
        $id_warehouse = $this->input->get('id_warehouse');

        //create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(11);
        $spreadsheet->getActiveSheet()->setTitle('DATA_IMPORT');

        //set column for import template
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'SERIAL NUMBER')
            ->setCellValue('B2', 'BOX ID')
            ->setCellValue('C2', 'DESCRIPTION')
            ->setCellValue('D2', 'PRODUCT CODE')
            ->setCellValue('E2', 'QTY')
            ->setCellValue('F2', 'LOCATOR');

        foreach (range('A', 'F') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        //create new sheet for master data product inventory
        $objWorkSheet = $spreadsheet->createSheet(1);
        $objWorkSheet
            ->setCellValue('A1', 'SERIAL NUMBER')
            ->setCellValue('B1', 'BOX ID')
            ->setCellValue('C1', 'DESCRIPTION')
            ->setCellValue('D1', 'PRODUCT CODE')
            ->setCellValue('E1', 'UOM')
            ->setCellValue('F1', 'LOCATOR')
            ->setCellValue('G1', 'QTY_IN')
            ->setCellValue('H1', 'QTY_PICK')
            ->setCellValue('I1', 'QTY_OUT')
            ->setCellValue('J1', 'AVAILABLE');

        $objWorkSheet->setTitle("PRODUCT_INVENTORY");

        $where['ti.id_warehouse'] = $id_warehouse;
        $data_product = $this->m_product->get_inventory_product($where);
        
        $i = 2;
        foreach ($data_product->result() as $row) {
            // echo  $row->product_code;
            // echo  '<br>';
            $qty_available = ($row->qty_in - ($row->qty_pick + $row->qty_out));
            $objWorkSheet
                ->setCellValue('A' . $i, $row->lot_number)
                ->setCellValue('B' . $i, $row->box_id)
                ->setCellValue('C' . $i, $row->product_name)
                // ->setCellValue('C' . $i, $row->product_code.' ')
                ->setCellValue('E' . $i, $row->product_uom)
                ->setCellValue('F' . $i, $row->locator)
                ->setCellValue('G' . $i, $row->qty_in)
                ->setCellValue('H' . $i, $row->qty_pick)
                ->setCellValue('I' . $i, $row->qty_out)
                ->setCellValue('J' . $i, $qty_available);
                $objWorkSheet->setCellValueExplicit('D' . $i,$row->product_code, DataType::TYPE_STRING);
            $i++;
        }
        // var_dump($data_product->result());
        // die();
        foreach (range('A', 'J') as $columnID) {
            $objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objWorkSheet->setAutoFilter('A1:J' . $i);
        // $objWorkSheet->getStyle('C1:C' . $i)
        // ->getNumberFormat()
        // ->setFormatCode('00000');
       

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="form_import_outbound_product.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function save_upload_data_product_outbound()
    {
        //$id_warehouse = $this->input->post('id_warehouse');
        $file_trx = $_FILES;
        $config['upload_path'] = 'files/temp/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '200000'; // max_size in kb
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 100;
        $this->load->library('upload');
        $this->upload->initialize($config);
        $data_i = [];

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
            // print_r($sheet);
            // die();
            foreach ($sheet as $row) {
                if ($numrow > 2) {
                    // print_r($row);
                    if ($row['C'] == '' || $row['D'] == '' || $row['E'] == '' || $row['F'] == '') {
                        $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
                        $numrow++;
                        continue;
                    } else {
                        //cek kode product
                        $kode = trim($row['D']);
                        $serial_number = trim($row['A']);
                        $box_id = trim($row['B']);
                        $qty = trim($row['E']);
                        $loc = trim($row['F']);
                        
                        //cek kode produk
                        // echo $kode;
                        // die();
                        $data_p = $this->m_app->select_global('tb_product', array('code' => $kode));
                        // print_r($data_p->result_array());
                        // die();
                        if ($data_p->num_rows() == 0) {
                            $message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data product tidak valid / kolom kosong.<br>';
                            $numrow++;
                            continue;
                        }

                        //cek stok pada inboud
                        $where['tp.code'] = $kode;
                        if ($serial_number != '' && $serial_number != null) {
                            $where['ti.lot_number'] = $serial_number;
                            $where['ti.locator'] = $loc;
                        }
                        if ($box_id != '' && $box_id != null) {
                            $where['ti.lot_number'] = $serial_number;
                            $where['ti.locator'] = $loc;
                            $where['ti.box_id'] = $box_id;
                        }
                        // print_r($where);
                        // die();
                        $inventory = $this->m_product->get_inventory_product($where);
                        // print_r($inventory->result_array());
                        // die();
                        if ($inventory->num_rows() > 0) {
                            
                            $inventory = $inventory->result_array();
                            $temp = array();
                            for ($i = 0; $i < sizeof($inventory); $i++) {
                                //outstanding
                                $stock = $inventory[$i]['qty_in'] - ($inventory[$i]['qty_pick'] + $inventory[$i]['qty_out']);
                                $temp[] = array(
                                    'po_no'         => $inventory[$i]['po_no'],
                                    'id_inbound'    => $inventory[$i]['id_detail'],
                                    'id_product'    => $inventory[$i]['id_product'],
                                    'product_code'  => $inventory[$i]['product_code'],
                                    'product_name'  => $inventory[$i]['product_name'],
                                    'qty_available' => $qty,
                                    'qty'           => $qty,
                                    'uom_product'   => $inventory[$i]['product_uom'],
                                    'locator'       => $inventory[$i]['locator'],
                                    'box_id'       => $inventory[$i]['box_id'],
                                );

                                if ($stock >= $qty) {
                                    $i = sizeof($inventory);
                                    $numrow++;
                                    continue;
                                }

                                $qty -= $stock;

                                if ($i == sizeof($inventory) - 1) {
                                    $temp = array();
                                    $message .= 'Baris ke-' . $numrow . ', stok produk tidak tersedia / kosong.<br>';
                                    $numrow++;
                                    continue;
                                }
                            }
                            // print_r($temp);
                            $data_i = array_merge($data_i, $temp);
                            // array_push($data_i,$temp);
                            // $data_i += $temp;
                            // print_r($data_i);
                        } else {
                            $message .= 'Baris ke-' . $numrow . ', stok produk tidak tersedia / kosong.<br>';
                            $numrow++;
                            continue;
                        }
                    }
                }
                $numrow++;
            }
            // return;
            // print_r($data_i);
            // die();
            $file = $config['upload_path'] . $data['file_name'];
            if (file_exists($file)) {
                unlink($file);
            }

            echo json_encode(array(
                'code' => 200,
                'message' => $message,
                'data_i' => $data_i,
            ));
        }
    }
}
