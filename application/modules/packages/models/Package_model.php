<?php 
defined('BASEPATH') OR exit('No script direct access allowed');

class Package_model extends CI_Model 
{

    private $table = 'tb_packages';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function save($packages, $itinerary, $gallery)
    {
        $itinerary_days = $itinerary['itinerary_days'];
        $itinerary_title = $itinerary['itinerary_title'];
        $itinerary_content = $itinerary['itinerary_content'];

        $this->db->trans_start();
        
        $this->db->insert($this->table, $packages);
        $package_last_id = $this->db->insert_id();
        
        for ($i=0; $i < count($itinerary_days); $i++) { 
            $itineraries[] = array(
                'days' => $itinerary_days[$i],
                'title' => $itinerary_title[$i],
                'content' => $itinerary_content[$i],
                'package_id' => $package_last_id
            );
        }
        $this->db->insert_batch('tb_packages_itinerary', $itineraries);
        foreach ($gallery as $key => $value) {
            $package_gallery[] = array(
                'image' => $gallery[$key],
                'package_id' => $package_last_id
            );
        }
        $this->db->insert_batch('tb_packages_gallery', $package_gallery);
        
        $this->db->trans_complete();
    }

}