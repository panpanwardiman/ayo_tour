<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = ['users', 'all users'];
        $data['module'] = 'user';
        $data['content'] = 'user_list';
        $data['users'] = $this->user_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = ['users', 'new users'];
        $data['module'] = 'user';
        $data['content'] = 'user_create';
        echo Modules::run('backend_template', $data);
    }

    function store() 
    {            
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules(
                'email', 'Email', 
                'required|is_unique[tb_users.email]'
        );
        $this->form_validation->set_rules(
                'password', 'Password', 
                'required|min_length[8]'
        );
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name',TRUE), 
                'last_name' => $this->input->post('last_name',TRUE), 
                'email' => $this->input->post('email',TRUE), 
                'password' => $this->_hash($this->input->post('password',TRUE)), 
                'role' => $this->input->post('role',TRUE), 
            );
            if ($this->user_model->save($data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/user/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/user/create'));
            }
        }
    }

    function edit($id)
    {
        $data['halaman'] = ['users', '', ''];
        $data['module'] = 'user';
        $data['content'] = 'user_edit';
        $data['user'] = $this->user_model->user_by_id($id);
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules(
                'email', 'Email', 
                'required|valid_email|callback__email_callback'
        );
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->edit($id);
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name',TRUE), 
                'last_name' => $this->input->post('last_name',TRUE), 
                'email' => $this->input->post('email',TRUE), 
                'role' => $this->input->post('role',TRUE), 
            );
            if ($this->user_model->update($id, $data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/user'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/user'));
            }
        }
    }

    function destroy($id)
    {
        if ($this->user_model->delete($id)) {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/user'));
        } else {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/user'));
        }
    }

    function change_password()
    {
        $data['halaman'] = ['users', '', ''];
        $data['module'] = 'user';
        $data['content'] = 'change_password';
        echo Modules::run('backend_template', $data);
    }

    function update_password($id)
    {
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_enter_new_password', 'Re-Enter New Password', 'required|min_length[8]|matches[new_password]'
        );
        if ($this->form_validation->run($this) == FALSE) {
            $this->change_password();  
        } else {
            $data = array(
                'password' => $this->_hash($this->input->post('new_password'))
            );
            if ($this->user_model->_update_password($id, $data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Password berhasil diubah !</p></div>'                
                );
                redirect(site_url('at-admin/user'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Password gagal diubah !</p></div>'                
                );
                redirect(site_url('at-admin/user'));
            }
        }
    }

    function _email_callback($email)
    {
        // $id = $this->input->post('id', TRUE);
        $id = $this->uri->segment(4);
        $data = $this->user_model->email_validation($id, $email);
        
        if ($data->num_rows() > 0) {
            $this->form_validation->set_message('_email_callback', '%s already taken.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _hash($password) 
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

}