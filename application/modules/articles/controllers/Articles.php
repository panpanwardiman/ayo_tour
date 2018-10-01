<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->model('category/category_model');
        $this->load->model('tags/tags_model');
        $this->load->library('upload');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = ['articles', 'all article'];
        $data['module'] = 'articles';
        $data['content'] = 'article_list';
        $data['articles'] = $this->article_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = ['articles', 'new article'];
        $data['module'] = 'articles';
        $data['content'] = 'article_create';
        $data['tags'] = $this->tags_model->get_all();
        $data['categories'] = $this->category_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './uploaded/image';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $img = $this->upload->data();
                $data = array(
                    'title' => $this->input->post('title'), 
                    'content' => $this->input->post('content'), 
                    'category_id' => $this->input->post('category_id'), 
                    'user_id' => $this->session->userdata('id'),
                    'status' => $this->input->post('status'), 
                    'slug' => url_title($this->input->post('title')), 
                    'tag' => implode(',', $this->input->post('tag')), 
                    'date' => date('y-m-d'),
                    'article_image' => $img['file_name'], 
                );
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                );                                              
                redirect(site_url('at-admin/article/create'));
            }

            if ($this->article_model->save($data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/article/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan !</p></div>'                
                );
                redirect(site_url('at-admin/article/create'));
            }
        }
    }

    function edit($id)
    {
        $data['halaman'] = ['articles', 'all article'];
        $data['module'] = 'articles';
        $data['content'] = 'article_edit';
        $data['article'] = $this->article_model->article_by_id($id);
        $data['tags'] = $this->tags_model->get_all();
        $data['categories'] = $this->category_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $config['upload_path'] = './uploaded/image';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (empty($_FILES['image']['name'])) {
                $data = array(
                    'title' => $this->input->post('title'), 
                    'content' => $this->input->post('content'), 
                    'category_id' => $this->input->post('category_id'), 
                    'user_id' => $this->session->userdata('id'),
                    'status' => $this->input->post('status'), 
                    'slug' => url_title($this->input->post('title')), 
                    'tag' => implode(',', $this->input->post('tag')),
                    'date' => date('y-m-d'),
                );
            } else {
                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();
                    $data = array(
                        'title' => $this->input->post('title'), 
                        'content' => $this->input->post('content'), 
                        'category_id' => $this->input->post('category_id'), 
                        'user_id' => $this->session->userdata('id'),
                        'status' => $this->input->post('status'), 
                        'slug' => url_title($this->input->post('title')), 
                        'tag' => implode(',', $this->input->post('tag')), 
                        'date' => date('y-m-d'),
                        'article_image' => $img['file_name'], 
                    );
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'message', 
                        '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                    );                                               
                    redirect(site_url('at-admin/article/create'));
                }
            }

            if ($this->article_model->update($id, $data)) {                 
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil diedit !</p></div>'                
                );
                redirect(site_url('at-admin/article/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal diedit !</p></div>'                
                );
                redirect(site_url('at-admin/article/create'));
            }
        }
    }

    function destroy($id)
    {
        $article = $this->article_model->article_by_id($id);
        unlink('./uploaded/image/'.$article->article_image);
        if ($this->article_model->delete($id)) {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-info"><p>Data berhasil dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/article'));
        } else {
            $this->session->set_flashdata(
                'message', 
                '<div class="callout callout-danger"><p>Data gagal dihapus !</p></div>'                
            );
            redirect(site_url('at-admin/article'));
        }
    }

}