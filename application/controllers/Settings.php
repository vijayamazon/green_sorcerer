<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
  private $user_id;
  public function  __construct()
  {
       parent::__construct();
      if(!$this->login_model->userLoginCheck())
      {
        redirect('user_auth');
      }
      else
      {
        $this->load->model("settings_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
       
      }
       
  }

  public function index()
  {
    $this->load->view('UI/header');
    $this->load->view('UI/settings');
    $this->load->view('UI/footer');
  }
  public function get_product_list($orderby='rule_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->settings_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }

  
  public function add_spec_info()
  {
    if(!empty($_POST["min_sales_rank"]) && !empty($_POST["max_sales_rank"]) && !empty($_POST["net_amount"] ) && !empty($_POST["color"] ) && !empty($_POST["sound"] ))
      {
         if($this->settings_model->add_spec_info($this->input->post("min_sales_rank"),$this->input->post("max_sales_rank"),$this->input->post("net_amount"),$this->input->post("color"),$this->input->post("sound")))
         {
              echo '{"status_code":"1","status_text":"Setuped Sucessfully"}';
           
         }
         else
         {
           echo '{"status_code":"0","status_text":"something went wrong please try again"}';      
         }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Mandatory data missing "}';  
      }
  }
  
  public function remove_products()
      {
        if(isset($_POST['sku_set']))
        {
          $id_set=json_decode($_POST['sku_set']);
          if(empty($id_set))
          {
            echo  '{"status_code":"0","status_text":"No product selected for remove"}';   
      	    die();            
          }
           $product=$this->settings_model->get_selected_product_details($id_set);
               // print_r($product);
               // die();
                  if(!empty($product))
                  {
                      
                   $sql="DELETE FROM  rule_info  WHERE rule_id in (";
                              $id_csv='';  
                              foreach($product as $pro)
                                {
                                  $id_csv.=$pro['rule_id'].","; 
                                } 
                              $id_csv=rtrim($id_csv,",");
                              $sql=$sql.$id_csv.")";
                              $this->db->query($sql);
							 
                              echo  '{"status_code":"1","status_text":"The Rule has been removed successfully"}';             
                              }
                              else
                              {
                                 echo  '{"status_code":"0","status_text":"No Rule has been removed"}';              
                              }

		}
	  }
  
  
 
}

