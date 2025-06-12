<?php
function is_login(){
	$ci = get_instance();
	if (!$ci->session->userdata('user_id')) {
		$ci->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  Silahkan Login Terlebih Dahulu</div>');
		redirect(base_url());
	}

}
function CekNoAnggota($anggota_no){
	$ci = get_instance();
	$data = $ci->db->select('anggota_no')->where('anggota_no',$anggota_no)->get('anggota');
	$return = false;
	if ($data->num_rows() > 0) {
		return true;
	}
	return $return;
}
function ViewAnggota(){
	$ci =& get_instance();
	$data = $ci->db->select('anggota_no,anggota_nama,CONCAT_WS(" - ",anggota_no,anggota_nama) AS anggota')->get('anggota')->result();
	return $data;
}
function ViewJenis(){
	$ci =& get_instance();
	$data = $ci->db->get('jenis_simpan')->result();
	return $data;
}
function Saldo($anggota_no){
	$ci =& get_instance();
	$data = $ci->db->query("
			SELECT sum(a.jumlah) as jumlah_simpanan,
			(select sum(jumlah) FROM pengambilan WHERE anggota_no=a.anggota_no) as jumlah_pengambilan
			FROM simpanan as a
			JOIN anggota as b
			WHERE a.anggota_no='".$anggota_no."'
			")->row();
	$saldo = $data->jumlah_simpanan - $data->jumlah_pengambilan;
	return $saldo;
}
function getMaxKodePinjaman()
{
	$ci =& get_instance();
	$q = $ci->db->query("SELECT MAX(id_pinjam) as ID from pinjaman_header");
	$kd = "";
	if($q->num_rows()>0)
	{
		foreach($q->result() as $k)
		{
			$kode = substr($k->ID,1,4);
			$tmp = ((int)$kode)+1;
			$kd = "P".sprintf("%04s", $tmp);
		}
	}
	else
	{
		$kd = "P0001"; //"A"."001";
	}
	return $kd;
}
function jmlCicilan($id)
{
	$CI =& get_instance();
	$text = "SELECT sum(jumlah_bayar) as total
					FROM pinjaman_detail
					WHERE id_pinjam='$id'
			GROUP BY id_pinjam";
	$q = $CI->db->query($text);
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
function Jumlah_Simpanan($id){

	$CI =& get_instance();
	$q = $CI->db->query("SELECT sum(jumlah) as total FROM simpanan WHERE anggota_no='$id'");
	if($q->num_rows()>0){
		foreach($q->result() as $k){
			$hasil = $k->total;
		}
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function sisa_pinjaman($id){
	$CI =& get_instance();
	$q = $CI->db->query("select b.anggota_no,sum(a.angsuran+a.bunga) as total
		from pinjaman_detail as a
		join pinjaman_header as b
		ON a.id_pinjam=b.id_pinjam
		WHERE jumlah_bayar=0 AND anggota_no='$id'
		GROUP BY b.anggota_no");
	if($q->num_rows()>0){
		foreach($q->result() as $k){
			$hasil = $k->total;
		}
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function Jumlah_Pengambilan($id){
	$CI =& get_instance();
	$q = $CI->db->query("SELECT sum(jumlah) as total FROM pengambilan WHERE anggota_no='$id'");
	if($q->num_rows()>0){
		foreach($q->result() as $k){
			$hasil = $k->total;
		}
	}else{
		$hasil = 0;
	}
	return $hasil;
}
function getSaldo($id)
{
	$CI =& get_instance();
	$text = "SELECT a.anggota_no,
					(SELECT SUM(jumlah) FROM simpanan WHERE anggota_no='$id') as jml_simpanan,
					(SELECT SUM(jumlah) FROM pengambilan WHERE anggota_no='$id') as jml_ambil
					FROM anggota as a
					WHERE a.anggota_no='$id'";
	$q = $CI->db->query($text);
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
function Jumlah_pembayaran($id)
{
	$CI =& get_instance();
	$q = $CI->db->query("SELECT sum(jumlah_bayar) as total FROM pinjaman_detail
	WHERE id_pinjam='$id' AND jumlah_bayar<>0");
	if($q->num_rows()>0){
		foreach($q->result() as $k){
			$hasil = $k->total;
		}
	}else{
		$hasil = 0;
	}
	return $hasil;
}