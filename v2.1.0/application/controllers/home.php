<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}// end of constructor
	
	public function index() {
		$data['page'] = 'home';
		$data['page_title'] = 'emBank || Online Payment Gateway System';
		$data['loggedIn'] = false;
		
		$this->load->view('body/home_page',$data);
	}
	
}