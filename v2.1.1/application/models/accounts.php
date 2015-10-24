<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Model {
	
	var $user_id;
	var $mobNum;
	var $balance	= 0;
	var $reg_time;
	var $status;
	var $user_role;
	
	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->library('encrypt');
	}// end of constructor
	
	public function getUserInfo($userId){
		$this->db->select('mobNum, balance, reg_time, status, user_role');
		$this->db->from('user');
		$this->db->where('user_id', $userId);
		
		$query = $this->db->get();
		
		foreach ($query->result() as $row) {
			$this->user_id = $userId;
			$this->mobNum = $row->mobNum;
			$this->balance = $row->balance;
			$this->reg_time = $row->reg_time;
			$this->status = $row->status;
			$this->user_role = $row->user_role;
		}
	}
	
	public function checkBalPIN($balPin) {
		$this->db->select('recharge_denomination, recharge_by');
		$this->db->from('embank_recharge');
		$this->db->where('recharge_pin', $balPin);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			foreach ($query->result() as $row) {
				if($row->recharge_by == 'false') {
					$this->load->helper('date');
					$updateData = array(
								   'recharge_by' => $this->getMobNum(),
								   'recharge_date' => mdate("%Y-%m-%d %h:%i:%s",now())
								);
					
					$this->db->where('recharge_pin', $balPin);
					$this->db->update('embank_recharge', $updateData);
					
					$this->updateBalance($row->recharge_denomination);
					return $row->recharge_denomination;
				} else {
					return false;	
				}
			}
		} else {
			return false;
		}
	}
	
	public function trfBalanceToAcc($receiver, $amount) {
		$this->db->select('balance');
		$this->db->from('user');
		$this->db->where('mobNum', $receiver);
		
		$query = $this->db->get();
		
		foreach ($query->result() as $row) {
			$updateData = array(
						   'balance' => ($row->balance + $amount)
						);
			
			$this->db->where('mobNum', $receiver);
			$this->db->update('user', $updateData);
			
			$this->updateBalance($amount,'-');
			return;
		}
	}
	
	public function trfBalanceToNum($amount) {
		$this->updateBalance($amount,'-');
		return;
	}
	
	private function updateBalance($bal, $operator = '+') {
		if($operator == '+') {
			$updateData = array(
					   'balance' => ($this->getBalance() + $bal)
					);
		} else if($operator == '-') {
			$updateData = array(
					   'balance' => ($this->getBalance() - $bal)
					);
		}
		
		$this->db->where('mobNum', $this->getMobNum());
		$this->db->update('user', $updateData);
	}
	
	public function getUserId() {
		return $this->user_id;
	}
	public function getMobNum() {
		return $this->mobNum;
	}
	public function getBalance() {
		return $this->balance;
	}
	public function getRegTime() {
		return $this->reg_time;
	}
	public function getStatus() {
		return $this->status;
	}
	public function getUserRole() {
		return $this->user_role;
	}
	
}