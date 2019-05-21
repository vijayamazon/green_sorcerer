<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Amazon_product_api_ca extends CI_Model
{
  private $seller_id='';
  private $auth_token='';
  private $access_key='';
  private $secret_key='';
  private $market_id='';
  private $service_url='mws.amazonservices.com';
  public function  __construct()
  {
   		parent::__construct();
  }

  public function set_credentials($user_id,$seller_id,$auth_token,$access_key,$secret_key,$market_placeID)
  {
        $this->seller_id=$seller_id;
        $this->auth_token=$auth_token;
        $this->access_key=$access_key;
        $this->secret_key=$secret_key;
        $this->market_id=$market_placeID;  
        return TRUE;
  }
  public function get_product_to_match($limit=600000)
  {
    $query=$this->db->query("SELECT pro_isbn  FROM product_info where process_flag=0 OR process_flag is null  limit 0,".$limit);
    return $query->result_array();
  }
  public function fetch_product_details($user_id,$ean)
  { 
    try
    {
      $httpHeader=array();
      $httpHeader[]='Transfer-Encoding: chunked';
      $httpHeader[]='Content-Type: text/xml';
      $httpHeader[]='Expect:';
      $httpHeader[]='Accept:';
      $param['Action']=urlencode("GetMatchingProductForId");
      $param['IdType']='EAN';
      $mod_ean=str_pad($ean,13,"0",STR_PAD_LEFT);
       //echo "ean:$ean";
      $param['IdList.Id.1']=$ean;
      //echo "mod_ean:$mod_ean";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->built_query_string($param));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 15);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
      curl_setopt($ch, CURLOPT_POST, true);
      $response = curl_exec($ch);
      //echo "response1:$response";
      $res = simplexml_load_string($response);
 //echo "response:$res";
      $namespaces = $res->getNamespaces(true);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $payload=[];
      $payload['lm_ean']=$payload['lm_asin']=$payload['sales_rank']=$payload['list_price']='';
      $payload['asin_counts']=-3;
      if($httpcode != 200)
      {
        if(preg_match('/throttled/',(string)$res->GetMatchingProductForIdResult->Error->Message ))
        {
          sleep(1);
          echo "throttling occured;\n";
          $this->fetch_product_details($user_id,$ean);
        }
        
        
      }
      if(preg_match('/Invalid EAN/',(string)$res->GetMatchingProductForIdResult->Error->Message))
      {
        
          echo "ERROR ".(string)$res->GetMatchingProductForIdResult->Error->Message;
          $data['status_code']=3;
          $data['status_text']="No Data";
          $payload['lm_ean']=$ean;
          $payload['asin_counts']=-3;
          $payload['lm_asin']='';
          $data['payload']=$payload;  
          return $data;
        //throw new Exception($res->GetMatchingProductForIdResult->Error->Message);   
      }
      
      if(isset($res->GetMatchingProductForIdResult[0]->Products->Product))
      {
            $payload['lm_ean']=$ean;
            $payload['asin_counts']= count($res->GetMatchingProductForIdResult[0]->Products->Product);
            $payload['lm_asin']= (string)$res->GetMatchingProductForIdResult[0]->Products->Product->Identifiers->MarketplaceASIN->ASIN;
			$payload['sales_rank']=isset($res->GetMatchingProductForIdResult[0]->Products->Product->SalesRankings->SalesRank->Rank)?(string)$res->GetMatchingProductForIdResult[0]->Products->Product->SalesRankings->SalesRank->Rank:'';
            if(isset($res->GetMatchingProductForIdResult->Products->Product->AttributeSets))
            {
              $ns = $res->GetMatchingProductForIdResult->Products->Product->AttributeSets->children($namespaces["ns2"]);  
			  $payload['list_price']=isset($ns->ItemAttributes->ListPrice->Amount)?str_replace('.','.',(string)$ns->ItemAttributes->ListPrice->Amount):'';
            }
            
             
      

      }
      if(count($payload) > 0 && !empty($payload['lm_asin']))
      {
        $data['status_code']=1;
        $data['status_text']="Success";
        $data['payload']=$payload;  
      }
      else
      {
          $data['status_code']=3;
          $data['status_text']="No Data";
          $payload['lm_ean']=$ean;
          $payload['asin_counts']=-3;
          $payload['lm_asin']='';
          $data['payload']=$payload;  
      }
      return $data;
    }
    catch(Exception $e) 
    {
      
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
public function fetch_product_detail($user_id,$asin)
  { 
    try
    {
      $httpHeader=array();
      $httpHeader[]='Transfer-Encoding: chunked';
      $httpHeader[]='Content-Type: text/xml';
      $httpHeader[]='Expect:';
      $httpHeader[]='Accept:';
      $param['Action']=urlencode("GetLowestOfferListingsForASIN");
      //$param['ExcludeMe']='true';
      // $asin=str_pad($asin,13,"0",STR_PAD_LEFT);
      $param['ASINList.ASIN.1']=$asin;
	  //$param['ItemCondition']='NEW';
	  //$param['ExcludeMe']='false';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->built_query_string($param));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 15);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
      curl_setopt($ch, CURLOPT_POST, true);
      $response = curl_exec($ch);
	  //echo"$response";
      $res = simplexml_load_string($response);
      //print_r($res);
	   
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $payload=[];
      $payload['lm_asin']=$payload['comp_asin']=$payload['low_price']='';
      $payload['asin_counts']=-3;
      if($httpcode != 200)
      {
        if(preg_match('/throttled/',(string)$res->GetLowestOfferListingsForASINResult->Error->Message ))
        {
          sleep(1);
          echo "throttling occured;\n";
          $this->fetch_product_details($user_id,$asin);
        }
        
        
      }
      if(preg_match('/Invalid ASIN/',(string)$res->GetLowestOfferListingsForASINResult->Error->Message))
      {
        
          echo "ERROR ".(string)$res->GetLowestOfferListingsForASINResult->Error->Message;
          $data['status_code']=3;
          $data['status_text']="No Data";
          $payload['lm_asin']=$asin;
          $payload['asin_counts']=-3;
          $data['payload']=$payload;  
          return $data;
        //throw new Exception($res->GetMatchingProductForIdResult->Error->Message);   
      }
      
       if(isset($res->GetLowestOfferListingsForASINResult[0]->Product))
      {
            $payload['lm_asin']=$asin;
	        $payload['comp_asin']= (string)$res->GetLowestOfferListingsForASINResult[0]->Product->Identifiers->MarketplaceASIN->ASIN;
			$payload['low_price']= (((string)$res->GetLowestOfferListingsForASINResult[0]->Product->LowestOfferListings->LowestOfferListing->Price->LandedPrice->Amount)/1.2808);
			
            
            
              
            }
            
      if(count($payload) > 0 && !empty($payload['comp_asin']))
      {
        $data['status_code']=1;
        $data['status_text']="Success";
        $data['payload']=$payload;  
      }
      else
      {
          $data['status_code']=3;
          $data['status_text']="No Data";
          $payload['lm_asin']=$asin;
          $payload['asin_counts']=-3;
          $data['payload']=$payload;  
      }
      return $data;
    }
    catch(Exception $e) 
    {
      
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
 
 
 private function built_query_string($add_param)
 {
         $params = array(
                  'AWSAccessKeyId'=> urlencode($this->access_key),
                  'SellerId'=> urlencode($this->seller_id),
				  'MWSAuthToken'=>urlencode($this->auth_token),
                  'SignatureMethod' => urlencode("HmacSHA256"),
                  'SignatureVersion'=> urlencode("2"),
                  'Timestamp'=>gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time()),
                  'Version' => urlencode("2011-10-01"),
                  'MarketplaceId'=>$this->market_id

                 );
  
            $params=array_merge($params,$add_param);
          $url_parts = array();
        foreach(array_keys($params) as $key)
        {
            $url_parts[] = $key . "=" . str_replace('%7E', '~', rawurlencode($params[$key]));
        }
        sort($url_parts);
            $url_string = implode("&", $url_parts);
            $string_to_sign = "POST\nmws.amazonservices.com\n/Products/2011-10-01\n" . $url_string;
            
            $signature = hash_hmac("sha256", $string_to_sign, $this->secret_key, TRUE);
            $signature = urlencode(base64_encode($signature));
            $url = "https://mws.amazonservices.com/Products/2011-10-01?". $url_string . "&Signature=" . $signature;
            return $url; 
 }
}