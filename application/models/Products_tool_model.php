<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_tool_model extends CI_Model
{
    public function  __construct()
    {
       parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
    }

    public function getProducts()
    {
      $sql= "SELECT * FROM new_products order by product_id desc ";
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;                
    }

    public function getStores()
    {
      $sql= "SELECT * FROM stores WHERE status = 1";
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;                
    }


    public function fetchChunk()
    {
      $sql= "SELECT * FROM isbn_numbers WHERE processed <> 1 order by id asc limit 10";
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;                
    }
    public function updateSalesRank($rank,$profit,$region,$isbn)
    {
      $columnProfit = $region.'_price';
      $columnRank = $region.'_rank';
      $sql= "UPDATE `new_products` SET $columnRank = ".$this->db->escape($rank).", $columnProfit = ".$this->db->escape($profit)."  WHERE isbn = ".$this->db->escape($isbn)."";
      $query=$this->db->query($sql);
      return true;  
    }

    public function updateSalesRankAll($data,$isbn)
    {
      $sql= "UPDATE `new_products` SET ";
      foreach ($data as $region => $value) {
       $columnRank = $region.'_rank';
       $columnProfit = $region.'_price';
       $columnFbmProfit = $region.'_fbm_price';
       $columnDropShipProfit = $region.'_drop_ship_price';
       $sql .= " $columnRank = ".$this->db->escape($value['rank']).", $columnProfit = ".$this->db->escape($value['profit']).", $columnFbmProfit = ".$this->db->escape($value['fbm_profit']).", $columnDropShipProfit = ".$this->db->escape($value['drop_ship_profit']).", "; 
     }
     $sql = rtrim($sql,", ");
     $sql .= " WHERE isbn = ".$this->db->escape($isbn)."";
     $query=$this->db->query($sql);
     return true;  
   }

    public function updateSalesRankNew($data,$isbn)
    {
      $sql= "UPDATE `new_products` SET ";
      foreach ($data as $column => $value) {
        $sql .= " $column = ".$this->db->escape($value).","; 
      }
      $sql = rtrim($sql,", ");
      $sql .= " WHERE isbn = ".$this->db->escape($isbn)."";
      $query=$this->db->query($sql);
      return true;  
    }

    public function checkExisting($isbn)
    {
      $sql= "SELECT * from  `new_products` WHERE isbn = ".$this->db->escape($isbn)." AND is_complete = 1";
      $query=$this->db->query($sql);
      $rows = $query->result_array(); 
      return $rows;   
    }

   public function insertBuybackBWB($data)
    {
      if (isset($data['isAccepted'])) {
        if ($data['isAccepted']== 1) {
          $check = $this->db->query("SELECT isbn FROM buyback WHERE isbn = ".$this->db->escape($data['isbn'])."");

          $checkRow = $check->row();
          if (!isset($checkRow)) {
            $sql= "INSERT INTO `buyback`(`isbn`,`warehouse_id`,`warehouse_name`,`warehouse_address`) VALUES (".$this->db->escape($data['isbn']).",".$this->db->escape($data['warehouseId']).",".$this->db->escape($data['warehouseName']).",".$this->db->escape($data['warehouseAddress']).")";
            $query=$this->db->query($sql);
            return true; 
          }  
        }
      }            
    }

    public function insertBuybackBooksRun($data,$isbn)
    {
      if (isset($data['result']['text']['Average'])) {
        if ($data['result']['text']['Average']!= 0) {
          $check = $this->db->query("SELECT isbn FROM buyback WHERE isbn = ".$this->db->escape($isbn)." AND warehouse_name = 'Books Run'");
          $checkRow = $check->row();
          if (!isset($checkRow)) {
            $sql= "INSERT INTO `buyback`(`isbn`,`warehouse_name`,`avg_price`,`used_price`,`new_price`) VALUES (".$isbn.",'Books Run',".$this->db->escape($data['result']['text']['Average']).",".$this->db->escape($data['result']['text']['Good']).",".$this->db->escape($data['result']['text']['New']).")";
            $query=$this->db->query($sql);
            return true;  
          } 
        }
      }                    
    }

    public function markComplete($isbn)
    {
      $sql= "UPDATE `new_products` SET is_complete = 1  WHERE isbn = ".$this->db->escape($isbn)."";
      $query=$this->db->query($sql);
      return true;  
    }
    public function markAutomatedProcessed($isbn)
    {
      $sql= "UPDATE `isbn_numbers` SET processed = 1  WHERE isbn_13 = ".$this->db->escape($isbn)."";
      $query=$this->db->query($sql);
      return true;  
    }

    public function record_count() {
      return $this->db->count_all("new_products");
    }

    public function is_present($isbn) {
      $check = $this->db->query("SELECT isbn FROM new_products WHERE isbn = ".$this->db->escape($isbn)."");
      $checkRow = $check->row();
      if (isset($checkRow)) {
        return true;
      } else {
        return false;
      }
    }

    public function getFBAFee($asin) {
      $url = "https://api.sellerprime.com/free_tool/amazon_revenue_calculator";
      $postvars = array(
              'afn_fees_request' => array(
                'item_price' => 0
              ),
              'mfn_fees_request' => array(
                'item_price' => 0,
                'shipping_price' => 0
              ),
              'product_id' => $asin,
            );
      $postvars = json_encode($postvars);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$postvars);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
          'Content-Type: application/json',                                                                                
          'Content-Length: ' . strlen($postvars))                                                                       
      );
      $result = curl_exec($ch);
      curl_close ($ch);
      $result = json_decode($result, 1);
      if (isset($result['afn_fees_detail']['fulfillment_fees']['total_fees'])) {
        return $result['afn_fees_detail']['fulfillment_fees']['total_fees'];
      } else {
        return 0;
      }
      
    }

    public function calculateProfit($salePrice,$height,$length,$width,$weight,$market,$isbn)
    {
      $sqlpp= "SELECT * FROM regions where region_code = '".strtoupper($market)."'";
      $querypp=$this->db->query($sqlpp);
      $rowpp = $querypp->row();
      $purchasedPrice  =  $rowpp->purchased_price;
      $shippingFee  =  $rowpp->amazon_shipping_cost;

       $url = "https://ocwpmnb46i.execute-api.us-west-2.amazonaws.com/beta/api/v1/fba-revenue-calculator?media=True&pro=False&apparel=False&height=".$height."&length=".$length."&width=".$width."&unit_weight=".$weight*0.00220462;
       $ch = curl_init($url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
       $result = curl_exec($ch);
       $cost = json_decode($result,true);
       //print_r($cost);exit;
      $x1 = (0.15*$salePrice) + 1.80;
      $x2 = (float)$cost['cost']+ $shippingFee;
      $profit = (($salePrice - $x1) - $x2) - $purchasedPrice;
      // $retArr = array(
      //   'cost_by_dimenssions' => $cost['cost'],
      //   'profit' => $profit
      // );
      // return json_encode($retArr);
      return $profit;
    }
    public function baseProfit($salePrice,$height,$length,$width,$weight,$market){
      
      $sqlpp= "SELECT * FROM regions where region_code = '".strtoupper($market)."'";
      $querypp=$this->db->query($sqlpp);
      $rowpp = $querypp->row();
      $purchasedPrice  =  $rowpp->purchased_price;
      $shippingFee  =  $rowpp->amazon_shipping_cost;
      $weightLb = $weight * 0.00220462; 
      //echo $weightLb;exit;

      if ($weightLb <= 0.75 && $length <= 15 && $width <= 12 && $height <= 0.75) {
        $baseVal = 2.41;
      } else if ($weightLb <= 1.25 && $length <= 18 && $width <= 14 && $height <= 8){
        $baseVal = 3.19;
      } else if ($weightLb <= 1.5 && $length <= 18 && $width <= 14 && $height <= 8){
        $baseVal = 4.71;
      } else {
        $baseVal = (ceil($weightLb - 2) * 0.38 ) + 4.71;
      }
      //echo $baseVal;exit;

      $x1 = (0.15*$salePrice) + 1.80;
      $x2 = (float)$baseVal+ $shippingFee*$weightLb;
      $profit = (($salePrice - $x1) - $x2) - $purchasedPrice;
      return $profit;
    }

    public function baseProfitFiles($salePrice,$height,$length,$width,$weight,$market,$purchasedPrice){
      $sqlpp= "SELECT * FROM regions where region_code = '".strtoupper($market)."'";
      $querypp=$this->db->query($sqlpp);
      $rowpp = $querypp->row();
      $shippingFee  =  $rowpp->amazon_shipping_cost;
      $weightLb = $weight * 0.00220462; 
      //echo $weightLb;exit;

      if ($weightLb <= 0.75 && $length <= 15 && $width <= 12 && $height <= 0.75) {
        $baseVal = 2.41;
      } else if ($weightLb <= 1.25 && $length <= 18 && $width <= 14 && $height <= 8){
        $baseVal = 3.19;
      } else if ($weightLb <= 1.5 && $length <= 18 && $width <= 14 && $height <= 8){
        $baseVal = 4.71;
      } else {
        $baseVal = (ceil($weightLb - 2) * 0.38 ) + 4.71;
      }
      //echo $baseVal;exit;

      $x1 = (0.15*$salePrice) + 1.80;
      $x2 = (float)$baseVal+ $shippingFee*$weightLb;
      $profit = (($salePrice - $x1) - $x2) - $purchasedPrice;
      return $profit;
    }

    
    public function insertProduct($data,$store)
    {      
      if (isset($data['products'][0]['eanList'][0])) {
        $isbn = $data['products'][0]['eanList'][0];
        $asin = $data['products'][0]['asin'];
        $book_title = $data['products'][0]['title'];
        $author = $data['products'][0]['author'];
        $manufacturer = $data['products'][0]['manufacturer'];
        $description = $data['products'][0]['description'];

        $weight = $data['products'][0]['packageWeight']*0.035274;
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
      //if (end($data['products'][0]['csv'][3]) == '-1') {
      //  $salesRankUsa = 0;
      // } else {
      //  $salesRankUsa = number_format(end($data['products'][0]['csv'][3]));
      //}
      //$profit = $this->calculateProfit($keepa_amazon_price,$height,$length,$width,$data['products'][0]['packageWeight'],'us',$isbn);
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
}

