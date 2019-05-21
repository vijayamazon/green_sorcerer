<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_alert extends CI_Controller {
  private $rs=[];
  public function  __construct()
  {
     parent::__construct();
     
     //$this->load->model('email_alert_model');
     $this->load->library('parser');
     $this->parser->set_delimiters('{','}');
    
  }
  
 public function send_alert()
  {

       $qry=$this->db->query("SELECT pro_id,rule_id,pro_title,pro_asin,net_amount,pro_us_price,pro_us_rank,pro_isbn,pro_id,color FROM product_info INNER JOIN rule_info WHERE pro_us_rank BETWEEN ROUND(min_sales_rank) AND ROUND(max_sales_rank) AND ROUND(net_amount) >= ROUND(pro_us_price)");
    	$res=$qry->result_array();
		$msg='';
    	if(count($res) > 0)
    	{
            $msg .= '
    <!DOCTYPE html>
    <html lang="en">';
    $msg .= '<p>Hi,<br></p>';
    $msg .= '<p> Please find the below give list of ISBN which met threshold for New Price,</p>';
    $msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #13b2b2;color: white;border: 2px solid black;
    padding: 8px;">ISBN</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #13b2b2;color: white;border: 2px solid black;
    padding: 8px;">Title</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #13b2b2;color: white;border: 2px solid black;
    padding: 8px;">Amazon Url</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #13b2b2;color: white;border: 2px solid black;
    padding: 8px;">Net Amount</th>
    </tr>
    </thead>
    <tbody>';
        foreach ($res as $rs){
            $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$rs['pro_isbn'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$rs['pro_title'].'</td>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;"><a target="_blank" href="www.amazon.com/dp/'.$rs["pro_asin"].'" style="font-size:15px;font-weight:600;color:green">Click Here</a> </td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$rs['net_amount'].'</td>';
            $msg .='</tr>';
        }
   
    $msg .= '</tbody></table>';
    $msg .= '<p>Thank you!<br></p>';
    $msg .= '</body></html>';
      if(!empty($msg))
      {
          $email_content=$msg;
		  
          $this->send_mail($res[0],$email_content);
		  
          sleep(10);  

      }
      
    }
	
  }	
    
  public function send_mail($rs,$msg)
  {
      $this->load->library('email');
      $config['protocol'] = 'smtp';
     $config['smtp_host'] = "tls://email-smtp.us-west-2.amazonaws.com";
     $config['smtp_port'] = '465';
     $config['smtp_user'] = 'AKIAIQNU2NLHN24PYFTA';
     $config['smtp_pass'] = 'ArbF9Hs4dVEojY+yHVZ4nupMSlttvfYlUQi9c5iCOG7z';
      $config['wordwrap']=TRUE;
      $config['charset'] = "utf-8";
      $config['mailtype'] = "html";
      $config['newline'] = "\r\n";
	  $config['crlf'] = "\r\n";
      $this->email->initialize($config);
      $this->email->from('feedback_mail@idqlabs.com');
      $this->email->to("yugandharmani25@gmail.com");
      $this->email->subject("ISBN - New Price Theshold Met");
      $this->email->message($msg);
      
      if ($this->email->send()) 
      {
        echo '{"status_code":"1","status_text":"Mail has been sent Suceesfully"}';
		//$qi="UPDATE product_info SET is_alerted_new=1 WHERE pro_tshold_new_price >= pro_new_low_price AND process_flag=1 AND pro_new_low_price > '0' ";
					//print_r($qi);
					
                   // $this->db->query($qi);
      }
      else
      {
       echo $this->email->print_debugger();
      }
  
    
  }
  
}