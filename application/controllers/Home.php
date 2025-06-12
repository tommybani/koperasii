<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_home');
	}

	public function index()
	{
		$data['content'] = 'home/home';
		$data['js']	= 'home/home_js';
		$data['anggota'] = $this->db->get_where('anggota',array('anggota_id' => $this->session->userdata('user_id')))->row_array();
		$data['img'] = 'assets/user.jpg';
		if ($data['anggota']['anggota_foto'] != '') {
			$data['img'] = 'assets/anggota/'.$data['anggota']['anggota_foto'];
		}
		$data['dt_simpanan'] = $this->M_home->simpanan();
		$text = "SELECT anggota_no,tgl,id_jenis,jumlah,'simpan' as ket FROM simpanan
					WHERE anggota_no='".$this->session->userdata('username')."'
					UNION
					SELECT anggota_no,tgl,id_jenis,jumlah,'ambil' as ket FROM `pengambilan`
					WHERE anggota_no='".$this->session->userdata('username')."'
					ORDER BY tgl";

		$pinjam = "SELECT a.id_pinjam,a.tgl,a.anggota_no,a.jumlah,a.lama,a.bunga,					
					b.anggota_nama,b.anggota_jk,b.anggota_no_identitas
					FROM pinjaman_header as a
					JOIN anggota as b
					ON a.anggota_no=b.anggota_no
					WHERE a.anggota_no='".$this->session->userdata('username')."'
					GROUP BY a.id_pinjam";

		$data['detail'] = $this->db->query($text);
		$data['pinjaman'] = $this->db->query($pinjam);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit;
		$this->load->view('template/main',$data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */