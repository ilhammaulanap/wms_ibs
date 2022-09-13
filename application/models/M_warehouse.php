<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_warehouse extends CI_Model
{
    private function _query_warehouse()
    {
        $this->db->select('tw.*, md5(tw.id) md5_id');
        $this->db->from('tb_warehouse tw');
        $this->db->where('tw.deletedate IS NULL');
    }

    private function _query_warehouse_user()
    {
        $this->db->select('tw.*, md5(tw.id) md5_id');
        $this->db->from('tb_warehouse tw');
        $this->db->join('tb_warehouse_user twu', 'tw.id=twu.id_warehouse');
        $this->db->join('tb_user tu', 'twu.id_user=tu.id');
        $this->db->join('tb_user_level tul', 'tu.id_level=tul.id');
        $this->db->where('tw.deletedate IS NULL');
    }

    public function _query_warehouse_locator()
    {
        $this->db->select('twl.id, twl.name');
        $this->db->from('tb_warehouse tw');
        $this->db->join('tb_warehouse_locator twl', 'tw.id=twl.id_warehouse');
    }

    public function get_data_warehouse($where = array())
    {
        $this->_query_warehouse();
        $this->db->where($where);
        return $this->db->get();
    }

    public function get_data_warehouse_select_all($term = '')
    {
        $this->_query_warehouse_user();
        $this->db->like('tw.name', $term);
        $this->db->group_by('tw.id');
        $this->db->order_by('tw.id');
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

    public function get_data_warehouse_select($term = '')
    {
        $level = $this->session->userdata('wh_level');
        $idu   = $this->session->userdata('wh_id');

        $this->_query_warehouse_user();
        $this->db->like('tw.name', $term);
        if ($level == '3') { //level bukan administrator tampilkan gudang berdasarkan role dia saja
            $this->db->where('twu.id_user', $idu);
        }
        $this->db->group_by('tw.id');
        $this->db->order_by('tw.id');
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

    public function get_warehouse_user($idu = '')
    {
        // $idu   = $this->session->userdata('wh_id');
        $this->_query_warehouse_user();
        $this->db->where('twu.id_user', $idu);
        $this->db->group_by('tw.id');
        $this->db->order_by('tw.id');
        $data = $this->db->get();
        return $data;
    }

    public function get_data_locator_select($term = '', $id_wh = '')
    {
        $this->_query_warehouse_locator();
        $this->db->where('tw.id', $id_wh);
        $this->db->where('twl.deletedate IS NULL', NULL, FALSE);
        $this->db->like('twl.name', $term);
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

    public function get_data_role($where)
    {
        $this->db->select('twu.*, tu.name name_user, tu.id_level, tul.name level, tu.username');
        $this->db->from('tb_warehouse_user twu');
        $this->db->join('tb_user tu', 'twu.id_user=tu.id');
        $this->db->join('tb_user_level tul', 'tu.id_level=tul.id');
        $this->db->where($where);
        return $this->db->get();
    }
}
