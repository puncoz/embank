<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');
		
		$this->load->model('user');
		$this->load->model('accounts');
	}// end of constructor
	
	public function index() {
		if( ! $this->user->isLoggedIn()) {
			redirect('index.php/users/login/');
		}
		
		$data['page'] = 'account_main';
		$data['page_title'] = 'Account || emBank';
		$data['loggedIn'] = true;
		$data['mobNum'] = $this->accounts->getMobNum();
		$data['balance'] = $this->accounts->getBalance();
		$data['user_role'] = $this->accounts->getUserRole();
		
		$this->load->view('body/acc_page', $data);
	}
	
	public function deposit() {
		if( ! $this->user->isLoggedIn()) {
			redirect('index.php/users/login/');
		}
		
		$data['page'] = 'account_deposit';
		$data['page_title'] = 'Deposit Balance || emBank';
		$data['loggedIn'] = true;
		$data['mobNum'] = $this->accounts->getMobNum();
		$data['balance'] = $this->accounts->getBalance();
		$data['user_role'] = $this->accounts->getUserRole();
		
		$msg = $this->session->flashdata('embank_recharge_pin_form_msg');
		$data['msg'] = ($msg) ? $msg : false;
		
		$rules = array(
		   array(
				 'field'   => 'balance_pin', 
				 'label'   => 'Balance PIN Code', 
				 'rules'   => 'required|numeric|exact_length[9]|greater_than[100000000]|less_than[999999999]|xss_clean'
			  )
			);
		$this->form_validation->set_rules($rules);
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('body/acc_deposit', $data);
		} else {
			$balPin = $this->input->post('balance_pin',true);
			$balance = $this->accounts->checkBalPIN($balPin);
			
			if($balPin && $balance !== false) {
				$this->session->set_flashdata('embank_recharge_pin_form_msg', 'Rs. '.$balance.' added successfully.');
				redirect('index.php/account/deposit/');
			} else {
				$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Invalid PIN Number</p></div>';
				$this->load->view('body/acc_deposit', $data);
			}
		}
	}
	
	public function withdraw($option = 1) {
		if( ! $this->user->isLoggedIn()) {
			redirect('index.php/users/login/');
		}
		
		$data['option'] = ($option == 1) ? 'acc' : (($option == 2) ? 'num' : 'acc');
		
		$data['page'] = 'account_withdraw';
		$data['page_title'] = 'Withdraw Balance || emBank';	
		$data['loggedIn'] = true;	
		$data['mobNum'] = $this->accounts->getMobNum();
		$data['balance'] = $this->accounts->getBalance();
		$data['user_role'] = $this->accounts->getUserRole();
		
		$msg = $this->session->flashdata('embank_transfer_balance_acc_form_msg');
		$data['msg'] = ($msg) ? $msg : false;
		
		if($option == 1) {
			$rules = array(
               array(
                     'field'   => 'acc_num', 
                     'label'   => 'Account number', 
                     'rules'   => 'required|numeric|exact_length[10]|greater_than[9800000000]|less_than[9899999999]|xss_clean'
                  )
				);
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('body/acc_withdraw', $data);
			} else {
				$receiver = $this->input->post('acc_num',true);
				$ammount = $this->input->post('amount',true);
				
				if($receiver && $ammount) {
					if($ammount > $data['balance']) {
						$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Insufficient balance</p></div>';
						$this->load->view('body/acc_withdraw', $data);
					} else if($this->user->verifyNewNum($receiver)) {
						$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Invalid account number</p></div>';
						$this->load->view('body/acc_withdraw', $data);
					} else {
						$this->accounts->trfBalanceToAcc($receiver,$ammount);
						$this->session->set_flashdata('embank_transfer_balance_acc_form_msg', 'Rs. '.$ammount.' transfered to Acc. No. '.$receiver.' successfully.');
						redirect('index.php/account/withdraw/1/');
					}
				} else {
					$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Invalid Transfer</p></div>';
					$this->load->view('body/acc_withdraw', $data);
				}
			}
		} else if($option == 2) {
			$rules = array(
               array(
                     'field'   => 'mob_num', 
                     'label'   => 'Mobile number', 
                     'rules'   => 'required|numeric|exact_length[10]|greater_than[9800000000]|less_than[9899999999]|xss_clean'
                  )
				);
			$this->form_validation->set_rules($rules);
			
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('body/acc_withdraw', $data);
			} else {
				$receiver = $this->input->post('mob_num',true);
				$ammount = $this->input->post('amount',true);
				
				if($receiver && $ammount) {
					if($ammount > $data['balance']) {
						$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Insufficient balance</p></div>';
						$this->load->view('body/acc_withdraw', $data);
					} else {
						$this->accounts->trfBalanceToNum($ammount);
						$this->session->set_flashdata('embank_transfer_balance_acc_form_msg', 'Rs. '.$ammount.' transfered to Mobile No. '.$receiver.' successfully.');
						
						$this->load->model('avr');
						
						$this->avr->transferBalance($receiver,$ammount);
					}
				} else {
					$data['custom_error'] = '<div id="error-msg"><a href="#" class="close" onclick="$(\'#error-msg\').hide();">Close X</a><p>Invalid Transfer</p></div>';
					$this->load->view('body/acc_withdraw', $data);
				}
			}
		} else {
			redirect('index.php/account/withdraw/1/');
		}
	}
}