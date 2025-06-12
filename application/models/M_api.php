<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {

	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
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
	public function anggota($anggota_no){
		return $this->db->where('anggota_no',$anggota_no)->get('anggota')->row_array();
	}
	public function simpanan($anggota_no){
		$this->db->select('simpanan.*,jenis_simpan.jenis_simpanan');
		$this->db->join('jenis_simpan','jenis_simpan.id_jenis=simpanan.id_jenis','LEFT');
		$this->db->where('anggota_no',$anggota_no);
		return $this->db->get('simpanan')->result_array();
	}
	public function delete_simpanan($id_simpanan){
		$this->db->where('id_simpanan',$id_simpanan)->delete('simpanan');
	}
	public function pengambilan($anggota_no){
		$this->db->select('pengambilan.*,jenis_simpan.jenis_simpanan');
		$this->db->join('jenis_simpan','jenis_simpan.id_jenis=pengambilan.id_jenis','LEFT');
		$this->db->where('anggota_no',$anggota_no);
		return $this->db->get('pengambilan')->result_array();
	}
	public function delete_pengambilan($id_ambil){
		$this->db->where('id_ambil',$id_ambil)->delete('pengambilan');
	}
	public function getSaldo($id)
	{
		$text = "SELECT a.anggota_no,
						(SELECT SUM(jumlah) FROM simpanan WHERE anggota_no='$id') as jml_simpanan,
						(SELECT SUM(jumlah) FROM pengambilan WHERE anggota_no='$id') as jml_ambil
						FROM anggota as a
						WHERE a.anggota_no='$id'";
		$q = $this->db->query($text);
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$simpanan = $k->jml_simpanan; //substr($k->ID,0,1);
				$ambil = $k->jml_ambil;
				$saldo = $simpanan - $ambil;
			}
			$hasil = $saldo;
		}
		else
		{
			$hasil = 0;
		}
		return $hasil;
	}

	public function cari_nopinjam($id){
		$q = $this->db->query("select *
			from pinjaman_detail as a
			join pinjaman_header as b
			ON a.id_pinjam=b.id_pinjam
			WHERE jumlah_bayar=0 AND anggota_no='$id'
			GROUP BY b.anggota_no");
		if($q->num_rows()>0){
			//$hasil = array();
			foreach($q->result() as $k){
				$hasil = $k->id_pinjam;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	public function cari_lama($id){
		$q = $this->db->query("select *
			from pinjaman_header
			WHERE id_pinjam='$id'");
		if($q->num_rows()>0){
			//$hasil = array();
			foreach($q->result() as $k){
				$hasil = $k->lama;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function cari_bunga($id){
		$q = $this->db->query("select *
			from pinjaman_header
			WHERE id_pinjam='$id'");
		if($q->num_rows()>0){
			//$hasil = array();
			foreach($q->result() as $k){
				$hasil = $k->bunga;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function cicilan_ke($id){
		$q = $this->db->query("select *
			from pinjaman_detail
			WHERE id_pinjam='$id' AND jumlah_bayar=0
			ORDER BY cicilan ASC LIMIT 1");
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$hasil = $k->cicilan;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function cicilan_angsuran($id){
		$q = $this->db->query("select *
			from pinjaman_detail
			WHERE id_pinjam='$id' AND jumlah_bayar=0
			ORDER BY cicilan ASC LIMIT 1");
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$hasil = $k->angsuran+$k->bunga;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	public function cari_jumlah($id){
		$q = $this->db->query("select *
			from pinjaman_header
			WHERE id_pinjam='$id'");
		if($q->num_rows()>0){
			//$hasil = array();
			foreach($q->result() as $k){
				$hasil = $k->jumlah;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	

}

/* End of file M_api.php */
/* Location: ./application/models/M_api.php */