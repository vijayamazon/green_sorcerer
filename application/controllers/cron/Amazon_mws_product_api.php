 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amazon_mws_product_api extends CI_Controller 
{
  public function  __construct()
  {
	     parent::__construct();
       	 $this->load->model('amazon_feed/amazon_product_api','amazon_api');
  }

   public function product_match()
  {
    $query=$this->db->query("SELECT * FROM amazon_profile WHERE profile_id='1'");
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
 			  		$qi="UPDATE product_info SET pro_us_rank=".$this->db->escape($res['payload']['sales_rank']).",pro_isbn=".$this->db->escape($res['payload']['lm_ean']).",pro_asin=".$this->db->escape($res['payload']['lm_asin']).",pro_asin_counts=".$this->db->escape($res['payload']['asin_counts']).",pro_image=".$this->db->escape($res['payload']['image']).",pro_weight=".$this->db->escape($res['payload']['weight']).",pro_title=".$this->db->escape($res['payload']['title']).",process_flag=1 WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			  	elseif($res['status_code']==3)
 			  	{
 			  		//$product[]=$res['payload'];
 			  		$qi="UPDATE product_info SET pro_us_rank=".$this->db->escape($res['payload']['sales_rank']).",pro_isbn=".$this->db->escape($res['payload']['lm_ean']).",pro_asin=".$this->db->escape($res['payload']['lm_asin']).",pro_asin_counts=".$this->db->escape($res['payload']['asin_counts']).",pro_image=".$this->db->escape($res['payload']['image']).",pro_weight=".$this->db->escape($res['payload']['weight']).",pro_title=".$this->db->escape($res['payload']['title']).",process_flag=1 WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			 $res=$this->amazon_api->fetch_product_detail($usr['profile_id'],$res['payload']['lm_asin']);
 			  	if($res['status_code']==1)
 			  	{
 			  		$qi="UPDATE product_info SET pro_us_price=".$this->db->escape($res['payload']['low_price'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	}
 			  	elseif($res['status_code']==3)
 			  	{
 			  		//$product[]=$res['payload'];
 			  		$qi="UPDATE product_info SET pro_us_price=".$this->db->escape($res['payload']['low_price'])." WHERE pro_isbn='".$prd['pro_isbn']."' ";
					//print_r($qi);
					
                    $this->db->query($qi);
					echo "\n INSERT MADED**********************\n";
 			  	} 
				if($res['payload']['low_price'] > 0){
					
					$sqlquery="SELECT * FROM product_info INNER JOIN rule_info WHERE pro_us_rank BETWEEN  ROUND(min_sales_rank) AND ROUND(max_sales_rank) AND CEIL(ROUND((net_amount),'2') >= ROUND((pro_us_price),'2')) AND pro_isbn='".$prd['pro_isbn']."' ";
					$query=$this->db->query($sqlquery) ;
                    $data= $query->result_array();
					print_r($data);
					if(count($data) > 0){
						$qi="UPDATE product_info SET pro_color='".$data[0]['color']."',match_flag='1',pro_sound='".$data[0]['sound']."' WHERE pro_isbn='".$prd['pro_isbn']."' ";
						print_r($qi);
						$this->db->query($qi);
					}
				}
         }
	     
	  }
	}
  }
 }
}
}