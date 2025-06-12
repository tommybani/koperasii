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
		echo 'hy';
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/c_anggota/Dashboard.php */