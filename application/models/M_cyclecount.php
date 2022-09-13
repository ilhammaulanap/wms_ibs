<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_cyclecount extends CI_Model
{
    public function get_cycle_count_header($where = array(), $order = ''){
        $this->db->select('ch.*,tw.name warehouse,us.name name_user_submit');
        $this->db->from('tb_cycle_count_h ch');
        $this->db->join('tb_warehouse tw', 'ch.id_warehouse=tw.id');
        $this->db->join('tb_user us', 'ch.id_user_submit=us.id');
        $this->db->where($where);
        $this->db->where('ch.deleted_at IS NULL', NULL, FALSE);
        $this->db->order_by($order);
        $this->db->group_by('ch.id_cycle_count_h');
        return $this->db->get();
    }

    
    public function get_cycle_count_detail($where = array(), $order = ''){
        $this->db->select('cd.*,tp.code code_product,tp.name product,twl.name locator');
        $this->db->from('tb_cycle_count_d cd');
        $this->db->join('tb_product tp', 'cd.id_product=tp.id');
        $this->db->join('tb_product_status tps', 'cd.id_product_status=tps.id');
        $this->db->join('tb_warehouse_locator twl', 'cd.id_locator=twl.id');
        $this->db->join('tb_cycle_count_h ch', 'cd.id_cycle_count_h=ch.id_cycle_count_h');
        $this->db->where($where);
        $this->db->where('cd.deleted_at IS NULL', NULL, FALSE);
        $this->db->order_by($order);
        $this->db->group_by('cd.id_cycle_count_d');
        return $this->db->get();
    }
}