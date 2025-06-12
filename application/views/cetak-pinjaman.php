<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.4cm ;
font-size: 9pt;
border-collapse:collapse;
}
table.gridket{
width:20.4cm ;
font-size: 9pt;
border-collapse:collapse;
}
table.grid th{
padding-top:1mm;
padding-bottom:1mm;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
padding-left:0.2cm;
border:1px solid #000;
}
table.grid tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-left:2mm;
border-bottom:0.2mm solid #000;
border:1px solid #000;
}
table.gridket tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-left:2mm;
border-bottom:0.2mm solid #000;
}
h1{
font-size: 18pt;
}
h2{
font-size: 14pt;
}
h3{
font-size: 10pt;
}
.profil{
display: block;
width:20.4cm ;
font-size:10px;
margin:0px;
padding:0px;
}
.profil .koperasii{
font-size:14px;
font-weight:bold;
}
.header{
display: block;
width:20.4cm ;
margin-bottom: 0.3cm;
text-align: center;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20cm ;
}
.page {
width:20cm ;
font-size:13px;
}

</style>
<?php
$where	= " WHERE id_pinjam ='".$kode."'";

$q	= "SELECT a.*,b.* 
	  FROM pinjaman_header as a
	  JOIN anggota as b
	  ON a.anggota_no=b.anggota_no
	  WHERE id_pinjam='".$kode."'";
$data = $this->db->query($q);	  
foreach($data->result_array() as $d){
$noanggota		= $d['anggota_no'];
$nama 			= $d['anggota_nama'];
$tgl_pinjam 	= $d['tgl'];
$lama		 	= $d['lama'];
$bunga		 	= $d['bunga'];
$jumlah		 	= number_format($d['jumlah']);
}

$ket = "<table class='gridket' >
		<tr>
			<td>Tanggal</td>
			<td>: $tgl_pinjam</td>
			<td>Lama Pinjaman</td>
			<td>: $lama Bulan</td>
		</tr>
		<tr>
			<td>Bunga</td>
			<td>: $bunga %</td>
			<td>Jumlah Pinjaman</td>
			<td>: $jumlah</td>
		</tr>
		</table>";
$judul_H = "CETAK PINJAMAN ANGGOTA<br>";
$judul_H .= "NO.PINJAMAN $kode<br>";
$judul_H .= "$noanggota - $nama<br>";

$profil = "<b><h3>Koperasi Serba Usaha Karya Sejahtera</b></h3>";
$profil .= "<h4>Kel. Gisikdrono, Kec. Semarang Barat, Kota Semarang</h4>"; 

$query = "SELECT * FROM pinjaman_detail
		$where
		order by cicilan";


$data = $this->db->query($query);

function myheader($profil,$judul_H,$ket){
echo  "<div class='profil'>".$profil."
		</div>
		<br>
		<div class='header'>
		  <h2>".$judul_H."</h2>
		  </div>
		<table class='grid' >
		<tr>
			<th width='5%'>No</th>
			<th >Cicilan Ke</th>
			<th >Jatuh Tempo</th>
			<th >Angsuran</th>
			<th >Bunga</th>
			<th >Jatuh Bayar</th>
			<th >Total</th>
		</tr>";		
}
	//echo $query;
function myfooter(){	
	echo "</table>";
}
	$gtotal=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r_data){
	$tgl = $r_data['tgl_jatuh_tempo'];		
	$tgl_bayar = $r_data['tgl_bayar'];		
	$total_bayar = $r_data['jumlah_bayar'];
	$angsuran = $r_data['angsuran'];
	$bunga = $r_data['bunga'];
	$total = $angsuran+$bunga;
	//$total = $r_data[hargabeli]*$r_data[jmlbeli];
	$gtotal = $gtotal+$total;
	if(($no%40) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($profil,$judul_H,$ket);
	}
	echo "<tr>
			<td align='center'>$no</td>
			<td align='center'>$r_data[cicilan]</td>
			<td align='center'>$tgl</td>
			<td align='right'>".number_format($angsuran)."</td>
			<td align='right'>".number_format($bunga)."</td>
			<td align='center'>$tgl_bayar</td>
			<td align='center'>".number_format($total_bayar)."</td>
			</tr>";
	$no++;
	}

myfooter();	
		echo "</table>";
	
	echo "<div class='akhir' align='right'>
			Total : <b>".number_format($gtotal)."</b>
		</div>";

	/*
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	*/
	//echo $content;
//}
?>