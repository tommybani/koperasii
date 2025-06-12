<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_api');
	}

	public function json(){

		$id['anggota_no'] = $this->input->post('nomor');	
				
		$hasil = $this->M_api->getSelectedData("anggota",$id);
		$row = $hasil->num_rows();

		if($row>0){
			
			foreach($hasil->result() as $db)
			{
				if($db->anggota_jk=='L'){
					$sex = 'Laki-laki';
				}else{
					$sex = 'Perempuan';
				}
				$data['anggota_jk'] 			= $sex;
				$data['anggota_no_identitas'] 	= $db->anggota_no_identitas;
				$data['anggota_nama'] 			= $db->anggota_nama;
				$data['anggota_hp'] 			= $db->anggota_hp;
				$data['sisa_angsuran'] 			= $this->M_api->sisa_pinjaman($db->anggota_no);
				$data['no_pinjam'] 				=  $this->M_api->cari_nopinjam($db->anggota_no);
				$data['lama'] = $this->M_api->cari_lama($data['no_pinjam']);
				$data['bunga'] = $this->M_api->cari_bunga($data['no_pinjam']);
				$data['angsuran'] = $this->M_api->cicilan_ke($data['no_pinjam']).' / '.'Rp.'.number_format($this->M_api->cicilan_angsuran($data['no_pinjam']));
				$data['jumlah']  = 'Rp.'.number_format($this->M_api->cari_jumlah($data['no_pinjam']));
				$data['sisa_angsuran_number'] = 'Rp.'.number_format($data['sisa_angsuran']);
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
			$data['sisa_angsuran_number']='';

			echo json_encode($data);
		}
	
	}

	public function detail($anggota_no='')
	{
		if ($anggota_no != '' ) {
			$data['anggota'] = $this->M_api->anggota($anggota_no);
			$data['pengambilan'] = $this->M_api->pengambilan($anggota_no);
			$data['simpanan'] = $this->M_api->simpanan($anggota_no);
			$data['title'] = 'Detail Data Anggota / '.$data['anggota']['anggota_nama'];
			$data['content'] = 'detail/detail';
			$data['js']	= 'detail/detail_js';
			$data['img'] 	 = 'assets/user.jpg'; 
			if ($data['anggota']['anggota_foto'] != '') {
				$data['img'] = 'assets/anggota/'.$data['anggota']['anggota_foto'];
			}
			$this->load->view('template/main',$data);
		}
	}
	public function delete_simpanan($id_simpanan='',$anggota_no){
		if ($id_simpanan !='') {
			$this->M_api->delete_simpanan($id_simpanan);
			
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Data Berhasil Dihapus</div>');
			redirect(base_url('Api/detail/'.$anggota_no));
		}
	}
	public function delete_pengambilan($id_ambil='',$anggota_no){
		if ($id_ambil !='') {
			$this->M_api->delete_pengambilan($id_ambil);
			
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Data Berhasil Dihapus</div>');
			redirect(base_url('Api/detail/'.$anggota_no));
		}
	}
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id = $this->input->get('id');
			
			$d['nomor'] = $id; //$this->config->item('judul');
			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
			$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
			$d['lisensi'] = $this->config->item('lisensi_app');	
			
			$text = "SELECT a.id_simpanan,a.noanggota,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan,
					c.namaanggota,c.noidentitas,c.alamat
					FROM simpanan as a
					JOIN jenis_simpan as b
					JOIN anggota as c
					ON a.id_jenis=b.id_jenis AND a.noanggota=c.noanggota
					WHERE a.id_simpanan='$id'";
			
			//$hasil = $this->app_model->getSelectedData("anggota",$id);
			$hasil = $this->app_model->manualQuery($text);
			$row = $hasil->num_rows();
			if($row>0){
				foreach($hasil->result() as $db)
				{
					$d['tgl'] = $this->app_model->tgl_str($db->tgl);
					$d['identitas'] = $db->noidentitas;
					$d['noanggota'] = $db->noanggota;
					$d['nama'] = $db->namaanggota;
					$d['alamat'] = $db->alamat; 
					$d['jenis'] = $db->jenis_simpanan;
					$d['jumlah'] = number_format($db->jumlah);
					$d['terbilang'] = $this->app_model->terbilang($db->jumlah,4);
				}
			}
						
			$this->load->view('cetak-terima', $d);

		}else{
			redirect('/koperasi/logout/','refresh');
		}
	}
	public function saldo(){
		$id = $this->input->post('nomor');	
					
		$hasil = $this->M_api->getSaldo($id);
		$data['saldo'] = number_format($hasil);
		echo json_encode($data);
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */