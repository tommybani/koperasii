<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_simpanan');
	}

	public function index()
	{
		$data['s']			= $this->M_simpanan->view();
		$data['content'] 	= 'simpanan/simpanan_v';
		$data['js']			= 'simpanan/simpanan_js';
		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->load->view('template/main',$data);
	}

	public function add()
	{
		$data['s']			= $this->M_simpanan->view();

		$data['content'] 	= 'simpanan/simpanan_add';
		$data['js']			= 'simpanan/simpanan_add_js';


		$this->load->view('template/main',$data);
	}
	public function GetJumlah(){
		$data['jumlah'] = $this->M_simpanan->GetJumlah($this->input->post('id_jenis'));

		echo json_encode($data);
	}
	public function add_action(){
		$i = $this->input;

		$data = array(
			'jumlah' 	=> preg_replace("/[^0-9]/", "", $i->post('jumlah')),
			'user_id'	=> $this->session->userdata('user_id'),
			'tglinsert' => date('Y-m-d h:i:s'),
			'tgl' 		=> $i->post('tgl'),
			'anggota_no'=> $i->post('anggota_no'),
			'id_jenis'	=> $i->post('id_jenis')
		);

		$this->M_simpanan->insert($data);
		$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Berhasil Menambahkan Simpanan</div>');
		redirect(base_url('simpanan'));
	}
	public function cetak($id){

		$d['nomor'] = $id;
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$text = "SELECT a.id_simpanan,a.anggota_no,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan,
					c.anggota_nama,c.anggota_no_identitas,c.anggota_alamat
					FROM simpanan as a
					JOIN jenis_simpan as b
					JOIN anggota as c
					ON a.id_jenis=b.id_jenis AND a.anggota_no=c.anggota_no
					WHERE a.id_simpanan='$id'";

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
				$d['terbilang'] = $this->M_simpanan->terbilang($db->jumlah,4);
			}
		}
		$this->load->view('cetak-terima',$d);

	}

}

/* End of file Simpanan.php */
/* Location: ./application/controllers/Simpanan.php */