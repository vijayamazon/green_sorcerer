<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_rank_conf extends CI_Controller {
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
    $this->load->model("sales_rank_conf_model");
    $this->load->model("products_tool_model");
    $this->load->model("amazon_price_inventory_model");   
    $user=$this->session->userdata('user_logged_in');  
    $this->user_id=$user['id'];
    
  }
  
}

public function index()
{
  $data['permissions'] = $this->sales_rank_conf_model->getPermissions();
  $data['stores'] = $this->sales_rank_conf_model->getStores();
  $data['special_list'] = $this->sales_rank_conf_model->getSpecialList();
  $data['available_regions'] = $this->sales_rank_conf_model->getRegions();
  $data['available_regions_buybacks'] = $this->sales_rank_conf_model->getRegionsAndBuybacks();
  $data['item_count'] = $this->products_tool_model->record_count();
  $data['variant_price_threshold'] = $this->sales_rank_conf_model->getVariantPriceAndThreshold();
  foreach ($data['available_regions'] as $value) {
    $data['configuration'][$value['region_code']]=$this->sales_rank_conf_model->getConfiguration($value['region_code']);
  }
  $data['product_category'] = $this->sales_rank_conf_model->getProductCategory();
  $this->load->view('UI/header');
  $this->load->view('UI/sales_rank_conf',$data);
  $this->load->view('UI/footer');
  

}

public function updatePriceConfiguration ()
{

  $data = $this->input->post();
  // echo $data['fbmThresholdPrice'];
  // exit();
  $purchasedPrice = (preg_replace('/[^\d.]/', '', $data['purchasedPrice']));
  $variantPrice = (preg_replace('/[^\d.]/', '', $data['fbmvariantPrice']));
  $dropShipPrice = (preg_replace('/[^\d.]/', '', $data['fbmDropShipPrice']));
  $fbaThresholdPrice = (preg_replace('/[^\d. -]/', '', $data['fbaThresholdPrice']));
  $fbmThresholdPrice = (preg_replace('/[^\d. -]/', '', $data['fbmThresholdPrice']));

  $this->db->query("UPDATE `regions` SET `purchased_price` = ".$this->db->escape($purchasedPrice)." ");
  $this->sales_rank_conf_model->updateVariantPrice($variantPrice);
  $this->sales_rank_conf_model->updateDropShipPriceColor($dropShipPrice,$data['dropShipColor']);
  $this->sales_rank_conf_model->updateThresholdPriceColor('fba_threshold_price',$fbaThresholdPrice,$data['fbaThresholdColor']);
  $this->sales_rank_conf_model->updateThresholdPriceColor('fbm_threshold_price',$fbmThresholdPrice,$data['fbmThresholdColor']);

  $this->sales_rank_conf_model->resetPermissions();
  if (isset($data['perms'])) {
    foreach ($data['perms'] as $key => $value) {
      $this->sales_rank_conf_model->enablePermission($value);
    }
  }
  redirect('Sales_rank_conf');

}

public function updateSalesRankConf() {
  $data['sales_rank_conf'] = array(
    'max_sales_rank' => intval(preg_replace('/[^\d.]/', '', $this->input->post('ceilValue'))),
    'min_sales_rank' => intval(preg_replace('/[^\d.]/', '', $this->input->post('floorValue'))),
    'profit' => (preg_replace('/[^\d.]/', '', $this->input->post('profit'))),
    'region' => $this->input->post('region'),
    'category' => $this->input->post('category'),
    'profit_category' => $this->input->post('profit_category')
  );

  $res = $this->sales_rank_conf_model->setConfiguration($data['sales_rank_conf']);

  if($res==true)
  {
    $this->session->set_flashdata('success', "Configuration Made"); 
  }else{
    $this->session->set_flashdata('error', "Please Check. There is an error.");
  }

  redirect('Sales_rank_conf');
}
public function saveProductCategory()
{
  $product_name = $this->input->post('product_name');
  $this->sales_rank_conf_model->insertProductCategory($product_name);
  redirect('Sales_rank_conf');
}
public function deleteProductCategory()
{
  $deleteThis = $this->input->post('deleteProductId');

  $res = $this->sales_rank_conf_model->deleteProductCategory($deleteThis);

  if($res==true)
  {
    $this->session->set_flashdata('success', "Product category Removed"); 
  }else{
    $this->session->set_flashdata('error', "Please Check. There is an error.");
  }

  redirect('Sales_rank_conf');
}
public function deleteConfiguration() {
  $deleteThis = $this->input->post('deleteId');
    //echo $deleteThis;exit;

  $res = $this->sales_rank_conf_model->deleteConfiguration($deleteThis);

  if($res==true)
  {
    $this->session->set_flashdata('success', "Configuration Removed"); 
  }else{
    $this->session->set_flashdata('error', "Please Check. There is an error.");
  }
  
  redirect('Sales_rank_conf');
}

public function updateRegion() {

  $data = $this->input->post();
  $this->sales_rank_conf_model->resetRegions();
  if (isset($data['availableRegion'])) {
    foreach ($data['availableRegion'] as $key => $value) {
      $this->sales_rank_conf_model->enableRegion($value);
    }
  }
  if (isset($data['regionColor'])) {
    foreach ($data['regionColor'] as $key => $value) {
      $this->sales_rank_conf_model->changeRegionColor($value,$key);
    }
  }

  redirect('Sales_rank_conf');
}
public function updateAmazonShippingFee() {

  $data = $this->input->post();
  foreach ($data['amazonShippings'] as $region => $value) {
    $this->sales_rank_conf_model->setAmazonShipping($value,$region);
  }
  
  redirect('Sales_rank_conf');
}

public function updateSpecialList() {

  $data = $this->input->post();
  $this->sales_rank_conf_model->setSpecialList($data['list']);
  
  redirect('Sales_rank_conf');
}
public function updateMarkets() {
  $data = $this->input->post();
  
  if ($data['marketId'] != '' ) {
    $this->sales_rank_conf_model->updateMarket($data['marketId'],$data['marketAdd']);
  }elseif ($data['marketAdd'] != ''){
    $this->sales_rank_conf_model->addStore($data['marketAdd']);
  }
  $this->sales_rank_conf_model->resetStores();
  if (isset($data['stores'])) {
    foreach ($data['stores'] as $value) {
      $this->sales_rank_conf_model->enableStore($value);
    }
  }
  redirect('Sales_rank_conf');
}
public function deleteMarket()
{
  $marketId = $this->input->post('marketid');
  $this->sales_rank_conf_model->deleteMarket($marketId);
  redirect('Sales_rank_conf');
}

public function updateUspsShippingFee()
{
  $shipping_cost = $this->input->post('merchant_shipping_cost');
  $perPound_cost = $this->input->post('merchant_price_per_pound');
  $region_code = $this->input->post('region_code');
  $res = $this->sales_rank_conf_model->updateUspsShippingFee($shipping_cost,$perPound_cost,$region_code);
  redirect('Sales_rank_conf');
}


}

