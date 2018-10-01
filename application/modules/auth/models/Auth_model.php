<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    private $table = 'tb_users';

    function __construct()
    {
        parent::__construct();
    }

    function login($email)
    {
        return $this->db->select('id, first_name, password')
                        ->from($this->table)
                        ->where('email', $email)
                        ->get()->row();
    }
}