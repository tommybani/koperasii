<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_pembayaran');
	}

	public function index()
	{
		$data['content']	= 'pembayaran/pembayaran';
		$data['js']			= 'pembayaran/pembayaran_js';
		$this->load->view('template/main',$data);
	}
	public function add_action(){
		$tgl = $this->input->post('tgl_bayar');
		$exp = explode("/",$this->input->post('angsuran'));
		$cicilan = $exp[0];
		$jumlah = preg_replace("/[^0-9]/", "", $exp[1]);

		$up['id_pinjam'] = $this->input->post('id_pinjam');
		$up['tgl_bayar'] = ($tgl);
		$up['jumlah_bayar'] = $jumlah;

		$id['id_pinjam'] = $this->input->post('id_pinjam');
		$id['cicilan'] = $cicilan;

		$hasil = $this->M_pembayaran->getSelectedData("pinjaman_detail",$id);
		$row = $hasil->num_rows();
		if($row>=0){
			$this->M_pembayaran->updateData("pinjaman_detail",$up,$id);
			$this->session->set_flashdata('message','<div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Pembayaran Berhasil</div>');
			redirect(base_url('pinjaman'));
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Terjadi Kesalahan, Pembayaran Gagal</div>');
			redirect(base_url('pinjaman'));
		}
	}

	public function view_bayar()
	{

		$id = $this->input->post('nomor');
		$data['id'] = $id;
		$data['pinjaman'] = $this->M_pembayaran->view_bayar($id);
		$this->load->view('pembayaran/view_pembayaran', $data);
	}
	public function cetak($id){
		$text = "SELECT *
					FROM pinjaman_header as a
					JOIN pinjaman_detail as b
					JOIN anggota as c
					ON a.id_pinjam=b.id_pinjam AND a.anggota_no=c.anggota_no
					WHERE a.id_pinjam='$id'";

			//$hasil = $this->app_model->getSelectedData("anggota",$id);

			$hasil = $this->db->query($text);
			$row = $hasil->num_rows();
			if($row>0){
				foreach($hasil->result() as $db)
				{
					$d['kode'] = $id;
					$d['tgl'] = $db->tgl;
					$d['identitas'] = $db->anggota_no_identitas;
					$d['noanggota'] = $db->anggota_no;
					$d['nama'] = $db->anggota_nama;
					$d['alamat'] = $db->anggota_alamat;
					//$d['jenis'] = $db->jenis_simpanan;
					$d['jumlah'] = number_format($db->jumlah);
					//$d['terbilang'] = $this->app_model->terbilang($db->jumlah,4);
				}
			}
			$this->load->view('cetak-pembayaran', $d);
	}

}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */