<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;

class Inbound extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('m_inbound');
		$this->load->model('m_product');
	}

	public function index()
	{
		$data  = array(
			'title' => 'List Inbound',
			'level' => $this->session->userdata('wh_level'),
		);

		$this->template->load('layout/v_layout', 'inbound/v_list', $data);
	}

	public function asn()
	{
		$data  = array(
			'title' => 'List ASN',
			'level' => $this->session->userdata('wh_level'),
		);

		$this->template->load('layout/v_layout', 'inbound/asn/v_list', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Create Inbound',
			'id_user'   => $this->session->userdata('wh_id'),
			'name_user' => $this->session->userdata('wh_name'),
		];
		$this->template->load('layout/v_layout', 'inbound/v_form_header_inbound', $data);
	}

	public function edit($id_inbound = '')
	{

		$data = [
			'title'     => 'Edit Inbound',
			'id'        => $id_inbound,
			'id_user'   => $this->session->userdata('wh_id'),
			'name_user' => $this->session->userdata('wh_name'),
		];

		$this->template->load('layout/v_layout', 'inbound/v_form_detail_inbound', $data);
	}

	public function get_inbound()
	{
		$order = 'lastupdate, inbound_no ASC';
		// $where['ti.id_warehouse']   = $this->input->post('id_warehouse');
		// print_r($this->session->wh_id_warehouse);
		// echo $_SESSION['wh_id_warehouse'];
		if ($this->session->wh_id_warehouse == null) {
			$where['ti.id_warehouse']   = null;
		} else {
			$where['ti.id_warehouse']   = $_SESSION['wh_id_warehouse'];
		}
		// die();

		if ($where['ti.id_warehouse'] != null) {
			$data = $this->m_inbound->get_header($where, $order)->result_array();
		} else {
			$data = $this->m_inbound->get_header(array(), $order)->result_array();
		}

		$final['draw'] = 1;
		$final['recordsTotal'] = sizeof($data);
		$final['recordsFiltered'] = sizeof($data);
		$final['data'] = $data;
		echo json_encode($final);
	}

	public function get_inbound_history()
	{
		$order = 'lastupdate DESC';
		$where['ti.inbound_date>='] = $this->input->post('date1');
		$where['ti.inbound_date<='] = $this->input->post('date2');
		$where['ti.id_warehouse']   = $this->input->post('id_warehouse');
		$id_product = $this->input->post('id_product');
		$id_locator = $this->input->post('id_locator');
		$id_project = $this->input->post('id_project');

		if ($id_product != null) {
			$where['tid.id_product'] = $id_product;
		}

		if ($id_locator != null) {
			$where['tid.id_locator'] = $id_locator;
		}

		if ($id_project != null) {
			$where['ti.id_project'] = $id_project;
		}

		$data = $this->m_inbound->get_body_history($where, $order)->result_array();
		$final['draw'] = 1;
		$final['recordsTotal'] = sizeof($data);
		$final['recordsFiltered'] = sizeof($data);
		$final['data'] = $data;
		echo json_encode($final);
	}

	public function get_inbound_history_single()
	{
		$order = '';
		$where['tip.id_inbound'] = $this->input->post('id');
		$data = $this->m_inbound->get_inbound_detail($where, $order)->result_array();
		echo json_encode($data);
	}

	public function get_inbound_product()
	{
		$where['ti.id_warehouse'] = $this->input->post('id_warehouse');
		$where['tid.id_product']  = $this->input->post('id_product');
		// print_r($where);
		// die();
		$data = $this->m_inbound->get_detail_product_inbound($where)->result_array();
		$final['draw'] = 1;
		$final['recordsTotal'] = sizeof($data);
		$final['recordsFiltered'] = sizeof($data);
		$final['data'] = $data;
		echo json_encode($final);
	}

	public function order($mode = 'add', $id_inbound = '')
	{
		switch ($mode) {
			case 'edit':

				$data_inbound = $this->m_app->select_global('tb_inbound', array('md5(id)' => $id_inbound));
				if ($data_inbound->num_rows() > 0) {
					$data = [
						'title'     => 'Edit Order Inbound',
						'id'        => $id_inbound,
						'id_user'   => $this->session->userdata('wh_id'),
						'name_user' => $this->session->userdata('wh_name'),
						'mode'      => $mode,
					];

					$this->template->load('layout/v_layout', 'inbound/v_form_order', $data);
				} else {
					redirect(site_url('inbound/'));
				}
				break;
			default:
				$data = [
					'title'     => 'New Order Inbound',
					'id'        => '',
					'id_user'   => $this->session->userdata('wh_id'),
					'name_user' => $this->session->userdata('wh_name'),
					'mode'      => $mode,
				];

				$this->template->load('layout/v_layout', 'inbound/v_form_order', $data);
				break;
		}
	}

	public function create_asn()
	{
		$data = [
			'title'     => 'Create ASN',
			'id'        => '',
			'id_user'   => $this->session->userdata('wh_id'),
			'name_user' => $this->session->userdata('wh_name'),
		];

		$this->template->load('layout/v_layout', 'inbound/asn/v_form_header', $data);
	}

	public function update_asn($id_inbound = '')
	{
		$data = [
			'title'     => 'Update ASN',
			'id'        => $id_inbound,
			'id_user'   => $this->session->userdata('wh_id'),
			'name_user' => $this->session->userdata('wh_name'),
		];

		$this->template->load('layout/v_layout', 'inbound/asn/v_form_detail', $data);
	}

	public function create_inbound_asn($id_inbound = '')
	{
		$data = [
			'title'     => 'Create Inbound from ASN',
			'id'        => $id_inbound,
			'id_user'   => $this->session->userdata('wh_id'),
			'name_user' => $this->session->userdata('wh_name'),
		];

		$this->template->load('layout/v_layout', 'inbound/v_form_header_inbound', $data);
	}

	public function save_asn()
	{
		$data = [
			'est_inbound_date'      => $this->input->post('est_inbound_date'),
			// 'asn_no'                => $this->input->post('asn_no'),
			'po_no'                 => $this->input->post('po_no'),
			'no_container'          => $this->input->post('no_container'),
			'truck_no'              => $this->input->post('truck_no'),
			'driver_name'           => $this->input->post('driver_name'),
			'driver_contact'        => $this->input->post('driver_contact'),
			'id_mot'                => $this->input->post('id_mot'),
			'id_supplier'           => $this->input->post('id_supplier'),
			'id_warehouse'          => $this->input->post('id_warehouse'),
			'id_project'            => $this->input->post('id_project'),
			'id_vendor'             => $this->input->post('id_vendor'),
			// 'link_attach'           => urlencode($this->input->post('link_attach')),
			// 'id_user_tc'            => get_id_user(),
			'id_user_tc'            => $this->input->post('id_user_tc'),
			'status'                => 1,
			// 'lastupdate'        => date('Y-m-d H:i:s')
		];
		foreach ($data as $asn => $key) {
			if (empty(trim($data[$asn]))) {
				echo json_encode(array('code' => 500, 'message' => $asn . ' is required'));
				return;
			}
		}
		$warehouse = $this->m_app->select_global('tb_warehouse', array('id' => $data['id_warehouse'], 'deletedate' => NULL));
		$mot = $this->m_app->select_global('tb_mot', array('id' => $data['id_mot'], 'deletedate' => NULL));
		$supplier = $this->m_app->select_global('tb_supplier', array('id' => $data['id_supplier'], 'deletedate' => NULL));
		$project = $this->m_app->select_global('tb_warehouse_project', array('id' => $data['id_project'], 'deletedate' => NULL));
		$vendor = $this->m_app->select_global('tb_vendor', array('id' => $data['id_vendor'], 'deletedate' => NULL));

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
		if ($mot->num_rows() <= 0) {
			echo json_encode(array('code' => 500, 'message' => 'MOT not found'));
			return;
		}
		if ($supplier->num_rows() <= 0) {
			echo json_encode(array('code' => 500, 'message' => 'Supplier not found'));
			return;
		}
		if ($project->num_rows() <= 0) {
			echo json_encode(array('code' => 500, 'message' => 'Project not found'));
			return;
		}
		if ($vendor->num_rows() <= 0) {
			echo json_encode(array('code' => 500, 'message' => 'Vendor not found'));
			return;
		}
		if ($this->input->post('id') != null) {
			$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			if ($check_inbound->num_rows() <= 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data Advance Shipping Notice Not Found'
					]
				);
				return false;
			}
			$save = $this->m_app->update_global('tb_inbound', array('id' => $this->input->post('id')), $data);

			if ($save < 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data Advance Shipping Notice Gagal Diupdate'
					]
				);
				return false;
			}
			sumbit_log('Update ASN, id inbound : ' . $this->input->post('id'), get_id_user());
			$data = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
		} else {
			$data['asn_no'] = $this->m_inbound->get_last_no_asn('ASN', $code_wh);
			// print_r($data);
			// die();
			$save = $this->m_app->insert_global('tb_inbound', $data);
			if ($save <= 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data Advance Shipping Notice Gagal Disimpan'
					]
				);
				return false;
			}
			sumbit_log('Save ASN, id inbound : ' . $save, get_id_user());
			$data = $this->m_app->select_global('tb_inbound', array('id' => $save, 'deletedate' => NULL));
		}
		// header("Content-Type: application/json");
		echo json_encode(
			[
				'code' => 200,
				'message' => 'Data Advance Shipping Notice Success saved',
				'data' => $data->row_array()
			]
		);
		return;
	}

	public function get_asn()
	{
		try {
			$where = array();
			$term = '';
			$where['ti.deletedate'] =  NULL;
			if (!empty($this->input->get('id'))) {
				$where['ti.id'] =  $this->input->get('id');
			}
			if (!empty($this->input->get('id_warehouse'))) {
				$where['ti.id_warehouse'] =  $this->input->get('id_warehouse');
			}
			if (!empty($this->input->get('id_user_tc'))) {
				$where['ti.id_user_tc'] = $this->input->get('id_user_tc');
			}
			// if (!empty($this->input->get('status'))) {
			// 	$where['ti.status'] = $this->input->get('status');
			// }
			if (!empty($this->input->get('id_mot'))) {
				$where['ti.id_mot'] = $this->input->get('id_mot');
			}
			if (!empty($this->input->get('id_supplier'))) {
				$where['ti.id_supplier'] = $this->input->get('id_supplier');
			}
			if (!empty($this->input->get('id_project'))) {
				$where['ti.id_project'] = $this->input->get('id_project');
			}
			if (!empty($this->input->get('id_vendor'))) {
				$where['ti.id_vendor'] = $this->input->get('id_vendor');
			}
			if (!empty($this->input->get('date1'))) {
				if (empty($this->input->get('date2'))) {
					echo json_encode(array('code' => 500, 'message' => 'date2 is required'));
					return;
				}
				$where['ti.inbound_date>='] = $this->input->get('date1');
				$where['ti.inbound_date<='] = $this->input->get('date2');
			}
			if (!empty($this->input->get('est_inbound_date1'))) {
				if (empty($this->input->get('est_inbound_date2'))) {
					echo json_encode(array('code' => 500, 'message' => 'est_inbound_date2 is required'));
					return;
				}
				$where['ti.est_inbound_date>='] = $this->input->get('est_inbound_date1');
				$where['ti.est_inbound_date<='] = $this->input->get('est_inbound_date2');
			}
			if (!empty($this->input->get('no_asn'))) {
				$term = $this->input->get('no_asn');
			}
			// var_dump($where);
			// die();
			$data = $this->m_inbound->get_asn($where, $term)->result_array();


			$final['draw'] = 1;
			$final['recordsTotal'] = sizeof($data);
			$final['recordsFiltered'] = sizeof($data);
			$final['data'] = $data;
			echo json_encode($final);
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

	public function get_asn_detail()
	{
		try {
			$where = array();
			$where['ti.deletedate'] =  NULL;
			if (!empty($this->input->get('id'))) {
				$where['ti.id'] =  $this->input->get('id');
			} elseif (!empty($this->input->get('asn_no'))) {
				$where['ti.asn_no'] =  $this->input->get('asn_no');
			} else {
				echo json_encode(array('code' => 500, 'message' => 'id is required'));
				return;
			}
			$data = $this->m_inbound->get_asn($where);
			if ($data->num_rows() != 0) {
				$data = $data->row_array();
				$data_detail = $this->m_inbound->get_detail_product_asn($where)->result_array();
				$data['inbound_product'] = $data_detail;
				$final['code'] = 200;
				$final['message'] = 'Data found';
			} else {
				$data = $data->row_array();
				$final['code'] = 500;
				$final['message'] = 'Data not found';
			}
			$final['status'] = true;
			$final['data'] = $data;
			echo json_encode($final);
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

	public function save_asn_product()
	{
		try {
			$data = [
				'id_inbound'            => $this->input->post('id_inbound'),
				'id_product'            => $this->input->post('id_product'),
				'lot_number'            => $this->input->post('lot_number'),
				'shipment_no'           => $this->input->post('shipment_no'),
				'box_id'                => $this->input->post('box_id'),
				'site_id'               => $this->input->post('site_id'),
				'est_qty_product'       => $this->input->post('est_qty_product'),
				'site_id'       		=> $this->input->post('site_id'),
			];
			foreach ($data as $asn => $key) {
				if (empty($data[$asn]) || $data[$asn] == NULL) {
					echo json_encode(array('code' => 500, 'message' => $asn . ' is required'));
					return;
				}
			}
			$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id_inbound'), 'deletedate' => NULL));
			$check_product = $this->m_app->select_global('tb_product', array('id' => $this->input->post('id_product'), 'deletedate' => NULL));

			if ($check_inbound->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Asn not found'));
				return;
			}
			if ($check_product->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Product not found'));
				return;
			}
			if (!empty($this->input->post('id'))) {
				$check_inbound_product = $this->m_app->select_global('tb_inbound_product', array('id' => $this->input->post('id'), 'deletedate' => NULL));

				if ($check_inbound_product->num_rows() <= 0) {
					echo json_encode(array('code' => 500, 'message' => 'id not found'));
					return;
				} else {
					$save = $this->m_app->update_global('tb_inbound_product', array('id' => $this->input->post('id')), $data);
					if ($save < 0) {
						echo json_encode(
							[
								'code' => 500,
								'message' => 'Data Advance Shipping Notice Product Gagal Diupdate'
							]
						);
						return false;
					}
					sumbit_log('Update ASN Product, id inbound : ' . $this->input->post('id'), get_id_user());
				}
			} else {
				$save = $this->m_app->insert_global('tb_inbound_product', $data);
				if ($save <= 0) {
					echo json_encode(
						[
							'code' => 500,
							'message' => 'Data Advance Shipping Notice product Gagal Disimpan'
						]
					);
					return false;
				}
				sumbit_log('Save ASN, id inbound : ' . $save, get_id_user());
			}
			$where['ti.id'] =  $this->input->get('id');
			$data = $this->m_inbound->get_asn(array('ti.id' => $this->input->post('id_inbound')))->row_array();
			$data_detail = $this->m_inbound->get_detail_product_asn(array('ti.id' => $this->input->post('id_inbound')))->result_array();
			$data['inbound_product'] = $data_detail;
			$final['code'] = 200;
			$final['status'] = true;
			$final['message'] = 'Save data Success';
			$final['data'] = $data;
			echo json_encode($final);
			// var_dump($save);
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

	public function delete_asn()
	{
		try {
			if (empty($this->input->post('id'))) {
				echo json_encode(array('code' => 500, 'message' => 'id is required'));
				return;
			}
			$check_asn = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			if ($check_asn->num_rows() == 0) {
				echo json_encode(array('code' => 500, 'message' => 'id not found'));
				return;
			}
			$check_asn = $check_asn->row_array();
			if ($check_asn['status'] != 1) {
				echo json_encode(array('code' => 500, 'message' => 'data already inbound'));
				return;
			}

			$key2 = array('id' => $this->input->post('id'));
			$key3 = array('id_inbound' => $this->input->post('id'));
			$delete_inbound_product = $this->m_app->soft_delete_data('tb_inbound_product', $key3);
			$delete_inbound = $this->m_app->soft_delete_data('tb_inbound', $key2);
			echo json_encode(array(
				'code' => 200,
				'message' => 'Success Delete Data',
				'data' => null,
			));
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

	public function delete_asn_product()
	{
		try {
			if (empty($this->input->post('id'))) {
				echo json_encode(array('code' => 500, 'message' => 'id is required'));
				return;
			}
			$check_asn_product = $this->m_app->select_global('tb_inbound_product', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			if ($check_asn_product->num_rows() == 0) {
				echo json_encode(array('code' => 500, 'message' => 'id not found'));
				return;
			}
			$check_asn_product = $check_asn_product->row_array();
			$check_asn = $this->m_app->select_global('tb_inbound', array('id' => $check_asn_product['id_inbound']))->row_array();
			// var_dump($check_asn);
			// die();
			if ($check_asn['status'] != 1) {
				echo json_encode(array('code' => 500, 'message' => 'data already inbound'));
				return;
			}
			$key3 = array('id' => $this->input->post('id'));
			$delete_inbound_product = $this->m_app->soft_delete_data('tb_inbound_product', $key3);
			echo json_encode(array(
				'code' => 200,
				'message' => 'Success Delete Data',
				'data' => null,
			));
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

	public function save_inbound_header()
	{
		try {
			$id = $this->input->post('id');
			$data = array(
				'inbound_date'      => $this->input->post('inbound_date'),
				'po_no'             => $this->input->post('po_no'),
				'no_container'      => $this->input->post('no_container'),
				'truck_no'          => $this->input->post('truck_no'),
				'driver_name'       => $this->input->post('driver_name'),
				'driver_contact'    => $this->input->post('driver_contact'),
				'id_mot'            => $this->input->post('id_mot'),
				'id_supplier'       => $this->input->post('id_supplier'),
				'id_warehouse'      => $this->input->post('id_warehouse'),
				'id_project'        => $this->input->post('id_project'),
				'id_vendor'         => $this->input->post('id_vendor'),
				'link_attach'       => urlencode($this->input->post('link_attach')),
				// 'id_user'           => get_id_user(),
				// 'status'            => 2,
				'id_user'           => 1,
				'lastupdate'        => date('Y-m-d H:i:s'),
			);
			foreach ($data as $inbound => $key) {
				if (empty(trim($data[$inbound]))) {
					echo json_encode(array('code' => 500, 'message' => $inbound . ' is required'));
					return;
				}
			}
			$warehouse = $this->m_app->select_global('tb_warehouse', array('id' => $data['id_warehouse'], 'deletedate' => NULL));
			$mot = $this->m_app->select_global('tb_mot', array('id' => $data['id_mot'], 'deletedate' => NULL));
			$supplier = $this->m_app->select_global('tb_supplier', array('id' => $data['id_supplier'], 'deletedate' => NULL));
			$project = $this->m_app->select_global('tb_warehouse_project', array('id' => $data['id_project'], 'deletedate' => NULL));
			$vendor = $this->m_app->select_global('tb_vendor', array('id' => $data['id_vendor'], 'deletedate' => NULL));

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
			if ($mot->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'MOT not found'));
				return;
			}
			if ($supplier->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Supplier not found'));
				return;
			}
			if ($project->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Project not found'));
				return;
			}
			if ($vendor->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Vendor not found'));
				return;
			}
			if ($this->input->post('id') != null) {
				$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
				if ($check_inbound->num_rows() <= 0) {
					echo json_encode(
						[
							'code' => 500,
							'message' => 'Data inbound Not Found'
						]
					);
					return false;
				}
				$inbound = $check_inbound->row_array();
				if ($inbound['inbound_no'] == Null || $inbound['inbound_no'] == '') {
					$data['inbound_no'] = $this->m_inbound->get_last_no_inbound('In', $code_wh);
					$data['status'] = 2;
				}
				if (!empty($_FILES['photo_sj'])) {
					//remove old file
					$file = './files/suratjalan/' . $_FILES['photo_sj']['name'];

					if ($inbound['photo_sj'] != '') {
						unlink('./files/suratjalan/' . $inbound['photo_sj']);
					}
					$document_sj    = $this->upload_document('photo_sj', './files/suratjalan/');
					$data['photo_sj'] = $document_sj;
				}
				if (!empty($_FILES['photo_truck'])) {
					//remove old file
					if ($inbound['photo_truck'] != '') {
						unlink('./files/truck/' . $inbound['photo_truck']);
					}
					$document_truck = $this->upload_document('photo_truck', './files/truck/');
					$data['photo_truck'] = $document_truck;
				}

				$save = $this->m_app->update_global('tb_inbound', array('id' => $this->input->post('id')), $data);

				if ($save < 0) {
					echo json_encode(
						[
							'code' => 500,
							'message' => 'Data Advance Shipping Notice Gagal Diupdate'
						]
					);
					return false;
				}
				sumbit_log('Update Inbound, id inbound : ' . $this->input->post('id'), get_id_user());
				$data = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			} else {
				if (!empty($_FILES['photo_sj'])) {
					$document_sj    = $this->upload_document('photo_sj', './files/suratjalan/');
					$data['photo_sj'] = $document_sj;
					//remove old file
					$file = './files/suratjalan/' . $_FILES['photo_sj']['name'];
				} else {
					echo json_encode(array('code' => 500, 'message' => 'photo_sj is required'));
					return;
				}
				if (!empty($_FILES['photo_truck'])) {
					$document_truck = $this->upload_document('photo_truck', './files/truck/');
					$data['photo_truck'] = $document_truck;
					//remove old file
					$file = './files/truck/' . $_FILES['photo_truck']['name'];
				} else {
					echo json_encode(array('code' => 500, 'message' => 'photo_truck is required'));
					return;
				}
				$data['inbound_no'] = $this->m_inbound->get_last_no_inbound('In', $code_wh);
				$data['status'] = 3;
				// print_r($data);
				// die();
				$save = $this->m_app->insert_global('tb_inbound', $data);
				if ($save <= 0) {
					echo json_encode(
						[
							'code' => 500,
							'message' => 'Data Inbound Gagal Disimpan'
						]
					);
					return false;
				}
				sumbit_log('Save Inbound, id inbound : ' . $save, get_id_user());
				$data = $this->m_app->select_global('tb_inbound', array('id' => $save, 'deletedate' => NULL));
			}
			// header("Content-Type: application/json");
			echo json_encode(
				[
					'code' => 200,
					'message' => 'Data Inbound Success saved',
					'data' => $data->row_array()
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

	public function save_inbound_detail()
	{
		try {
			$data = [
				'id_inbound'            => $this->input->post('id_inbound'),
				'id_product'            => $this->input->post('id_product'),
				'lot_number'            => $this->input->post('lot_number'),
				'shipment_no'           => $this->input->post('shipment_no'),
				'box_id'                => $this->input->post('box_id'),
				'id_locator'       		=> $this->input->post('id_locator'),
				'qty_product'       	=> $this->input->post('qty_product'),
				'id_product_status'     => $this->input->post('id_product_status'),
				'site_id'       		=> $this->input->post('site_id'),
				'note'	       			=> $this->input->post('note'),
			];
			// var_dump($data);
			foreach ($data as $asn => $key) {
				if (empty($data[$asn]) || $data[$asn] == NULL) {
					echo json_encode(array('code' => 500, 'message' => $asn . ' is required'));
					return;
				}
			}
			$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id_inbound'), 'deletedate' => NULL));
			$check_product = $this->m_app->select_global('tb_product', array('id' => $this->input->post('id_product'), 'deletedate' => NULL));

			if ($check_inbound->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Inbound not found'));
				return;
			}
			if ($check_product->num_rows() <= 0) {
				echo json_encode(array('code' => 500, 'message' => 'Product not found'));
				return;
			}
			if (!empty($this->input->post('id'))) {
				$check_inbound_product = $this->m_app->select_global('tb_inbound_product', array('id' => $this->input->post('id'), 'deletedate' => NULL));

				if ($check_inbound_product->num_rows() <= 0) {
					echo json_encode(array('code' => 500, 'message' => 'id not found'));
					return;
				} else {
					$save = $this->m_app->update_global('tb_inbound_product', array('id' => $this->input->post('id')), $data);
					if ($save < 0) {
						echo json_encode(
							[
								'code' => 500,
								'message' => 'Data Inbound Product Gagal Diupdate'
							]
						);
						return false;
					}
					sumbit_log('Update Inbound Product, id inbound : ' . $this->input->post('id'), get_id_user());
				}
			} else {
				$save = $this->m_app->insert_global('tb_inbound_product', $data);
				if ($save <= 0) {
					echo json_encode(
						[
							'code' => 500,
							'message' => 'Data inbound product Gagal Disimpan'
						]
					);
					return false;
				}
				sumbit_log('Save inbound product, id inbound : ' . $save, get_id_user());
			}
			$where['ti.id'] =  $this->input->get('id');
			$data = $this->m_inbound->get_asn(array('ti.id' => $this->input->post('id_inbound')))->row_array();
			$data_detail = $this->m_inbound->get_detail_product_asn(array('ti.id' => $this->input->post('id_inbound')))->result_array();
			$data['inbound_product'] = $data_detail;
			$final['code'] = 200;
			$final['status'] = true;
			$final['message'] = 'Save data Success';
			$final['data'] = $data;
			echo json_encode($final);
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

	public function get_inbound_detail()
	{
		try {
			// echo 'ada';
			// die();
			$where = array();
			$where['ti.deletedate'] =  NULL;
			if (!empty($this->input->get('id'))) {
				$where['md5(ti.id)'] =  $this->input->get('id');
			} else {
				echo json_encode(array('code' => 500, 'message' => 'id is required'));
				return;
			}
			$data = $this->m_inbound->get_header_inbound($where);
			// var_dump($data->row_array());
			// die();
			if ($data->num_rows() != 0) {
				$data = $data->row_array();
				$data_detail = $this->m_inbound->get_detail_product_asn($where)->result_array();
				$data['inbound_product'] = $data_detail;
				$final['code'] = 200;
				$final['message'] = 'Data found';
			} else {
				$data = $data->row_array();
				$final['code'] = 500;
				$final['message'] = 'Data not found';
			}
			$final['status'] = true;
			$final['data'] = $data;
			echo json_encode($final);
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

	public function update_status_inbound()
	{
		try {
			$id = $this->input->post('id');
			if (empty(trim($id))) {
				echo json_encode(array('code' => 500, 'message' => 'Id is required'));
				return;
			}
			if (empty(trim($this->input->post('status')))) {
				echo json_encode(array('code' => 500, 'message' => 'Status is required'));
				return;
			}
			$data = [
				'status'      => $this->input->post('status'),
			];

			$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			if ($check_inbound->num_rows() <= 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'inbound Not Found'
					]
				);
				return false;
			}
			$save = $this->m_app->update_global('tb_inbound', array('id' => $this->input->post('id')), $data);

			if ($save < 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data Inbound Gagal Diupdate'
					]
				);
				return false;
			}
			sumbit_log('Update inbound, id inbound : ' . $this->input->post('id'), get_id_user());
			$data = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			echo json_encode(
				[
					'code' => 200,
					'message' => 'Data Inbound Success saved',
					'data' => $data->row_array()
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

	public function save_order()
	{
		$id = $this->input->post('id');
		$id_stock_transfer = $this->input->post('id_stock_transfer');
		$data = array(
			'inbound_date'      => $this->input->post('inbound_date'),
			'po_no'             => $this->input->post('po_no'),
			'no_container'       => $this->input->post('no_container'),
			'truck_no'          => $this->input->post('truck_no'),
			'driver_name'       => $this->input->post('driver_name'),
			'driver_contact'    => $this->input->post('driver_contact'),
			'id_mot'            => $this->input->post('id_mot'),
			'id_supplier'       => $this->input->post('id_supplier'),
			'id_warehouse'      => $this->input->post('id_warehouse'),
			'id_project'        => $this->input->post('id_project'),
			'id_vendor'        => $this->input->post('id_vendor'),
			'link_attach'       => urlencode($this->input->post('link_attach')),
			'id_user'           => get_id_user(),
			'lastupdate'        => date('Y-m-d H:i:s'),
		);

		$code_wh = '';
		$warehouse = $this->m_app->select_global('tb_warehouse', array('id' => $data['id_warehouse']));
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

		if ($id_stock_transfer != '' && $id_stock_transfer != null) {
			$data['inbound_no'] = $this->m_inbound->get_last_no_inbound('ST', $code_wh);
			$data['id_stock_transfer'] = $id_stock_transfer;
			//
			$this->m_app->update_global('tb_stock_transfer', array('id' => $id_stock_transfer), array('stock_transfer_status' => 'received'));
			//
		} else {
			$data['inbound_no'] = $this->m_inbound->get_last_no_inbound('In', $code_wh);
		}

		//save header
		// var_dump($data);
		// die();
		if ($id == '' || $id == null) {
			$id = $this->m_app->insert_global('tb_inbound', $data);

			if ($id <= 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data Inbound Gagal Disimpan'
					]
				);
				return false;
			}
			sumbit_log('Save Inbound, id inbound : ' . $id, get_id_user());
		} else {
			unset($data['inbound_no']);
			unset($data['id_user']);
			$this->m_app->update_global('tb_inbound', array('id' => $id), $data);
			sumbit_log('Update Inbound, id inbound : ' . $id, get_id_user());
		}

		//data detail
		$id_detail  = $this->input->post('id_detail');
		$id_product = $this->input->post('id_product');
		$lot_number = $this->input->post('lot_number');
		$box_id  = $this->input->post('box_id');
		$id_locator = $this->input->post('id_locator');
		$qty        = $this->input->post('qty');
		$id_trash   = $this->input->post('id_trash');
		$id_status  = $this->input->post('id_product_status');
		$shipment_no  = $this->input->post('shipment_no');
		$site_id  = $this->input->post('site_id');
		$note  = $this->input->post('note');


		for ($i = 0; $i < sizeof($id_detail); $i++) {
			$data_detail = array(
				'id_inbound'        => $id,
				'id_product'        => $id_product[$i],
				'lot_number'        => $lot_number[$i],
				'box_id'            => $box_id[$i],
				'qty_product'       => $qty[$i],
				'id_locator'        => $id_locator[$i],
				'id_product_status' => $id_status[$i],
				'shipment_no' => $shipment_no[$i],
				'site_id' => $site_id[$i],
				'note' => $note[$i],
			);

			if ($id_detail[$i] == '0') {
				$id_d = $this->m_app->insert_global('tb_inbound_product', $data_detail);

				// $_FILES['multipleUpload']['name']     = $name;
				// $_FILES['multipleUpload']['type']     = $files['type'][$i];
				// $_FILES['multipleUpload']['tmp_name'] = $files['tmp_name'][$i];
				// $_FILES['multipleUpload']['error']    = $files['error'][$i];
				// $_FILES['multipleUpload']['size']     = $files['size'][$i];
				// $foto_material = $this->upload_document('multipleUpload', './files/material/');
				// if ($foto_material != NULL) {
				//     $this->m_app->update_global('tb_inbound_product', array('id' => $id_d), array('photo' => $foto_material));
				// }
			} else {
				$id_d = $id_detail[$i];
				$this->m_app->update_global('tb_inbound_product', array('id' => $id_d), $data_detail);
				//get data detail
				$d_detail = $this->m_app->select_global('tb_inbound_product', array('id' => $id_d))->row_array();
				// if ($files['name'][$i] != '') {
				//     $_FILES['multipleUpload']['name']     = $name;
				//     $_FILES['multipleUpload']['type']     = $files['type'][$i];
				//     $_FILES['multipleUpload']['tmp_name'] = $files['tmp_name'][$i];
				//     $_FILES['multipleUpload']['error']    = $files['error'][$i];
				//     $_FILES['multipleUpload']['size']     = $files['size'][$i];
				//     $foto_material = $this->upload_document('multipleUpload', './files/material/');

				//     if ($foto_material != NULL) {
				//         $this->m_app->update_global('tb_inbound_product', array('id' => $id_d), array('photo' => $foto_material));
				//         //remove old file
				//         $file = './files/material/' . $d_detail['photo'];
				//         if (file_exists($file) && strlen($d_detail['photo']) > 0) {
				//             unlink($file);
				//         }
				//     }
				// }
			}
		}

		//synchronize data trash
		$id_trash = explode(',', $id_trash);
		$this->m_inbound->sync_id_detail($id, $id_trash);

		$data_inbound   = $this->m_app->select_global('tb_inbound', array('id' => $id))->row_array();
		if ($_FILES['photo_sj']['name'] != '') {
			$document_sj    = $this->upload_document('photo_sj', './files/suratjalan/');
			$update = array(
				'photo_sj' => $document_sj,
			);
			$this->m_app->update_global('tb_inbound', array('id' => $id), $update);

			//remove old file
			$file = './files/suratjalan/' . $data_inbound['photo_sj'];
			if (file_exists($file) && $data_inbound['photo_sj'] != '') {
				unlink($file);
			}
		}

		if ($_FILES['photo_truck']['name'] != '') {
			$document_truck = $this->upload_document('photo_truck', './files/truck/');
			$update = array(
				'photo_truck' => $document_truck
			);
			$this->m_app->update_global('tb_inbound', array('id' => $id), $update);

			//remove old file
			$file = './files/truck/' . $data_inbound['photo_truck'];
			if (file_exists($file) && $data_inbound['photo_truck'] != '') {
				unlink($file);
			}
		}

		echo json_encode([
			'code'      => 200,
			'message'   => 'Data Inbound Berhasil Disimpan',
			'data'      => $data_inbound,
		]);
	}

	public function info_order()
	{
		$id = $this->input->get('id');

		$header = $this->m_inbound->get_header(['md5(ti.id)' => $id]);
		$body   = $this->m_inbound->get_body(['md5(tid.id_inbound)' => $id]);

		if ($header->num_rows() > 0) {
			if ($body->num_rows() > 0) {
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
			return $this->upload->display_errors(); // NULL;
		} else {
			$files_name = $this->upload->data()['file_name'];
			return $files_name;
		}
	}

	public function history()
	{
		$data  = [
			'title' => 'History Inbound'
		];

		$this->template->load('layout/v_layout', 'inbound/v_history', $data);
	}

	public function get_ajax_data_select_asn()
	{
		// Search term
		$searchTerm     = $this->input->post('searchTerm');
		$id_warehouse     = $this->input->post('id_warehouse');
		if ($id_warehouse === '' || $id_warehouse == null) {
			$response = null;
		} else {
			$response = $this->m_inbound->get_asn_select2(['ti.id_warehouse' => $id_warehouse], $searchTerm);
		}

		echo json_encode($response);
	}

	public function get_ajax_data_select_wh()
	{
		$level = $this->session->userdata('wh_level');
		$id = $this->session->userdata('wh_id_warehouse');
		// print_r($id);
		// die();
		if ($level == 3) {
			// echo 'check user';
			$searchTerm = $this->m_inbound->get_warehouse_user($id)->result_array();
			$response   = $this->m_inbound->get_array_id_warehouse2($searchTerm[0]['name']);
			echo json_encode($response);
		} else {
			$searchTerm = $this->m_inbound->get_warehouse_user($id)->result_array();
			if ($id == null) {
				$searchTerm = $this->input->post('searchTerm');
				$response   = $this->m_inbound->get_array_id_warehouse2($searchTerm);
			} else {
				$response   = $this->m_inbound->get_array_id_warehouse2($searchTerm[0]['name']);
			}
			echo json_encode($response);
		}
	}

	public function get_ajax_data_select_product()
	{
		// Search term
		$searchTerm     = $this->input->post('searchTerm');
		$id_warehouse   = $this->input->post('id_warehouse');
		if ($id_warehouse === '' || $id_warehouse == null) {
			$response = [];
		} else {
			$response = $this->m_inbound->get_array_id_product_inbound($searchTerm, $id_warehouse);
		}
		echo json_encode($response);
	}

	public function get_ajax_data_select_locator()
	{
		// Search term
		$searchTerm     = $this->input->post('searchTerm');
		$id_product     = $this->input->post('id_product');
		if ($id_product === '' || $id_product == null) {
			$response = null;
		} else {
			$response = $this->m_inbound->get_array_id_locator_inbound($searchTerm, $id_product);
		}

		echo json_encode($response);
	}

	public function export_template_import_product_inbound()
	{
		$id_warehouse = $this->input->get('id_warehouse');
		if (empty(trim($id_warehouse))) {
			echo json_encode(array('code' => 500, 'message' => 'id warehouse is required'));
			return;
		}
		//create new spreadsheet
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		$spreadsheet->getActiveSheet()->setTitle('DATA_IMPORT');

		//set column for import template
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A2', 'PRODUCT CODE')
			->setCellValue('B2', 'DESCRIPTION')
			->setCellValue('C2', 'SERIAL NUMBER')
			->setCellValue('D2', 'BOX ID')
			->setCellValue('E2', 'SHIPMENT NUMBER')
			->setCellValue('F2', 'SITE ID')
			->setCellValue('G2', 'QTY')
			->setCellValue('H2', 'UOM')
			->setCellValue('I2', 'LOCATOR')
			->setCellValue('J2', 'STATUS (GOOD/DAMAGE/DISMANTLE)')
			->setCellValue('K2', 'NOTE');

		foreach (range('A', 'K') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		//create new sheet for master data product
		$objWorkSheet = $spreadsheet->createSheet(1);
		$objWorkSheet
			->setCellValue('A1', 'PRODUCT CODE')
			->setCellValue('B1', 'DESCRIPTION')
			->setCellValue('C1', 'UOM')
			->setCellValue('D1', 'LENGTH')
			->setCellValue('E1', 'WIDTH')
			->setCellValue('F1', 'HEIGHT')
			->setCellValue('G1', 'WEIGHT');

		$objWorkSheet->setTitle("PRODUCT");

		$data_product = $this->m_app->select_global('tb_product', array('deletedate IS NULL' => NULL));
		$i = 2;
		foreach ($data_product->result() as $row) {
			$uom = $this->m_app->select_global('tb_product_uom', array('id' => $row->id_uom));
			// var_dump($uom->row()->symbol);
			// die();
			if ($uom->num_rows() > 0) {
				$uom = $uom->row()->symbol;
			} else {
				$uom = '';
			}
			$objWorkSheet
				->setCellValue('B' . $i, $row->name)
				// ->setCellValue('B' . $i, $row->code)
				->setCellValue('C' . $i, $uom)
				->setCellValue('D' . $i, $row->length)
				->setCellValue('E' . $i, $row->width)
				->setCellValue('F' . $i, $row->height)
				->setCellValue('G' . $i, $row->weight);
			$objWorkSheet->setCellValueExplicit('A' . $i, $row->code, DataType::TYPE_STRING);
			$i++;
		}

		foreach (range('A', 'G') as $columnID) {
			$objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
		}
		$objWorkSheet->setAutoFilter('A1:G' . $i);

		//locator
		//create new sheet for master data product
		$objWorkSheet = $spreadsheet->createSheet(1);
		$objWorkSheet
			->setCellValue('A1', 'ID LOCATOR')
			->setCellValue('B1', 'NAMA LOCATOR');

		$objWorkSheet->setTitle("LOCATOR");

		$data_product = $this->m_app->select_global('tb_warehouse_locator', array('id_warehouse' => $id_warehouse, 'deletedate IS NULL' => NULL));
		$i = 2;
		foreach ($data_product->result() as $row) {
			$objWorkSheet
				->setCellValue('A' . $i, $row->id)
				->setCellValue('B' . $i, $row->name);
			$i++;
		}

		foreach (range('A', 'B') as $columnID) {
			$objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
		}
		$objWorkSheet->setAutoFilter('A1:B' . $i);


		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="form_import_inbound_product.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function save_upload_data_product_inbound()
	{
		$id = $this->input->post('id');
		$id_warehouse = $this->input->post('id_warehouse');
		if (empty(trim($id))) {
			echo json_encode(array('code' => 500, 'message' => 'id is required'));
			return;
		}
		if (empty(trim($id_warehouse))) {
			echo json_encode(array('code' => 500, 'message' => 'id warehouse is required'));
			return;
		}
		if (empty($_FILES['file_template'])) {
			echo json_encode(array('code' => 500, 'message' => 'File is required'));
			return;
		}
		$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
		if ($check_inbound->num_rows() <= 0) {
			echo json_encode(
				[
					'code' => 500,
					'message' => 'Data inbound Not Found'
				]
			);
			return false;
		}
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
			$numrow2 = 1;
			$message = '';


			foreach ($sheet as $row) {
				if ($numrow > 2) {

					if ($row['A'] == '' || $row['B'] == '' || $row['D'] == '' || $row['E'] == '' || $row['F'] == '' || $row['G'] == '' || $row['H'] == '' || $row['I'] == '' || $row['J'] == '') {
						$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';
						// $numrow++;
						continue;
					} else {
						//cek kode product
						$kode = trim($row['A']);
						$lot = trim($row['C']);
						$box_id = trim($row['D']);
						$shipment_no = trim($row['E']);
						$site_id = trim($row['F']);
						$qty = trim($row['G']);
						$uom = trim($row['H']);
						$locator = trim($row['I']);
						$status = trim($row['J']);
						$note = trim($row['K']);
						if (!is_numeric($qty)) {
							$message .= 'Baris ke-' . $numrow . 'QTY is must numeric.<br>';
							// $numrow++;
						}
						//cek kode produk
						$data_p = $this->m_app->select_global('tb_product', array('code' => $kode, 'deletedate' => NULL));
						if ($data_p->num_rows() == 0) {
							$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data product tidak valid / kolom kosong.<br>';
							$numrow++;
							continue;
						}

						//cek uom
						$data_u = $this->m_app->select_global('tb_product_uom', array('symbol' => $uom));
						if ($data_u->num_rows() == 0) {
							$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data uom tidak valid / kolom kosong.<br>';
							$numrow++;
							continue;
						}

						//locator
						$data_l = $this->m_app->select_global('tb_warehouse_locator', array('id_warehouse' => $id_warehouse, 'name' => $locator));
						if ($data_l->num_rows() == 0) {
							$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data locator tidak valid / kolom kosong.<br>';
							$numrow++;
							continue;
						}

						//status
						$data_s = $this->m_app->select_global('tb_product_status', array('name' => $status));
						if ($data_s->num_rows() == 0) {
							$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data status tidak valid / kolom kosong.<br>';
							$numrow++;
							continue;
						}

						$data_i[] = array(
							'id_product' => $data_p->row()->id,
							'shipment_no' => $shipment_no,
							'lot_number' => $lot,
							'box_id'    => $box_id,
							'site_id' => $site_id,
							'qty_product' => $qty,
							'id_locator' => $data_l->row()->id,
							'id_product_status' => $data_s->row()->id,
							'note' => $note,
						);
					}
				}
				$numrow++;
			}
			// print_r($data_i);
			// die();
			$file = $config['upload_path'] . $data['file_name'];
			if (file_exists($file)) {
				unlink($file);
			}

			if ($message != '') {
				echo json_encode(array(
					'code' => 400,
					'message' => $message,
					'data_i' => [],
				));
				return;
			} else {
				foreach ($data_i as $key => $val) {
					$data_i[$key]['id_inbound'] = $id;
					$numrow2++;
					$save = $this->m_app->insert_global('tb_inbound_product', $data_i[$key]);
					if ($save <= 0) {
						$message .= 'Baris ke-' . $numrow2 . ' gagal tersimpan, data product tidak valid / kolom kosong.<br>';
					} else {
						$data_i[$key]['id'] = $save;
						$data_j[] = $data_i[$key];
						sumbit_log('Save ASN, id inbound : ' . $save, get_id_user());
					}
				}
				if ($message != '') {
					echo json_encode(array(
						'code' => 400,
						'message' => $message,
						'data_i' => [],
					));
					return;
				} else {
					echo json_encode(array(
						'code' => 200,
						'message' => 'Success Upload Data',
						'data_i' => $data_j,
					));
					return;
				}
			}
		}
	}

	public function receive_stock_transfer()
	{
		$data = array(
			'title' => 'Receive Stock Transfer',
			'level' => $this->session->userdata('wh_level'),
		);

		$this->template->load('layout/v_layout', 'stocktransfer/v_form_receive', $data);
	}

	public function delete_order()
	{
		$id = $this->input->post('id');
		$key = array('md5(tip.id_inbound)' => $id);
		$key2 = array('md5(id)' => $id);
		$key3 = array('md5(id_inbound)' => $id);
		$check_outbound = $this->m_app->check_outbound($key);
		if ($check_outbound->num_rows() > 0) {
			echo json_encode(array(
				'code' => 400,
				'message' => 'Failed Delete Data',
				'data' => null,
			));
		} else {
			$delete_inbound_product = $this->m_app->soft_delete_data('tb_inbound_product', $key3);
			$delete_inbound = $this->m_app->soft_delete_data('tb_inbound', $key2);
			echo json_encode(array(
				'code' => 200,
				'message' => 'Success Delete Data',
				'data' => null,
			));
		}
	}



	public function export_template_import_product_asn()
	{
		$id_warehouse = $this->input->get('id_warehouse');

		//create new spreadsheet
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		$spreadsheet->getActiveSheet()->setTitle('DATA_IMPORT');

		//set column for import template
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A2', 'PRODUCT CODE')
			->setCellValue('B2', 'DESCRIPTION')
			->setCellValue('C2', 'SERIAL NUMBER')
			->setCellValue('D2', 'BOX ID')
			->setCellValue('E2', 'SHIPMENT NUMBER')
			->setCellValue('F2', 'SITE ID')
			->setCellValue('G2', 'EST QTY PRODUCT');

		foreach (range('A', 'G') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		//create new sheet for master data product
		$objWorkSheet = $spreadsheet->createSheet(1);
		$objWorkSheet
			->setCellValue('A1', 'DESCRIPTION')
			->setCellValue('B1', 'PRODUCT CODE')
			->setCellValue('C1', 'UOM')
			->setCellValue('D1', 'LENGTH')
			->setCellValue('E1', 'WIDTH')
			->setCellValue('F1', 'HEIGHT')
			->setCellValue('G1', 'WEIGHT');

		$objWorkSheet->setTitle("PRODUCT");

		$data_product = $this->m_app->select_global('tb_product', array('deletedate IS NULL' => NULL));
		$i = 2;
		foreach ($data_product->result() as $row) {
			$uom = $this->m_app->select_global('tb_product_uom', array('id' => $row->id_uom));
			// var_dump($uom->row()->symbol);
			// die();
			if ($uom->num_rows() > 0) {
				$uom = $uom->row()->symbol;
			} else {
				$uom = '';
			}
			$objWorkSheet
				->setCellValue('A' . $i, $row->name)
				// ->setCellValue('B' . $i, $row->code)
				->setCellValue('C' . $i, $uom)
				->setCellValue('D' . $i, $row->length)
				->setCellValue('E' . $i, $row->width)
				->setCellValue('F' . $i, $row->height)
				->setCellValue('G' . $i, $row->weight);
			$objWorkSheet->setCellValueExplicit('B' . $i, $row->code, DataType::TYPE_STRING);
			$i++;
		}

		foreach (range('A', 'G') as $columnID) {
			$objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
		}
		$objWorkSheet->setAutoFilter('A1:G' . $i);




		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="form_import_asn_product.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function save_upload_data_product_asn()
	{
		try {
			$id = $this->input->post('id');
			$id_warehouse = $this->input->post('id_warehouse');
			if (empty(trim($id))) {
				echo json_encode(array('code' => 500, 'message' => 'id is required'));
				return;
			}
			if (empty(trim($id_warehouse))) {
				echo json_encode(array('code' => 500, 'message' => 'id warehouse is required'));
				return;
			}
			if (empty($_FILES['file_template'])) {
				echo json_encode(array('code' => 500, 'message' => 'File is required'));
				return;
			}
			$check_inbound = $this->m_app->select_global('tb_inbound', array('id' => $this->input->post('id'), 'deletedate' => NULL));
			// var_dump($check_inbound->result_array());
			// die();
			if ($check_inbound->num_rows() <= 0) {
				echo json_encode(
					[
						'code' => 500,
						'message' => 'Data inbound Not Found'
					]
				);
				return false;
			}
			$file_trx = $_FILES;
			$config['upload_path'] = 'files/temp/';
			$config['allowed_types'] = 'xls|xlsx';
			$config['max_size'] = '200000'; // max_size in kb
			$config['encrypt_name'] = TRUE;
			$config['max_filename'] = 100;
			$this->load->library('upload');
			$this->upload->initialize($config);
			$data_i = [];
			$data_j = [];

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
				$numrow2 = 1;
				$message = '';

				foreach ($sheet as $row) {
					if ($numrow > 2) {

						// $numrow++;
						if ($row['A'] == '' || $row['B'] == '' || $row['D'] == '' || $row['E'] == '' || $row['F'] == '' || $row['G'] == '') {
							$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data tidak valid / kolom kosong.<br>';


							continue;
						} else {
							//cek kode product
							$kode = trim($row['A']);
							$lot = trim($row['C']);
							$box_id = trim($row['D']);
							$shipment_no = trim($row['E']);
							$site_id = trim($row['F']);
							$est_qty = trim($row['G']);
							//cek kode produk
							if (!is_numeric($est_qty)) {
								$message .= 'Baris ke-' . $numrow . 'est_qty is must numeric.<br>';
								// $numrow++;
							}
							$data_p = $this->m_app->select_global('tb_product', array('code' => $kode, 'deletedate' => NULL));
							if ($data_p->num_rows() == 0) {
								$message .= 'Baris ke-' . $numrow . ' gagal tersimpan, data product tidak valid / kolom kosong.<br>';
								// $numrow++;
								continue;
							}

							$data_i[] = array(
								'id_product' => $data_p->row()->id,
								'shipment_no' => $shipment_no,
								'lot_number' => $lot,
								'box_id'    => $box_id,
								'est_qty_product' => $est_qty,
								'site_id' => $site_id,
							);
						}
					}
					$numrow++;
				}
				// print_r($data_i);
				// die();
				$file = $config['upload_path'] . $data['file_name'];
				if (file_exists($file)) {
					unlink($file);
				}
				if ($message != '') {
					echo json_encode(array(
						'code' => 400,
						'message' => $message,
						'data_i' => [],
					));
					return;
				} else {
					foreach ($data_i as $key => $val) {
						$data_i[$key]['id_inbound'] = $id;
						// var_dump($data_i[$key]);
						// die();
						$numrow2++;
						$save = $this->m_app->insert_global('tb_inbound_product', $data_i[$key]);
						if ($save <= 0) {
							$message .= 'Baris ke-' . $numrow2 . ' gagal tersimpan, data product tidak valid / kolom kosong.<br>';
						} else {
							$data_i[$key]['id'] = $save;
							$data_j[] = $data_i[$key];
							sumbit_log('Save ASN, id inbound : ' . $save, get_id_user());
						}
					}
					echo json_encode(array(
						'code' => 200,
						'message' => 'Success Upload Data',
						'data_i' => $data_j,
					));
					return;
				}
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
}
