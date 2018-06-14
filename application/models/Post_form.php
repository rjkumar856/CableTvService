<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_form extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_contact($data){
    $this->db->insert('contact',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
    public function insert_newNotification($data){
    $this->db->insert('notification',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
    public function insert_newconnection($data){
    $this->db->insert('new_connection',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
}