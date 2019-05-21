<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
	  }
    
	public function get_inventory_list($orderby='rule_id',$direction='ASC',$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            
            $srterm=urldecode($str[0]->searchtext);
         }

         $sort_order='rule_id';
         if($orderby=='rule_id')
         {
          $sort_order='rule_id';
         } 
         $sqlcount="SELECT count(*) as total from rule_info  WHERE is_active=1  ";
                    
         $sqlquery= "SELECT rule_id,min_sales_rank,max_sales_rank,net_amount from rule_info WHERE is_active=1 ";

	

        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (pro_isbn LIKE '%".$srterm."%' OR pro_asin LIKE '%".$srterm."%' ) "; 
          $sqlcount.=" AND (pro_isbn LIKE '%".$srterm."%' OR pro_asin LIKE '%".$srterm."%'  ) "; 
        }

        $sqlquery.=" ORDER BY ".$orderby." ".$direction." LIMIT ".$offet.",".$limit;

        $query=$this->db->query($sqlquery) ;
        $data= $query->result_array();
        $countquery=$this->db->query($sqlcount);
        
        $numrows= $countquery->result_array();
        if(count($data) > 0)
        {
        $result_set=array('status_code'=>'1','status_text'=>'successfully reterived','total' =>$numrows[0]['total'], 'datalist' => $data ,'searchterm' => $searchterm );
        }
        else
        {
         $result_set=array('status_code'=>'0','status_text'=>'No data found'); 
        }
        return $result_set;
    }
	public function add_spec_info($min_sales_rank,$max_sales_rank,$net_amount,$color,$sound)
     {
         $this->db->trans_start();
         $update_vitalinfo=array(
                           'min_sales_rank'=>$min_sales_rank,
                           'max_sales_rank'=>$max_sales_rank,
                           'net_amount'=>$net_amount,
						   'color'=>$color,
						   'sound'=>$sound,
						   'is_active'=>'1',
                          );
          $this->db->insert('rule_info', $update_vitalinfo);
         
         $this->db->trans_complete();
         if ($this->db->trans_status() === FALSE)
         {
               return FALSE;
         }
         else
         {
              return TRUE;
         }
     }
	 public function get_selected_product_details($id_set)
  {
    $sql="SELECT rule_id FROM rule_info where rule_id in (";
      foreach($id_set  as $asin)
      {
        $sql.="'".$asin."',";
      }
     $sql=rtrim($sql,",");
     $sql=$sql.")";
                          
     $query=$this->db->query($sql);
     return $query->result_array();     
  }

 
 
}