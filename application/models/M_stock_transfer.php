<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_stock_transfer extends CI_Model
{
    public function get_last_no_stock_transfer()
    {
        $params = date('Ymd') . 'ST';
        $this->db->select('stock_transfer_no');
        $this->db->from('tb_stock_transfer');
        $this->db->like('stock_transfer_no', $params, 'after');
        $this->db->order_by('stock_transfer_no', 'desc');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $code = $data->row()->stock_transfer_no;
            $cur_num = substr($code, strlen($params)) + 1;
            return $params . sprintf('%04d', $cur_num);
        } else {
            return $params . '0001';
        }
    }

    public function sync_id_detail($id_stock_transfer, $id_trash)
    {
        $this->db->where_in('id', $id_trash);
        $this->db->where('id_stock_transfer', $id_stock_transfer);
        $this->db->update('tb_stock_transfer_detail', array('deletedate' => date('Y-m-d H:i:s')));
        return $this->db->affected_rows();
    }

    private function _query_stocktransfer()
    {
        $this->db->select('tst.*, MD5(tst.id) md5_id, two.name warehouse_origin, 
                            twd.name warehouse_destination, tu.name name_creator, 
                            tu.id id_user_created, twp.name project_name');
        $this->db->select('COUNT(tsd.id) c_material, tib.id id_inbound, tbm.name mot,
                            tib.id_mot, tip.shipment_no,tib.id_supplier, tbs.name supplier, tib.truck_no, 
                            tib.driver_name, tib.driver_contact');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tsd', 'tst.id=tsd.id_stock_transfer');
        $this->db->join('tb_inbound ti', 'tst.id=ti.id_stock_transfer', 'LEFT');
        $this->db->join('tb_inbound_product tip', 'tsd.id_inbound_product=tip.id');
        $this->db->join('tb_inbound tib', 'tip.id_inbound=tib.id');
        $this->db->join('tb_mot tbm', 'tib.id_mot=tbm.id');
        $this->db->join('tb_supplier tbs', 'tib.id_supplier=tbs.id');
        $this->db->join('tb_warehouse two', 'tst.id_wh_origin=two.id');
        $this->db->join('tb_warehouse twd', 'tst.id_wh_destination=twd.id');
        $this->db->join('tb_user tu', 'tst.id_user=tu.id');
        $this->db->join('tb_warehouse_project twp', 'tst.id_project=twp.id');
        // echo $this->db->get_compiled_select();
        // die();
    }

    public function get_stocktransfer($where = array())
    {
        $this->_query_stocktransfer();
        
        $this->db->where($where);
        // echo $this->db->get_compiled_select();
        // die();
        $this->db->group_by('tst.id');
        // echo $this->db->get_compiled_select();
        // die();
        return $this->db->get();
    }

    public function get_stock($where = array())
    {
        // print_r($where);
        // die();
        $this->db->select('tst.*
        , two.name warehouse_origin, 
        twd.name warehouse_destination,twp.name project_name');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_warehouse two', 'tst.id_wh_origin=two.id');
        $this->db->join('tb_warehouse twd', 'tst.id_wh_destination=twd.id');
        $this->db->join('tb_warehouse_project twp', 'tst.id_project=twp.id');
        $this->db->where($where);
        return $this->db->get();
    }

    //search update status
    public function get_list_stocktransfer($term = '')
    {
        $this->_query_stocktransfer();
        $this->db->where("(tst.stock_transfer_no LIKE '%$term%')");
        $this->db->where_in('tst.stock_transfer_status', array('ordered'));
        $this->db->group_by('tst.id');
        
        return $this->db->get();
    }

    public function get_stocktransfer_detail($where = array(), $order = '')
    {
        $this->db->select('tsd.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tsd', 'tst.id=tsd.id_stock_transfer');
        $this->db->group_by('tsd.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('tsd.*'); //id detail, id inbound detail, qty, id outbound
        $this->db->select('tst.stock_transfer_no, tst.stock_transfer_date, tst.stock_transfer_status');
        $this->db->select('tp.id id_product, tp.code product_code, tp.name product_name, (tp.length*tp.height*tp.width) cbm, tp.weight');
        $this->db->select('twl.name locator, tps.id id_product_status, tps.name product_status, tpu.name uom, (tip.qty_product-IFNULL(top_2.qty_out,0))+tsd.qty available, tsd.qty');
        $this->db->select('ti.po_no, tip.lot_number,tip.shipment_no');
        $this->db->select('two.name warehouse_origin, twd.name warehouse_destination');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tsd', 'tst.id=tsd.id_stock_transfer');
        $this->db->join('tb_inbound_product tip', 'tsd.id_inbound_product=tip.id');
        $this->db->join('tb_warehouse two', 'tst.id_wh_origin=two.id');
        $this->db->join('tb_warehouse twd', 'tst.id_wh_destination=twd.id');
        $this->db->join("($top) top_2", 'tip.id=top_2.id', 'LEFT');
        $this->db->join('tb_inbound ti', 'tip.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tip.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_product_status tps', 'tip.id_product_status=tps.id');
        $this->db->join('tb_warehouse_locator twl', 'tip.id_locator=twl.id');
        $this->db->where($where);
        $this->db->order_by($order);
        return $this->db->get();
    }

    public function get_array_id_warehouse($term)
    {
        $this->db->select('two.id, two.name');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tsd', 'tst.id=tsd.id_stock_transfer');
        $this->db->join('tb_warehouse two', 'tst.id_wh_origin=two.id');
        $this->db->like('two.name', $term);
        $this->db->group_by('tst.id_wh_origin');
        $data = $this->db->get();

        $dd = array();
        $i = 0;

        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['name'];
            $i++;
        }
        return $dd;
    }
}
