<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		// $data['s']			= $this->M_simpanan->view();
		$data['content'] 	= 'pengaturan/pengaturan_v';
		// $data['js']			= 'simpanan/simpanan_js';
		$this->load->view('template/main',$data);
	}

}

/* End of file Pengaturan.php */
/* Location: ./application/controllers/Pengaturan.php */