<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales_rank_conf_model extends CI_Model
{
  public function  __construct()
  {
   parent::__construct();
   $user=$this->session->userdata('user_logged_in');  
   $this->user_id=$user['id'];
 }

 public function setConfiguration($data)
 {
      //print_r($data);exit;
  $sql= "INSERT INTO `sales_rank_configuration`(`min_sales_rank`, `max_sales_rank`, `profit`, `region`,`category`,`profit_category`) VALUES (".$this->db->escape($data['min_sales_rank']).",".$this->db->escape($data['max_sales_rank']).",".$this->db->escape($data['profit']).",".$this->db->escape($data['region']).",".$this->db->escape($data['category']).",".$this->db->escape($data['profit_category']).")";
  $query=$this->db->query($sql);
  return true;                
}

public function getConfiguration($region)
{
  $sql= "SELECT * FROM sales_rank_configuration WHERE region = ".$this->db->escape($region)." ";
  $query=$this->db->query($sql);

  $rows = $query->result_array(); 
  return $rows;                
}
public function getConfigurationOnCategory($region,$cat)
{
  $sql= "SELECT * FROM sales_rank_configuration WHERE region = ".$this->db->escape($region)." AND category = '".$cat."' ";
  $query=$this->db->query($sql);

  $rows = $query->result_array(); 
  return $rows;                
}

public function getRegions()
{
  $sql= "SELECT * FROM regions where region_code NOT LIKE '%buyback%'";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}
public function getRegionsAndBuybacks()
{
  $sql= "SELECT * FROM regions";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}
public function getStores()
{
  $sql= "SELECT * FROM stores";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}
public function getSpecialList()
{
  $sql= "SELECT * FROM isbn_configuration";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}
public function getPermissions()
{
  $sql= "SELECT * FROM permission";
  $query=$this->db->query($sql);
  $rows = $query->result_array(); 
  return $rows;                
}

public function deleteConfiguration($id)
{
  $sql= "DELETE FROM `sales_rank_configuration` WHERE id = ".$this->db->escape($id)."";
  $query=$this->db->query($sql);
  return true;                
}

public function enableRegion($region_code)
{
  $sql= "UPDATE `regions` SET `status`= 1 WHERE region_code = ".$this->db->escape($region_code)."";
  $query=$this->db->query($sql);
  return true;                
}
public function changeRegionColor($color,$region_code)
{
  $sql= "UPDATE `regions` SET `color`= ".$this->db->escape($color)." WHERE region_code = ".$this->db->escape($region_code)."";
  $query=$this->db->query($sql);
  return true;                
}
public function resetRegions()
{
  $sql= "UPDATE `regions` SET `status`= 0";
  $query=$this->db->query($sql);
  return true;                
}
public function resetStores()
{
  $sql= "UPDATE `stores` SET `status`= 0";
  $query=$this->db->query($sql);
  return true;                
}
public function resetPermissions()
{
  $sql= "UPDATE `permission` SET `status`= 0";
  $query=$this->db->query($sql);
  return true;                
}
public function enablePermission($perm)
{
  $sql= "UPDATE `permission` SET `status`= 1 WHERE perm_name = ".$this->db->escape($perm)."";
  $query=$this->db->query($sql);
  return true;                
}
public function enableStore($id)
{
  $sql= "UPDATE `stores` SET `status`= 1 WHERE store_id = ".$this->db->escape($id)."";
  $query=$this->db->query($sql);
  return true;                
}
public function addStore($store)
{
      //print_r($data);exit;
  $sql= "INSERT INTO `stores`(`name`, `status`) VALUES (".$this->db->escape($store).",1)";
  $query=$this->db->query($sql);
  return true;                
}
public function setAmazonShipping($value,$region)
{
  $sql= "UPDATE `regions` SET `amazon_shipping_cost`= ".$this->db->escape($value)." where region_code = ".$this->db->escape($region)." ";
  $query=$this->db->query($sql);
  return true;                
}
public function setSpecialList($list)
{
  $sql= "UPDATE `isbn_configuration` SET `isbn_list`= ".$this->db->escape($list)." where id = 1 ";
  $query=$this->db->query($sql);
  return true;                
}
public function getVariantPriceAndThreshold()
{
  $sql = "SELECT price_type,value,color FROM `variant_prices`";
  $query=$this->db->query($sql);
  return $query->result_array();
}
public function getProductCategory()
{
  $sql = "SELECT * from product_category";
  $query = $this->db->query($sql);
  return $query->result_array();
}
public function getVariantPriceOnly()
{
  $sql = "SELECT value FROM `variant_prices` where price_type = 'fbm_variant_price'";
  $query=$this->db->query($sql);
  return $query->row_array();
}
public function insertProductCategory($product_name)
{
  $sql= "INSERT INTO `product_category`(`product_name`) VALUES (".$this->db->escape($product_name).")";
  $query=$this->db->query($sql);
  return true; 
}
public function deleteProductCategory($productCatId)
{
  $sql= " DELETE FROM `product_category` WHERE id = ".$this->db->escape($productCatId)." ;";
  $query=$this->db->query($sql);
  return true;
}

public function updateMarket($marketId,$value)
{
  $sql= "UPDATE `stores` SET `name`= ".$this->db->escape($value)." WHERE `store_id` = ".$this->db->escape($marketId)." ";
  $query=$this->db->query($sql);
  return true;
}
public function deleteMarket($marketId)
{
  $sql= "DELETE FROM `stores` WHERE store_id = ".$this->db->escape($marketId)."";
  $query=$this->db->query($sql);
  return true; 
}

public function updateUspsShippingFee($shipping_cost,$per_pound_cost,$domain_id)
{
  $sql= "UPDATE `regions` SET `merchant_shipping_cost`= ".$this->db->escape($shipping_cost).", `merchant_price_per_pound` = ".$this->db->escape($per_pound_cost)." WHERE `domain_id` = ".$this->db->escape($domain_id)." ";
  $query=$this->db->query($sql);
  return true;
}

public function getThresholdPriceColor()
{
  $sql = "SELECT price_type,value,color FROM `variant_prices` WHERE price_type = 'fba_threshold_price' OR price_type = 'fbm_threshold_price' OR price_type = 'fbm_drop_ship_price' ";

  $query=$this->db->query($sql);
  $res = $query->result_array();
  $final = array();
  $final['fba_price'] = $res[0]['value'];
  $final['fba_color'] = $res[0]['color'];
  $final['fbm_price'] = $res[1]['value'];
  $final['fbm_color'] = $res[1]['color'];
  $final['drop_ship_price'] = $res[2]['value'];
  $final['drop_ship_color'] = $res[2]['color'];
  return $final; 
}

public function updateVariantPrice($value)
{
  $sql = "UPDATE `variant_prices` SET `value`=".$this->db->escape($value).", `date_updated`=NOW() where `price_type`= 'fbm_variant_price' ";
  $query = $this->db->query($sql);
  return true;
}
public function updateDropShipPriceColor($value,$color)
{
  $sql = "UPDATE `variant_prices` SET `value`=".$this->db->escape($value).", `color`=".$this->db->escape($color).", `date_updated`=NOW() where `price_type`= 'fbm_drop_ship_price' ";
  $query = $this->db->query($sql);
  return true;
}
public function updateThresholdPriceColor($price_type,$thresholdPrice,$color)
{
  $sql = "UPDATE `variant_prices` SET `value`=".$this->db->escape($thresholdPrice).", `color`= ".$this->db->escape($color).",`date_updated`=NOW() where `price_type`= ".$this->db->escape($price_type)." ";
  $query = $this->db->query($sql);
  return true;
}

}