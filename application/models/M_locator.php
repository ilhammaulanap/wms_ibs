<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_locator extends CI_Model
{
    public function get_locator_in($whereIn = array()){
        $this->db->select('wl.*,tw.name warehouse');
        $this->db->from('tb_warehouse_locator wl');
        $this->db->join('tb_warehouse tw', 'wl.id_warehouse=tw.id');
        $this->db->where_in('wl.id',$whereIn);
        $this->db->where('wl.deletedate IS NULL', NULL, FALSE);
        return $this->db->get();
    }
}