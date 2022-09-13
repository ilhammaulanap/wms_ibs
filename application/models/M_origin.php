<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_origin extends CI_Model
{
    public function get_data_origin($term = '')
    {
        $this->db->select('*');
        $this->db->from('tb_origin');
        $this->db->order_by('name');
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
