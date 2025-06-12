<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	function simpanan(){
		return $this->db->query("SELECT a.id_simpanan,a.anggota_no,
					sum(a.jumlah) as jumlah_simpanan,
					(select sum(jumlah) FROM pengambilan WHERE anggota_no=a.anggota_no) as jumlah_pengambilan,
					b.anggota_nama,b.anggota_jk,b.anggota_no_identitas
					FROM simpanan as a
					JOIN anggota as b
					ON a.anggota_no=b.anggota_no
					WHERE  a.anggota_no='".$this->session->userdata('username')."'
					GROUP BY a.anggota_no");
	}
	public function nama_jenis($id){
		$data = $this->db->query("SELECT * FROM jenis_simpan WHERE id_jenis='$id'");
		$row = $data->num_rows();
		if($row>0){
			foreach($data->result() as $t){
				$hasil = $t->jenis_simpanan;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
	public function jmlCicilan($id)
	{
		$text = "SELECT sum(jumlah_bayar) as total
						FROM pinjaman_detail
						WHERE id_pinjam='$id'
				GROUP BY id_pinjam";
		$q = $this->db->query($text);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$hasil = $k->total;
			}

		}
		else
		{
			$hasil = 0;
		}
		return $hasil;
	}

}

/* End of file M_home.php */
/* Location: ./application/models/M_home.php */