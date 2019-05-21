<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProUpdate extends CI_Controller {
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
      $query = ("SELECT * FROM cron_update");
      $data['result'] = $this->db->query($query)->result();
      $this->load->view('UI/header');
      $this->load->view('UI/updation',$data);
      $this->load->view('UI/footer');
  }
}

?>