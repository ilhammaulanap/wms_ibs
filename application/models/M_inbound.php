<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_inbound extends CI_Model
{
    public function get_last_no_inbound($tipe = 'In', $codeWH = 'WH')
    {
        $params = date('Ymd') . '/' . $tipe . '/' . $codeWH . '/';
        $this->db->select('inbound_no');
        $this->db->from('tb_inbound');
        $this->db->like('inbound_no', $params, 'after');
        $this->db->order_by('inbound_no', 'desc');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $code = $data->row()->inbound_no;
            $cur_num = substr($code, strlen($params)) + 1;
            return $params . sprintf('%04d', $cur_num);
        } else {
            return $params . '0001';
        }
    }

    public function get_last_no_asn($tipe = 'ASN', $codeWH = 'WH')
    {
        $params = date('Ymd') . '/' . $tipe . '/' . $codeWH . '/';
        $this->db->select('asn_no');
        $this->db->from('tb_inbound');
        $this->db->like('asn_no', $params, 'after');
        $this->db->order_by('asn_no', 'desc');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $code = $data->row()->asn_no;
            $cur_num = substr($code, strlen($params)) + 1;
            return $params . sprintf('%04d', $cur_num);
        } else {
            return $params . '0001';
        }
    }

    public function sync_id_detail($id_inbound, $id_trash)
    {
        $this->db->where_in('id', $id_trash);
        $this->db->where('id_inbound', $id_inbound);
        $this->db->update('tb_inbound_product', array('deletedate' => date('Y-m-d')));
        return $this->db->affected_rows();
    }

    public function get_header($where = array(), $order = '')
    {
        $this->db->select('ti.*, md5(ti.id) md5_id, tw.name warehouse, tv.name vendor, tu.name name_user_tc,
                        tu_1.name name_creator, ts.name supplier, 
                        tm.name mot, twp.name project_name, tid.shipment_no');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'ti.id=tid.id_inbound');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id', 'LEFT');
        $this->db->join('tb_user tu_1', 'ti.id_user=tu_1.id');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id', 'LEFT');
        $this->db->join('tb_user tu', 'ti.id_user_tc=tu.id', 'LEFT');
        $this->db->join('tb_user tuw', 'ti.id_user=tuw.id', 'LEFT');
        $this->db->where($where);
        $this->db->where('ti.deletedate IS NULL', NULL, FALSE);
        $this->db->where_in('ti.status', ['2', '3']);
        $this->db->order_by($order);
        $this->db->group_by('ti.id');
        return $this->db->get();
    }

    public function get_header_inbound($where = array(), $order = '')
    {
        $this->db->select('ti.*, md5(ti.id) md5_id, tw.name warehouse, tv.name vendor, tu.name name_user_tc,
                        tu_1.name name_creator, ts.name supplier, 
                        tm.name mot, twp.name project_name');
        $this->db->from('tb_inbound ti');
        // $this->db->join('tb_inbound_product tid', 'ti.id=tid.id_inbound');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id', 'LEFT');
        $this->db->join('tb_user tu_1', 'ti.id_user=tu_1.id');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id', 'LEFT');
        $this->db->join('tb_user tu', 'ti.id_user_tc=tu.id', 'LEFT');
        $this->db->join('tb_user tuw', 'ti.id_user=tuw.id', 'LEFT');
        $this->db->where($where);
        $this->db->where('ti.deletedate IS NULL', NULL, FALSE);
        $this->db->where_in('ti.status', ['2', '3']);
        $this->db->order_by($order);
        $this->db->group_by('ti.id');
        // echo $this->db->get_compiled_select();
        // die();
        return $this->db->get();
    }

    public function get_body($where = array(), $order = '')
    {
        $this->db->select('ti.*, tid.*, tp.code, tp.name product, tpu.name uom, tv.name vendor, tu.name name_user_tc, tu.name name_user,
                    twl.name locator, tps.name product_status, tw.name warehouse, 
                    ts.name supplier, tm.name mot,SUM(tid.qty_product) total_qty_product, twp.name project_name, tid.shipment_no');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator', 'LEFT');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id', 'LEFT');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id', 'LEFT');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id', 'LEFT');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id', 'LEFT');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id', 'LEFT');
        $this->db->join('tb_user tu', 'ti.id_user_tc=tu.id', 'LEFT');
        $this->db->join('tb_user tuw', 'ti.id_user=tuw.id', 'LEFT');
        // $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id', 'LEFT');
        $this->db->where($where);
        $this->db->where('tid.deletedate IS NULL', NULL, FALSE);
        $this->db->group_by('tid.id, tid.lot_number');
        $this->db->order_by($order);

        return $this->db->get();
    }

    public function get_body_history($where = array(), $order = '')
    {
        $this->db->select('ti.*, tp.code, tp.name product, tpu.name uom, 
                    twl.name locator, tps.name product_status, tw.name warehouse, 
                    ts.name supplier, tm.name mot,SUM(tid.qty_product) total_qty_product, 
                    twp.name project_name, tid.shipment_no, tv.name vendor');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id', 'LEFT');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id', 'LEFT');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id', 'LEFT');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id', 'LEFT');
        $this->db->where($where);
        $this->db->where('tid.deletedate IS NULL', NULL, FALSE);
        $this->db->group_by('ti.id');
        $this->db->order_by($order);
        // echo $this->db->get_compiled_select();
        // die();
        return $this->db->get();
    }

    public function get_array_id_warehouse($term)
    {
        $this->db->select('ti.id_warehouse id, tw.name');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tip', 'ti.id=tip.id_inbound');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->like('tw.name', $term);
        $this->db->group_by('ti.id_warehouse');
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

    public function get_detail_product_inbound($where = array())
    {
        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('tstd.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tstd', 'tst.id=tstd.id_stock_transfer');
        $this->db->group_by('tstd.id_inbound_product');
        $tst = $this->db->get_compiled_select();


        $this->db->select('tid.id, tid.id_product,tid.id_product_status, ti.po_no, tid.shipment_no, tid.box_id, ti.inbound_date, tp.code product_code, tp.name product_name, twl.name locator, tid.id_locator, (tid.qty_product-IFNULL(top.qty_out,0)-IFNULL(tst.qty_out,0)) available, tpu.name uom_name');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join("($top) top", 'tid.id=top.id', 'LEFT');
        $this->db->join("($tst) tst", 'tid.id=tst.id', 'LEFT');
        $this->db->where($where);
        $this->db->having('available>', '0');
        return $this->db->get();
    }

    public function get_array_id_product_inbound($term, $id_warehouse = '')
    {
        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('tid.id_product id, tp.code, tp.name name_product, (tid.qty_product-IFNULL(top.qty_out,0)) available');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join("($top) top", 'tid.id=top.id', 'LEFT');
        if ($id_warehouse != '') {
            $this->db->where('ti.id_warehouse', $id_warehouse);
        }
        $this->db->where("( tp.name LIKE '%" . $term . "%' OR tp.code LIKE '%" . $term . "%' )");
        $this->db->group_by('tid.id_product');
        $data = $this->db->get();

        $dd = array();
        $i = 0;

        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['text'] = $value['code'] . ' ' . $value['name_product'];
            $i++;
        }
        return $dd;
    }

    public function get_array_id_locator_inbound($term, $id_product = '')
    {
        $this->db->select('twl.id, twl.name locator');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
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

    public function get_warehouse_user($id)
    {
        $this->db->select('name');
        $this->db->from('tb_warehouse');
        $this->db->where('id = ' . $id);
        $data = $this->db->get();
        return $data;
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

    public function get_inbound_detail($where = array(), $order = '')
    {
        $this->db->select('tip.*, ti.inbound_no, ti.inbound_date, tp.code, tp.name,tpc.name_category category');
        $this->db->from('tb_inbound_product tip');
        $this->db->join('tb_inbound ti', 'tip.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tip.id_product=tp.id');
        $this->db->join('tb_product_category tpc', 'tpc.id=tp.id_category');
        $this->db->where($where);
        return $this->db->get();
    }

    public function get_asn($where = array(), $term = '', $order = '')
    {
        // var_dump($where);
        // die();
        $this->db->select('ti.*,
                          tw.name as warehouse_name, 
                          tm.name as mot, 
                          ts.name as supplier, 
                          twp.name as project,
                          tv.name as vendor,
                          tu.name as name_user_tc,
                          SUM(IF(tip.deletedate IS NULL,1,0)) as total_product
                          ');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id');
        $this->db->join('tb_user tu', 'ti.id_user_tc=tu.id');
        $this->db->join('tb_inbound_product tip', 'ti.id=tip.id_inbound', 'left');
        $this->db->where($where);
        $this->db->where('ti.deletedate IS NULL', NULL, FALSE);
        // $this->db->where('tip.deletedate IS NULL', NULL, FALSE);
        $this->db->where_in('ti.status', ['1', '2']);
        $this->db->like('ti.asn_no', $term);
        $this->db->group_by('ti.id');
        // echo $this->db->get_compiled_select();
        // die();
        return $this->db->get();
    }


    public function get_asn_select2($where = [], $term = '')
    {
        $this->db->select('ti.*,
        tw.name as warehouse_name, 
        tm.name as mot, 
        ts.name as supplier, 
        twp.name as project,
        tv.name as vendor,
        tu.name as name_user_tc,
        count(tip.id) as total_product
        ');
        $this->db->from('tb_inbound ti');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        $this->db->join('tb_mot tm', 'ti.id_mot=tm.id');
        $this->db->join('tb_supplier ts', 'ti.id_supplier=ts.id');
        $this->db->join('tb_warehouse_project twp', 'ti.id_project=twp.id');
        $this->db->join('tb_vendor tv', 'ti.id_vendor=tv.id');
        $this->db->join('tb_user tu', 'ti.id_user_tc=tu.id');
        $this->db->join('tb_inbound_product tip', 'ti.id=tip.id_inbound');
        $this->db->where($where);
        $this->db->where('ti.deletedate IS NULL', NULL, FALSE);
        $this->db->where('tip.deletedate IS NULL', NULL, FALSE);
        $this->db->where_in('ti.status', ['1', '2']);
        $this->db->like('ti.asn_no', $term);
        $this->db->group_by('ti.id');
        $data = $this->db->get();

        $dd = array();
        $i = 0;
        foreach ($data->result_array() as $key => $value) {
            $dd[] = $value;
            $dd[$i]['id'] = $value['id'];
            $dd[$i]['text'] = $value['asn_no'];
            $i++;
        }
        return $dd;
    }

    public function get_detail_product_asn($where = array())
    {
        $this->db->select('top.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_outbound to');
        $this->db->join('tb_outbound_product top', 'to.id=top.id_outbound');
        $this->db->group_by('top.id_inbound_product');
        $top = $this->db->get_compiled_select();

        $this->db->select('tstd.id_inbound_product id, SUM(qty) qty_out');
        $this->db->from('tb_stock_transfer tst');
        $this->db->join('tb_stock_transfer_detail tstd', 'tst.id=tstd.id_stock_transfer');
        $this->db->group_by('tstd.id_inbound_product');
        $tst = $this->db->get_compiled_select();


        $this->db->select(
            'tid.*, 
                    ti.po_no, 
                    ti.inbound_date, 
                    tp.code product_code, 
                    tp.name product_name, 
                    twl.name locator, 
                    tpu.name uom_name,
                    tps.name product_status',
        );
        $this->db->from('tb_inbound_product tid');
        // $this->db->from('tb_inbound ti');
        // $this->db->join('tb_inbound_product tid', 'tid.id_inbound=ti.id');
        $this->db->join('tb_inbound ti', 'tid.id_inbound=ti.id');
        $this->db->join('tb_product tp', 'tid.id_product=tp.id');
        $this->db->join('tb_product_uom tpu', 'tp.id_uom=tpu.id');
        $this->db->join('tb_warehouse_locator twl', 'twl.id=tid.id_locator', 'left');
        $this->db->join('tb_product_status tps', 'tid.id_product_status=tps.id', 'left');
        $this->db->join('tb_warehouse tw', 'ti.id_warehouse=tw.id');
        // $this->db->join("($top) top", 'tid.id=top.id', 'LEFT');
        // $this->db->join("($tst) tst", 'tid.id=tst.id', 'LEFT');
        $this->db->where($where);
        $this->db->where('tid.deletedate IS NULL', NULL, FALSE);
        // $this->db->having('available>', '0');
        return $this->db->get();
    }

    public function export_template_import_product_asn()
    {
        try {
            echo 'ada';
            die();
        } catch (Throwable $e) {
            echo json_encode(
                [
                    'code' => 500,
                    'message' => 'Oops Something Wrong' . $e,
                ]
            );
            return;
        }
    }
}
