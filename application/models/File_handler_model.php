<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_handler_model extends CI_Model
{
  public function  __construct()
  {
   parent::__construct();
   $user=$this->session->userdata('user_logged_in');  
   $this->user_id=$user['id'];

 }

 public function getFiles($limit, $start)
 {
  $sql= "SELECT * FROM book_files Order By file_id desc LIMIT $limit OFFSET $start  ";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}

/*public function addFile($uploadData)
{
  $baseurl=base_url();
  $urlToFile = $baseurl.'uploads/'.$uploadData['file_name'];
  $sql= "INSERT INTO `book_files`(`date_added`, `filename`, `status`, `url`,`file_path`,`dir_path`) VALUES (NOW(),".$this->db->escape($uploadData['file_name']).",1,".$this->db->escape($urlToFile).",".$this->db->escape($uploadData['full_path']).",".$this->db->escape($uploadData['file_path']).")";
  $query=$this->db->query($sql);
  return true; 

}*/
public function addFile($uploadData)
{
  $baseurl=base_url();
  $urlToFile = $baseurl.'uploads/'.$uploadData['file_name'];
  $sql= "INSERT INTO `book_files`(`date_added`, `filename`, `status`,`last_index`, `url`,`file_path`,`dir_path`) VALUES (NOW(),".$this->db->escape($uploadData['file_name']).",0,"."0,".$this->db->escape($urlToFile).",".$this->db->escape($uploadData['full_path']).",".$this->db->escape($uploadData['file_path']).")";
  $query=$this->db->query($sql);
  return true; 

}

public function deleteFile($id,$path)
{
  $sql= "DELETE FROM `book_files` WHERE file_id = ".$this->db->escape($id)."";
  $query=$this->db->query($sql);
  @unlink($path);
  return true;                
}
public function record_count() {
  return $this->db->count_all("book_files");
}

public function updateFile($fileName,$last_index,$status)
{
  $sql = 'UPDATE `book_files` SET `status` ='.$this->db->escape($status).' , `last_index` = '.$this->db->escape($last_index).' where `filename` = '.$this->db->escape($fileName).' ';
  $query = $this->db->query($sql);
  return true;
}
public function insertProduct($data,$store)
{     

  $data = json_decode($data,true);
  if (isset($data['products'][0]['eanList'][0])) {
    $isbn = $data['products'][0]['eanList'][0];
    $asin = $data['products'][0]['asin'];
    $book_title = $data['products'][0]['title'];
    $author = $data['products'][0]['author'];
    $manufacturer = $data['products'][0]['manufacturer'];
    $description = $data['products'][0]['description'];

    $weight = $data['products'][0]['packageWeight']*0.00220462;
    $height = $data['products'][0]['packageHeight']*0.0393701;
    $length = $data['products'][0]['packageLength']*0.0393701;
    $width = $data['products'][0]['packageWidth']*0.0393701;
    if (isset($data['products'][0]['csv'][11])) {
      $count_new = end($data['products'][0]['csv'][11]);
    } else {
      $count_new = 0;
    }
    if (isset($data['products'][0]['csv'][12])) {
      $count_used = end($data['products'][0]['csv'][12]);
    } else {
      $count_used =0;
    }
    if (isset($data['products'][0]['csv'][0])) {
      $keepa_amazon_price = end($data['products'][0]['csv'][0])/100;
    } else {
      $keepa_amazon_price = 0;
    }
    if (isset($data['products'][0]['csv'][1])) {
      $keepa_new_price = end($data['products'][0]['csv'][1])/100;
    } else {
      $keepa_new_price = 0;
    }
    if (isset($data['products'][0]['csv'][2])) {
      $keepa_used_price = end($data['products'][0]['csv'][2])/100;
    } else {
      $keepa_used_price = 0;
    }
    
    $images = explode(',', $data['products'][0]['imagesCSV']);
    $image = 'https://images-na.ssl-images-amazon.com/images/I/'.$images[0];
    $book_categories = '';
    if (isset($data['products'][0]['categoryTree'])) {
      foreach ($data['products'][0]['categoryTree'] as $cat) {
        $book_categories .= $cat['name'].' , ';
      }
    }
    $check = $this->db->query("SELECT isbn FROM new_products WHERE isbn = ".$this->db->escape($isbn)."");

    $checkRow = $check->row();
    if (isset($checkRow)) {
      $updateQuery = "UPDATE new_products SET quantity = quantity + 1 , date_updated = NOW() , keepa_amazon_price = ".$this->db->escape($keepa_amazon_price).", keepa_new_price = ".$this->db->escape($keepa_new_price).", keepa_used_price = ".$this->db->escape($keepa_used_price).", count_new = ".$this->db->escape($count_new).", count_used = ".$this->db->escape($count_used)." WHERE isbn = ".$this->db->escape($isbn)."";
      $query=$this->db->query($updateQuery);
      return true;

    } else {
      $sql= "INSERT INTO `new_products`(`isbn`, `asin`, `book_title`, `author`,`manufacturer`, `description`,`date_added`, `book_store`, `image`, `weight`,`height`, `length`, `width`,`count_new`,`count_used`, `keepa_amazon_price`, `keepa_new_price`, `keepa_used_price`,`quantity`,`book_categories`) VALUES (".$this->db->escape($isbn).",".$this->db->escape($asin).",".$this->db->escape($book_title).",".$this->db->escape($author).",".$this->db->escape($manufacturer).",".$this->db->escape($description).",NOW(),".$this->db->escape($store).",".$this->db->escape($image).",".$this->db->escape($weight).",".$this->db->escape($height).",".$this->db->escape($length).",".$this->db->escape($width).",".$this->db->escape($count_new).",".$this->db->escape($count_used).",".$this->db->escape($keepa_amazon_price).",".$this->db->escape($keepa_new_price).",".$this->db->escape($keepa_used_price).",1,".$this->db->escape($book_categories).")";
      $query=$this->db->query($sql);
      return true;
    } 
  } else {
    return false;
  }
}

public function getFileIndex()
{
  $sql= "SELECT * FROM `book_files` where `status` = 0 ORDER BY `date_added` ASC LIMIT 1";
  $query=$this->db->query($sql);
  return $query->row_array(); 
}
public function getDropShipPriceOnly()
{
  $sql = "SELECT value FROM `variant_prices` where price_type = 'fbm_drop_ship_price'";
  $query=$this->db->query($sql);
  return $query->row_array();
}

}