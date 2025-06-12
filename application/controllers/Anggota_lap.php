<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_lap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_laporananggota');
	}

	public function index()
	{
		$data['content']	= 'anggota_laporan/anggota_lap';
		$this->load->view('template/main',$data);
	}

}

/* End of file Anggota_lap.php */
/* Location: ./application/controllers/Anggota_lap.php */