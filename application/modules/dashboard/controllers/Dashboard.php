<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    function index()
    {
        $data['halaman'] = 'dashboard';
        $data['module'] = 'dashboard';
        $data['content'] = 'dashboard';
        echo Modules::run('backend_template', $data);
    }
}