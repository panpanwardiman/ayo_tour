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
        return $this->db->select('a.id, a.title, a.status, a.date, b.first_name as author, c.name as category')
                        ->from('tb_articles a')
                        ->join('tb_users b', 'b.id = a.user_id', 'left')
                        ->join('tb_categories c', 'c.id = a.category_id', 'left')
                        ->get();
    }  
    
    function save($data)
    {   
        $article = array(
            'title' => $data['title'] ,
            'content' => $data['content'],
            'category_id' => $data['category_id'] ,
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'slug' => $data['slug'], 
            'date' => $data['date'],
            'article_image' => $data['article_image'],
        );

        $tags_articles = $data['tags'];
        $this->db->trans_start();
        $this->db->insert($this->table, $article);
        $article_id = $this->db->insert_id();
        for ($i=0; $i < count($tags_articles); $i++) { 
            $tag[] = array(
                'tag_id' => $tags_articles[$i],
                'article_id' => $article_id
            );
        }
        $this->db->insert_batch('tb_tags_articles', $tag);
        $this->db->trans_complete();
        return TRUE;
        
    }

    function article_by_id($id)
    {
        return $this->db->select('a.id, a.title, a.content, a.status, a.article_image, b.id as category_id,')
                        ->from('tb_articles a')
                        ->join('tb_categories b', 'b.id = a.category_id', 'left')
                        ->where('a.id', $id)
                        ->get()->row();
    }

    function update($id, $data)
    {
        $article = array(
            'title' => $data['title'] ,
            'content' => $data['content'],
            'category_id' => $data['category_id'] ,
            'user_id' => $data['user_id'],
            'status' => $data['status'],
            'slug' => $data['slug'], 
            'date' => $data['date'],
            'article_image' => $data['article_image'],
        );

        $tags_articles = $data['tags'];
        for ($i=0; $i < count($tags_articles); $i++) { 
            $tag[] = array(
                'tag_id' => $tags_articles[$i],
                'article_id' => $id
            );
        }

        foreach ($tag as $key => $value) {
            $sql[] ="(".implode(',', $tag[$key]).")";
        }
        $temp = array_keys($tag);
        $rows = $tag[$temp[0]];
        foreach ($rows as $key => $value) {
            $updatestr[] = $key." = VALUES(".$key.")";
        }

        // echo "INSERT INTO tb_tags_articles(tag_id, article_id) VALUES ".implode(',', $sql)." ON DUPLICATE KEY UPDATE ".implode(', ', $updatestr);

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $article);
        $this->db->query("INSERT INTO tb_tags_articles(tag_id, article_id) VALUES ".implode(',', $sql)." ON DUPLICATE KEY UPDATE ".implode(', ', $updatestr));
        $this->db->trans_complate();
        return TRUE;
    }

}