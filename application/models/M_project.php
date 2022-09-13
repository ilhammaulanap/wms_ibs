<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_project extends CI_Model
{
    public function get_data_project($id_warehouse = '')
    {
        if($id_warehouse != ''){
            $where = array(
                'id_warehouse' => $id_warehouse,
                'deletedate IS NULL' => NULL
            );
            $this->db->select('*');
            $this->db->from('tb_warehouse_project');
            $this->db->where($where);
            $data = $this->db->get();
        }else{
            $where = array(
                'deletedate IS NULL' => NULL
            );
            $this->db->select('*');
            $this->db->from('tb_warehouse_project');
            $this->db->where($where);
            $data = $this->db->get();
        }
        
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
