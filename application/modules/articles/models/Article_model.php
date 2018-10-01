<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{

    private $table = 'tb_articles';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        return $this->db->select('a.id, a.title, a.tag, a.status, a.date, b.first_name as author, c.name as category')
                        ->from('tb_articles a')
                        ->join('tb_users b', 'b.id = a.user_id', 'left')
                        ->join('tb_categories c', 'c.id = a.category_id', 'left')
                        ->get();
    }  
    
    function save($data)
    {   
        return $this->db->insert($this->table, $data);
    }

    function article_by_id($id)
    {
        return $this->db->select('a.id, a.title, a.content, a.tag, a.status, a.article_image, b.id as category_id,')
                        ->from('tb_articles a')
                        ->join('tb_categories b', 'b.id = a.category_id', 'left')
                        ->where('a.id', $id)
                        ->get()->row();
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

}