<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    function index()
    {
        $this->load->view('login');
    }

    function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            redirect(site_url('auth'));
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $row = $this->auth_model->login($email);
            if ($row) {
                $password_hash = $row->password;
                if (password_verify($password, $password_hash)) {
                    $data = array(
                        'id' => $row->id,
                        'first_name' => $row->first_name,
                        'ayo_tour_logged_in' => TRUE
                    );
                    $this->session->set_userdata($data);
                    redirect(site_url('at-admin'));
                } else {
                    $this->session->set_flashdata('message', 'Email atau Password salah !');
                    redirect(site_url('at-admin/auth'));
                }
            }
        }
    }

    function logout()
    {
        $data = array('id', 'first_name', 'ayo_tour_logged_in');
        $this->session->unset_userdata($data);
        redirect(site_url('at-admin/auth'));
    }

}