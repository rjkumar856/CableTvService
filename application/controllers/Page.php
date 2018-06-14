<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

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
	}
	public function about()
	{
		$this->load->view('about_page');
	}
	
	public function contact()
	{
		$this->load->view('contact_page');
	}
	
	public function internet_packs()
	{
	    $this->load->model('All_page');	
		$data['internet_packages']=$this->All_page->GetAllPacksByNetworkType();
		$this->load->view('internet_packs_page', $data);
	}
	
	public function cable_pack()
	{
	    $this->load->model('All_page');	
		$data['internet_packages']=$this->All_page->GetAllPacksByNetworkType();
		$data['cable_packages']=$this->All_page->GetCablePacks();
		$data['channel_list']=$this->All_page->GetCableChannelsbyType();
		
		$this->load->view('cable_packs_page', $data);
	}
}
