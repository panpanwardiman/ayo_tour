<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model
{

    private $table = 'tb_slider';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function slider_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    function save($data)
    {
        return $this->db->insert($this->table, $data);
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

    function service_validation($id, $name)
    {
        return $this->db->select('name')
                        ->where('name', $name)
                        ->where('id !=', $id)
                        ->get($this->table);
    }

}