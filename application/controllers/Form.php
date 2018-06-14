<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

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
		$this->load->library('email');
		$this->load->database();
		$this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('post_form');
        $this->load->model('Mailsend');
        $this->load->library('details');
	}
	
	public function contact(){
	    $this->form_validation->set_rules('inquiry_name', 'Full Name', 'trim|required|xss_clean');
         $this->form_validation->set_rules('inquiry_email', 'Email ID', 'trim|xss_clean|required|valid_email');
         $this->form_validation->set_rules('inquiry_phone', 'Mobile Number', 'trim|xss_clean|required');
         $this->form_validation->set_rules('inquiry_address', 'Address', 'trim|required|xss_clean|min_length[4]');
         $this->form_validation->set_rules('inquiry_city', 'City', 'trim|xss_clean|required|alpha_numeric_spaces');
         $this->form_validation->set_rules('inquiry_message', 'Your Query', 'trim|xss_clean|required|min_length[4]');
         
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');

         if ($this->form_validation->run() == FALSE) {
         $this->load->view('contact_page', $this->data);
         return false;
         }
         
         $customer_details = array(
         'name'   => $this->input->post('inquiry_name'),
         'email'      => $this->input->post('inquiry_email'),
         'phone'      => $this->input->post('inquiry_phone'),
         'address'  => $this->input->post('inquiry_address'),
         'city'   => $this->input->post('inquiry_city'),
         'message'  => $this->input->post('inquiry_message'),
         'ip'=>$this->details->getClientIP(),
         'status'  => "1"
      );
      
        $contact_details = $this->post_form->insert_contact($customer_details);
        if ($contact_details){
           $this->session->set_flashdata('message', 'Your Inquiry submitted Successfully!');
           $this->data['message'] = $this->session->flashdata('message');
           
           $subject='New Contact Form Submitted';
           $message='<table cellpadding="5" border="1" style="border-collapse:collapse;width:100%;max-width:600px;margin:10px auto;"><tr><th colspan="2" style="background: #0093de;color: #fff;">NEW ENQUIRY</th></tr><tr><td>Name</td><td>'.$customer_details['name'].'</td></tr><tr><td>Email</td><td>'.$customer_details['email'].'</td></tr><tr><td>Phone</td><td>'.$customer_details['phone'].'</td></tr><tr><td>Address</td><td>'.$customer_details['address'].'</td></tr><tr><td>City</td><td>'.$customer_details['city'].'</td></tr><tr><td>Message</td><td>'.$customer_details['message'].'</td></tr></table>';
           $this->Mailsend->send_mail('info@worldvisioncable.in','info@worldvisioncable.in',$subject,$message);
           redirect(base_url().'contact-us');
    }
		
	}
	
	public function contacthome(){
	     header('Content-type: application/json');
	     $this->form_validation->set_rules('inquiry_name', 'Full Name', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_email', 'Email ID', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_phone', 'Mobile Number', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_city', 'City', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_message', 'Your Query', 'trim|xss_clean');
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');
         
         if ($this->form_validation->run() == FALSE) {
         $this->load->view('contact_page', $this->data);
         echo json_encode(array("code"=>'201',"status1"=>"error","message"=>$this->data['message_error']));
         return true;
         }
         
         $customer_details = array(
         'name'   => $this->input->post('inquiry_name'),
         'email'      => $this->input->post('inquiry_email'),
         'phone'      => $this->input->post('inquiry_phone'),
         'address'  => '',
         'city'   => $this->input->post('inquiry_city'),
         'message'  => $this->input->post('inquiry_message'),
         'ip'=>$this->details->getClientIP(),
         'status'  => "1"
      );
      
        $contact_details = $this->post_form->insert_contact($customer_details);
            if ($contact_details){
               $subject='New Contact Form Submitted';
               $message='<table cellpadding="5" border="1" style="border-collapse:collapse;width:100%;max-width:600px;margin:10px auto;"><tr><th colspan="2" style="background: #0093de;color: #fff;">NEW ENQUIRY</th></tr><tr><td>Name</td><td>'.$customer_details['name'].'</td></tr><tr><td>Email</td><td>'.$customer_details['email'].'</td></tr><tr><td>Phone</td><td>'.$customer_details['phone'].'</td></tr><tr><td>City</td><td>'.$customer_details['city'].'</td></tr><tr><td>Message</td><td>'.$customer_details['message'].'</td></tr></table>';
              $this->Mailsend->send_mail('info@worldvisioncable.in','info@worldvisioncable.in',$subject,$message);
               echo json_encode(array("code"=>'200',"status1"=>"success","message"=>'Your Inquiry submitted Successfully!'));
               return true;
               redirect(base_url().'contact-us');
                }else{
                    echo json_encode(array("code"=>'202',"status1"=>"error","message"=>$this->data['message_error']));
                    return true;
                }
		
	}
	
	
	public function newconnection(){
	    header('Content-type: application/json');
	     $this->form_validation->set_rules('inquiry_name', 'Full Name', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_email', 'Email ID', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_phone', 'Mobile Number', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_address', 'Address', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_service', 'Services', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_pincode', 'Pincode', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_city', 'City', 'trim|xss_clean');
         $this->form_validation->set_rules('inquiry_message', 'Your Query', 'trim|xss_clean');
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');
         
         if ($this->form_validation->run() == FALSE) {
         $this->load->view('contact_page', $this->data);
         echo json_encode(array("code"=>'201',"status1"=>"error","message"=>$this->data['message_error']));
         return true;
         }
         
         $customer_details = array(
         'name'   => $this->input->post('inquiry_name'),
         'email'      => $this->input->post('inquiry_email'),
         'phone'      => $this->input->post('inquiry_phone'),
         'service'  => $this->input->post('inquiry_service'),
         'pincode'  => $this->input->post('inquiry_pincode'),
         'address'  => $this->input->post('inquiry_address'),
         'city'   => $this->input->post('inquiry_city'),
         'message'  => $this->input->post('inquiry_message'),
         'ip'=>$this->details->getClientIP(),
         'status'  => "1"
      );
      
            $contact_details = $this->post_form->insert_newconnection($customer_details);
            $new_connection = $this->post_form->insert_newNotification(array('title'=>'New Connection Request', 'type'=>$customer_details['service'],'status'=>'2'));
            
            if ($contact_details){
               $subject='New Connection Request Submitted';
               $message='<table cellpadding="5" border="1" style="border-collapse:collapse;width:100%;max-width:600px;margin:10px auto;"><tr><th colspan="2" style="background: #0093de;color: #fff;">NEW ENQUIRY</th></tr><tr><td>Name</td><td>'.$customer_details['name'].'</td></tr><tr><td>Email</td><td>'.$customer_details['email'].'</td></tr><tr><td>Phone</td><td>'.$customer_details['phone'].'</td></tr><tr><td>service</td><td>'.$customer_details['service'].'</td></tr><tr><td>pincode</td><td>'.$customer_details['pincode'].'</td></tr><tr><td>Address</td><td>'.$customer_details['address'].'</td></tr><tr><td>City</td><td>'.$customer_details['city'].'</td></tr><tr><td>Message</td><td>'.$customer_details['message'].'</td></tr></table>';
               $this->Mailsend->send_mail('info@worldvisioncable.in','info@worldvisioncable.in',$subject,$message);
               echo json_encode(array("code"=>'200',"status1"=>"success","message"=>'Your Inquiry submitted Successfully!'));
               return true;
               redirect(base_url().'contact-us');
                }else{
                    echo json_encode(array("code"=>'202',"status1"=>"error","message"=>$this->data['message_error']));
                    return true;
                }
		
	}
	
	
	
    public function send_mail($from='info@worldvisioncable.in',$to='info@worldvisioncable.in',$subject='Test Mail from World Vision Cable',$message='',$cc='info@worldvisioncable.in',$bcc=''){
        $mail_subject = $subject;
	    $message_html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <style type="text/css">
                        html, body {margin: 0; padding: 0; outline: 0; font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: normal; width:100%; height:100%; }
                        body{min-width:320px; margin:0; padding:0; background:#fff;}
                        *, *:before, *:after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
                        .main { width:100%; margin:0; padding:0; display:block; position:relative; }
                        .main-center {background: #f6f6f6; width:100%; max-width:800px; margin:0 auto; display:block; }
                        .center { width:100%; max-width:650px; margin:0 auto; display:block; padding-top:0px; }
                        </style>
                        </head>
                        <body class="background">
                        <div class="main">
                        <div class="main-center">
                        <div class="center">
                        <table style="border: 0px solid #ccc" border="0" cellpadding="0" cellspacing="0" align="center" width="600" bgcolor="#FFFFFF">
                        <tbody>
                        <tr>
                            <td width="500" height="80" align="left" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px">
                            <span style="font-size: 0; line-height: 0"><a href="https://www.worldvisioncable.in" target="_blank" rel="noreferrer"><img src="https://www.worldvisioncable.in/assets/images/logo.png" width="200" border="0"></a></span>
                            </td>
                        
                            <td width="100" align="right" bgcolor="#FFFFFF" class="m_-8518122674246736728responsive-image" style="font-size: 0; line-height: 0; padding: 0 10px">
                            <span style="font-size: 0; line-height: 0"><a href="https://play.google.com/store/apps/details?id=in.webliststore" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-andriod.png" width="22" height="24" border="0"></a></span>
                            </td>
                        
                            <td width="25" align="right" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px 0 0"><a href="https://itunes.apple.com/us/app/weblist-store-classified-and-online-shopping/id1256935760?ls=1&mt=8" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-ios.png" width="22" height="24" border="0"></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" bgcolor="#0093de" style="padding: 30px; font-size: 16px;font-weight: bold; text-align: center; color: #fff"><span style="color:#fff;">Weblist Store! </span> Now Sell, Buy, List and shop in the Best Way</td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 30px 20px 10px; font-size: 14px">
                            <div>'.$message.'</div>
                            <br><br>
                            <div>Grow your business online. Grow your business with <a href="https://www.worldvisioncable.in" style="color:#de1d3c;"><b>World Vision Cable</b></a>.</div>
                            <br></td>
                        </tr>
                        <tr><td colspan="4" style="padding: 20px; font-size: 14px"><div style="font-size: 14px"> <span>Regards,</span></div>
                            <div style="font-size: 14px; padding-top: 10px"> <span>Team World Vision Cable</span> </div></td>
                        </tr>
                        <tr>
                        <td colspan="4" style="padding: 10px 20px; font-size: 14px;background: #0093de;color:#fff;font-size: 10px;">
                        <p>The information contained in this e-mail is private & confidential and may also be legally privileged. If you are not the intended recipient of this mail, please notify us, preferably by e-mail; and do not read, copy or disclose the contents of this message to anyone. Whilst we have taken reasonable precautions to ensure that any attachment to this e-mail has been swept for viruses, e-mail communications cannot be guaranteed to be secure or error free, as information can be corrupted, intercepted, lost or contain viruses. We do not accept liability for such matter or their consequences.</p>
                        </td></tr>
                        <tr>
                            <td colspan="4" bgcolor="#5b5b5b" style="padding: 0; text-align: center">
                            <a href="https://www.webliststore.in/support-app"><img src="https://www.webliststore.in/image/app-download-mail.jpg" alt="app-download" border="0" usemap="#m_-8518122674246736728_Map"></a>
                            </td>
                        </tr></tbody></table></div></div></div></body></html>';
	    
        	    $config['protocol']    = 'sendmail';
                $config['mailpath']    = '/usr/sbin/sendmail';
                //$config['smtp_timeout'] = '5'; 
                $config['charset']    = 'utf-8';
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE;
      
              $config['wordwrap'] = TRUE;
              $config['smtp_host'] = 'mail.webliststore.in';
              $config['smtp_port'] = '465';
              $config['smtp_user'] = 'form@webliststore.in';
              $config['smtp_pass'] = 'weblist@123';

      $this->email->initialize($config);
     
      $this->email->to($to);
      if(isset($bcc)){$this->email->bcc($bcc);}
      $this->email->cc($cc);
      //$this->phpmailer->IsMail();
      $this->email->from($from);
      //$this->email->IsHTML(true);
      $this->email->subject($mail_subject);
      $this->email->message($message_html);
      if($this->email->Send()) {
        return '1';
      }
      else {
        return '0';
      }
    }

}
