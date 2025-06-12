<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pinjaman extends CI_Model {

	var $pinjaman = "pinjaman_header";
	
	public function view(){
		return $this->db->query("
			SELECT a.id_pinjam,a.tgl,a.anggota_no,a.jumlah,a.lama,a.bunga,
			b.anggota_nama,b.anggota_jk,b.anggota_no_identitas,a.biaya_admin,a.simpanan,a.jumlah_diterima
			FROM pinjaman_header as a
			JOIN anggota as b ON a.anggota_no=b.anggota_no")->result();
	}

	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	public function sisa_pinjaman($id){
		$q = $this->db->query("select b.anggota_no,sum(a.angsuran+a.bunga) as total
			from pinjaman_detail as a
			join pinjaman_header as b
			ON a.id_pinjam=b.id_pinjam
			WHERE jumlah_bayar=0 AND anggota_no='$id'
			GROUP BY b.anggota_no");
		$hasil=0;
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$hasil = $k->total;
			}
		}
		return $hasil;
	}
	public function tgl_tagihan($i,$tgl_now){
		/* tanggal tagihan */
		date_default_timezone_set("Asia/Jakarta");

		$exp		= explode("-",$tgl_now);
		$tgl		= $exp[2];

		$satubulan = 30*($i-1);
		$month = date('F');
		$day = $tgl; //date('j');
		$year = date('Y');
		$time = '24:00:00';
		$date = mktime(0,0,0, date('m'), $day+$satubulan, $year);
		$date = date("Y-m", $date);//." ".$time;
		$tanggal	= $date."-".$tgl;
		return $tanggal;
	}
	public function insertdata($table,$data){
		$this->db->insert($table,$data);
	}

}

/* End of file M_pinjaman.php */
/* Location: ./application/models/M_pinjaman.php */