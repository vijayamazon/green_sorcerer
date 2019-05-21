<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_profile extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
       
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck())
     {
      redirect('user_auth');
     }
     else
     {
     	$user=$this->session->userdata('user_logged_in');  
     	$this->user_id=$user['id'];
     }
  }
  public function index()
  {
      $this->load->view('UI/header');
      $this->load->view('UI/my_profile');
      $this->load->view('UI/footer');
  }
  public function update_amazon_api()
  {
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
         if(isset($api->seller_id) && isset($api->tokenid) && isset($api->access_key) && isset($api->secret_key) && isset($api->market_id) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->access_key) && !empty($api->secret_key) && !empty($api->market_id))
         {
            if($this->update_api($api->seller_id,$api->tokenid,$api->access_key,$api->secret_key,$api->market_id))
            {
               echo '{"status_code":"1","status_text":"API details updated"}';         
            }
            else
            {
                echo '{"status_code":"0","status_text":"Server Error please try again"}';     
            }
         }
         else
         {
           echo '{"status_code":"0","status_text":"Input Error"}';     
         }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input Error"}';  
      }
  }
  public function update_api($seller_id,$token_id,$access_key,$secret_key,$market_id)
    {
       $time_stamp=date("Y-m-d H:s:i");
       $sql="INSERT INTO amazon_profile(profile_id,seller_id,auth_token,access_key,secret_key,market_placeID) VALUES($this->user_id,'{$seller_id}','{$token_id}','{$access_key}','{$secret_key}','{$market_id}')
             ON DUPLICATE KEY UPDATE seller_id = VALUES(seller_id),auth_token=VALUES(auth_token),access_key=VALUES(access_key),secret_key=VALUES(secret_key),market_placeID=VALUES(market_placeID);";
       if($this->db->query($sql))      
       {
          return TRUE;
       }
       else
       {
          return false;
       }
    }

  public function get_profile_info()
  {
     $sql="SELECT scr_u_id as uid,scr_firstname as fname,scr_lastname as lname,scr_uname as email,scr_is_verified as is_verified,scr_active as is_active,trial_count as credits,
                 DATE_FORMAT(joined_on,'%Y-%m-%d') as joined,profile_img as pro_img
          FROM `scr_user` WHERE scr_u_id={$this->user_id}";
     $query=$this->db->query($sql);
     $data['details']=$query->result_array();
     $query=$this->db->query("SELECT seller_id as seller_id,auth_token as tokenid,access_key as access_key,secret_key as secret_key ,market_placeID as market_id FROM amazon_profile WHERE profile_id={$this->user_id};");
     $data['api_details']=$query->result_array();
     $data['status_code']='1';
     $data['status_text']='Success';
     echo json_encode($data);
      
    
   
  }  
  public function update_profile()
  {
    $this->load->library('upload');
      $main='';
      if(!empty($_FILES['attached_file']['tmp_name']))
      {
          $main=$this->uploadprodimg('attached_file','./asset/profile_img/');
          if($this->db->query("UPDATE scr_user SET profile_img='".$main."' WHERE scr_u_id=".$this->user_id))
          {
            echo '{"status_code":"1","status_text":"Successfully updated"}';
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update"}';
          }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input error"}';
      }
  }
  function uploadprodimg($image,$folder)
    {
           $config['upload_path'] = $folder;
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
           $config['file_name']=md5(microtime());
           $config['max_size']  = '2000';
           $config['max_width']  = '0';
           $config['max_height']  = '0';
           $this->upload->initialize($config);
           if( ! $this->upload->do_upload($image))
           {  

              echo '{"status_code":"0","status_text":"'.$this->upload->display_errors().'"}';
              die();
              // return FALSE;
           }
           else
           {
               $img=$this->upload->data();
               return $img['file_name'];; 
           }
    }
 
    
}

