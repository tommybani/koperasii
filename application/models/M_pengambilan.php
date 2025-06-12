<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengambilan extends CI_Model {

	var $pengambilan = "pengambilan";

	function insert($data){
		$this->db->insert($this->pengambilan,$data);
	}
	function view(){
		return $this->db->query("
			SELECT a.id_ambil,a.anggota_no,
			sum(a.jumlah) as jumlah_pengambilan,
			(select sum(jumlah) FROM simpanan WHERE anggota_no=a.anggota_no) as jumlah_simpanan,
			b.anggota_nama,b.anggota_jk,b.anggota_no_identitas,b.anggota_foto
			FROM pengambilan as a
			JOIN anggota as b ON a.anggota_no=b.anggota_no
			GROUP BY a.anggota_no
			")->result();

	}
	public function bilang($x) {
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima",
		"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$result = "";
		if ($x <12) {
			$result = " ". $angka[$x];
		} else if ($x <20) {
			$result = $this->M_pengambilan->bilang($x - 10). " belas";
		} else if ($x <100) {
			$result = $this->M_pengambilan->bilang($x/10)." puluh". $this->M_pengambilan->bilang($x % 10);
		} else if ($x <200) {
			$result = " seratus" . $this->M_pengambilan->bilang($x - 100);
		} else if ($x <1000) {
			$result = $this->M_pengambilan->bilang($x/100) . " ratus" . $this->M_pengambilan->bilang($x % 100);
		} else if ($x <2000) {
			$result = " seribu" . $this->M_pengambilan->bilang($x - 1000);
		} else if ($x <1000000) {
			$result = $this->M_pengambilan->bilang($x/1000) . " ribu" . $this->M_pengambilan->bilang($x % 1000);
		} else if ($x <1000000000) {
			$result = $this->M_pengambilan->bilang($x/1000000) . " juta" . $this->M_pengambilan->bilang($x % 1000000);
		} else if ($x <1000000000000) {
			$result = $this->M_pengambilan->bilang($x/1000000000) . " milyar" . $this->M_pengambilan->bilang(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$result = $this->M_pengambilan->bilang($x/1000000000000) . " trilyun" . $this->M_pengambilan->bilang(fmod($x,1000000000000));
		}
			return $result;
	}
	public function terbilang($x, $style=4) {
		if($x<0) {
			$hasil = "minus ". trim($this->M_pengambilan->bilang($x));
		} else {
			$hasil = trim($this->M_pengambilan->bilang($x));
		}
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
				break;
		}
		return $hasil;
	}

}

/* End of file M_pengambilan.php */
/* Location: ./application/models/M_pengambilan.php */