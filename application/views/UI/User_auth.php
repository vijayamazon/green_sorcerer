<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth extends CI_Controller {
 
    public function  __construct()
	{
	   parent::__construct();
       $this->load->library('form_validation');
	}
	

	public function index()
	{
         if(!$this->login_model->userLoginCheck())
          {
    		  $this->load->view('user_login');
	      }
	    else
	      {   
	        $user=$this->session->userdata('user_logged_in');
			if($user['isadmin']==1 || $user['isadmin']==2)
			{
   		      redirect('products_tool');
			}
	      }
    }
    public function login()
    {
         $this->form_validation->set_rules('username', 'Username ', 'required');
	     $this->form_validation->set_rules('password', 'Password ', 'required|callback_user_verify');
	     if($this->form_validation->run() == FALSE)
	     {
	          $this->load->view('user_login');
	     }
	     else
	     {
	         
	        $user=$this->session->userdata('user_logged_in');
			if($user['isadmin']==1 || $user['isadmin']==2)
			{
   		      redirect('products_tool');
			}
			

	     }
 
    }     
    function user_verify($password)
	{
	  $usr = $this->input->post('username');
	  $result=$this->login_model->userLoginProcess($usr,$password);
	  if($result)
	  {
	     if($this->login_model->is_verified_user())
		 {
			 return true;
	     }
         else
		 {
		 	 
            $this->session->set_userdata('resent_email', $this->input->post('username'));		 	
		 	$err_msg="Please verify your mail from the email we have sent or <a href='".base_url()."user_auth/resend_mail/'>To Resend the Activation mail please click </a>" ;

			$this->form_validation->set_message('user_verify', $err_msg);
	        return false;
		 } 		 
	  }
	  else
	  {
	    $this->form_validation->set_message('user_verify', 'Invalid username or password');
	    return false;
	  }
	}
        
    public function logout()
  	{
	  $this->login_model->userLogoutProcess();
	  redirect("user_auth","refresh");
	}
     

    public function signup()
	{
		$this->load->view('user_signup');
	}

	public function referal_signup($rid='',$ref_hash='')
	{
		if(!empty($rid) && !empty($ref_hash))
		{
		   $query=$this->db->query("SELECT ref_id as ref_key,refered_hash_id as hash_key,refered_fname as fname, refered_lname as lname,refered_mail as mail,'MAIL' as sign_up_type
		   							FROM referal_hub WHERE ref_id=".$this->db->escape($rid)." AND refered_hash_id=".$this->db->escape($ref_hash))	;
		   $data['ref_data']=$query->result_array();
		   $this->load->view('referer_signup',$data);  
		}
		else
		{
			$data['msg']="A referal link broken. please reinitate";
		    $this->load->view("action_success",$data);
		}
	}
	public function referal_self_signup($rid='',$ref_hash='')
	{
		if(!empty($rid) && !empty($ref_hash))
		{
		   $query=$this->db->query("SELECT scr_u_id as ref_key,referal_key as hash_key,'SELF' as sign_up_type FROM scr_user WHERE scr_u_id=".$this->db->escape($rid)." AND referal_key=".$this->db->escape($ref_hash));	
		   $data['ref_data']=$query->result_array();
		   $this->load->view('referer_signup',$data);  
		}
		else
		{
			$data['msg']="A referal link broken. please reinitate";
		    $this->load->view("action_success",$data);
		}
	}

	public function add_user()
	{
		 $this->form_validation->set_rules('fname', 'First Name ', 'required');
	     $this->form_validation->set_rules('lname', 'Last Name ', 'required');
	     $this->form_validation->set_rules('country', 'country', 'callback_validate_country');
	     $this->form_validation->set_message('is_unique', 'The Email already exist');
	     $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[scr_user.scr_uname]');
	     $this->form_validation->set_message('matches', 'Password mismatch');
	     $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]|matches[rpwd]');
         $this->form_validation->set_rules('rpwd', 'confirm password', 'required');
         $this->form_validation->set_rules( 'g-recaptcha-response', 'captcha', 'trim|callback_check_google_captcha|required' );
	     if($this->form_validation->run() == FALSE)
	     {
	       $this->load->view('user_signup');
	     }
	     else
	     {

	       $mail_verify_key=md5(uniqid(rand(), true));	
	       $ref_key=md5(uniqid(rand(), true));	

	       $insert_user = array('scr_firstname' =>$this->input->post('fname'),
                                'scr_lastname' =>$this->input->post('lname'),
                                'scr_is_verified' => 0,
                                'scr_is_admin' => 2,
								'scr_active' => 1,
                                'scr_uname' =>$this->input->post('email'),
								'scr_password' =>$this->input->post('pwd'),
								'mail_verify_key'=>$mail_verify_key,
								'referal_key'=>strtoupper($ref_key),
								'cntry_id'=>$this->input->post('country')
                               );
	       $this->db->trans_start();
	   
           $this->db->insert('scr_user', $insert_user);
           $uid=$this->db->insert_id();

	       $this->db->trans_complete();
	       $data['name']=$this->input->post("fname");
	  	   $data['activate_link']=base_url()."user_auth/mail_verify/".$uid."/".$mail_verify_key;
		   $msg=$this->load->view('mail/activation_mail',$data,TRUE);
		   if($this->sent_activation_link($msg,$this->input->post("email")))
		   {
		    $data['msg']="A verification link has been sent to your mail. Please verify by clicking the link.";
		    $this->load->view("action_success",$data);
		   }
		   else
		   {
		    $this->load->view('user_signup');
		   }
	  
           
	     }
	}
	public function add_referer()
	{
		 $this->form_validation->set_rules('fname', 'First Name ', 'required');
	     $this->form_validation->set_rules('lname', 'Last Name ', 'required');
	     $this->form_validation->set_rules('hash_key', 'hash_key ', 'required');
	     $this->form_validation->set_rules('referer', 'referer', 'required|callback_check_referer');
	     $this->form_validation->set_message('is_unique', 'The Email already exist');
	     $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[scr_user.scr_uname]');
	     $this->form_validation->set_message('matches', 'Password mismatch');
	     $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]|matches[rpwd]');
         $this->form_validation->set_rules('rpwd', 'confirm password', 'required');
         $this->form_validation->set_rules( 'g-recaptcha-response', 'captcha', 'trim|callback_check_google_captcha|required' );
	  
	     if($this->form_validation->run() == FALSE)
	     {
	     	$rid=$this->input->post('referer');
	     	$ref_hash=$this->input->post('hash_key');
	       if($this->input->post('sign_up_type')=='SELF')
	       {
	       	$query=$this->db->query("SELECT scr_u_id as ref_key,referal_key as hash_key,'SELF' as sign_up_type FROM scr_user WHERE scr_u_id=".$this->db->escape($rid)." AND referal_key=".$this->db->escape($ref_hash));	
		   $data['ref_data']=$query->result_array();
		   
	       }	
	       elseif($this->input->post('sign_up_type')=='MAIL')
	       {
	       		 $query=$this->db->query("SELECT ref_id as ref_key,refered_hash_id as hash_key,refered_fname as fname, refered_lname as lname,refered_mail as mail,'MAIL' as sign_up_type
		   							FROM referal_hub WHERE ref_id=".$this->db->escape($rid)." AND refered_hash_id=".$this->db->escape($ref_hash))	;
		   $data['ref_data']=$query->result_array();
		  
	       }
	       $this->load->view('referer_signup',$data);  
	     }
	     else
	     {
	     	
	     	$ref_key=md5(uniqid(rand(), true));	 
	       $insert_user = array('scr_firstname' =>$this->input->post('fname'),
                                'scr_lastname' =>$this->input->post('lname'),
                                'scr_is_verified' => 1,
                                'scr_is_admin' => 2,
								'scr_active' => 1,
                                'scr_uname' =>$this->input->post('email'),
								'scr_password' =>$this->input->post('pwd'),
								'mail_verify_key'=>'verified',
								'referal_key'=>strtoupper($ref_key),
								'cntry_id'=>$this->input->post('country')
                               );
	       $mail_verify_key=md5(uniqid(rand(), true));	 
	       if($this->input->post('sign_up_type')=='SELF')
	       {
	       	$insert_user['mail_verify_key']=$mail_verify_key;
	       }

	       $this->db->trans_start();
           $this->db->insert('scr_user', $insert_user);
           $uid=$this->db->insert_id();
           if($this->input->post('sign_up_type')=='MAIL')
	       {
	       
           $this->db->query("UPDATE referal_hub SET is_signup=1,ref_type='MAIL' where ref_id=".$this->db->escape($_POST['referer'])." AND refered_hash_id=".$this->db->escape($_POST['hash_key'])." AND refered_mail=".$this->db->escape($_POST['email']));
           }
           elseif($this->input->post('sign_up_type')=='SELF')
	       {
	        	 $insert_ref_user = array('ref_by_user_id' =>$this->input->post('referer'),
                                'refered_mail' =>$this->input->post('email'),
                                'refered_hash_id' =>$this->input->post('hash_key'),
                                'refered_fname' =>$this->input->post("fname"),
                                'refered_lname' =>$this->input->post("lname"),
                                'is_signup'=>1,
                                'ref_type'=>'LINK'
                               );
	        	 $this->db->insert('referal_hub', $insert_ref_user);
      
	       }
	       

	       $this->db->trans_complete();
	       if($this->input->post('sign_up_type')=='MAIL')
	       {
	   	       $data['msg']="Account created successfully please login .";
			   $this->load->view("action_success",$data);
		   }
		   elseif($this->input->post('sign_up_type')=='SELF')
		   {
		       $data['name']=$this->input->post("fname");
		  	   $data['activate_link']=base_url()."user_auth/mail_verify/".$uid."/".$mail_verify_key;
			   $msg=$this->load->view('mail/activation_mail',$data,TRUE);
			   if($this->sent_activation_link($msg,$this->input->post("email")))
			   {
			    $data['msg']="A verification link has been sent to your mail. Please verify by clicking the link.";
			    $this->load->view("action_success",$data);
			   }
			   else
			   {
			   $data['msg']="Not able to create account .";
			   $this->load->view("action_success",$data);
			   }
	     	
		   }
		   
	     }
	}
   public function check_referer($ref_key)
  {
  	   if(!isset($_POST['sign_up_type']) || empty($_POST['sign_up_type']))
  	   {
  	   	 $this->form_validation->set_message('check_referer', 'referal data signup type missing');
         return FALSE;
  	   }
       if(!empty($this->input->post('email')) && !empty($this->input->post('referer')) && !empty($this->input->post('hash_key')) )
       { 
       	 if($this->input->post('sign_up_type')=='MAIL')
       	 {
       	     $query=$this->db->query("SELECT ref_id,refered_fname from referal_hub WHERE ref_id=".$this->db->escape($_POST['referer'])." AND refered_hash_id=".$this->db->escape($_POST['hash_key'])." AND refered_mail=".$this->db->escape($_POST['email']));
       	     $res=$query->result_array();
       	     if(!empty($res['0']['refered_fname']))
			 {
		    	return TRUE;
			 }
			 else
			 {
				$this->form_validation->set_message('check_referer', 'referal data mismatch');
	     		return FALSE;
			 }
       	 	
       	 }
       	 elseif($this->input->post('sign_up_type')=='SELF')
       	 {
       	     $query=$this->db->query("SELECT scr_u_id from scr_user WHERE scr_u_id=".$this->db->escape($_POST['referer'])." AND referal_key=".$this->db->escape($_POST['hash_key']));
       	     $res=$query->result_array();
       	     if(!empty($res['0']['scr_u_id']))
			 {
		    	return TRUE;
			 }
			 else
			 {
				$this->form_validation->set_message('check_referer', 'referal data mismatch');
	     		return FALSE;
			 }
       	 	
       	 }
       	 else
       	 {
       		$this->form_validation->set_message('check_referer', 'referal data mismatch');
         	return FALSE; 	
       	 }
         
       }
       else
       {
         $this->form_validation->set_message('check_referer', 'referal data mismatch');
         return FALSE;
       }
  }

	public function resend_mail($email='')
	{
       if($this->session->userdata('resent_email'))
	     {
		       $email=$this->session->userdata('resent_email');
		       $mail_verify_key=md5(uniqid(rand(), true));
		       $this->db->query("UPDATE scr_user SET mail_verify_key='".$mail_verify_key."' WHERE scr_uname='{$email}'");
		       $query=$this->db->query("SELECT scr_u_id,scr_uname,scr_firstname,scr_lastname from scr_user WHERE scr_uname='".$email."'");
		       $res=$query->result_array();
               $data['name']=$res[0]['scr_firstname'];
		  	   $data['activate_link']=base_url()."user_auth/mail_verify/".$res[0]['scr_u_id']."/".$mail_verify_key;
		  	   $msg=$this->load->view('mail/activation_mail',$data,TRUE);
			   if($this->sent_activation_link($msg,$email))
			   {
			    $data['msg']="A verification link has been resent to your mail. Please verify by clicking the link.";
			    $this->load->view("action_success",$data);
			   }
			   else
			   {
		         $data['msg']="Something went wrong please try again";	   	
		         $this->load->view("action_success",$data);
			   }
	          
         }
         else
         {
         	  $sdata['msg']="Something went wrong please try again";
         	  $this->load->view("action_success",$sdata);
         }
         
	}
  public function validate_country($country)
  {
    $sql="SELECT * FROM country_master WHERE country_id=".$this->db->escape($country);
    $query=$this->db->query($sql);
  	$res=$query->result_array();

  	if(count($res)>0)
  	{
  		return TRUE;
  	}
  	else
  	{
  		$this->session->set_flashdata('vmsg','Country code error'); 
  		$this->form_validation->set_message('validate_country', 'country code error');
  		return FALSE;
  	}
  }
  public function check_google_captcha($recaptcha)
  {
       if(!empty($recaptcha))
       {
       	 $google_url="https://www.google.com/recaptcha/api/siteverify";
		 $secret='6Ld9VxQUAAAAAEDKFFKQyz1v1SCp4Rcvnuv094XS';
		 $ip=$_SERVER['REMOTE_ADDR'];
		 $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
		 $res=file_get_contents($url);
		 
		 $res= json_decode($res, true);
		 if($res['success'])
		 {
	    	return TRUE;
		 }
		 else
		 {
			$this->form_validation->set_message('check_google_captcha', 'Wrong captcha code');
     		return FALSE;
		 }
         
       }
       else
       {
         $this->form_validation->set_message('check_google_captcha', 'Wrong captcha code');
         return FALSE;
       }
  }
  private function fetch_curl_data($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 25);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;
	}
 public function mail_verify($uid,$mail_hass)
 {
		if(!empty($uid) && !empty($mail_hass) && is_numeric($uid))
		{
		   $data=array();
		   $query=$this->db->query("SELECT scr_firstname,scr_uname,mail_verify_key FROM scr_user where scr_u_id=".$this->db->escape($uid));
		   if ($query->num_rows() == 1)
	        {
	          $row = $query->row();
	          if (strcmp($row->mail_verify_key,$mail_hass)== 0) 
		      {
			   $update=array('mail_verify_key' =>"verified",'scr_is_verified'=>1); 

			   $this->db->where('scr_u_id',$uid);
			   $this->db->update('scr_user',$update);
		 	   $data['msg']="Your mail has been verified successfully. And you can start using our feature.";
	  		  }       
		  	  elseif(strcmp($row->mail_verify_key,'verified')==0)
			  {
			   $data['msg']="Your mail has already been verified and you can start using our feature.";
			  }
			  else
			  {
			   $data['msg']="Your verification mail expired create a new account";
			  }
			}
			else
			{
	          $data['msg']="No Record Found Or Link May Be Borken or Changed";
			}
		   $this->load->view("action_success",$data);
	   }
	   else
		{
		 redirect('user_auth');
		}
 }
 private function sent_activation_link($msg,$recev)
 {
     $this->load->library('email');
     $this->email->from("support@prosellerlisting.com","Prosellerlisting.com");
     $this->email->to($recev);
     $this->email->subject("Prosellerlisting - user account activation mail");
     $this->email->message($msg);
     if ($this->email->send())
	  {
        return true;
      }
     else
	  {
       return FALSE;
        
      }
 }
  
}

