<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('package_model');
        $this->load->model('category/category_model');
        $this->load->model('tags/tags_model');
        $this->load->library('upload');
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = ['packages', 'all packages'];
        $data['module'] = 'packages';
        $data['content'] = 'package_list';
        $data['packages'] = $this->package_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function create()
    {
        $data['halaman'] = ['packages', 'new packages'];
        $data['module'] = 'packages';
        $data['content'] = 'package_create';
        $data['categories'] = $this->category_model->get_all();
        $data['tags'] = $this->tags_model->get_all();
        echo Modules::run('backend_template', $data);
    }

    function store()
    {
        $this->form_validation->set_rules('package_name', 'Package Name', 'required|max_lenght[100]');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('trip_duration_days', 'Trip Duration Days', 'required|max_lenght[2]|numeric');
        $this->form_validation->set_rules('trip_duration_nights', 'Trip Duration Nights', 'required|max_lenght[2]|numeric');
        $this->form_validation->set_rules('inclutions', 'Inclutions', 'required');
        $this->form_validation->set_rules('exclutions', 'Exclutions', 'required');
        $this->form_validation->set_rules('itinerary', 'Itinerary', 'required|numeric');
        $this->form_validation->set_rules('itinerary_content', 'Itinerary Content', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './uploaded/image';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['max_width'] = 1536;
            $config['max_height'] = 768;
            // $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (empty($_FILES['image']['name'])) {
                
            } else {
                if ($this->upload->do_upload('image')) {
                    $img = $this->upload->data();
                    $gallery['package_gallery'] = $img['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata(
                        'message', 
                        '<div class="callout callout-danger"><p>'.$error.'</p></div>'                
                    );                                               
                    redirect(site_url('at-admin/package/create'));
                }
            }

            $packages['package_name'] = $this->input->post('package_name');
            $packages['content'] = $this->input->post('content');
            $packages['price'] = $this->input->post('price');
            $packages['category_id'] = $this->input->post('category_id');
            $packages['tag'] = $this->input->post('tag');
            $packages['trip_duration_days'] = $this->input->post('trip_duration_days');
            $packages['trip_duration_nights'] = $this->input->post('trip_duration_nights');
            $packages['inclutions'] = explode('|', $this->input->post('inclutions'));
            $packages['exclutions'] = explode('|', $this->input->post('exclutions'));
            $itenarary['itinerary_days'] = $this->input->post('itinerary_days');
            $itenarary['itinerary_title'] = $this->input->post('itinerary_title');
            $itenarary['itinerary_content'] = $this->input->post('itinerary_content');

            if ($this->package_model->save($packages, $itinerary, $gallery)) {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-info"><p>Data berhasil disimpan</p></div>'                
                );                                               
                redirect(site_url('at-admin/package/create'));
            } else {
                $this->session->set_flashdata(
                    'message', 
                    '<div class="callout callout-danger"><p>Data gagal disimpan</p></div>'                
                );                                               
                redirect(site_url('at-admin/package/create'));
            }
        }
    }

}