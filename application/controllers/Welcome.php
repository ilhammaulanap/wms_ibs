<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
			'title' => 'Dashboard',
		);
		$this->template->load('layout/v_layout', 'welcome/v_dashboard', $data);
	}

	public function ajax_summary()
	{
		$level = $this->session->userdata('wh_level');
		$idu = $this->session->userdata('wh_id');
		//get summary inbound
		$qty_in = 0;
		$qty_out = 0;
		$qty_on_hand = 0;
		if ($level == '1') {
			$data = $this->input->post();
			$where = array();
			if(!empty($data)){
				if ($data['id_warehouse'] != '') {
					$where['ti.id_warehouse'] = $data['id_warehouse'];
				}
			}			
			$data = $this->m_product->get_inventory_product($where)->result_array();
		}else{
			$id_warehouse = $this->m_app->select_global('tb_warehouse_user', array('id_user' => $idu));
			if ($id_warehouse->num_rows() > 0) {
				$id_warehouse = $id_warehouse->row()->id_warehouse;
				$where['ti.id_warehouse'] = $id_warehouse;
				$data = $this->m_product->get_inventory_product($where)->result_array();
			}else{
				$data = $this->input->post();
				$where = array();
				if(!empty($data)){
					if ($data['id_warehouse'] != '') {
						$where['ti.id_warehouse'] = $data['id_warehouse'];
					}
				}			
				$data = $this->m_product->get_inventory_product($where)->result_array();
			}
		}
		foreach ($data as $key => $value) {
			$qty_in = $qty_in + $value['qty_in'];
			$qty_out = $qty_out + $value['qty_out'];
			$qty_on_hand = $qty_on_hand + $value['available'];
		}
		$dateNow =  date("Y-m-d");
		$d=strtotime("-7 day");
		$date1 = date("Y-m-d", $d);
		$result=array();
		$i = 0;
		foreach($data as $key => $value)
		{
			if (strtotime($value['inbound_date']) <= strtotime($dateNow) && strtotime($value['inbound_date']) > strtotime($date1)) {
				if(!isset($result[$value['inbound_date']]))
				{
					$result[$value['inbound_date']]=array('date'=>$value['inbound_date'],'qty_in'=>0, 'qty_out'=>0, 'qty_on_hand' => 0);
				}
				$result[$value['inbound_date']]['date'] = $value['inbound_date'];
				$result[$value['inbound_date']]['qty_in']+=$value['qty_in'];
				$result[$value['inbound_date']]['qty_out']+=$value['qty_out'];
				$result[$value['inbound_date']]['qty_on_hand']+=$value['available'];
				$i ++;
			}
			
		}
		function cmp($a, $b) {
			return strcmp($a['date'], $b['date']);
		}
		
		usort($result, "cmp");
		$total_inbound = $this->m_inbound->get_header()->num_rows();
		$outbound_op = $this->m_app->select_global('tb_outbound', array('status_outbound' => '1', 'deletedate IS NULL' => NULL))->num_rows();
		$outbound_os = $this->m_app->select_global('tb_outbound', array('status_outbound' => '2', 'deletedate IS NULL' => NULL))->num_rows();
		$outbound_d = $this->m_app->select_global('tb_outbound', array('status_outbound' => '3', 'deletedate IS NULL' => NULL))->num_rows();
		// print_r($result);
		echo json_encode(
			array(
				'code' => 200,
				'total_qty_in' => $qty_in,
				'total_qty_out' => $qty_out,
				'total_qty_on_hand' => $qty_on_hand,
				'data_by_date' => $result,
				'inbound_total' => $total_inbound,
				'outbound_op' => $outbound_op,
				'outbound_os' => $outbound_os,
				'outbound_d' => $outbound_d,
			)
		);
	}
}
