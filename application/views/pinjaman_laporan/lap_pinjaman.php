<title>Laporan Pinjaman Anggota</title>
<link rel="icon" href="<?php echo base_url(); ?>asset/images/sroico.png" type="image/png">
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
}

</style>
<?php
$judul_H = "Laporan Pinjaman Anggota <br>";

if($pilih=='anggota'){
	$noanggota = $param;
	$where	= " WHERE a.anggota_no = '$noanggota'";
	$judul_H .= "Berdasarkan Nomor $noanggota<br>";
}elseif($pilih=='tanggal'){
	$tgl = $param;
	$where	= " WHERE tgl = '$tgl'";
	$judul_H .= "Berdasarkan Tanggal $param<br>";
}else{
	$where	= "";
}
$profil = "<b><h3>Koperasi Serba Usaha Karya Sejahtera</b></h3>";
$profil .= "<h4>Kel. Gisikdrono, Kec. Semarang Barat, Kota Semarang</h4>"; 

$query = "select *
		from pinjaman_header as a
		join anggota as b
		ON a.anggota_no=b.anggota_no
		$where
		order by id_pinjam";
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
			<th >No.Pinjaman</th>
			<th >Tanggal</th>
			<th >Nomor Anggota</th>
			<th >Nama Anggota</th>
			<th >L/P</th>
			<th >Jumlah Pinjam</th>
      <th >Bunga</th>
			<th >Jumlah + Bunga</th>
			<th >Sisa</th>
		</tr>";
}
	//echo $query;
function myfooter(){
	echo "</table>";
}
	$stotal=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r_data){
		$jml = $r_data['jumlah'];
		$setor = $r_data['jumlah']+(($r_data['jumlah']*$r_data['bunga']/100));
		$jml_bayar = Jumlah_pembayaran($r_data['id_pinjam']);
		$sisa = $setor-$jml_bayar;
		$stotal = $stotal+$jml;
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
			<td align='center'>$r_data[id_pinjam]</td>
			<td align='center'>$r_data[tgl]</td>
			<td align='center'>$r_data[anggota_no]</td>
			<td align='left'>$r_data[anggota_nama]</td>
			<td align='center'>$r_data[anggota_jk]</td>
			<td align='right'>".number_format($jml)."</td>
      <td align='center'>$r_data[bunga]</td>
			<td align='right'>".number_format($setor)."</td>
			<td align='right'>".number_format($sisa)."</td>
			</tr>";
	$no++;
	}

myfooter();
		echo "</table>";
	echo "<div class='akhir' align='right'>
			Total <b>".number_format($stotal)."</b>
		</div>";

?>
