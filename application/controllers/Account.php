<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('Account_details');
        $this->load->library('Payment');
        $this->load->model('Mailsend');
	}
	public function index()
	{
		if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		$data['smartcard_details']=$this->Account_details->get_smartcard_details($session_user_data['id']);
    		$this->load->view('account_page', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function my_package(){
	    if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['active_cable_package']=$this->Account_details->get_user_active_cable_package($session_user_data['id']);
    		$data['active_internet_package']=$this->Account_details->get_user_active_internet_package($session_user_data['id']);
    		
    		$data['recommended_internet_package']=$this->Account_details->get_recommended_internet_package($session_user_data['id']);
    		$data['recommended_cable_package']=$this->Account_details->get_recommended_cable_package($session_user_data['id']);
    		
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		
    		if(empty($data['Account_details'][0]['phone'])){
    		    $this->payment->setcustomerMobile('9900065533');
    		}else{
    		    $this->payment->setcustomerMobile($data['Account_details'][0]['phone']);
    		}
    		if(empty($data['Account_details'][0]['email'])){
    		    $this->payment->setcustomerEmailId('info@worldvisioncable.in');
    		}else{
    		    $this->payment->setcustomerEmailId($data['Account_details'][0]['email']);
    		}
    		
    		$this->payment->setcustomerName($data['Account_details'][0]['full_name']);
    		$this->payment->setcustomerBillingAddress($data['Account_details'][0]['city_name']);
    		$this->payment->setcustomerAccount($session_user_data['id']);
    		
    		if($data['active_internet_package']){
    		$this->payment->settransactionId("wvc_".time().rand(01,99));
    		if($data['active_internet_package'][0]['Total'] > 50){
    		$this->payment->setamount($data['active_internet_package'][0]['Total']);
    		}else{
    		    $this->payment->setamount('51');
    		}
    		$this->payment->setudf9("user_id:".$session_user_data['id'].";package_type:1;package_id:".$data['active_internet_package'][0]['packageId']);
    		$payment_url1=$this->payment->getPGUrl();
    		$data['payment_url_broadband']=$this->payment_url('https://payment.atomtech.in/paynetz/epi/fts',parse_url($payment_url1, PHP_URL_QUERY));
    		}
    		
    		if($data['active_cable_package']){
    		$this->payment->settransactionId("wvc_".time().rand(001,99));
    		if($data['active_cable_package'][0]['price']>50){
    		$this->payment->setamount($data['active_cable_package'][0]['price']);
    		}else{
    		    $this->payment->setamount('51');
    		}
    		$this->payment->setudf9("user_id:".$session_user_data['id'].";package_type:2;package_id:".$data['active_cable_package'][0]['packageId']);
    		$payment_url1=$this->payment->getPGUrl();
    		$data['payment_url_cable']=$this->payment_url('https://payment.atomtech.in/paynetz/epi/fts',parse_url($payment_url1, PHP_URL_QUERY));
    		$data['payment_url']=$payment_url1;
    		}
    		$this->load->view('my_package_page', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	
	public function payment_success(){
	    
    	    if($_POST){
        	        $postArray = $_POST;
        	        if(isset($this->session->userdata['logged_in'])){
        	        $session_user_data=$this->session->userdata['logged_in'];
        	        }else{
        	            $session_user_data=array();
        	        }
        	        $postArray['payment_response']=json_encode($_POST);
        	        $package_details=explode(";",$_POST['udf9']);
        	        
        	        unset($postArray['desc']);
        	        $postArray['descr']=$_POST['desc'];
        	        if(isset($package_details->package_id)){
        	        $postArray['package_id']=$package_details->package_id;
        	        }else{
        	            $postArray['package_id']='1';
        	        }
        	        if(isset($package_details->package_type)){
        	        $postArray['package_type']=$package_details->package_type;
        	        }else{
        	            $postArray['package_type']='1';
        	        }
        	        
        	        if(isset($package_details->user_id)){
        	        $transaction_details['user_id']=$package_details->package_type;
        	        }else{
        	            $transaction_details['user_id']='1';
        	        }
        	        
        	        foreach($package_details as $value){
        	            $udf9_value =explode(":",$value);
        	            if(is_array($udf9_value) && !empty($udf9_value[0]) && !empty($udf9_value[1])){
        	            $transaction_details[trim($udf9_value[0])]=trim($udf9_value[1]);
        	            }
        	        }
        	        
        	        $transaction_details['descr']=$_POST['desc'];
        	        $transaction_details['payment_response']=json_encode($_POST);
        	        $transaction_details['mmp_txn']=$_POST['mmp_txn'];
        	        $transaction_details['mer_txn']=$_POST['mer_txn'];
        	        $transaction_details['amt']=$_POST['amt'];
        	        $transaction_details['prod']=$_POST['prod'];
        	        $transaction_details['bank_txn']=$_POST['bank_txn'];
        	        $transaction_details['f_code']=$_POST['f_code'];
        	        $transaction_details['clientcode']=$_POST['clientcode'];
        	        $transaction_details['bank_name']=$_POST['bank_name'];
        	        $transaction_details['merchant_id']=$_POST['merchant_id'];
        	        $transaction_details['date']=$_POST['date'];
        	        $transaction_details['discriminator']=$_POST['discriminator'];
        	        $transaction_details['udf9']=$_POST['udf9'];
        	        
        	        if ($postArray['f_code'] == "Ok"){ $postArray['status']=1;$transaction_details['status']=1; }
        	        else if ($postArray['f_code'] == "C"){ $postArray['status']=2;$transaction_details['status']=2; }
        	        else{ $postArray['status']=3;$transaction_details['status']=3; }
        	        
        	        $transaction_id=$this->Account_details->insert_transaction($transaction_details);
    	        
            	       if ($postArray['f_code'] == "Ok"){
            	            $result_package_details=$this->Account_details->get_package_details($transaction_details['package_type'],$transaction_details['package_id']);
            	            if($transaction_details['package_type'] == 1){
                	                if($result_package_details[0]['Validity']=='30 Days'){
                	                    $pack_validity="first day of +1 months";
                    	            }else{
                    	                $pack_validity="first day of +".$result_package_details[0]['Validity'];
                    	            }
            	            }else{
            	                if($result_package_details[0]['Validity']=='30 Days'){
                	                    $pack_validity=" +1 months";
                    	            }else{
                    	                $pack_validity=" +".$result_package_details[0]['Validity'];
                    	            }
            	            }
            	            
            	            $Due_date= date('Y-m-d', strtotime($pack_validity));
            	            $postArray['status']=1;
            	            $payment_details['user_id']=$transaction_details['user_id'];
            	            $payment_details['Type']='Online';
            	            $payment_details['Package_type']=$transaction_details['package_type'];
            	            $payment_details['Package_id']=$transaction_details['package_id'];
            	            $payment_details['Amount']=$_POST['amt'];
            	            $payment_details['Due_date']=$Due_date;
            	            $payment_details['Status']=1;
            	            $payment_details['payment_response']=json_encode($_POST);
            	            $payment_details['transaction_id']=$transaction_id;
            	            
            	            $this->Account_details->insert_payment($payment_details);
            	            $customer_details = array('user_id'=>$transaction_details['user_id'],'due_date'=>$Due_date);
            	            
            	            if($transaction_details['package_type'] == 1){
            	            $update_due_date_details = $this->Account_details->update_due_date_broadband($customer_details);
            	            }else{
            	            $update_due_date_details = $this->Account_details->update_due_date_cable($customer_details);
            	            }
            	            $data['Account_details']=$this->Account_details->get_user_details($transaction_details['user_id']);
            	            $subject='Payment Successfull';
                            $message='<table cellpadding="5" border="1" style="border-collapse:collapse;width:100%;max-width:600px;margin:10px auto;"><tr><th colspan="2" style="background: #0093de;color: #fff;">Payment Details</th></tr>
                            <tr><td>Name</td><td>'.$data['Account_details'][0]['full_name'].'</td></tr>
                            <tr><td>User Name</td><td>'.$transaction_details['user_id'].'</td></tr>
                            <tr><td>Amount</td><td>'.$postArray['amt'].'</td></tr>
                            <tr><td>Transaction Ref. no.</td><td>'.$postArray['mer_txn'].'</td></tr>
                            <tr><td>Transaction ID</td><td>'.$postArray['mmp_txn'].'</td></tr>
                            <tr><td>Transaction details</td><td>'.$postArray['descr'].'</td></tr>
                            <tr><td>Date</td><td>'.$postArray['date'].'</td></tr>
                            </table>';
            	            $this->Mailsend->send_mail('info@worldvisioncable.in','rjkumar856@gmail.com',$subject,$message);
            	      }
            	        
    	        $this->load->view('payment_success_page');
    	    }else{
    	        redirect(base_url()."my-package");
    	    }
	}
	
	public function view_bill(){
	    if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		$data['get_post_payments']=$this->Account_details->get_post_payments($session_user_data['id']);
    		
    		$this->load->view('view_bill_page', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function my_complaint(){
	    if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		$this->load->view('complaint_page', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function view_complaint(){
	    if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		$data['get_post_complaint']=$this->Account_details->get_post_complaint($session_user_data['id']);
    		
    		$this->load->view('view_complaints', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function complaint_submission(){
	    if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		
    		     $this->form_validation->set_rules('user_complaintNature', 'Nature Of Complaint', 'trim|required|xss_clean');
                 $this->form_validation->set_rules('user_technician', 'Technician', 'trim|xss_clean');
                 $this->form_validation->set_rules('user_description', 'Description', 'trim|xss_clean|required|min_length[6]');
                 
                 $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');
        
                 if ($this->form_validation->run() == FALSE) {
                 $this->load->view('complaint_page', $data);
                 return false;
                 }
                 
                 $customer_details = array('user_id'=>$session_user_data['id'],'name' => $data['Account_details'][0]['full_name'],'email' => $data['Account_details'][0]['email'],'phone' => $data['Account_details'][0]['phone'],'nature_of_complaint'=> $this->input->post('user_complaintNature'),
                 'technician'=> $this->input->post('user_technician'),'description'=> $this->input->post('user_description'),'complaint_status'=>'Pending','status'=>'1');
                 
                 $complaint_submission_details = $this->Account_details->post_complaint_submission($customer_details);
            
                 if ($complaint_submission_details){
                   $this->session->set_flashdata('message', 'Your Complaint has been Posted Successfully!');
                   $this->data['message'] = $this->session->flashdata('message');
                   redirect(base_url()."my-complaint");
                }else{
                       $this->session->set_flashdata('message', 'Some Error Occured. Try some other times!');
                        $this->data['message'] = $this->session->flashdata('message');
                        $this->load->view('complaint_page', $data);
                        return false;
             }
             
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function change_password(){
		if(isset($this->session->userdata['logged_in'])){
		    $session_user_data=$this->session->userdata['logged_in'];
    		$data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
    		$this->load->view('chage_password', $data);
        }else{
            redirect(base_url()."login");
        }
	}
	
	public function change_password_submission(){
	    if(isset($this->session->userdata['logged_in'])){
	        $this->load->model('login_form');
		    $session_user_data=$this->session->userdata['logged_in'];
		    $data['Account_details']=$this->Account_details->get_user_details($session_user_data['id']);
	    
	     $this->form_validation->set_rules('old_user_password', 'Old password', 'trim|required|xss_clean');
         $this->form_validation->set_rules('new_user_password', 'New password', 'trim|xss_clean|required|min_length[6]|matches[confirm_user_password]');
         $this->form_validation->set_rules('confirm_user_password', 'Confirm password', 'trim|xss_clean');
         
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');

         if ($this->form_validation->run() == FALSE) {
         $this->load->view('chage_password', $data);
         return false;
         }
         
         $customer_details = array(
         'id'=>$session_user_data['id'],
         'userid' => $session_user_data['userid'],
         'user_password'=> $this->input->post('new_user_password'),
         'user_old_password'=> $this->input->post('old_user_password'),
      );
         
         $password_details = $this->login_form->check_login($session_user_data['userid']);
         if ($password_details && is_array($password_details)){
             
             if($password_details[0]['password'] === md5($customer_details['user_old_password'])){
                 
                 $change_password_details = $this->Account_details->change_user_password($customer_details);
                 if ($change_password_details){
                   $this->session->set_flashdata('message', 'Your password has been changed Successfully!');
                   $this->data['message'] = $this->session->flashdata('message');
                   redirect(base_url()."change-password");
                }else{
                       $this->session->set_flashdata('message', 'You have entered Wrong Old Password');
                        $this->data['message'] = $this->session->flashdata('message');
                        $this->load->view('chage_password', $data);
                        return false;
             }
                 
             }else{
                       $this->session->set_flashdata('message', 'You have entered Wrong Old Password');
                        $this->data['message'] = $this->session->flashdata('message');
                        $this->load->view('chage_password', $data);
                        return false;
                        }
         }
        
	    }else{
            redirect(base_url()."change-password");
        }
	}
	
	public function payment_url($url,$param){
	                $port = 443;
	                $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_PORT, $port);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                    $returnData = curl_exec($ch);
                    // Check if any error occured
                    if (curl_errno($ch)) {
                        return 'Curl error: ' . curl_error($ch);
                    }
                    curl_close($ch);
                    $xmlObj = new SimpleXMLElement($returnData);
                    $final_url = $xmlObj->MERCHANT->RESPONSE->url;
                    // eof code to generate token
                    // code to generate form action
                    $param = "";
                    $param .= "ttype=NBFundTransfer";
                    $param .= "&tempTxnId=" . $xmlObj->MERCHANT->RESPONSE->param[1];
                    $param .= "&token=" . $xmlObj->MERCHANT->RESPONSE->param[2];
                    $param .= "&txnStage=1";
                    $final_url = $url . "?" . $param;
                    return $final_url;
	}
	
}