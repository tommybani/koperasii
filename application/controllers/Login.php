<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index(){
		$this->load->view('login');
	}
	public function login_action(){
		if (isset($_POST['masuk'])) {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$data = $this->M_login->GetData($username,$password);
			if ($data->num_rows() > 0) {
				$array = array(
					'user_id' => $data->row()->user_id,
					'username' => $data->row()->username,
					'nama' => $data->row()->nama,
					'level' => $data->row()->level,
					'foto' => $data->row()->foto,
				);
				$this->session->set_userdata($array);
				redirect(base_url('dashboard'));
			}else{

				$q_cek_login = $this->db->get_where('anggota', array('anggota_no' => $username, 'anggota_password' => $password));
				if(count($q_cek_login->result())>0)
				{

					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'yesGetMeLoginAnggota';
						$sess_data['user_id'] = $qad->anggota_id;
						$sess_data['username'] = $qad->anggota_no;
						$sess_data['nama'] = $qad->anggota_nama;
						$sess_data['level'] = 'anggota';
						$sess_data['foto'] = $qad->anggota_foto;
						$this->session->set_userdata($sess_data);
					}
					redirect('home');

				}else{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
	                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                  Periksa Kembali Username/Password Anda</div>');
					redirect(base_url());
				}


				
			}
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url());
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */