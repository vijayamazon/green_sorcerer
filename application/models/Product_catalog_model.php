<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_catalog_model extends CI_Model
{
    public function  __construct()
    {
       parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
       
    }

    public function getProducts($limit, $start, $search)
    {
      $sql= "SELECT * FROM new_products $search LIMIT $limit OFFSET $start ";
      //print_r($sql);exit;
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;                
    }

    public function record_count($search_params) {
      $sql= "SELECT * FROM new_products $search_params ";
      $query=$this->db->query($sql);
      return $query->num_rows(); 
    }
}