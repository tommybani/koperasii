<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('M_anggota');
	}

	public function index()
	{
		$data['anggota']	= $this->M_anggota->view();
		$data['content'] 	= 'anggota/anggota_v';
		$data['js']			= 'anggota/anggota_js';
		$this->load->view('template/main',$data);
	}
	public function add(){
		$data['content'] 	= 'anggota/anggota_add';
		$data['js']			= 'anggota/anggota_add_js';
		$this->load->view('template/main',$data);
	}
	public function add_action(){
		if (isset($_POST['simpan'])) {
			$i = $this->input;
			$foto = '';

			if (CekNoAnggota($i->post('anggota_no_identitas')) == TRUE) {

				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  No Anggota Sudah Di Gunakan</div>');
				redirect(base_url('anggota/add'));
				
			}

			$config['upload_path'] = 'assets/anggota/';
	        $config['allowed_types'] = 'jpg|png|jpeg';
	        $config['max_size']  = '2048';
	        $config['remove_space'] = TRUE;
	        $config['encrypt_name'] = TRUE;

	        $this->load->library('upload');
        	$this->upload->initialize($config);

        	if($this->upload->do_upload('anggota_foto')){
        		$foto = $this->upload->data('file_name');
        	}
			$data = array(
				'anggota_no'			=> $i->post('anggota_no'),
				'anggota_no_identitas'	=> $i->post('anggota_no_identitas'),
				'anggota_nama'			=> $i->post('anggota_nama'),
				'anggota_password'		=> md5($i->post('anggota_password')),
				'anggota_tempat_lahir'	=> $i->post('anggota_tempat_lahir'),
				'anggota_tanggal_lahir'	=> $i->post('anggota_tanggal_lahir'),
				'anggota_jk'			=> $i->post('anggota_jk'),
				'anggota_hp'			=> $i->post('anggota_hp'),
				'anggota_alamat'		=> $i->post('anggota_alamat'),
				'anggota_foto'			=> $foto
			);
			$simpan = $this->M_anggota->add($data);
			$this->session->set_flashdata('message','<div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Data Anggota Berhasil Ditambahkan</div>');
			redirect(base_url('anggota'));

		}
	}
	public function delete($anggota_id){
		$foto = $this->db->select('anggota_foto')->where('anggota_id',$anggota_id)->get('anggota')->row()->anggota_foto;
		if ($foto != '' || $foto != NULL) {
    		if (file_exists('assets/anggota/'.$foto)) {
    			unlink('assets/anggota/'.$foto);
    		}
    	}
		$this->M_anggota->delete($anggota_id);
		$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Data Anggota Berhasil Dihapus</div>');
		redirect(base_url('anggota'));
	}
	public function CariKode(){
		$data['nomor'] = $this->M_anggota->GetMaxKodeAnggota();
		echo json_encode($data);
	}
	public function update($anggota_id=FALSE){
		if ($anggota_id != FALSE) {
			$data['anggota'] 	= $this->M_anggota->GetData($anggota_id); 
			$data['content'] 	= "anggota/anggota_update";
			$data['js'] 		= "anggota/anggota_update_js";
			$this->load->view('template/main',$data);
		}else{
			redirect(base_url('anggota','refresh'));
		}
		
	}
	public function update_action(){
		if (isset($_POST['update'])) {

			$i = $this->input;
			$data = "";

			$config['upload_path'] = 'assets/anggota/';
	        $config['allowed_types'] = 'jpg|png|jpeg';
	        $config['max_size']  = '2048';
	        $config['remove_space'] = TRUE;
	        $config['encrypt_name'] = TRUE;

	        $this->load->library('upload');
        	$this->upload->initialize($config);

        	if($this->upload->do_upload('anggota_foto')){

        		$foto = $this->db->select('anggota_foto')->where('anggota_no',$i->post('anggota_no'))->get('anggota')->row()->anggota_foto;

				if ($foto != '' || $foto != NULL) {
		    		if (file_exists('assets/anggota/'.$foto)) {
		    			unlink('assets/anggota/'.$foto);
		    		}
		    	}

        		if ($i->post('anggota_password') != '') {
        			$data = array(
        				'anggota_no_identitas'	=> $i->post('anggota_no_identitas'),
						'anggota_nama'			=> $i->post('anggota_nama'),
						'anggota_password'		=> md5($i->post('anggota_password')),
						'anggota_tempat_lahir'	=> $i->post('anggota_tempat_lahir'),
						'anggota_tanggal_lahir'	=> $i->post('anggota_tanggal_lahir'),
						'anggota_jk'			=> $i->post('anggota_jk'),
						'anggota_hp'			=> $i->post('anggota_hp'),
						'anggota_alamat'		=> $i->post('anggota_alamat'),
						'anggota_foto'			=> $this->upload->data('file_name')
        			); 
        		}else{
        			$data = array(
        				'anggota_no_identitas'	=> $i->post('anggota_no_identitas'),
						'anggota_nama'			=> $i->post('anggota_nama'),
						'anggota_tempat_lahir'	=> $i->post('anggota_tempat_lahir'),
						'anggota_tanggal_lahir'	=> $i->post('anggota_tanggal_lahir'),
						'anggota_jk'			=> $i->post('anggota_jk'),
						'anggota_hp'			=> $i->post('anggota_hp'),
						'anggota_alamat'		=> $i->post('anggota_alamat'),
						'anggota_foto'			=> $this->upload->data('file_name')
        			); 
        		}
        		
        	}else{
        		if ($i->post('anggota_password') != '') {
        			$data = array(
        				'anggota_no_identitas'	=> $i->post('anggota_no_identitas'),
						'anggota_nama'			=> $i->post('anggota_nama'),
						'anggota_password'		=> md5($i->post('anggota_password')),
						'anggota_tempat_lahir'	=> $i->post('anggota_tempat_lahir'),
						'anggota_tanggal_lahir'	=> $i->post('anggota_tanggal_lahir'),
						'anggota_jk'			=> $i->post('anggota_jk'),
						'anggota_hp'			=> $i->post('anggota_hp'),
						'anggota_alamat'		=> $i->post('anggota_alamat')
        			); 
        		}else{
        			$data = array(
        				'anggota_no_identitas'	=> $i->post('anggota_no_identitas'),
						'anggota_nama'			=> $i->post('anggota_nama'),
						'anggota_tempat_lahir'	=> $i->post('anggota_tempat_lahir'),
						'anggota_tanggal_lahir'	=> $i->post('anggota_tanggal_lahir'),
						'anggota_jk'			=> $i->post('anggota_jk'),
						'anggota_hp'			=> $i->post('anggota_hp'),
						'anggota_alamat'		=> $i->post('anggota_alamat'),
        			); 
        		}	
        	}
			
        	$this->M_anggota->update($i->post('anggota_no'),$data);
        	$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Berhasil Mengubah Data</div>');
		redirect(base_url('anggota'));

		}else{
			redirect(base_url('anggota'));
		}
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */