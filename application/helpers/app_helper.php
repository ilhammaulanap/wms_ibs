<?php

function check_login()
{
    //check session id
    $CI = get_instance();
    if (!($CI->session->has_userdata('wh_id'))) {
        if (!$CI->input->is_ajax_request()) {
            redirect(site_url());
        } else {
            echo json_encode(array(
                'code' => 500,
                'message' => 'SESSION_EXPIRED'
            ));
            die();
        }
    }
}

function get_info()
{
    return array(
        'code' => 'WMS',
        'title' => 'Warehouse Management System'
    );
}

function get_id_user()
{
    $CI = get_instance();
    return  $CI->session->userdata('wh_id');
}

function sumbit_log($aksi = '', $id_user = '')
{
    $CI = get_instance();
    $data_log = array(
        'lastupdate' => date('Y-m-d H:i:s'),
        'id_user'    => $id_user,
        'aksi'         => $aksi,
    );
    $CI->load->model('m_app');
    $CI->m_app->insert_global('tb_log', $data_log);
}
