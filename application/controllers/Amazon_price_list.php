<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amazon_price_list extends CI_Controller {
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
        $this->load->model("amazon_price_inventory_model");   
        $this->load->model("sales_rank_conf_model");
        $this->load->library('session');
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
       
      }
       
  }

  public function index()
  {
    $this->load->view('UI/header');
    $permissions= $this->sales_rank_conf_model->getPermissions();
    foreach ($permissions as $perm ) {
      if ($perm['status'] == '1') {
        $this->session->set_userdata($perm['perm_name'], $perm['status']);
      } else {
        $this->session->unset_userdata($perm['perm_name']);
      }

    }
    $data['stores']=$this->amazon_price_inventory_model->getStores();
    $this->load->view('UI/amazon_price_list',$data);
    //print_r($result);exit;
    $this->load->view('UI/footer');

  }
  
  public function get_product_list($orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->amazon_price_inventory_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }

  public function get_pre_data()
  {
    $data['status_text']='Success';
    $data['status_code']='1';
    $data['total_imported']=$this->amazon_price_inventory_model->total_imported();
    //$data['total_processed']=$this->amazon_catalogue_model->total_processed();
    echo json_encode($data);
  }
  public function import_data()
     {
      $this->load->library('upload');
	  if(!empty($_FILES['import_file']['tmp_name']))
      {
          $main=$this->upload_import_file('import_file','./import_data/');
          if($main )
          {
            $res=$this->amazon_price_inventory_model->import_data($main);
            echo json_encode($res);
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to upload import file"}';    
          }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Not able to upload import file"}';
      }
  }
  function upload_import_file($image,$folder)
     {
           $config['upload_path'] = $folder;
           $config['allowed_types'] = 'csv';
           $config['file_name']=strtoupper(md5(microtime()).mt_rand()); 
           $config['max_size']  = '0';
           $config['max_width']  = '0';
           $config['max_height']  = '0';
           $this->upload->initialize($config);
           if( ! $this->upload->do_upload($image))
           {  
              echo '{"status_code":"0","status_text":"'.$this->upload->display_errors().'"}';
              die();
           }
           else
           {
               $img=$this->upload->data();
               return $img['file_name'];; 
           }
     }


     public function export_data()
     {
        $sql="SELECT pro_isbn INTO OUTFILE '/var/www/html/asin_analyzer/asset/exportdata/download_01.csv'
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"."\""."'
  LINES TERMINATED BY '\n'
  FROM amazon_tool;";
  // $this->db->query($sql);
      $db_host = "localhost";
      $db_username ="root";
      $db_password = "";
      $db_name = "amazon_tool";
      $log_file=strtoupper(md5(microtime()).mt_rand()).'.csv';
      // $dir=realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR."log_data/";
      $dir=realpath('asset').DIRECTORY_SEPARATOR."exportdata".DIRECTORY_SEPARATOR;
      $fp=fopen($dir.$log_file, "w");
      $con = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die(mysqli_error());
	  $user=$this->session->userdata('user_logged_in');
	if($user['isadmin']==1 && $user['isverified']==1)
		{
      $sql="SELECT pro_isbn,pro_weight,pro_title,pro_image,pro_us_rank,pro_us_price,pro_ca_rank,pro_ca_price,pro_uk_rank,pro_uk_price,
	  pro_mx_rank,pro_mx_price,pro_in_rank,pro_in_price,pro_jp_rank,pro_jp_price,pro_as_rank,pro_as_price from product_info WHERE process_flag=1 AND pro_asin_counts > '0'";
		}
      $result = mysqli_query($con,$sql);
      if (mysqli_num_rows($result) > 0) 
      {
       fputcsv($fp,array('ID','ISBN','Title','Image','Weight','US Sales Rank','US Price','CANADA Sales Rank','CANADA Price','UK Sales Rank','UK  Price','MEXICO Sales Rank','MEXICO Sales Price','INDIA Sales Rank','INDIA Price','JAPAN Sales Rank','JAPAN Price','AUSTRALIA Sales Rank','AUSTRALIA Price'));
        $i=1;
        while($row = mysqli_fetch_assoc($result)) 
        {
          $pro_isbn=(string)str_replace("\"","\"\"",stripslashes($row['pro_isbn']));
		  $pro_title=(string)str_replace("\"","\"\"",stripslashes($row['pro_title']));
	      $pro_image=(string)str_replace("\"","\"\"",stripslashes($row['pro_image']));
		  $pro_weight=(string)str_replace("\"","\"\"",stripslashes($row['pro_weight']));
		  $pro_us_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_us_rank']));
		  $pro_us_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_us_price']));
		  $pro_ca_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_ca_rank']));
		  $pro_ca_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_ca_price']));
		  $pro_uk_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_uk_rank']));
		  $pro_uk_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_uk_price']));
		  $pro_mx_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_mx_rank']));
		  $pro_mx_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_mx_price']));
		  $pro_in_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_in_rank']));
		  $pro_in_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_in_price']));
		  $pro_ja_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_jp_rank']));
		  $pro_ja_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_jp_price']));
		  $pro_as_rank=(string)str_replace("\"","\"\"",stripslashes($row['pro_as_rank']));
		  $pro_as_price=(string)str_replace("\"","\"\"",stripslashes($row['pro_as_price']));
		  
		  $rw="\"{$i}\",\"$pro_isbn\",\"$pro_title\",\"$pro_image\",\"$pro_weight\",\"$pro_us_rank\",\"$pro_us_price\",\"$pro_ca_rank\",\"$pro_ca_price\",\"$pro_uk_rank\",\"$pro_uk_price\",\"$pro_mx_rank\",\"$pro_mx_price\",\"$pro_in_rank\",\"$pro_in_price\",\"$pro_ja_rank\",\"$pro_ja_price\",\"$pro_as_rank\",\"$pro_as_price\""."\n";
          fwrite($fp, $rw);
          // fputcsv($fp,array($i,$brand,$mpn,$upc,$asin,$title,$prod_img,$desc,$bullet,$weight,$breadcrump));
          $i++;
        }
        fclose($fp);
      }  
// echo "fasd".is_file($dir.$log_file);
      if(is_file($dir.$log_file))
      {
        $data['status_code']='1';
        $data['status_text']="Your file has been generated.";
        $data['download_url']=$log_file;
        echo json_encode($data);
      }
      else
      {
        echo '{"status_code":"0","status_text":"Not able to export data / Empty data"}';    
      }
    



     }
	 
     public function remove_data()
     {
		 $user=$this->session->userdata('user_logged_in');
	     if($user['isadmin']==1 && $user['isverified']==1){
        $this->db->query("TRUNCATE product_info");
        echo '{"status_code":"1","status_text":"All data has been removed."}'; 
		 }
else{
	 echo '{"status_code":"0","status_text":"No data has been removed."}'; 
}		 
     }
 public function cron_run()
  {
	 $query=$this->db->query("SELECT pro_isbn  FROM product_info where process_flag=0 OR process_flag is null  limit 0,600000");
	 $prod_list=$query->result_array();;
         if(!empty($prod_list))
         {
	$trigger="start /B F:\\xampp\php\php F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api product_match 2>nul >nul";
    pclose(popen($trigger, "r"));
    $trigger1="start /B F:\\xampp\php\php F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api_ca product_match 2>nul >nul";
    pclose(popen($trigger1, "r"));	
    $trigger2="start /B F:\\xampp\php\php F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api_uk product_match 2>nul >nul";
    pclose(popen($trigger2, "r"));
	$trigger3="start /B F:\\xampp\php\php F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api_mx product_match 2>nul >nul";
    pclose(popen($trigger3, "r"));
	$trigger4="start /B F:\\xampp\php\php  F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api_in product_match 2>nul >nul";
    pclose(popen($trigger4, "r"));
	$trigger5="start /B F:\\xampp\php\php  F:\\xampp\htdocs\Green_Sorcerer\index.php cron Amazon_mws_product_api_jp product_match 2>nul >nul";
    pclose(popen($trigger5, "r"));
	$data['status_text']="Sucess";
    echo '{"status_code":"1","status_text":"Your data is now being processed."}'; 
      
  }
  else
  {
	  echo '{"status_code":"0","status_text":"No input provided."}'; 
  }
}
public function upload_barcode ()
  {
        if(empty($_POST['search']) || strlen($_POST['search']) <= 0)
      {
      	 $data['status_code']="0";
      	 $data['status_text']="ASINs Are Empty";
      	 echo json_encode($data);
         die();	
      }
      
      $res=[];
      $delimit= "\n";  
      $key_list=array_unique(explode($delimit,$this->input->post('search')));
      foreach($key_list as $key)
      {
        if(!empty($key))
        {
          
          $res[]=array('pro_isbn'=>$key);    
        }
        
      }
      
      $this->db->insert_batch('product_info',$res);
	  
           $data['status_code']='1';
            $data['status_text']='Success';
      
      echo json_encode($data);
}
public function insertProduct()
  {
      $data = $this->input->post();

      $service_url = "https://api.keepa.com/product?key=9uuqu3qdmfttr1al5o3v8t6rbh9gqlqqhgb9952htq0mmev9nvf5mtt3lt0do6mf&rating=1&domain=1&offers=40&code=".$data['isbn'];
      $ch = curl_init($service_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
      $result = curl_exec($ch);
      $res = json_decode($result,true);
      $message = $this->amazon_price_inventory_model->insertProduct($res,$data['storeName']);
      $json = array();
      echo json_encode($json = array('success' => 1 ,'msg' => $message ));
      exit;
  }
}

