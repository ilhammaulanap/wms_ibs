<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_outbound extends CI_Model
{
    public function get_last_no_outbound($tipe = 'Out', $code_wh = '')
    {
        $params = date('Ymd') . '/' . $tipe . '/' . $code_wh . '/';
        $this->db->select('outbound_no');
        $this->db->from('tb_outbound');
        $this->db->like('outbound_no', $params, 'after');
        $this->db->order_by('outbound_no', 'desc');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $code = $data->row()->outbound_no;
            $cur_num = substr($code, strlen($params)) + 1;
            return $params . sprintf('%04d', $cur_num);
        } else {
            return $params . '0001';
        }
    }

    public function sync_id_detail($id_outbound, $id_trash)
    {
        $this->db->where_in('id', $id_trash);
        $this->db->where('id_outbound', $id_outbound);
        $this->db->update('tb_outbound_product', array('deletedate' => date('Y-m-d')));
        return $this->db->affected_rows();
    }

    //search update status
    public function get_list_outbound($term = '')
    {
        $this->db->select('ti.id, ti.outbound_no, ti.mr_no, ti.status_outbound, ti.*, DATE_FORMAT(tos.status_date, "%m/%d/%Y") date_status, DATE_FORMAT(status_date, "%H:%i") time_status');
        $this->db->from('tb_outbound ti');
        $this->db->join('tb_outbound_product tid', 'ti.id=tid.id_outbound');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_outbound_status tos', '(ti.id=tos.id_outbound AND tos.id_status_outbound=ti.status_outbound)', 'LEFT');
        $this->db->where("(ti.outbound_no LIKE '%$term%' OR ti.mr_no LIKE '%$term%' OR ti.site_name LIKE '%$term%')");
        $this->db->where_not_in('ti.status_outbound', array('3', '4'));
        $this->db->group_by('ti.id');

        return $this->db->get();
    }

    public function get_outbound($where = array())
    {
        $this->db->select('to.*, MD5(to.id) md5_id, DATE_FORMAT(tos.status_date, "%m/%d/%Y") date_status, 
                            DATE_FORMAT(status_date, "%H:%i")time_status, tso.name status, tw.name warehouse, tw.address address_warehouse,
                            tu.name name_creator, tu.id id_user_created, tm.name mot, twp.name project,tv.name vendor');
        $this->db->select('COUNT(top.id) c_material');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->join('tb_warehouse tw', 'to.id_warehouse=tw.id');
        $this->db->join('tb_outbound_status tos', '(to.id=tos.id_outbound AND tos.id_status_outbound=to.status_outbound)', 'LEFT');
        $this->db->join('tb_status_outbound tso', 'tso.id=to.status_outbound');
        $this->db->join('tb_user tu', 'to.id_user=tu.id');
        $this->db->join('tb_warehouse_project twp', 'to.id_project=twp.id');
        $this->db->join('tb_vendor tv', 'to.id_vendor=tv.id','LEFT');
        $this->db->join('tb_mot tm', 'tm.id=to.id_mot', 'LEFT');
        $this->db->where($where);
        $this->db->order_by('to.lastupdate');
        $this->db->group_by('to.id');
        return $this->db->get();
    }

    public function get_outbound_detail($where = array(), $order = '')
    {

        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out','top.note note_outbound');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->where('top.deletedate IS NULL', NULL, FALSE);
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('top.id','top.id_outbound','top.id_inbound_product','top.qty'); //id detail, id inbound detail, qty, id outbound
        $this->db->select('tot.outbound_no,  MD5(tot.id) md5_id, tot.outbound_date, tot.mr_no, tot.wu_no,tot.site_wbs,tot.site_id, tot.site_name, tot.destination, tot.truck_no, tot.driver_name, tot.driver_contact, tot.status_outbound, tot.link_attach, tot.no_container');
        $this->db->select('tot.po_no, tip.lot_number');
        $this->db->select('tpc.name_category');
        $this->db->select('tp.id id_product, tp.code product_code, tp.name product_name, (tp.length*tp.height*tp.width) cbm, tp.weight');
        $this->db->select('twl.name locator, tps.name product_status, tpu.name uom, (tip.qty_product-IFNULL(top_2.qty_out,0))+top.qty available, top.qty, tpu.name uom_name');
        $this->db->select('tm.name mot');
        $this->db->select('tv.name vendor');
        $this->db->select('tip.box_id,top.note note_outbound');
        $this->db->from('tb_outbound_product top');
        $this->db->join('tb_outbound tot', 'top.id_outbound = tot.id');
        // $this->db->join('tb_outbound_product top', 'tot.id=top.id_outbound');
        $this->db->join('tb_inbound_product tip', 'top.id_inbound_product=tip.id');
        
        $this->db->join("($top) top_2", 'tip.id=top_2.id', 'LEFT');
        $this->db->join('tb_inbound ti', 'tip.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tip.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_product_status tps', 'tip.id_product_status=tps.id');
        $this->db->join('tb_warehouse_locator twl', 'tip.id_locator=twl.id');
        $this->db->join('tb_mot tm', 'tm.id=tot.id_mot', 'LEFT');
        $this->db->join('tb_vendor tv', 'tv.id=tot.id_vendor', 'LEFT');
        $this->db->join('tb_product_category tpc', 'tpc.id=tp.id_category');
        $this->db->where('top.deletedate IS NULL', NULL, FALSE);
        $this->db->where($where);
        $this->db->order_by($order);
        // echo $this->db->get_compiled_select();
        // die();
        return $this->db->get();
    }

    public function get_array_id_warehouse($term)
    {
        $this->db->select('to.id_warehouse id, tw.name');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->join('tb_warehouse tw', 'to.id_warehouse=tw.id');
        $this->db->like('tw.name', $term);
        $this->db->group_by('to.id_warehouse');
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
    public function get_array_id_warehouse2($term)
    {
        $this->db->select('id, name');
        $this->db->from('tb_warehouse tw');
        // $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        // $this->db->join('tb_warehouse tw', 'to.id_warehouse=tw.id');
        $this->db->like('name', $term);
        // $this->db->group_by('to.id_warehouse');
        // echo $this->db->get_compiled_select();
        // die();
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
    public function get_warehouse_user($id)
    {
        $this->db->select('name');
        $this->db->from('tb_warehouse');
        $this->db->where('id = '.$id);
        $data = $this->db->get();
        return $data;
    }

    public function get_array_id_product_outbound($term, $id_warehouse = '')
    {
        $this->db->select('tp.id, tp.code, tp.name name_product');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->join('tb_warehouse tw', 'to.id_warehouse=tw.id');
        $this->db->join('tb_inbound_product tip', 'tip.id=top.id_inbound_product');
        $this->db->join('tb_product tp', 'tip.id_product=tp.id');
        if ($id_warehouse != '') {
            $this->db->where('to.id_warehouse', $id_warehouse);
        }
        $this->db->like('tp.name', $term);
        $this->db->group_by('tp.id');
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        // print_r($data);
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['code'] . ' ' . $value['name_product'];
            $i++;
        }
        return $dd;
    }

    public function get_array_id_locator_outbound($term, $id_product = '')
    {
        $this->db->select('twl.id, twl.name locator');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->join('tb_inbound_product tid', 'tid.id=top.id_inbound_product');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_warehouse_locator twl', 'tid.id_locator=twl.id');
        if ($id_product != '') {
            $this->db->where('tid.id_product', $id_product);
        }
        $this->db->where("( twl.name LIKE '%" . $term . "%')");
        $this->db->group_by('tid.id_locator');
        $data = $this->db->get();

        $dd = array();
        $i = 0;

        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['locator'];
            $i++;
        }
        return $dd;
    }
}
