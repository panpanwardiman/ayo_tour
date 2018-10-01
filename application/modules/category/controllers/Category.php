<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library('upload');
        is_logged_id();
    }

    function index()
    {
        $data['halaman'] = 'category';
        $data['module'] = 'category';
        $data['content'] = 'category_list';
        $data['categories'] = $this->category_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = 'category';
        $data['module'] = 'category';
        $data['content'] = 'category_create';
        echo Modules::run('backend_template', $data);
    }

    function store() 
    {
        $this->form_validation->set_rules(
                'name', 'Name', 
                'required|min_length[3]|is_unique[tb_categories.name]'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './uploaded/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (empty($_FILES['image']['name'])) {
                $data['name'] = $this->input->post('name',TRUE);
                $data['status'] = $this->input->post('status', TRUE);
                $data['slug'] = $this->input->post('slug',TRUE);
                if ($data['slug'] == NULL) {
                    $data['slug'] = url_title($this->input->post('name'));
                } else {
                    $data['slug'] =$this->input->post('slug');
                }
            } else {
                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();
                    $data['name'] = $this->input->post('name',TRUE);
                    $data['category_image'] = $img['file_name'];
                    $data['status'] = $this->input->post('status', TRUE);
                    $slug = $this->input->post('slug',TRUE);
                    if ($slug == NULL) {
                        $data['slug'] = url_title($this->input->post('name'));
                    } else {
                        $data['slug'] =$this->input->post('slug');
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'message', 
                        '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                    );                                               
                    redirect(site_url('at-admin/category/create'));
                }
            }                

            if ($this->category_model->save($data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/category/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/category/create'));
            }
        }
    }

    function edit($id)
    {
        $data['halaman'] = 'category';
        $data['module'] = 'category';
        $data['content'] = 'category_edit';
        $data['category'] = $this->category_model->category_by_id($id);
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {
        $this->form_validation->set_rules(
                'name', 'Name', 
                'required|min_length[3]|callback__category_callback'
        );
        $this->form_validation->set_rules('slug', 'Slug', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            redirect(site_url('at-admin/category/'.$id));
        } else {
            $config['upload_path'] = './uploaded/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (empty($_FILES['image']['name'])) {
                $data['name'] = $this->input->post('name',TRUE);
                $data['status'] = $this->input->post('status', TRUE);
                $data['slug'] = $this->input->post('slug',TRUE);
                if ($data['slug'] == NULL) {
                    $data['slug'] = url_title($this->input->post('name'));
                } else {
                    $data['slug'] =$this->input->post('slug');
                }
            } else {
                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();
                    $data['name'] = $this->input->post('name',TRUE);
                    $data['category_image'] = $img['file_name'];
                    $data['status'] = $this->input->post('status', TRUE);
                    $data['slug'] = $this->input->post('slug',TRUE);

                    $active_image = $this->input->post('active_image',TRUE);
                    unlink('./uploaded/image/'.$active_image);

                    if ($data['slug'] == NULL) {
                        $data['slug'] = url_title($this->input->post('name'));
                    } else {
                        $data['slug'] =$this->input->post('slug');
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'message', 
                        '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                    );                                             
                    redirect(site_url('at-admin/category'));
                }
            }

            if ($this->category_model->update($id, $data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/category'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/category'));
            }
        }
    }

    function destroy($id)
    {
        if (is_logged_in()) {
            $category = $this->category_model->category_by_id($id);
            unlink('./uploaded/image/'.$category->category_image);
            
            if ($this->category_model->delete($id)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
                );
                redirect(site_url('at-admin/category'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
                );
                redirect(site_url('at-admin/category'));
            }
        }
    }

    function _category_callback($name)
    {
        // $id = $this->input->post('id', TRUE);
        $id = $this->uri->segment(4);
        $data = $this->category_model->category_validation($id, $name);
        
        if ($data->num_rows() > 0) {
            $this->form_validation->set_message('_category_callback', '%s already taken.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}