<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_tool extends CI_Controller {
  private $user_id;
  private $asin;
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
        $this->load->library('session');  
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
        $this->asin = '';
      }
       
  }
  public function index()
  {
    $permissions= $this->sales_rank_conf_model->getPermissions();

    foreach ($permissions as $perm ) {
      if ($perm['status'] == '1') {
        $this->session->set_userdata($perm['perm_name'], $perm['status']);
      } else {
        $this->session->unset_userdata($perm['perm_name']);
      }

    }
    $data['variant_price'] = $this->sales_rank_conf_model->getVariantPriceOnly();
    $available_regions = $this->sales_rank_conf_model->getRegionsAndBuybacks();
    $onlyRegions = $this->sales_rank_conf_model->getRegions();
    $colors = array();
    foreach ($available_regions as $key => $value) {
      $colors[$value['region_code']] = $value['color'];
    }
    $data['colors'] = $colors;
    $data['only_regions'] = $onlyRegions;
    $data['stores']=$this->products_tool_model->getStores();
    
    //$data['products']=$this->products_tool_model->getProducts();
    //print_r($data['stores']);exit;
    $this->load->view('UI/header');
    $this->load->view('UI/products_tool',$data);
    $this->load->view('UI/footer');
  }
  public function rankSepecialConf($data)
{
   $received = json_decode($data['data'],true);
   


   $json = array();
  if ( ($received['us_rank'] >= 0 && $received['us_rank'] < 500000) && $received['us_fbm_price'] <=1 && $data['weightLb'] <= 2 ) {
    $json['us_rank_conf'] = true;
    $json['us_rank_color'] = '#7037a6';
  }elseif (($received['us_rank'] >= 500000 && $received['us_rank'] < 1000000) && $received['us_fbm_price'] <=1 && $data['weightLb'] <= 2) {
    $json['us_rank_conf'] = true;
    $json['us_rank_color'] = '#ff8637';
  }elseif (($received['us_rank'] >= 1000000 && $received['us_rank'] < 2000000) && $received['us_fbm_price'] <=1 && $data['weightLb'] <= 2) {
   $json['us_rank_conf'] = true;
   $json['us_rank_color'] = '#cee82b';
 }else{
  $json['us_rank_conf'] = false;

}
  return $json;
}

  public function insertProduct()
  {
      $data = $this->input->post();


      $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=1&code=".$data['isbn'];
      $ch = curl_init($service_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
      $result = curl_exec($ch);
      $res = json_decode($result,true);
      $insertion = $this->products_tool_model->insertProduct($res,$data['storeName']);
      $json = array();
      echo json_encode($json = array('success' => $insertion ));
      exit;
  }

  public function FetchSalesRankAll()
  {
      $data = $this->input->post();
      $areas = array('us' => 1,'uk' => 2,'de' => 3,'fr' => 4,'it' => 8,'es' => 9,'jp' => 5,'ca' => 6,'in' => 10,'mx' => 11,'br' => 12,'au' => 13,'cn' => 7);
      $json = array();

      $checkResult = $this->products_tool_model->checkExisting($data['isbn']);

      if ($checkResult) {
        foreach ($areas as $key => $value) {
           $json[$key]['rank'] = $checkResult[0][$key.'_rank'];
           $json[$key]['profit'] = (float)$checkResult[0][$key.'_price'];
           $json[$key]['rank_validation'] = $this->validateRankConfigurations(strtoupper($key),str_replace(',', '',$checkResult[0][$key.'_rank']),(float)$checkResult[0][$key.'_price']);
        }
      } else {
        ini_set('max_execution_time', 0);
        $modelData = array();

        //$fbaFee = $this->products_tool_model->getFBAFee($data['asin']);  // Getting Product FBA Fee

        foreach ($areas as $key => $value) {
          $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=".$value."&stats=90&code=".$data['isbn'];
          $ch = curl_init($service_url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
          $result = curl_exec($ch);
          $res = json_decode($result,true);

          if (isset($res['products'][0]['packageWeight'])) {
            $weight = $res['products'][0]['packageWeight'];
          } else {
            $weight = 0 ;
          }
          if (isset($res['products'][0]['packageHeight'])) {
            $height = $res['products'][0]['packageHeight']*0.0393701;
          } else {
            $height = 0;
          }
          if (isset($res['products'][0]['packageLength'])) {
            $length = $res['products'][0]['packageLength']*0.0393701;
          } else {
            $length = 0;
          }
          if (isset($res['products'][0]['packageWidth'])) {
            $width = $res['products'][0]['packageWidth']*0.0393701;
          } else {
            $width = 0;
          }
          if (isset($res['products'][0]['stats']['avg90'][3])) {
            //$salesRank = number_format(end($res['products'][0]['csv'][3]));
            $salesRank = number_format($res['products'][0]['stats']['avg90'][3]);
          } else {
            $salesRank = 0;
          }
          if (isset($res['products'][0]['csv'][0])) {
            $salePrice = end($res['products'][0]['csv'][0])/100;
          } else {
            $salePrice = 0;
          }
          //$salePrice = 0;

          //$profit = $this->products_tool_model->calculateProfit($salePrice,$height,$length,$width,$weight,$key,$data['isbn']);
          // echo json_decode($profit);
          $profit = $this->products_tool_model->baseProfit($salePrice,$height,$length,$width,$weight,$key);
          $modelData[$key]['rank'] = $salesRank;
          $modelData[$key]['profit'] = $profit;
          $json[$key]['rank'] = $salesRank;
          $json[$key]['profit'] = $profit;
          $json[$key]['rank_validation'] = $this->validateRankConfigurations($key,str_replace(',', '', $salesRank),$profit);
        }
        $this->products_tool_model->updateSalesRankAll($modelData,$data['isbn']);
        $this->products_tool_model->markComplete($data['isbn']);
      }
      echo json_encode($json);
      exit;
  }
  public function validateRankConfigurations($region_code,$rank,$profit,$category){

    if (strpos(strtolower($category), 'cds')!== false) {
      $conf_cat = 'cd';
    }else if (strpos(strtolower($category), 'dvd')!== false) {
      $conf_cat = 'dvd';
    }else if(strpos(strtolower($category), 'toy')!== false){
      $conf_cat = 'toy';
    } else if(strpos(strtolower($category), 'books')!== false){
      $conf_cat = 'books';
    } else {
      $conf_cat = '';
    }
    
    $confs=$this->sales_rank_conf_model->getConfigurationOnCategory($region_code,$conf_cat);
    foreach ($confs as $key => $value) {
      if ($rank >= $value['min_sales_rank'] && $rank <= $value['max_sales_rank'] && $profit >= $value['profit']) {
        return '1';
      }
      
    } return '0';

  }
  public function validateRankOnly($region_code,$rank,$category){

    if (strpos(strtolower($category), 'cds')!== false) {
      $conf_cat = 'cd';
    }else if (strpos(strtolower($category), 'dvd')!== false) {
      $conf_cat = 'dvd';
    }else if(strpos(strtolower($category), 'toy')!== false){
      $conf_cat = 'toy';
    } else if(strpos(strtolower($category), 'books')!== false){
      $conf_cat = 'books';
    } else {
      $conf_cat = '';
    }
    
    $confs=$this->sales_rank_conf_model->getConfigurationOnCategory($region_code,$conf_cat);
    foreach ($confs as $key => $value) {
      if ($rank >= $value['min_sales_rank'] && $rank <= $value['max_sales_rank']) {
        return '1';
      }
      
    } return '0';

  }

  public function specialValidation($isbn){

    $special_list=$this->sales_rank_conf_model->getSpecialList();
    $special_list = explode(',', $special_list[0]['isbn_list']);
    if (in_array($isbn, $special_list)) {
      return 1;
    } else {
      return 0;
    }
  }

  public function saveRanksProfits(){
    $data = $this->input->post();
    $received = json_decode($data['data'],true);
    $check_present = $this->products_tool_model->is_present($data['isbn']);
    while (!$check_present) {
      $check_present = $this->products_tool_model->is_present($data['isbn']);
    }
    $update = $this->products_tool_model->updateSalesRankNew($received,$data['isbn']);
    $this->products_tool_model->markComplete($data['isbn']);
    
    $json = array();
    foreach ($received as $key => $value) {
      $reg = explode('_', $key);  
      if (!isset($json[$reg[0].'_validation'])) {
        $json['withprofit'][$reg[0].'_validation'] = $this->validateRankConfigurations(strtoupper($reg[0]),$received[$reg[0].'_rank'],$received[$reg[0].'_price'],$data['itemCat']);
        $json['onlyrank'][$reg[0].'_validation'] = $this->validateRankOnly(strtoupper($reg[0]),$received[$reg[0].'_rank'],$data['itemCat']);
      }
    }
    $json['special_verification'] = $this->specialValidation($data['isbn']);
    $rankJson = $this->rankSepecialConf($data);
    $json['rank_special_conf'] = $rankJson;
    echo json_encode($json);
    exit;
  }

public function buyBackCalls(){
  $data = $this->input->post();

  $ch = curl_init();
  $timeout = 5;
  $url = 'https://ps.betterworldbooks.com/screen/';
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,"isbn=".$data['isbn']."&accountName=Noble%20Books%20Recycling&user=noble_books&password=N0bL3b00k$");
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $data_bwb = curl_exec($ch);
  curl_close($ch);
  $this->products_tool_model->insertBuybackBWB(json_decode($data_bwb,true));

  $ch = curl_init();
  $timeout = 5;
  $url = 'http://booksrun.com/api/price/sell/'.$data['isbn'].'?key=zyqa1mrvt190u905y1va';
  curl_setopt($ch, CURLOPT_POST, 1 );
  //curl_setopt($ch, CURLOPT_POSTFIELDS, "?key=zyqa1mrvt190u905y1va" );
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $data_bookrun = curl_exec($ch);
  curl_close($ch);
  $this->products_tool_model->insertBuybackBooksRun(json_decode($data_bookrun,true),$data['isbn']);
  print_r(json_encode(array_merge(json_decode($data_bwb, true),json_decode($data_bookrun, true))));
  return true;

}


  public function automatedKeepa(){
    ini_set('max_execution_time', 0);
    $areas = array('us' => 1,'uk' => 2,'de' => 3,'fr' => 4,'it' => 8,'es' => 9,'jp' => 5,'ca' => 6,'in' => 10,'mx' => 11,'br' => 12,'au' => 13,'cn' => 7);
    $time_start = microtime(true);
    $isbn_chunk = $this->products_tool_model->fetchChunk();
    foreach ($isbn_chunk as $isbn) {

      //for initial insertion or upgradation
      $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=1&code=".$isbn['isbn_13'];
      $ch = curl_init($service_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
      $result = curl_exec($ch);
      $res = json_decode($result,true);
      $insertion = $this->products_tool_model->insertProduct($res,'Open Book Library');

      //For sales rank and profit of all market places
      if ($insertion) {
        $check = $this->products_tool_model->checkExisting($isbn['isbn_13']);
        if (!$check) {
          $modelData = array();
          foreach ($areas as $key => $value) {
            $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=".$value."&stats=90&code=".$isbn['isbn_13'];
            $ch = curl_init($service_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
            $result = curl_exec($ch);
            $res = json_decode($result,true);

            if (isset($res['products'][0]['packageWeight'])) {
              $weight = $res['products'][0]['packageWeight'];
            } else {
              $weight = 0 ;
            }
            if (isset($res['products'][0]['packageHeight'])) {
              $height = $res['products'][0]['packageHeight']*0.0393701;
            } else {
              $height = 0;
            }
            if (isset($res['products'][0]['packageLength'])) {
              $length = $res['products'][0]['packageLength']*0.0393701;
            } else {
              $length = 0;
            }
            if (isset($res['products'][0]['packageWidth'])) {
              $width = $res['products'][0]['packageWidth']*0.0393701;
            } else {
              $width = 0;
            }
            if (isset($res['products'][0]['stats']['avg90'][3])) {
            //$salesRank = number_format(end($res['products'][0]['csv'][3]));
              $salesRank = number_format($res['products'][0]['stats']['avg90'][3]);
            } else {
              $salesRank = 0;
            }
            if (isset($res['products'][0]['csv'][0])) {
              $salePrice = end($res['products'][0]['csv'][0])/100;
            } else {
              $salePrice = 0;
            }

            $profit = $this->products_tool_model->baseProfit($salePrice,$height,$length,$width,$weight,$key,$isbn['isbn_13']);
            $modelData[$key]['rank'] = $salesRank;
            $modelData[$key]['profit'] = $profit;
          }
          $this->products_tool_model->updateSalesRankAll($modelData,$isbn['isbn_13']);
          $this->products_tool_model->markComplete($isbn['isbn_13']); 
        }
      }
      
      $this->products_tool_model->markAutomatedProcessed($isbn['isbn_13']);      

    }
    $time_end = microtime(true);
    echo "10 ISBN's iterated in ".($time_end - $time_start)." Seconds.";

  }

  public function get_pro($pro){

    $query = ("SELECT * FROM new_products WHERE isbn = '".$pro."' ");
    $data = $this->db->query($query)->result();

    echo  json_encode($data);

  }


}

