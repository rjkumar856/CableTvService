<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_page extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }

    public function insert_post($data){
    $this->db->insert('tbl_rental_post',$data);

    $id = $this->db->insert_id();
    return (isset($id)) ? $id : FALSE;  
    }

    public function GetNetworkType(){
        $sql = "SELECT * FROM network_type WHERE status='1'";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function GetAllPacksByNetworkType(){
        $this->result=array();
        $this->sql = "SELECT * FROM network_type WHERE package_type='1' AND status='1'";        
        $this->query = $this->db->query($this->sql);
        foreach($this->query->result_array() as $key=>$value){
            $this->result[$value['Name']]='';
        
        $sql_pack = "SELECT * FROM internet_pack WHERE Network_id='$value[id]' AND status='1' ORDER BY serial_number ASC, date_added DESC";
        $query_pack = $this->db->query($sql_pack);        
        $this->result[$value['Name']] = $query_pack->result_array();
        }
        
        return $this->result;
    }
    
    public function GetAllPacksByID($id){
        $sql = "SELECT * FROM internet_pack WHERE Network_id='$id' AND status='1' ORDER BY serial_number ASC, date_added DESC";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function GetPacks(){
        $sql = "SELECT * FROM internet_pack WHERE status='1' ORDER BY serial_number ASC, date_added DESC";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function GetCablePacks(){
        $sql = "SELECT * FROM cable_package WHERE status='1'";        
        $query = $this->db->query($sql);        
        return $query->result_array();
    }
    
    public function GetCableChannelsbyType(){
        $result=array();
        $sql = "SELECT * FROM channel_package cp INNER JOIN channel ch ON ch.id=cp.channel_id INNER JOIN genre ge ON ge.id=ch.genre_id WHERE cp.status='1' AND ch.status='1' AND ge.status='1' ORDER BY ge.priority ASC, cp.cp_id ASC";        
        $query = $this->db->query($sql);
        
        foreach($query->result_array() as $key=>$value){
            $result[$value['cp_id']][$value['name']][]=$value;
        }
        return $result;
        
        //return $query->result_array();
    }
    
    
}