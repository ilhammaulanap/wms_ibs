<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barcode extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('m_inbound');
		$this->load->model('m_outbound');
		$this->load->model('m_product');
        // $this->load->library('zend');
        // $this->zend->load('zend/barcode');
        $this->load->library('Pdf');
	}

        public function index()
        {
            // print_r('ada');
            $data = [
                'title' => 'barcode',
            ];
            $this->template->load('layout/v_layout', 'barcode/v_barcode', $data);
        }
        public function getBarcode($kode){
            // print_r($kode);
            $code = explode("-",$kode);
            $data = [
                'title' => 'barcode',
                'code' => $code
            ];
            // $this->template->load('layout/v_layout', 'barcode/v_barcode', $data);
            $this->load->view('barcode/barcode_pdf', $data);
            // $this->load->view('barcode/v_barcode', $data);
        }
        // public function generate($kode)
        // {
        //     // print_r($kode);
        // //kita load library nya ini membaca file Zend.php yang berisi loader
        // //untuk file yang ada pada folder Zend
        // // $this->load->library('Zend');
         
        // return Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
        // // return;
        // }
}