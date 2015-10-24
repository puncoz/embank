<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Model {
	
	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->library('encrypt');
	}// end of constructor
	
	public function verifyNewNum($mobNum) {
		$query = $this->db->get_where('user', array('mobNum' => $mobNum));
		
		return ($query->num_rows() > 0) ? false : true;
	}
	
	public function RegisterUser($mobNum,$passwd) {
		$this->load->helper('date');
		
		$data = array(
			   'user_id' 		=> NULL ,
			   'mobNum'			=> $mobNum ,
			   'user_password'	=> $this->sha512($passwd),
			   'balance'		=> 0,
			   'reg_time'		=> mdate("%Y-%m-%d %h:%i:%s",now()),
			   'status'			=> 'active',
			   'user_role'		=> 'user'
			);

		$this->db->insert('user', $data);
	}
	
	public function checkLogin($mobNum, $passwd) {
		$this->db->select('user_id, user_password, reg_time, status');
		$this->db->from('user');
		$this->db->where('mobNum', $mobNum);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			foreach ($query->result() as $row) {
				if($this->sha512($passwd) == $row->user_password) {
					return $row->user_id;
				} else {
					return false;	
				}
			}
		} else {
			return false;
		}
	}
	
	public function loginUser($user_id,$mobNum, $passwd) {
		$userData = array(
                   'embank_user_id'  			=> $user_id,
                   'embank_user_mob'     		=> $mobNum,
                   'embank_user_pass_string' 	=> $this->encrypt->encode($passwd)
               );

		$this->session->set_userdata($userData);
		return true;
	}
	
	public function isLoggedIn() {
		$user_id = $this->session->userdata('embank_user_id');
		$user_mob = $this->session->userdata('embank_user_mob');
		$passwd = $this->encrypt->decode($this->session->userdata('embank_user_pass_string'));
		
		// Check if all session variables are set
		if($user_id !== FALSE && $user_mob !== FALSE && $passwd !== FALSE) {
			$this->checkLogin($user_mob, $passwd);
			$this->load->model('accounts');
			$this->accounts->getUserInfo($user_id);
			return true;
		} else {
			return false;
		}
	}
	
	public function do_logout() {
		$userData = array(
                   'embank_user_id'  			=> '',
                   'embank_user_mob'     		=> '',
                   'embank_user_pass_string' 	=> ''
               );
				
		// unset the session
		$this->session->unset_userdata($userData);
	}
	
	/**
	 * Generate an SHA512 Hash
	 *
	 * @access	public
	 * @param	string 	$str
	 * @param	bool	$raw_output	When set to TRUE, outputs raw binary data. Default value (FALSE) outputs lowercase hexits.
	 * @return	string
	 */
	private function sha512($str = '', $raw_output = FALSE) {
		if ( ! function_exists('hash')) {
			return $ $this->encrypt->hash($str);
		} else {
			return hash('sha512', $str, $raw_output);
		}
	}
	
	// --------------------------------------------------------------------
	
}