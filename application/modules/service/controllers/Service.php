<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('service_model');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = 'service';
        $data['module'] = 'service';
        $data['content'] = 'service_list';
        $data['services'] = $this->service_model->get_all();
        echo Modules::run('backend_template', $data);
        
    }

    function create()
    {
        $data['halaman'] = 'service';
        $data['module'] = 'service';
        $data['content'] = 'service_create';
        echo Modules::run('backend_template', $data);
    }

    function store()
    {
        $this->form_validation->set_rules(
            'name', 'Name',
            'required|min_length[3]|is_unique[tb_service.name]'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'status' => $this->input->post('status')
            );
            if ($this->service_model->save($data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/service/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/service/create'));
            }
        }        
    }

    function edit($id)
    {
        $data['halaman'] = 'service';
        $data['module'] = 'service';
        $data['content'] = 'service_edit';
        $data['service'] = $this->service_model->service_by_id($id);
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {
        $this->form_validation->set_rules(
            'name', 'Name',
            'required|min_length[3]|callback__service_callback'
        );

        if ($this->form_validation->run($this) == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'status' => $this->input->post('status')
            );
            if ($this->service_model->update($id, $data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/service'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/service'));
            }
        }
    }

    function destroy($id)
    {
        $delete = $this->service_model->delete($id);
        if ($delete) {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/service'));
        } else {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/service'));
        }
    }

    function _service_callback($name)
    {
        // $id = $this->input->post('id', TRUE);
        $id = $this->uri->segment(4);
        $data = $this->service_model->service_validation($id, $name);
        
        if ($data->num_rows() > 0) {
            $this->form_validation->set_message('_service_callback', '%s already taken.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}