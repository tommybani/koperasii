
<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">LIST DATA SIMPANAN ANGGOTA</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-danger btn-md" href="<?=site_url('simpanan/add')?>"><i class="glyphicon glyphicon-plus"></i></a>
    </div>
  </div>
  <div class="box-body">

  	<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="simpanan">
				<thead>
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>No.Anggota</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Jumlah Simpanan</th>
						<th>Jumlah Pengambilan</th>
						<th>Saldo</th>
						<th style="text-align:center;">Detail</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					$foto = 'assets/user.jpg';
					foreach ($s as $s) {
						if ($s->anggota_foto !='') {
							$foto = 'assets/anggota/'.$s->anggota_foto;	
						}
						
						$saldo = $s->jumlah_simpanan - $s->jumlah_pengambilan;
					?>
						<tr>
							<td><?=$no++?></td>
							<td>
								<img class="img-rounded" width="150" height="150" src="<?=base_url($foto)?>">
							</td>
							<td><?=$s->anggota_no?></td>
							<td><?=$s->anggota_no_identitas?></td>
							<td><?=$s->anggota_nama?></td>
							<td><?=($s->anggota_jk == 'L') ? "Laki-laki" : "Perempuan"?></td>
							<td>Rp.<?=number_format($s->jumlah_simpanan)?></td>
							<td>Rp.<?=number_format($s->jumlah_pengambilan)?></td>
							<td>Rp.<?=number_format($saldo)?></td>
							<td style="text-align:center">
								
								<a href="<?=site_url('Api/detail/'.$s->anggota_no)?>"
									class="btn btn-md btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
								
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

  </div>

</div>

