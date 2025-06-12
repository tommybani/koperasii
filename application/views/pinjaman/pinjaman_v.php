<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">LIST PINJAMAN ANGGOTA</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-danger btn-md" href="<?=site_url('pinjaman/add')?>"><i class="fa fa-plus"></i></a>
    </div>
  </div>
  <div class="box-body">

  	<div class="table-responsive">
  		<table class="table table-bordered table-striped table-hover" id="pinjaman">
  			<thead>
  				<tr>
  					<th>No</th>
  					<th>Nomor</th>
  					<th>Tanggal</th>
  					<th>No.Anggota</th>
            <th>Nama</th>
  					<th>L/P</th>
  					<th>Lama</th>
  					<th>Jumlah Pinjaman</th>
            <th>Biaya Admin</th>
            <th>Simpanan Pokok</th>
            <th>Jumlah Diterima</th>
  					<th>Bunga</th>
  					<th>Jumlah Bayar</th>
  					<th>Jumlah Cicilan</th>
  					<th>Sisa</th>

  					<th style="text-align: center;">Action</th>
  				</tr>
  			</thead>

  			<tbody>
  				<?php
  				$no=1;
  				$jml_bayar = 0;
  				$jml_cicilan = 0;
  				$sisa = 0;	
  				foreach ($pinjaman as $p) {
  					$jml_bayar = $p->jumlah+($p->jumlah*$p->bunga/100);
  					$jml_cicilan = jmlCicilan($p->id_pinjam);
  					$sisa = $jml_bayar-$jml_cicilan;
  				?>
  					<tr>
  						<td><?=$no++?></td>
  						<td><?=$p->id_pinjam?></td>
  						<td><?=$p->tgl?></td>
  						<td><?=$p->anggota_no?></td>
              <td><?=$p->anggota_nama?></td>
  						<td><?=($p->anggota_jk == 'L') ? "Laki-laki" : "Perempuan" ?></td>
  						<td><?=$p->lama?> Bulan</td>
  						<td>Rp.<?=number_format($p->jumlah)?></td>
              <td>Rp.<?=number_format($p->biaya_admin)?></td>
              <td>Rp.<?=number_format($p->simpanan)?></td>
              <td>Rp.<?=number_format($p->jumlah_diterima)?></td>
  						<td><?=$p->bunga?>%</td>
  						<td>Rp.<?=number_format($jml_bayar)?></td>
  						<td>Rp.<?=number_format($jml_cicilan)?></td>
  						<td>Rp.<?=number_format($sisa)?></td>
  						<td style="text-align: center;">
  							<a href="<?=site_url('pinjaman/hapus/'.$p->id_pinjam)?>" class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><i class="glyphicon glyphicon-trash"></i></a>

  							<a target="_blank" href="<?=site_url('pinjaman/cetak/'.$p->id_pinjam)?>" class="btn btn-success btn-md"><i class="glyphicon glyphicon-print"></i></a>
  						</td>
  					</tr>
  				<?php } ?>
  			</tbody>

  		</table>
  	</div>

  </div>

</div>

