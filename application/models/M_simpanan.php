<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_simpanan extends CI_Model
{

	var $simpanan = "simpanan";

	function GetJumlah($id_jenis)
	{
		return $this->db->where('id_jenis', $id_jenis)->get('jenis_simpan')->row()->jumlah;
	}
	function insert($data)
	{
		$this->db->insert($this->simpanan, $data);
	}
	function view()
	{
		return $this->db->query("
			SELECT 
    a.id_simpanan,
    a.anggota_no,
    SUM(a.jumlah) AS jumlah_simpanan,
    (SELECT SUM(jumlah) 
     FROM pengambilan 
     WHERE anggota_no = a.anggota_no) AS jumlah_pengambilan,
    b.anggota_nama,
    b.anggota_jk,
    b.anggota_no_identitas,
    b.anggota_foto
FROM 
    simpanan AS a
JOIN 
    anggota AS b 
    ON a.anggota_no = b.anggota_no
GROUP BY 
    a.id_simpanan, a.anggota_no, b.anggota_nama, b.anggota_jk, b.anggota_no_identitas, b.anggota_foto;

			
			")->result();
	}
	public function bilang($x)
	{
		$x = abs($x);
		$angka = array(
			"",
			"satu",
			"dua",
			"tiga",
			"empat",
			"lima",
			"enam",
			"tujuh",
			"delapan",
			"sembilan",
			"sepuluh",
			"sebelas"
		);
		$result = "";
		if ($x < 12) {
			$result = " " . $angka[$x];
		} else if ($x < 20) {
			$result = $this->M_simpanan->bilang($x - 10) . " belas";
		} else if ($x < 100) {
			$result = $this->M_simpanan->bilang($x / 10) . " puluh" . $this->M_simpanan->bilang($x % 10);
		} else if ($x < 200) {
			$result = " seratus" . $this->M_simpanan->bilang($x - 100);
		} else if ($x < 1000) {
			$result = $this->M_simpanan->bilang($x / 100) . " ratus" . $this->M_simpanan->bilang($x % 100);
		} else if ($x < 2000) {
			$result = " seribu" . $this->M_simpanan->bilang($x - 1000);
		} else if ($x < 1000000) {
			$result = $this->M_simpanan->bilang($x / 1000) . " ribu" . $this->M_simpanan->bilang($x % 1000);
		} else if ($x < 1000000000) {
			$result = $this->M_simpanan->bilang($x / 1000000) . " juta" . $this->M_simpanan->bilang($x % 1000000);
		} else if ($x < 1000000000000) {
			$result = $this->M_simpanan->bilang($x / 1000000000) . " milyar" . $this->M_simpanan->bilang(fmod($x, 1000000000));
		} else if ($x < 1000000000000000) {
			$result = $this->M_simpanan->bilang($x / 1000000000000) . " trilyun" . $this->M_simpanan->bilang(fmod($x, 1000000000000));
		}
		return $result;
	}
	public function terbilang($x, $style = 4)
	{
		if ($x < 0) {
			$hasil = "minus " . trim($this->M_simpanan->bilang($x));
		} else {
			$hasil = trim($this->M_simpanan->bilang($x));
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

/* End of file M_simpanan.php */
/* Location: ./application/models/M_simpanan.php */