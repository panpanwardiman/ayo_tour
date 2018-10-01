<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $table = 'tb_users';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function user_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    function update($id, $data)
    {
        return $this->db->where('id', $id)
                        ->update($this->table, $data);
    }

    function delete($id)
    {
        return $this->db->where('id', $id)
                    ->delete($this->table);
    }

    function email_validation($id, $email)
    {
        return $this->db->select('email')
                        ->where('email', $email)
                        ->where('id !=', $id)
                        ->get($this->table);
    }

    function _update_password($id, $data)
    {
        return $this->db->where('id', $id)
                        ->update($this->table, $data);
    }

}