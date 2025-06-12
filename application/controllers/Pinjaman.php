<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_pinjaman');
	}

	public function index()
	{
		$data['pinjaman']	 	= $this->M_pinjaman->view();
		$data['content'] 		= 'pinjaman/pinjaman_v';
		$data['js']				= 'pinjaman/pinjaman_js';
		$this->load->view('template/main',$data);
	}
	public function add()
	{
		$data['content'] 		= 'pinjaman/pinjaman_add';
		$data['js']				= 'pinjaman/pinjaman_add_js';
		$this->load->view('template/main',$data);
	}
	public function carikode(){
		$data['nomor'] = getMaxKodePinjaman();
		echo json_encode($data);
	}
	public function carianggota(){
		$id['anggota_no'] = $this->input->post('nomor');	
				
		$hasil = $this->M_pinjaman->getSelectedData("anggota",$id);
		$row = $hasil->num_rows();

		if($row>0){
			
			foreach($hasil->result() as $db)
			{
				if($db->anggota_jk=='L'){
					$sex = 'Laki-laki';
				}else{
					$sex = 'Perempuan';
				}
				$data['anggota_jk'] = $sex;
				$data['anggota_no_identitas'] = $db->anggota_no_identitas;
				$data['anggota_nama'] = $db->anggota_nama;
				$data['anggota_hp'] = $db->anggota_hp;
				$data['sisa_angsuran'] = $this->M_pinjaman->sisa_pinjaman($db->anggota_no);

				echo json_encode($data);
			}

		}else{
			$data['anggota_no_identitas'] = '';
			$data['anggota_nama'] = '';
			$data['anggota_jk'] = '';
			
			$data['anggota_hp'] = '';
			$data['sisa_angsuran'] ='';
			$data['no_pinjam'] = '';
			$data['lama'] = '';
			$data['bunga'] = '';
			$data['jumlah'] ='';
			$data['angsuran'] ='';
			echo json_encode($data);
		}
	}
	public function add_action(){
		if (isset($_POST['simpan'])) {
			$i = $this->input;
			$tgl = $i->post('tgl');
			$jumlah = preg_replace("/[^0-9]/", "", $i->post('jumlah'));
			$biaya_admin = preg_replace("/[^0-9]/", "", $i->post('biaya_admin'));
			$simpanan = preg_replace("/[^0-9]/", "", $i->post('simpanan'));
			$jumlah_diterima = preg_replace("/[^0-9]/", "", $i->post('jumlah_diterima'));

			$up['id_pinjam'] 	= $i->post('id_pinjam');
			$up['tgl']			= $i->post('tgl');
			$up['anggota_no']	= $i->post('anggota_no');
			$up['jumlah']		= $jumlah;
			$up['biaya_admin']		= $biaya_admin;
			$up['simpanan']			= $simpanan;
			$up['jumlah_diterima'] 	= $jumlah_diterima;
			$up['lama']			= $i->post('lama');
			$up['bunga']		= $i->post('bunga');
			$up['user_id']		= $this->session->userdata('user_id');

			// $ud['tgl_jatuh_tempo'] = $this->M_pinjaman->tgl_tagihan($i,$tgl);

			// echo "<pre>";
			// print_r($u);
			// exit;

			$ud['id_pinjam'] = $i->post('id_pinjam');
			$ud['bunga'] = round(($jumlah*$i->post('bunga')/100)/$up['lama']);
			$ud['angsuran'] = round($jumlah/$up['lama']);


			$id['id_pinjam'] = $i->post('id_pinjam');

			$si['jumlah'] = $simpanan;
			$si['user_id'] = $up['user_id'];
			$si['tglinsert'] = date('Y-m-d h:i:s');
			$si['tgl'] = date('Y-m-d');
			$si['anggota_no'] = $up['anggota_no'];
			$si['id_jenis'] = 2;

			$hasil = $this->M_pinjaman->getSelectedData("pinjaman_header",$id);
			$row = $hasil->num_rows();
			if($row==0){
				$this->M_pinjaman->insertdata("pinjaman_header",$up);
				$this->M_pinjaman->insertdata("simpanan",$si);
				for($i=1;$i<=$up['lama'];$i++){
					$ud['tgl_jatuh_tempo'] = $this->M_pinjaman->tgl_tagihan($i,$tgl);
					$ud['cicilan'] = $i;
					$this->M_pinjaman->insertData("pinjaman_detail",$ud);
				}

			}
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Berhasil Menambahkan Data</div>');
			redirect(base_url('pinjaman'));

			
		}
	}
	public function hapus($id){

		$data['id_pinjam'] = $id;

		$hasil = $this->M_pinjaman->getSelectedData("pinjaman_header",$data);
		$row = $hasil->num_rows();
		if($row>0){
			$this->M_pinjaman->deleteData("pinjaman_header",$data);
			$this->M_pinjaman->deleteData("pinjaman_detail",$data);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Data Berhasil Dihapus</div>');
			redirect(base_url('pinjaman'));
		}

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
			$this->load->view('cetak-pinjaman', $d);
	}


}

/* End of file Pinjaman.php */
/* Location: ./application/controllers/Pinjaman.php */