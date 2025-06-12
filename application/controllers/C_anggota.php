<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_anggota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('MC_anggota');
	}
	public function index()
	{
		
	}

}

/* End of file C_anggota.php */
/* Location: ./application/controllers/C_anggota.php */