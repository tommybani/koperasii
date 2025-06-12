<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	var $user = 'user';

	function GetData($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get($this->user);
	}

}

/* End of file M_login.php */
/* Location: ./application/models/M_login.php */