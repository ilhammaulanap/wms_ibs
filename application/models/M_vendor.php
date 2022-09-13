<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_vendor extends CI_Model
{
    public function get_array_id($term)
    {
        $this->db->select('*');
        $this->db->from('tb_vendor');
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
}
