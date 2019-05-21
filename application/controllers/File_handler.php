
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_Handler extends CI_Controller {
  private $user_id;
  public $sellingAmazonFee = array(
    "US"=>array("referralFee"=>0.15,"varClosingFee"=>1.80),
    "UK"=>array("referralFee"=>0.15,"varClosingFee"=>0.50),
    "MX"=>array("referralFee"=>8.62,"varClosingFee"=>0.00),
    "CA"=>array("referralFee"=>0.15,"varClosingFee"=>1.80),
    "IT"=>array("referralFee"=>0.15,"varClosingFee"=>1.01),
    "ES"=>array("referralFee"=>0.15,"varClosingFee"=>1.01),
    "FR"=>array("referralFee"=>0.15,"varClosingFee"=>0.61),
    "DE"=>array("referralFee"=>0.15,"varClosingFee"=>1.01),
    "JP"=>array("referralFee"=>0,"varClosingFee"=>80),
    "IN"=>array("referralFee"=>0.13,"varClosingFee"=>15)
  );

  public $regions = array();
  public $json = array();
  public $dropShippingFee = 0;
  public $us_fba_avg = 0;
  public $us_fbm_avg = 0;
  public $us_keepa_new_price = 0;
  public function  __construct()
  {
   parent::__construct();
   if(!$this->login_model->userLoginCheck())
   {
    redirect('user_auth');
  }
  else
  {
    $this->load->library('excel');
    $this->load->model("sales_rank_conf_model");
    $this->load->model("products_tool_model");
    $this->load->model("file_handler_model");
    $this->load->helper(array('form', 'url','file'));
    $this->load->library('session');
    $this->load->library('pagination');
    $user=$this->session->userdata('user_logged_in');  
    $this->user_id=$user['id'];

    $regionsData = $this->sales_rank_conf_model->getRegions();
    foreach ($regionsData as $key => $value) {
      $this->regions[$value['region_code']] = $value;
    } 
    $this->dropShippingFee = $this->file_handler_model->getDropShipPriceOnly();

  }

}
public function index()
{
  $params = array();
  $limit_per_page = 10;
  $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
  $total_records = $this->file_handler_model->record_count();
  if ($total_records > 0) 
  {
      // get current page records
    $params["files"] = $this->file_handler_model->getFiles($limit_per_page, $start_index);
    $config['base_url'] = base_url() . 'file_handler/index';
    $config['total_rows'] = $total_records;
    $config['per_page'] = $limit_per_page;
    $config["uri_segment"] = 3;
    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '<i class="fa fa-arrow-right"></i>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $this->pagination->initialize($config);
      // build paging links
    $params["links"] = $this->pagination->create_links();
  }

  // $this->load->view('UI/header-backup');
  $this->load->view('UI/header');
  $this->load->view('UI/file_handler',$params);
  $this->load->view('UI/footer');
}

public function uploadFile()
{
  ini_set('max_execution_time', 0);
  $baseurl=base_url();
  $config = array(
    'upload_path' => "./uploads/",
    'allowed_types' => "pdf|csv",
      'max_size' => "10048000" // Can be set to particular file size , here it is 10 MB(2048 Kb)
    );
  $this->load->library('upload', $config);
  if($this->upload->do_upload()) {
   $uploadData = $this->upload->data();
   $this->file_handler_model->addFile($uploadData);
   $csvData = array_map('str_getcsv', file($uploadData['full_path']));
   $vpData = $this->sales_rank_conf_model->getVariantPriceOnly();
   $variantPrice = $vpData['value'];
   $thresholdPriceColor = $this->sales_rank_conf_model->getThresholdPriceColor();
   $fileName = '';
   $object = '';
   foreach ($csvData as $key => $value) {
    if ($key == 0) {
      //header set
      $fileName = trim(basename($uploadData['file_name'],".csv").PHP_EOL);
      $object = new PHPExcel();
      $object->getProperties()->setCreator("Methew Adolph")
      ->setLastModifiedBy("Methew Adolph")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
      ->setDescription("Test document for Office 2007 XLSX, generated using PHPExcel library.")
      ->setKeywords("office 2007 openxml php")
      ->setCategory("Test result file");
      $object->setActiveSheetIndex(0);
      $object->getActiveSheet()->setTitle('test Excel file export');
      $headExcel = array('Isbn','Price','Us Rank','US Fba Profit','US Fbm Profit','US Drop Ship Profit','CA Rank','CA Profit','CA fbm Profit','CA Drop Ship Profit','UK Rank','UK Profit','UK fbm Profit','UK Drop Ship Profit','DE Rank','DE Profit','DE fbm Profit','DE Drop Ship Profit','FR Rank','FR Profit','FR fbm Profit','FR Drop Ship Profit','IT Rank','IT Profit','IT fbm Profit','IT Drop Ship Profit','ES Rank','ES Profit','ES fbm Profit','ES Drop Ship Profit','MX Rank','MX Profit','MX fbm Profit','MX Drop Ship Profit','IN Rank','IN Profit','IN fbm Profit','IN Drop Ship Profit','JP Rank','JP Profit','JP fbm Profit','JP Drop Ship Profit');
      $object->getActiveSheet()->fromArray($headExcel, null, 'A1');
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      $objWriter->save($uploadData['file_path'].$fileName.'Updated.xls');
    }else{
      // check for isbn and hit keepa
     $isbn = $value[0];
     if (isset($value[1])) {
      $price = $value[1];
    }else{
      $price = '$0.00';
    }
    $purchasedPrice = (float)str_replace('$','', $price);
    $rowData = array();
    $rowData['isbn'] = $isbn;
    $rowData['price'] = $purchasedPrice;
    $correct = $this->insertProductFiled($isbn,$uploadData['raw_name']);
    $drop_ship_fee = $this->dropShippingFee['value'];
    if ($correct) {
      if (is_numeric((float)str_replace('$', '', $price))) {
        $writeData = $this->FetchSalesRankAllFiled($isbn,(float)str_replace('$', '', $price),$variantPrice,$drop_ship_fee);
      }else{
        $writeData = $this->FetchSalesRankAllFiled($isbn,'0.00',$variantPrice,$drop_ship_fee);
      }

      $highestRow = $object->getActiveSheet()->getHighestDataRow() + 1;

      $cell = 'A'.$highestRow;
      $object->getActiveSheet()->fromArray($rowData,null,$cell);
      $column = 2;
      
      foreach ($writeData as $regionCode => $data) {
        if ($data['rank'] > 0) {
          $object->getActiveSheet()->setCellValueByColumnAndRow($column,$highestRow,$data['rank']);
          if ($data['profit'] >= $thresholdPriceColor['fba_price']) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column+1,$highestRow,$data['profit']);
            $this->cellColor($object,$column +1,$highestRow,$thresholdPriceColor['fba_color'],'bold');
          }else{
            $object->getActiveSheet()->setCellValueByColumnAndRow($column+1,$highestRow,$data['profit']);
          }

          if ($data['fbm_profit'] >= $thresholdPriceColor['fbm_price']) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column+2,$highestRow,$data['fbm_profit']);
            $this->cellColor($object,$column +2,$highestRow,$thresholdPriceColor['fbm_color'],'italic');
          }else{
            $object->getActiveSheet()->setCellValueByColumnAndRow($column+2,$highestRow,$data['fbm_profit']);
          }
            // for drop ship profit
          $object->getActiveSheet()->setCellValueByColumnAndRow($column+3,$highestRow,$data['drop_ship_profit']);
          $this->cellColor($object,$column+3,$highestRow,$thresholdPriceColor['drop_ship_color'],'italic');
          $column +=4;
        }else{
          $object->getActiveSheet()->setCellValueByColumnAndRow($column,$highestRow,$data['rank']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($column+1,$highestRow,$data['profit']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($column+2,$highestRow,$data['fbm_profit']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($column+3,$highestRow,$data['drop_ship_profit']);
          $column +=4;
        }

      }
    }else{
     $highestRow = $object->getActiveSheet()->getHighestDataRow() +1;
     $cell = 'A'.$highestRow;
     $object->getActiveSheet()->fromArray($rowData,null,$cell);
     $object->getActiveSheet()->setCellValueByColumnAndRow(2, $highestRow, 'Invalid ISBN Provided');
   }
 }
   }// end of csvData
   //echo "loop completely traversed!";
 $this->file_handler_model->updateFile($uploadData['file_name'],0,1); // filename,last_index,status
 $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
 $objWriter->save($uploadData['file_path'].$fileName.'Updated.xls'); // end foreach csv
 $this->session->set_userdata('alert','<h4 style="color: #339900">Uploaded Successfully</h4>');
 redirect('File_handler');
}else{
  $this->session->set_userdata('alert','<h4 style="color: #FA8072">'.$this->upload->display_errors().'</h4>');
  redirect('File_handler');
}
}
public function FetchSalesRankAllFiled($isbn,$purchasedPrice,$variantPrice,$dropShippingFee)
{
  $areas = array('US' => 1,'CA' => 6,'UK' => 2,'DE' => 3,'FR' => 4,'IT' => 8,'ES' => 9,'MX' => 11,'IN' => 10,'JP' => 5);
  $json = array();
  $modelData = array();
  foreach ($areas as $key => $value) {
    $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&stats=90&domain=".$value."&code=".$isbn;
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
      $salesRank = $res['products'][0]['stats']['avg90'][3];
    } else {
      $salesRank = 0;
    }
    if ( (isset($res['products'][0]['csv'][1]) ) && ( $res['products'][0]['csv'][1][count($res['products'][0]['csv'][1])-1] ) != -1) {
      $keepa_new_price = round(($res['products'][0]['csv'][1][count($res['products'][0]['csv'][1])-1]/100),2);
      $profit = $this->baseProfitFiles($keepa_new_price,$purchasedPrice,$height,$length,$width,$weight,$key);
      $fbm_profit = $this->baseFbmProfitFiles($keepa_new_price,$purchasedPrice,$variantPrice,$weight,$key);
      $drop_ship_profit = $this->dropShipFbmProfitFiles($keepa_new_price,$purchasedPrice,$variantPrice,$weight,$key,$dropShippingFee);
    }else{
      $profit = 0.00;
      $fbm_profit = 0.00;
      $drop_ship_profit = 0.00;
    }
    
    $modelData[$key]['rank'] = $salesRank;
    $modelData[$key]['profit'] = $profit;
    $modelData[$key]['fbm_profit'] = $fbm_profit;
    $modelData[$key]['drop_ship_profit'] = $drop_ship_profit;
  }
  $this->products_tool_model->updateSalesRankAll($modelData,$isbn);
  $this->products_tool_model->markComplete($isbn);
      //}
  return $modelData;
}
public function deleteFile()
{
  $deleteThis = $this->input->post('deleteId');
  $path = $this->input->post('path');
  $res = $this->file_handler_model->deleteFile($deleteThis,$path);
  if($res)
  {
    $this->session->set_userdata('alert','<h4 style="color: #339900">File Deleted Successfully</h4>'); 
    $filename = basename($path, ".csv");
    unlink("uploads/".$filename."Updated.xls"); 
  }
  redirect('File_handler');
}


public function insertProductFiled($isbn,$fileName)
{
  $service_url = "https://api.keepa.com/product?key=f4srik0llhm63as1p4bgv4j0vu1m985lbikjeo7btf231h2gvtqjmkf5kq9ahssk&domain=1&code=".$isbn;
  $ch = curl_init($service_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');
  $result = curl_exec($ch);
  $res = json_decode($result,true);
  if (isset($res['products'][0]['eanList'][0])) {
    $added = $this->file_handler_model->insertProduct($result,$fileName.'- File Item');
    return $added;
  }else{
    return false;
  }
}

public function cellColor($objectExcel,$column,$row,$color,$fontType){
  $colString = PHPExcel_Cell::stringFromColumnIndex($column);
  $cell = $colString.$row;
  $objectExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array(
    'fill'=>array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => $color)
    ),
    'font'=> array(
      $fontType=>true
    )
  ));
}

public function baseProfitFiles($avgFbaOfferPrice,$purchasedPrice,$height,$length,$width,$weight,$regionCode){
  $shippingFee  =  $this->regions[$regionCode]['amazon_shipping_cost'];
  $referralFee = $this->sellingAmazonFee[$regionCode]['referralFee'];
  $variableClosingFee = $this->sellingAmazonFee[$regionCode]['varClosingFee'];
  $weightLb = $weight * 0.00220462;
  $baseVal = 0;

  if ($weightLb <= 0.625 && $length <= 15 && $width <= 12 && $height <= 0.75) {
    $baseVal = 2.41;
  } else if ($weightLb > 0.625 && $weightLb < 1 && $length <= 15 && $width <= 12 && $height <= 0.75){
    $baseVal = 2.48;
  } else if ($weightLb <= 0.625 && $length <= 18 && $width <= 14 && $height <= 8){
    $baseVal = 3.19;
  } else if ($weightLb > 0.625 && $weightLb < 1 && $length <= 18 && $width <= 14 && $height <= 8){
    $baseVal = 3.28;
  } else if ($weightLb > 1 && $weightLb < 2 && $length <= 18 && $width <= 14 && $height <= 8){
    $baseVal = 4.76;
  } else if ($weightLb >= 2 && $weightLb < 3 && $length <= 18 && $width <= 14 && $height <= 8){
    $baseVal = 5.26;
  } else {
    if ($weightLb > 3 ) {
      $costOverWeight = ceil( $weightLb - 3) * 0.38 ;
      $baseVal =  $costOverWeight + 5.26 ;
    }else{
      $baseVal = 5.26;
    }
  }

  $x1 = ($referralFee*$avgFbaOfferPrice)+$variableClosingFee;
  $x2 = $baseVal+($shippingFee*$weightLb)+0.05 ;
  $profit = (($avgFbaOfferPrice - $x1) - $x2) - $purchasedPrice;
  $profit = round($profit,2);
  return $profit;
}

public function baseFbmProfitFiles($avgFbmOfferPrice,$purchasedPrice,$variantPrice,$weight,$regionCode)
{
  $weightLb =(float)$weight*0.00220462;
  $shippingCost = $this->regions[$regionCode]['merchant_shipping_cost'];
  $perPoundCost = $this->regions[$regionCode]['merchant_price_per_pound'];
  $referralFee = $this->sellingAmazonFee[$regionCode]['referralFee'];
  $variableClosingFee = $this->sellingAmazonFee[$regionCode]['varClosingFee'];
  if ($weightLb < 1) {
    $shippingFee = $perPoundCost;
  }else{
    $shippingFee = $weightLb * $perPoundCost ;
  }
  $shippingFee = $shippingFee + $shippingCost;
  $x1 = ($referralFee * $avgFbmOfferPrice ) + $variableClosingFee;
  $fbm_profit = (((($avgFbmOfferPrice - $x1)-$variantPrice)-$purchasedPrice) - $shippingFee );

  $fbm_profit = round($fbm_profit,2);
  return $fbm_profit;
}

public function dropShipFbmProfitFiles($avgFbmOfferPrice,$purchasedPrice,$variantPrice,$weight,$regionCode,$dropShippingFee)
{
  echo "$regionCode ".$avgFbmOfferPrice."\n";
  $referralFee = $this->sellingAmazonFee[$regionCode]['referralFee'];
  $variableClosingFee = $this->sellingAmazonFee[$regionCode]['varClosingFee'];

  $x1 = ($referralFee * $avgFbmOfferPrice ) + $variableClosingFee;
  $dropShipProfit = (((($avgFbmOfferPrice - $x1)-$variantPrice)-$purchasedPrice) - $dropShippingFee );
  $dropShipProfit = round($dropShipProfit,2);
  return $dropShipProfit;
}

}

