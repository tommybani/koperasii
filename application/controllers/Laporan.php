<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_laporan');
	}

	public function anggota()
	{
		$data['content']	= 'anggota_laporan/anggota_lap';
		$data['js']	= 'anggota_laporan/anggota_laporan_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_anggota()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['noanggota'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');


		$this->load->view('anggota_laporan/lap_anggota',$d);

	}
	public function simpanan()
	{
		$data['content']	= 'simpanan_laporan/simpanan_lap';
		$data['js']			= 'simpanan_laporan/simpanan_lap_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_simpanan()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['noanggota'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$this->load->view('simpanan_laporan/lap_simpanan',$d);

	}
	public function penarikan()
	{
		$data['content']	= 'penarikan_laporan/penarikan_lap';
		$data['js']			= 'penarikan_laporan/penarikan_lap_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_penarikan()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['param'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$this->load->view('penarikan_laporan/lap_penarikan',$d);

	}
	public function pinjaman()
	{
		$data['content']	= 'pinjaman_laporan/pinjaman_lap';
		$data['js']			= 'pinjaman_laporan/pinjaman_lap_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_pinjaman()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['param'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$this->load->view('pinjaman_laporan/lap_pinjaman',$d);

	}
	public function pembayaran()
	{
		$data['content']	= 'pembayaran_laporan/pembayaran_lap';
		$data['js']			= 'pembayaran_laporan/pembayaran_lap_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_pembayaran()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['param'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$this->load->view('pembayaran_laporan/lap_pembayaran',$d);

	}
	public function tunggakan()
	{
		$data['content']	= 'tunggakan_laporan/tunggakan_lap';
		$data['js']			= 'tunggakan_laporan/tunggakan_lap_js';
		$this->load->view('template/main',$data);
	}
	public function cetak_tunggakan()
	{

		$d['pilih'] = $this->uri->segment(3);
		$d['param'] = $this->uri->segment(4);
		$d['judulurl'] = $this->config->item('judulurl');
		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
		$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
		$d['lisensi'] = $this->config->item('lisensi_app');

		$this->load->view('tunggakan_laporan/lap_tunggakan',$d);

	}


}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */