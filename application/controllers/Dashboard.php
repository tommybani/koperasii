<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
	}

	public function index()
	{
		$data['judul'] = $this->config->item('judul');
		$data['title'] = 'Dashboard';
		$data['content'] = 'dashboard';
		$this->load->view('template/main',$data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */