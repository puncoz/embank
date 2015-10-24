<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class avr extends CI_Model {
	
	public function __construct(){
		$this->load->library('session');
	}// end of constructor
	
	public function sendRegNumSecCode($mobNum) {
		$secCode = bin2hex(openssl_random_pseudo_bytes(3));
		
		$this->load->helper('cookie');
		
		$cookie = array(
			'name'   => '_reg_mob_num',
			'value'  => $mobNum,
			'expire' => '150',
			'domain' => '',
			'path'   => '',
			'prefix' => 'embank_',
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);
		
		$cookie = array(
			'name'   => $mobNum.'_reg_verify_sec_code',
			'value'  => $secCode,
			'expire' => '100',
			'domain' => '',
			'path'   => '',
			'prefix' => 'embank_',
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);
		
		$this->session->set_flashdata('embank_mob_reg_token', $mobNum);
		
		$data['page'] = 'register';
		$data['page_title'] = 'Connecting to AVR...';
		$data['loggedIn'] = false;
		$data['mobNum'] = $mobNum;
		$data['randCode'] = $secCode;
		
		$this->load->view('avr_request/send_reg_ajax', $data);
	}
	
	public function transferBalance($receiver,$amount) {
		$data['page'] = 'account_withdraw';
		$data['page_title'] = 'Connecting to AVR...';
		$data['loggedIn'] = true;
		
		$data['receiver'] = $receiver;
		$data['ammount'] = $amount;
		
		$this->load->model('accounts');
		$data['balance'] = $this->accounts->getBalance();
		$data['user_role'] = $this->accounts->getUserRole();
		
		$this->load->view('avr_request/transfer_balance', $data);
	}
	
}