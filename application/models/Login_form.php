<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_form extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_login($data){
    $sql = "SELECT *,us.id as UserID, us.status as UserStatus FROM user us LEFT JOIN user_as_smartcard ua ON ua.user_id=us.id WHERE (us.userid='$data' OR ua.smart_card_no='$data')";        
    $query = $this->db->query($sql);        
    return $query->result_array();
    }
    public function inserLoggedDetails($data){
    $this->db->insert('logged_user',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
    public function post_forgot_password($data){
    $this->db->insert('forgot_password_request',$data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
    }
    
}