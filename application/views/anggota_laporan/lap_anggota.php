<title>Laporan Anggota</title>
<!-- <link rel="icon" href="<?php echo base_url(); ?>asset/images/sroico.png" type="image/png"> -->
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
width:29.7cm ;
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
h1{
font-size: 18pt;
}
h2{
font-size: 14pt;
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
width:29.7cm ;
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
width:29.7cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:29.7cm ;
font-size:13px;
}
.page {
width:29.7cm ;
font-size:12px;
}

</style>
<?php

$judul_H = "Laporan Anggota <br>";

if($pilih=='pilih'){
	$where	= " WHERE anggota_no ='$noanggota'";
	$judul_H .= "Berdasarkan Nomor $noanggota<br>";
}else{
	$where	= "";
}

$profil = "<b><h3>Koperasi Serba Usaha Karya Sejahtera</b></h3>";
$profil .= "<h4>Kel. Gisikdrono, Kec. Semarang Barat, Kota Semarang</h4>"; 

$query = "select * from anggota
		$where
		order by anggota_no";
//echo $query;

$data = $this->db->query($query);

function myheader($profil,$judul_H){
echo  "<div class='profil'>".$profil."
		</div>
		<br>
		<div class='header'>
		  <h2>".$judul_H."</h2>
		  </div>
		<table class='grid' >
		<tr>
			<th width='5%'>No</th>
			<th >Nomor Anggota</th>
			<th >NIK</th>
			<th >Nama Anggota</th>
			<th >L/P</th>
			<th >Tempat, Tanggal Lahir</th>
			<th >Alamat</th>
			<th >Telepon</th>
			<th >Simpanan</th>
			<th >Pinjaman</th>
		</tr>";
}
	//echo $query;
function myfooter(){
	echo "</table>";
}
	$no=1;
	$page =1;
	foreach($data->result_array() as $r_data){
		$simpanan = Jumlah_Simpanan($r_data['anggota_no']);
		$pinjaman = sisa_pinjaman($r_data['anggota_no']);
		$pengambilan = Jumlah_Pengambilan($r_data['anggota_no']);
    	$sisa = $simpanan - $pengambilan;
	if(($no%40) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($profil,$judul_H);
	}
	echo "<tr>
			<td align='center'>$no</td>
			<td align='center'>$r_data[anggota_no]</td>
			<td align='center'>$r_data[anggota_no_identitas]</td>
			<td align='left'>$r_data[anggota_nama]</td>
			<td align='center'>$r_data[anggota_jk]</td>
			<td align='left'>$r_data[anggota_tempat_lahir], $r_data[anggota_tanggal_lahir]</td>
			<td align='left'>$r_data[anggota_alamat]</td>
			<td align='left'>$r_data[anggota_hp]</td>
			<td align='right'>".number_format($sisa)."</td>
			<td align='right'>".number_format($pinjaman)."</td>
			</tr>";
	$no++;
	}

myfooter();
		echo "</table>";
	//echo "<div class='akhir' align='right'>
	//		Total <b>".number_format($gtotal)."</b>
	//	</div>";
	// echo "<br>";
	// echo "<div class='akhir' align='right'>";
	// 	echo "Karawang, ".date('d F Y');
	// 	echo "<br>Staf Koperasi";
	// 	echo "<br><br><br>";
	// 	echo $this->session->userdata('username');
	// echo  "</div>";

	/*
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	*/
	//echo $content;
//}
?>
