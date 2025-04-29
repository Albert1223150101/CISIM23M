<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class berita_model extends CI_Model{
    public function get_all_berita(){
        return $this->db->get('berita')->result_array();
    }
    public function insert_berita($data){
        return $this->db->insert('berita', $data);
    }

}