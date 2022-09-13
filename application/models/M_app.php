<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_app extends CI_Model
{
    public function select_global($table, $key = array(), $ordercol = "", $sorter = "asc")
    {
        $this->db->where($key);
        $this->db->from($table);
        if (!empty($ordercol)) {
            $this->db->order_by($ordercol, $sorter);
        }
        // echo $this->db->get_compiled_select();
        // die();
        $result = $this->db->get();
        return $result;
    }

    public function insert_global($table, $data = array())
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insert_batch_global($table, $data = array())
    {
        return $this->db->insert_batch($table, $data);
    }

    public function delete_global($table, $key = array())
    {
        $this->db->where($key);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function update_global($table, $key = array(), $field = array())
    {
        $this->db->where($key);
        $this->db->update($table, $field);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function update_outbound($table, $key = array(), $field = array())
    {
        $this->db->where($key);
        $this->db->update($table, $field);
        // echo $this->db->last_query();
        // die();
        return $this->db->affected_rows();
    }

    public function check_outbound($key)
    {
        // echo $key;
        // $id = md5($key);
        // echo $id;
        // die();
        $this->db->select('top.*');
        $this->db->from('tb_outbound_product top');
        $this->db->join('tb_inbound_product tip', 'top.id_inbound_product = tip.id');
        $this->db->where($key);
        $result = $this->db->get();
        return $result;
    }

    public function delete_data($table, $key)
    {

        $result = $this->db->delete($table, $key);
        return $result;
    }

    public function soft_delete_data($table, $key)
    {
        $result = $this->db->where($key)->update($table, array('deletedate' => date('Y-m-d H:i:s')));

        return $result;
    }
}
