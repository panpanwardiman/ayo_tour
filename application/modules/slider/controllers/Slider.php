<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('slider_model');
        $this->load->library('upload');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = 'slider';
        $data['module'] = 'slider';
        $data['content'] = 'slider_list';
        $data['sliders'] = $this->slider_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = 'slider';
        $data['module'] = 'slider';
        $data['content'] = 'slider_create';
        echo Modules::run('backend_template', $data);
    }

    function store()
    {
        // $this->form_validation->set_rules('image', 'Image', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './uploaded/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $img = $this->upload->data();
                $data = array(
                    'slider_image' => $img['file_name'], 
                    'status' => $this->input->post('status')
                );
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                );
                redirect(site_url('at-admin/slider'));
            }
            
            if ($this->slider_model->save($data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/slider/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/slider/create'));
            }
        }
    }

    function edit($id)
    {
        $data['halaman'] = 'slider';
        $data['module'] = 'slider';
        $data['content'] = 'slider_edit';
        $data['slider'] = $this->slider_model->slider_by_id($id);
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {           
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './uploaded/image/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (empty($_FILES['image']['name'])) {
                $data = array(
                    'status' => $this->input->post('status')
                );
            } else {
                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();
                    $data = array(
                        'slider_image' => $img['file_name'], 
                        'status' => $this->input->post('status')
                    );
                    $current_image = $this->input->post('current_image');
                    unlink('./uploaded/image/'.$current_image);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'message', 
                        '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                    );
                    redirect(site_url('at-admin/slider'));
                }
            }
            
            if ($this->slider_model->update($id, $data)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/slider'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/slider'));
            }
        }
    }

    function destroy($id)
    {
        $slider = $this->slider_model->slider_by_id($id);
        unlink('./uploaded/image/'.$slider->slider_image);
        
        if ($this->slider_model->delete($id)) {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/slider'));
        } else {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/slider'));
        }
    }

}