<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model {

	var $anggota = "anggota";
	public function add($data){
		$this->db->insert($this->anggota,$data);
	}
	public function view(){
		$this->db->select('
		anggota_id,
		anggota_no,
		anggota_no_identitas,
		anggota_foto,
		anggota_hp,
		anggota_nama,
		IF(anggota_jk="L","Laki-laki","Perempuan") AS jk
			');
		$this->db->from($this->anggota);
		$this->db->order_by('anggota_id','desc');
		// $this->db->order_by('anggota_id','desc');
		return $this->db->get()->result_array();
	}
	public function delete($anggota_id){
		$this->db->where('anggota_id',$anggota_id)->delete($this->anggota);
	}
	public function GetMaxKodeAnggota(){
		$q = $this->db->query("SELECT MAX(substr(anggota_no,2,3)) AS no FROM anggota");
		$kd = "";
		if ($q->num_rows() > 0)
		{
			foreach ($q->result() as $k)
			{
				$kode = $k->no;
				$tmp = ((int)$kode)+1;
				$kd = "A".sprintf("%03s", $tmp);
			}
		}
		else
		{
			$kd = "A"."001";
		}
		return $kd;
	}
	public function GetData($anggota_id){
		return $this->db->where('anggota_id',$anggota_id)->get($this->anggota)->row();
	}
	public function update($anggota_no,$data){
		$this->db->set($data);
		$this->db->where('anggota_no',$anggota_no);
		$this->db->update($this->anggota);

	}

}

/* End of file M_anggota.php */
/* Location: ./application/models/M_anggota.php */