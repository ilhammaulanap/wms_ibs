<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_product extends CI_Model
{
    public function get_array_id_uom($term)
    {
        $this->db->select('*');
        $this->db->from('tb_product_uom');
        $this->db->like('name', $term);
        $this->db->where('deletedate IS NULL', NULL, FALSE);
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

    public function get_array_id_category($term)
    {
        $this->db->select('*');
        $this->db->from('tb_product_category');
        $this->db->like('name_category', $term);
        $this->db->where('deletedate IS NULL', NULL, FALSE);
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['name_category'];
            $i++;
        }
        return $dd;
    }

    public function get_array_id_product_status($term)
    {
        $this->db->select('*');
        $this->db->from('tb_product_status');
        $this->db->like('name', $term);
        $this->db->where('deletedate IS NULL', NULL, FALSE);
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

    public function get_data_product()
    {
        $this->db->select('tp.*, tpu.name uom, tpu.symbol symbol_uom,tpc.name_category category');
        $this->db->from('tb_product tp');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_product_category tpc', 'tp.id_category=tpc.id');
        $this->db->where('tp.deletedate IS NULL', NULL);
        return $this->db->get();
    }

    public function get_last_code()
    {
        $params = date('Ymd');
        $this->db->select('code');
        $this->db->from('tb_product');
        $this->db->like('code', $params, 'after');
        $this->db->order_by('code', 'desc');
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            $code = $data->row()->code;
            $cur_num = substr($code, strlen($params)) + 1;
            return $params . sprintf('%03d', $cur_num);
        } else {
            return $params . '001';
        }
    }

    public function get_data_product_select($term = '')
    {
        $this->db->select('tp.*, tpu.name uom');
        $this->db->from('tb_product tp');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->like('tp.code', $term);
        $this->db->or_like('tp.name', $term);
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['code'] . ' ' . $value['name'];
            $i++;
        }
        return $dd;
    }

    public function get_data_product_select_wh($term = '', $id_warehouse = '')
    {
        $this->db->select('tp.*, tpu.name uom');
        $this->db->from('tb_product tp');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->where('tp.id_warehouse', $id_warehouse);
        $this->db->where("(tp.code LIKE '%$term%' OR tp.name LIKE '%$term%')");
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['code'] . ' ' . $value['name'];
            $i++;
        }
        return $dd;
    }

    public function get_data_product_select_wh_product($term = '', $id_warehouse = '')
    {
        //outbound
        $this->db->select('todp.id_detail_inbound, SUM(todp.qty_good) qty_good');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_detail tod', 'to.id=tod.id_outbound');
        $this->db->join('tb_outbound_detail_product todp', 'tod.id=todp.id_detail_outbound');
        $this->db->group_by('todp.id_detail_inbound');
        $outbound = $this->db->get_compiled_select();

        $this->db->select('tid.id_product id, ti.inbound_no, tid.id_product, tp.name product_name, tid.site_name, SUM(tid.qty_good-IFNULL(tod.qty_good,0)) qty_good, tpu.name uom');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_detail tid', 'ti.id=tid.id_inbound');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join("($outbound) tod", 'tid.id=tod.id_detail_inbound', 'LEFT');
        $this->db->like('tp.name', $term);
        $this->db->where('ti.id_warehouse', $id_warehouse);
        $this->db->group_by('tid.id_product');
        $this->db->having('qty_good>', '0');
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['product_name'];
            $i++;
        }
        return $dd;
    }

    public function get_inbound_product_status($id_detail_inbound)
    {
        $this->db->select('id_detail_inbound id, qty, id_status, tidp.id_locator, twl.name locator');
        $this->db->from('tb_inbound_detail_product tidp');
        $this->db->join('tb_warehouse_locator twl', 'tidp.id_locator=twl.id', 'LEFT');
        $this->db->where('id_detail_inbound', $id_detail_inbound);
        $this->db->where('tidp.deletedate IS NULL', NULL, FALSE);
        $inbound_detail = $this->db->get_compiled_select();

        $this->db->select('tps.id, tps.name, id.id_locator, id.locator, IFNULL(id.qty,0) qty');
        $this->db->from('tb_product_status tps');
        $this->db->join("($inbound_detail) id", 'tps.id=id.id_status', 'LEFT');
        return $this->db->get();
    }

    public function query_inventory($where = array())
    {
        $this->db->select('top.id_inbound_product id, SUM(qty) qty');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->where_in('to.status_outbound', array('1', '2')); //outbound prepartion and ready to pick up
        $this->db->group_by('top.id_inbound_product');
        $pick = $this->db->get_compiled_select();

        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->where('to.status_outbound', '3'); //outbound delvered
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('ti.id id_inbound, tid.lot_number, ti.id_warehouse, tid.id id_detail, tid.id_product, tp.code product_code, tp.name product_name, twl.name locator, tid.id_locator, SUM(tid.qty_product) qty_in, SUM(IFNULL(top.qty_out,0)) qty_out, SUM(IFNULL(pick.qty,0)) qty_pick, SUM(tid.qty_product-IFNULL(top.qty_out,0)) available, tpu.name product_uom, tps.name product_status, ti.po_no, ti.inbound_date, DATEDIFF(CURDATE(), ti.inbound_date) as date_diff');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join("($pick) pick", 'tid.id=pick.id', 'LEFT');
        $this->db->join("($top) top", 'tid.id=top.id', 'LEFT');
        $this->db->where('(tid.qty_product-IFNULL(top.qty_out,0))>', '0');
        // $this->db->group_by('tid.id_product, tps.id, twl.id');
        $this->db->group_by('tid.id, tps.id, twl.id');

        $ti = $this->db->get_compiled_select();

        $this->db->select('tp.id, tp.code product_code, tp.name product_name, IFNULL(ti.qty_in,0) qty_in, IFNULL(ti.qty_out,0) qty_out, IFNULL(ti.available,0) available, IFNULL(ti.qty_pick,0) qty_pick, IFNULL(ti.lot_number,"") lot_number, ti.id_locator, ti.locator, ti.product_status, tpu.name product_uom, ti.id_inbound, ti.po_no, ti.id_detail, ti.inbound_date, DATEDIFF(CURDATE(), ti.inbound_date) as date_diff');
        $this->db->from('tb_product tp');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join("($ti) ti", 'tp.id=ti.id_product');
        $this->db->where($where);
        $this->db->where('ti.available IS NOT NULL', NULL, FALSE);
    }

    public function query_inventory2($where = array())
    {
        $this->db->select('top.id_inbound_product id, SUM(qty) qty');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->where_in('to.status_outbound', array('1', '2')); //outbound prepartion and ready to pick up
        $this->db->group_by('top.id_inbound_product');
        $pick = $this->db->get_compiled_select();

        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->where_in('to.status_outbound', array('3','4')); //outbound delvered
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('ti.id id_inbound, ti.inbound_no, tid.id id_inbound_product, 
                        tid.lot_number, ti.id_warehouse, tid.id id_detail, tid.id_product, 
                        tp.code product_code, tp.name product_name, twl.name locator, 
                        tid.id_locator, SUM(tid.qty_product) qty_in, SUM(IFNULL(top.qty_out,0)) qty_out, 
                        SUM(IFNULL(pick.qty,0)) qty_pick, SUM(tid.qty_product-IFNULL(top.qty_out,0)) available, 
                        tpu.name product_uom, tps.name product_status, ti.po_no, ti.inbound_date, 
                        DATEDIFF(CURDATE(), ti.inbound_date) as date_diff, tw.name as warehouse_name,
                        tid.shipment_no, ts.name as suppier_name, tm.name as mot,ti.id_project,ti.truck_no, 
                        ti.driver_name, ti.driver_contact,tpc.name_category,ti.no_container,tid.note,tid.box_id');
        $this->db->from('tb_inbound ti');
        
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_category tpc', 'tp.id_category=tpc.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id');
        $this->db->join("($pick) pick", 'tid.id=pick.id', 'LEFT');
        $this->db->join("($top) top", 'tid.id=top.id', 'LEFT');
        $this->db->where('(tid.qty_product-IFNULL(top.qty_out,0))>', '0');
        // $this->db->group_by('tid.id_product, tps.id, twl.id');
        $this->db->group_by('tid.id, tps.id, twl.id');

        $ti = $this->db->get_compiled_select();
        // echo $ti;
        // die();

        $this->db->select('ti.id_inbound, ti.inbound_no, ti.id_inbound_product, tp.code product_code, 
                    tp.name product_name,tp.id id_product, IFNULL(ti.qty_in,0) qty_in, IFNULL(ti.qty_out,0) qty_out, 
                    IFNULL(ti.available,0) available, IFNULL(ti.qty_pick,0) qty_pick, 
                    IFNULL(ti.lot_number,"") lot_number, ti.id_locator, ti.locator, 
                    ti.product_status, tpu.name product_uom, ti.id_inbound, ti.po_no, ti.id_detail, 
                    ti.inbound_date, DATEDIFF(CURDATE(), ti.inbound_date) as date_diff, ti.warehouse_name,
                    ti.shipment_no, ti.shipment_no, ti.suppier_name, ti.mot, twp.name project_name,ti.truck_no, 
                    ti.driver_name, ti.driver_contact,ti.name_category,ti.no_container,ti.note,ti.box_id');
        $this->db->from('tb_product tp');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join("($ti) ti", 'tp.id=ti.id_product');
        $this->db->join('tb_warehouse_project twp','ti.id_project=twp.id');
        $this->db->where($where);
        $this->db->where('ti.available IS NOT NULL', NULL, FALSE);
        $this->db->group_by('ti.id_inbound_product');
    }

    public function get_inventory_product($where = array())
    {

        $this->query_inventory2($where);
        return $this->db->get();
    }

    public function get_array_id_product_inventory($term = '', $id_warehouse = '')
    {
        $where["( tp.name LIKE '%" . $term . "%' OR tp.code LIKE '%" . $term . "%' )"] = NULL;
        if ($id_warehouse != '') {
            $where['ti.id_warehouse'] = $id_warehouse;
        }
        $this->query_inventory($where);
        $this->db->group_by('tp.id');
        $data = $this->db->get();
        $dd = array();
        $i = 0;

        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['product_code'] . ' ' . $value['product_name'];
            $i++;
        }
        return $dd;
    }

    public function get_array_id_locator_inventory($term = '', $id_product = '')
    {
        $where["( ti.locator LIKE '%" . $term . "%')"] = NULL;
        if ($id_product != '') {
            $where['tp.id'] = $id_product;
        }
        $this->query_inventory($where);

        $this->db->group_by('ti.id_locator');
        $data = $this->db->get();
        $dd = array();
        $i = 0;

        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['id'] = $value['id_locator'];
            $dd[$i]['text'] = $value['locator'];
            $i++;
        }
        return $dd;
    }


    // public function data_dashboard(){
    //     // $this->query_inventory($where);
    //     // return $this->db->get();
    //     print_r('ada');
    // }
}
