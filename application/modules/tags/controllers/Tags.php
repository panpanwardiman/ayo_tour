<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('tags_model');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = 'tag';
        $data['module'] = 'tags';
        $data['content'] = 'tag_list';
        $data['tags'] = $this->tags_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = 'tag';
        $data['module'] = 'tags';
        $data['content'] = 'tag_create';
        echo Modules::run('backend_template', $data);
    }

    function store() 
    {        
        $this->form_validation->set_rules(
                'name', 'Name', 
                'required|min_length[3]|is_unique[tb_tags.name]'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data['name'] = $this->input->post('name',TRUE);
            $data['slug'] = $this->input->post('slug',TRUE); 

            if ($data['slug'] == NULL) {
                $data['slug'] = url_title($this->input->post('name'));
            } else {
                $data['slug'] =$this->input->post('slug');
            }
            if ($this->tags_model->save($data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/tag/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/tag/create'));
            }
        }
    }

    function edit($id)
    {
        $data['halaman'] = 'tag';
        $data['module'] = 'tags';
        $data['content'] = 'tag_edit';
        $data['tag'] = $this->tags_model->tag_by_id($id);
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {
        $this->form_validation->set_rules(
                'name', 'Name', 
                'required|min_length[3]|callback__tag_callback'
        );
        $this->form_validation->set_rules('slug', 'Slug', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            redirect(site_url('at-admin/tag/'.$id));
        } else {
            $data = array(
                'name' => $this->input->post('name',TRUE), 
                'slug' => $this->input->post('slug',TRUE), 
            );
            if ($this->tags_model->update($id, $data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/tag'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/tag'));
            }
        }
    }

    function destroy($id)
    {
        if ($this->tags_model->delete($id)) {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/tag'));
        } else {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/tag'));
        }
    }

    function _tag_callback($name)
    {
        // $id = $this->input->post('id', TRUE);
        $id = $this->uri->segment(4);
        $data = $this->tags_model->tag_validation($id, $name);
        
        if ($data->num_rows() > 0) {
            $this->form_validation->set_message('_tag_callback', '%s already taken.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}