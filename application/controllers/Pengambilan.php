<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengambilan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_pengambilan');
	}

	public function index()
	{
		$data['s']			= $this->M_pengambilan->view();
		$data['content'] 	= 'pengambilan/pengambilan_v';
		$data['js']			= 'pengambilan/pengambilan_js';
		$this->load->view('template/main',$data);
	}
	public function add(){
		$data['content'] 		= 'pengambilan/pengambilan_add';
		$data['js']				= 'pengambilan/pengambilan_add_js';
		$this->load->view('template/main',$data);
	}
	public function add_action(){
		$i = $this->input;
		$jumlah = preg_replace("/[^0-9]/", "", $i->post('jumlah'));

		if ($jumlah > Saldo($i->post('anggota_no')) ) {
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Saldo Tidak Mencukupi</div>');
			redirect(base_url('pengambilan/add'));
		}

		$data = array(
			'jumlah' 	=> $jumlah,
			'user_id'	=> $this->session->userdata('user_id'),
			'tglinsert' => date('Y-m-d H:i:s'),
			'tgl' 		=> $i->post('tgl'),
			'anggota_no'=> $i->post('anggota_no'),
			'id_jenis'	=> $i->post('id_jenis')
		);
		$this->M_pengambilan->insert($data);
		$this->session->set_flashdata('message','<div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Penarikan Dana Berhasil</div>');
		redirect(base_url('pengambilan'));
	}
	public function cetak($id){

		$d['nomor'] = $id;
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$text = "SELECT a.id_ambil,a.anggota_no,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan,
					c.anggota_nama,c.anggota_no_identitas,c.anggota_alamat
					FROM pengambilan as a
					JOIN jenis_simpan as b
					JOIN anggota as c
					ON a.id_jenis=b.id_jenis AND a.anggota_no=c.anggota_no
					WHERE a.id_ambil='$id'";

		$hasil = $this->db->query($text);
		$row = $hasil->num_rows();
		if($row>0){
			foreach($hasil->result() as $db)
			{
				$d['tgl'] = $db->tgl;
				$d['identitas'] = $db->anggota_no_identitas;
				$d['noanggota'] = $db->anggota_no;
				$d['nama'] = $db->anggota_nama;
				$d['alamat'] = $db->anggota_alamat; 
				$d['jenis'] = $db->jenis_simpanan;
				$d['jumlah'] = number_format($db->jumlah);
				$d['terbilang'] = $this->M_pengambilan->terbilang($db->jumlah,4);
			}
		}
		$this->load->view('cetak-terima',$d);

	}

}

/* End of file Pengambilan.php */
/* Location: ./application/controllers/Pengambilan.php */