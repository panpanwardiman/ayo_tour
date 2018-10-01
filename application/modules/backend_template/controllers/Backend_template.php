<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_template extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('ayo_tour_helper');
        is_logged_in();
    }

    function index($data)
    {
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('content', $data);
        $this->load->view('footer');
    }

}