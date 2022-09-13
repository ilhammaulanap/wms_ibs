<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('m_project');
    }


    public function get_ajax_project()
    {
        $searchTerm     = $this->input->post('searchTerm');
        $id_warehouse   = $this->input->post('id_warehouse');
        if($id_warehouse == null || $id_warehouse === ""){
            $data = [];
            echo json_encode($data);
        }else{
            $data = $this->m_project->get_data_project($id_warehouse);
            echo json_encode($data);    
        }
        
    }

}
