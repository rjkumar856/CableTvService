<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->library('details');
        $this->load->helper('security');
        $this->load->model('login_form');
	}

    public function page(){
        if(isset($this->session->userdata['logged_in'])){
		redirect(base_url()."my-account");
        }else{
            $this->load->view('login_page');
        }
	}
	
	public function submission_page(){
	     $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
         $this->form_validation->set_rules('user_password', 'Password', 'trim|xss_clean|required');
         
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');

         if ($this->form_validation->run() == FALSE) {
         $this->load->view('login_page');
         return false;
         }
         
         $customer_details = array(
         'user_name'   => $this->input->post('user_name'),
         'user_password'=> $this->input->post('user_password')
      );
        
        $login_details = $this->login_form->check_login($customer_details['user_name']);

        if ($login_details && is_array($login_details)){
            
                    if($login_details[0]['password'] == md5($customer_details['user_password'])){
                        
                        if($login_details[0]['UserStatus'] == '1'){
                            
                            $logged_details = $this->login_form->inserLoggedDetails(array("user_id"=>$login_details[0]['UserID'],"ip"=>$this->details->getClientIP()));
                            
                        $this->session->set_flashdata('message', 'You have logged in Successfully!');
                        $this->data['message'] = $this->session->flashdata('message');
                        $session_user_data=array("id"=>$login_details[0]['UserID'],"userid"=>$login_details[0]['userid'],"Name"=>$login_details[0]['full_name'],"email"=>$login_details[0]['email'],"mobile"=>$login_details[0]['phone'],"password"=>$login_details[0]['password']);
                        $this->session->set_userdata('logged_in', $session_user_data);
                        redirect(base_url()."my-account");
                        return true;
                        }else{
                        $this->session->set_flashdata('message', 'User ID is disabled by Admin. Contact admin to Enbale.');
                        $this->data['message'] = $this->session->flashdata('message');
                        $this->load->view('login_page');
                        return false;
                        }
                        
                        }else{
                        $this->session->set_flashdata('message', 'You entered Wrong Password');
                        $this->data['message'] = $this->session->flashdata('message');
                        $this->load->view('login_page');
                        return false;
                    }
            
            }else{
                    $this->session->set_flashdata('message', 'Invalid User Name');
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->load->view('login_page');
                    return false;
            }
		
	}
	
	public function forgot_password(){
	    if(isset($this->session->userdata['logged_in'])){
		redirect(base_url()."my-account");
        }else{
                $this->form_validation->set_rules('user_name', 'User Name/Email', 'trim|required|xss_clean');
                $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');
        
                 if ($this->form_validation->run() == FALSE) {
                 $this->load->view('login/forgot_password_page', $this->data);
                 return false;
                 }
                 
                if($this->input->post('user_name')){
                    $customer_details = array('user_name' => $this->input->post('user_name'),'ip'=>$this->details->getClientIP());
                    $request_details = $this->login_form->post_forgot_password($customer_details);
                            if ($request_details){
                                   $this->session->set_flashdata('message', 'Your Forgot password Request submitted Successfully!');
                                   $this->data['message'] = $this->session->flashdata('message');
                                   redirect(base_url().'forgot_password');
                            }
                }
                
                $this->load->view('login/forgot_password_page',$this->data);
        }
	}
	
	
	public function submission(){
	     header('Content-type: application/json');
	     $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|xss_clean');
         $this->form_validation->set_rules('user_password', 'Password', 'trim|xss_clean|required');
         
         $this->data['message_error'] = ($this->form_validation->run() == False) ? validation_errors() : $this->session->flashdata('message');

         if ($this->form_validation->run() == FALSE) {
         $this->load->view('login_page');
         echo json_encode(array("code"=>'201',"status1"=>"error","message"=>$this->data['message_error']));
         return true;
         }
         
         $customer_details = array(
         'user_name'   => $this->input->post('user_name'),
         'user_password'=> $this->input->post('user_password')
      );
        
        $login_details = $this->login_form->check_login($customer_details['user_name']);

        if ($login_details && is_array($login_details)){
            
                    if($login_details[0]['password'] == md5($customer_details['user_password'])){
                        
                        if($login_details[0]['UserStatus'] == '1'){
                            $logged_details = $this->login_form->inserLoggedDetails(array("user_id"=>$login_details[0]['UserID'],"ip"=>$this->details->getClientIP()));
                        $session_user_data=array("id"=>$login_details[0]['UserID'],"userid"=>$login_details[0]['userid'],"Name"=>$login_details[0]['full_name'],"email"=>$login_details[0]['email'],"mobile"=>$login_details[0]['phone'],"password"=>$login_details[0]['password']);
                        $this->session->set_userdata('logged_in', $session_user_data);
                        echo json_encode(array("code"=>'200',"status1"=>"succes","message"=>'You have logged in Successfully!'));
                        return true;
                        }else{
                        echo json_encode(array("code"=>'202',"status1"=>"error","message"=>'User ID is disabled by Admin. Contact admin to Enbale.'));
                        return true;
                        }
                        
                        }else{
                       echo json_encode(array("code"=>'203',"status1"=>"error","message"=>'You entered Wrong Password'));
                        return true;
                    }
            
            }else{
                    echo json_encode(array("code"=>'204',"status1"=>"error","message"=>'Invalid User Name'));
                    return true;
            }
            
	}
	
	public function logout(){
	    $this->session->unset_userdata('logged_in');
	    redirect(base_url()."login");
	}

}