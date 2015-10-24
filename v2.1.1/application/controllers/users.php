<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->load->model('user');
	}// end of constructor
	
	public function index() {
		if($this->user->isLoggedIn()) {
			redirect('index.php/account/');
		}
		redirect('index.php/users/login/');
	}
	
	public function login() {
		if($this->user->isLoggedIn()) {
			redirect('index.php/account/');
		}
		
		$data['page'] = 'login';
		$data['page_title'] = 'Login || emBank';
		$data['loggedIn'] = false;
		
		$rules = array(
               array(
                     'field'   => 'mob_num', 
                     'label'   => 'Mobile number', 
                     'rules'   => 'required|numeric|exact_length[10]|greater_than[9800000000]|less_than[9899999999]|xss_clean'
                  ),
				array(
					'field' => 'passwd',
					'label' => 'Password',
					'rules' => 'required|alpha_numeric|min_length[6]|xss_clean'
				  )
            );
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('body/login_page', $data);
		} else {
			$mobNum = $this->input->post('mob_num',true);
			$password = $this->input->post('passwd',true);
			$user_id = $this->user->checkLogin($mobNum,$password);
			
			if($mobNum && $password && $user_id) {
				$this->user->loginUser($user_id,$mobNum,$password);
				redirect('index.php/users/');
			} else {
				$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Incorrect mobile number or password</p></div>';
				$this->load->view('body/login_page', $data);
			}
		}
	}
	
	public function register($step = 1) {
		if($this->user->isLoggedIn()) {
			redirect('index.php/account/');
		}
		
		if($step == 1) {
			return $this->registerStep1();
		} else if($step == 2) {
			return $this->registerStep2();
		} else if($step == 3) {
			return $this->registerStep3();
		}
	}
	
	public function logout() {
		$this->user->do_logout();
		redirect('index.php/users/login/');
	}
	
	private function registerStep1() {
		$data['page'] = 'register';
		$data['page_title'] = 'Register || emBank';
		$data['loggedIn'] = false;
		$data['step'] = 1;
		
		$rules = array(
               array(
                     'field'   => 'mobile_no', 
                     'label'   => 'Mobile number', 
                     'rules'   => 'required|numeric|exact_length[10]|greater_than[9800000000]|less_than[9899999999]|xss_clean'
                  )
            );
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('body/register_page', $data);
		} else {
			$this->load->model('avr');
			
			$mobNum = $this->input->post('mobile_no',true);
			
			if($mobNum && $this->user->verifyNewNum($mobNum)) {
				$this->avr->sendRegNumSecCode($mobNum);
			} else {
				$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Mobile number "'.$mobNum.'" already registered. Login here</p></div>';
				$this->load->view('body/register_page', $data);
			}
		}
	}
	
	private function registerStep2() {
		$this->load->helper('cookie');
		
		$mobNum = get_cookie('_reg_mob_num');
		get_cookie($mobNum.'_reg_verify_sec_code');
		
		if( ! $this->session->flashdata('embank_mob_reg_token') && ! $this->session->flashdata('embank_user_reg_step_2')) {
			redirect('index.php/users/register/1/');	
		}
		
		$data['page'] = 'register';
		$data['page_title'] = 'Register || emBank';
		$data['loggedIn'] = false;
		$data['step'] = 2;
		
		$rules = array(
               array(
                     'field'   => 'validCode', 
                     'label'   => 'Validation Code', 
                     'rules'   => 'required|alpha_numeric|exact_length[6]|xss_clean'
                  )
            );
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('embank_user_reg_step_2', 'proceed');
			$this->load->view('body/register_page', $data);
		} else {			
			$validCode = $this->input->post('validCode',true);
			$secCode = get_cookie($mobNum.'_reg_verify_sec_code');
			
			if($secCode) {
				if($secCode == $validCode) {
					$this->session->set_flashdata('embank_user_reg_step_2_3', 'proceed');
					$this->input->set_cookie('_reg_mob_num',$mobNum,'150','','','embank_',FALSE);
					redirect('index.php/users/register/3/');	
				} else {
					$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Incorrect validation code.</p></div>';
					$this->session->set_flashdata('embank_user_reg_step_2', 'proceed');
					$this->load->view('body/register_page', $data);
				}
			} else {
				$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Validation code expired. Resend code</p></div>';
				$this->load->view('body/register_page', $data);
			}
		}
	}
	
	private function registerStep3() {
		if( ! $this->session->flashdata('embank_user_reg_step_2_3') && ! $this->session->flashdata('embank_user_reg_step_3')) {
			redirect('index.php/users/register/1/');	
		}
		
		$data['page'] = 'register';
		$data['page_title'] = 'Register || emBank';
		$data['loggedIn'] = false;
		$data['step'] = 3;
		
		$rules = array(
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|alpha_numeric|min_length[6]|matches[re_password]|xss_clean'
                  ),
				array(
					'field' => 're_password',
					'label' => 'Confirm Password',
					'rules' => 'required|alpha_numeric|min_length[6]|matches[password]|xss_clean'
				  )
            );
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('embank_user_reg_step_3', 'proceed');
			$this->load->view('body/register_page', $data);
		} else {	
			$this->load->helper('cookie');
					
			$passwd = $this->input->post('password',true);
			$mobNum = get_cookie('_reg_mob_num');
			
			if($mobNum) {
				$this->user->RegisterUser($mobNum,$passwd);
				redirect('index.php/users/login/');
			} else {
				redirect('index.php/users/register/1/');
			}
		}
	}
	
}