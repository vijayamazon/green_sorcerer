<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Amazon_price_inventory_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
	  }
    public function get_inventory_list($orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            
            $srterm=urldecode($str[0]->searchtext);
         }

         $sort_order='pro_id';
         if($orderby=='pro_id')
         {
          $sort_order='pro_asin';
         }
		 
         $sqlcount="SELECT count(*) as total from product_info  WHERE process_flag=1 AND pro_asin_counts > '0'  ";
         $user=$this->session->userdata('user_logged_in');
	     if($user['isadmin']==1 && $user['isverified']==1)
		{           
         $sqlquery= "SELECT  pro_id,pro_isbn,pro_weight,pro_title,pro_image,FORMAT(pro_us_rank, '#,###0 ') AS  pro_us_rank,CONCAT('$',pro_us_price) AS pro_us_price,
FORMAT(pro_ca_rank, '#,###0') AS pro_ca_rank,CONCAT('$',pro_ca_price) AS pro_ca_price,FORMAT(pro_uk_rank, '#,###0') AS pro_uk_rank,CONCAT('$',pro_uk_price) AS pro_uk_price,
FORMAT(pro_mx_rank, '#,###0') AS pro_mx_rank,CONCAT('$',pro_mx_price) AS pro_mx_price,FORMAT(pro_in_rank, '#,###0') AS pro_in_rank,CONCAT('$',pro_in_price) AS pro_in_price,
FORMAT(pro_jp_rank, '#,###0') AS pro_jp_rank,CONCAT('$',pro_jp_price) AS pro_jp_price,FORMAT(pro_as_rank, '#,###0') AS pro_as_rank,CONCAT('$',pro_as_price) AS pro_as_price,pro_color,pro_sound,match_flag,purchased_price
FROM product_info WHERE process_flag=1  AND pro_asin_counts > '0' ";
	  }
	  else{
		$sqlquery= "SELECT  pro_id,pro_isbn,pro_weight,pro_title,pro_image,pro_us_rank,pro_ca_rank,pro_uk_rank,
	  pro_mx_rank,pro_in_rank,pro_jp_rank,pro_as_rank,pro_color,pro_sound,match_flag,purchased_price from product_info WHERE process_flag=1  AND pro_asin_counts > '0'";  
	  }
	

        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (pro_isbn LIKE '%".$srterm."%' OR pro_asin LIKE '%".$srterm."%' ) "; 
          $sqlcount.=" AND (pro_isbn LIKE '%".$srterm."%' OR pro_asin LIKE '%".$srterm."%'  ) "; 
        }

        $sqlquery.=" ORDER BY pro_id DESC LIMIT ".$offet.",".$limit;
        //echo $sqlquery;exit;

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
	
	public function import_data($file_name)
   {    
       $pqr=$this->db->query("SELECT count(pro_id) as ttl FROM product_info ");
       $prd=$pqr->result_array();
	      ini_set('auto_detect_line_endings',TRUE);
          $dir="./import_data/";
          $fp=fopen($dir.$file_name, "r");
          $i=0;
          $cur_date=date("Y-m-d");
          $bulk_data=[];
          while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) 
          {
		   if($i >0)
			{
              // print_r($data);
              $ean=isset($data[0])?$data[0]:"";
			  $mod_ean=str_pad($ean,13,"978",STR_PAD_LEFT);
			  if(!empty($mod_ean))
              $bulk_data[]="(".$this->db->escape($mod_ean).")";
              if(count($bulk_data) == 500 )
              {
                $quer=implode(",",$bulk_data);
                $qi="INSERT IGNORE INTO product_info(`pro_isbn`) VALUES {$quer}";
                $this->db->query($qi);
                unset($bulk_data);
                  unset($quer);
              }     
            
			}
            $i++;
          }
          if(isset($bulk_data) && count($bulk_data) > 0 && count($bulk_data) < 500)
          {
                $quer=implode(",",$bulk_data);
                $qi="INSERT IGNORE INTO product_info(`pro_isbn`) VALUES {$quer}";
                $this->db->query($qi);
                unset($bulk_data);
                unset($quer);
          }
        $aqr=$this->db->query("SELECT count(pro_id) as ttl FROM product_info");
            $ard=$aqr->result_array();
            $import_count=$ard[0]['ttl']-$prd[0]['ttl']; 
        $res['status_code']=1;
            $res['status_text']='A total of '.$import_count."  ISBNs have been imported.";
            return $res;
    }
	
	public function total_imported()
    {
	  
	 
      $sql= "SELECT pro_id,pro_title,pro_asin,rule_id,net_amount,pro_us_price,pro_us_rank,pro_isbn,pro_id,color FROM product_info ";
      $query=$this->db->query($sql);

	  return $query->result_array();                
    }

    public function insertProduct($data,$store)
    {
     


      $isbn = $data['products'][0]['ean'];
      $asin = $data['products'][0]['asin'];
      $book_title = $data['products'][0]['title'];
      $author = $data['products'][0]['author'];
      $manufacturer = $data['products'][0]['manufacturer'];
      $description = $data['products'][0]['description'];
      
      $weight = $data['products'][0]['packageWeight']*0.035274;
      $height = $data['products'][0]['packageHeight'];
      $length = $data['products'][0]['packageLength'];
      $width = $data['products'][0]['packageWidth'];
      $count_new = end($data['products'][0]['csv'][11]);
      $count_used = end($data['products'][0]['csv'][12]);
      $keepa_amazon_price = end($data['products'][0]['csv'][0])/100;
      $keepa_new_price = end($data['products'][0]['csv'][1])/100;
      $keepa_used_price = end($data['products'][0]['csv'][2])/100;

      $images = explode(',', $data['products'][0]['imagesCSV']);
      $image = 'https://images-na.ssl-images-amazon.com/images/I/'.$images[0];
      $book_categories = '';
      foreach ($data['products'][0]['categoryTree'] as $cat) {
        $book_categories .= $cat['name'];
      }
      $check = $this->db->query("SELECT isbn FROM new_products WHERE isbn = ".$this->db->escape($isbn)."");

      $checkRow = $check->row();
      if (isset($checkRow)) {
        $updateQuery = "UPDATE new_products SET quantity = quantity + 1  WHERE isbn = ".$this->db->escape($isbn)."";
        $query=$this->db->query($updateQuery);
        return 'Quantity Updated !';
        
      } else {
        $sql= "INSERT INTO `new_products`(`isbn`, `asin`, `book_title`, `author`,`manufacturer`, `description`,`date_added`, `book_store`, `image`, `weight`,`height`, `length`, `width`,`count_new`,`count_used`, `keepa_amazon_price`, `keepa_new_price`, `keepa_used_price`,`quantity`) VALUES (".$this->db->escape($isbn).",".$this->db->escape($asin).",".$this->db->escape($book_title).",".$this->db->escape($author).",".$this->db->escape($manufacturer).",".$this->db->escape($description).",NOW(),".$this->db->escape($store).",".$this->db->escape($image).",".$this->db->escape($weight).",".$this->db->escape($height).",".$this->db->escape($length).",".$this->db->escape($width).",".$this->db->escape($count_new).",".$this->db->escape($count_used).",".$this->db->escape($keepa_amazon_price).",".$this->db->escape($keepa_new_price).",".$this->db->escape($keepa_used_price).",1)";
        $query=$this->db->query($sql);
        return 'Data Successfully Saved !';
      }                 
    }

    public function getStores()
    {
      $sql= "SELECT * FROM stores WHERE status = 1";
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;                
    }
	
	

 
 
}