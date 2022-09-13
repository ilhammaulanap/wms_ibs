<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_warehouse');
    }

    public function index()
    {
        $check_session_user = $this->session->has_userdata('wh_id');
        if ($check_session_user) {
            redirect(site_url('welcome'));
        }
        $this->load->view('auth/v_login');
    }

    public function submit_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //check space from input
        if (strlen(trim($password)) == 0 || strlen(trim($username)) == 0) {
            echo json_encode(
                array(
                    'code' => 404,
                    'message' => 'Username atau password tidak valid',
                    'data' => array(),
                )
            );
        } else {
            //search data user by username
            $data_user = $this->m_app->select_global('tb_user', array('username' => $username, 'deletedate IS NULL' => NULL));
            if ($data_user->num_rows() > 0) {
                //data found

                //verify password from database

                if (password_verify($password, $data_user->row()->password)) {
                    $data_session = [
                        'wh_id'         => $data_user->row()->id,
                        'wh_username'   => $data_user->row()->username,
                        'wh_name'       => $data_user->row()->name,
                        'wh_level'      => $data_user->row()->id_level,
                    ];

                    if ($data_session['wh_level'] == '3') {
                        $data_wh_user = $this->m_warehouse->get_warehouse_user($data_session['wh_id']);
                        if ($data_wh_user->num_rows() > 0) {
                            $data_session['wh_id_warehouse'] = $data_wh_user->row()->id;
                        } else {
                            echo json_encode(
                                array(
                                    'code' => 500,
                                    'message' => 'Warehouse belum dimapping',
                                    'data' => array()
                                )
                            );
                            return;
                        }
                    }else if ($data_session['wh_level'] == '4') {
                        $data_wh_user = $this->m_warehouse->get_warehouse_user($data_session['wh_id']);
                        if ($data_wh_user->num_rows() > 0) {
                            $data_session['wh_id_warehouse'] = $data_wh_user->row()->id;
                        } else {
                            echo json_encode(
                                array(
                                    'code' => 500,
                                    'message' => 'Warehouse belum dimapping',
                                    'data' => array()
                                )
                            );
                            return;
                        }
                    }

                    //save session userdata
                    $this->session->set_userdata($data_session);
                    //check session set or not

                    $check_session_user = $this->session->has_userdata('wh_id');
                    if ($check_session_user) {
                        echo json_encode(
                            array(
                                'code' => 200,
                                'message' => 'Login Berhasil',
                                'data' => $data_session,
                            )
                        );
                    } else {
                        echo json_encode(
                            array(
                                'code' => 500,
                                'message' => 'Login Gagal',
                                'data' => array()
                            )
                        );
                    }
                } else {
                    //password tidak valid
                    echo json_encode(
                        array(
                            'code' => 500,
                            'message' => 'Password tidak valid',
                            'data' => array(),
                        )
                    );
                }
            } else {
                //data not found
                echo json_encode(
                    array(
                        'code' => 404,
                        'message' => 'Username tidak valid',
                        'data' => array(),
                    )
                );
            }
        }
    }

    public function submit_logout()
    {
        $this->session->sess_destroy();
        echo json_encode(
            array(
                'code' => 200
            )
        );
    }
}
