<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amazon_mws_product_api_mx extends CI_Controller 
{
  public function  __construct()
  {
	     parent::__construct();
       	 $this->load->model('amazon_feed/Amazon_product_api_mx','amazon_api');
  }

  public function product_match()
  {
    $query=$this->db->query("SELECT * FROM amazon_profile WHERE profile_id='3'");
    $user=$query->result_array();
    if(count($user) > 0)
    {
      foreach($user as $usr)
      {
         $this->amazon_api->set_credentials($usr['profile_id'],$usr['seller_id'],$usr['auth_token'],$usr['access_key'],$usr['secret_key'],$usr['market_placeID']);
         $prod_list=$this->amazon_api->get_product_to_match(600000);
         if(!empty($prod_list))
         {
         	echo date('y-m-d h:i:s')."\n";
         	foreach($prod_list as $prd)
         	{
 			  if($prd['pro_isbn'])
 			  {
 			//time_nanosleep(0, 500000000);
 			  	echo "Processing\t".$prd['pro_isbn']."\n";
 			  	$res=$this->amazon_api->fetch_product_details($usr['profile_id'],$prd['pro_isbn']);
 			  	if($res['status_code']==1)
 			  	{
 			  		$qi="UPDATE product_info SET pro_mx_rank=".$this->db->escape($res['payload']['sales_rank'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			  	elseif($res['status_code']==3)
 			  	{
 			  		//$product[]=$res['payload'];
 			  		$qi="UPDATE product_info SET pro_mx_rank=".$this->db->escape($res['payload']['sales_rank'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			 $res=$this->amazon_api->fetch_product_detail($usr['profile_id'],$res['payload']['lm_asin']);
 			  	if($res['status_code']==1)
 			  	{
 			  		$qi="UPDATE product_info SET pro_mx_price=".$this->db->escape($res['payload']['low_price'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			  	elseif($res['status_code']==3)
 			  	{
 			  		//$product[]=$res['payload'];
 			  		$qi="UPDATE product_info SET pro_mx_price=".$this->db->escape($res['payload']['low_price'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	} 
         }
	     
	  }
	}
  }
 }
}
}