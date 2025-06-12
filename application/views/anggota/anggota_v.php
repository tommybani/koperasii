<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>



<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">DATA ANGGOTA</h3>
    <div class="box-tools pull-right">
      <a class="btn btn-danger btn-md" href="<?=site_url('anggota/add')?>"><i class="glyphicon glyphicon-plus"></i></a>
    </div>
  </div>
  <div class="box-body">
  	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover" id="anggota">
			<thead>
				<tr>
					<th style="text-align: center;">No</th>
					<th style="text-align: center;">Foto</th>
					<th style="text-align: center;">No Anggota</th>
					<th style="text-align: center;">NIK</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Jenis Kelamin</th>
					<th style="text-align: center;">Telepon</th>
					<th style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				$foto = 'assets/user.jpg';
				foreach ($anggota as $a) {
					if ($a['anggota_foto'] !='') {
						$foto = 'assets/anggota/'.$a['anggota_foto'];
					}
				?>
					<tr>
						<td style="text-align: center;"><?=$no++?></td>
						<td style="text-align: center;">
							<img class="img-rounded" width="150" height="150" src="<?=base_url($foto)?>">
						</td>
						<td style="text-align: center;"><?=$a['anggota_no']?></td>
						<td style="text-align: center;"><?=$a['anggota_no_identitas']?></td>
						<td style="text-align: center;"><?=$a['anggota_nama']?></td>
						<td style="text-align: center;"><?=$a['jk']?></td>
						<td style="text-align: center;"><?=$a['anggota_hp']?></td>
						<td style="text-align: center;">
							<a href="<?=site_url('anggota/update/'.$a['anggota_id'])?>" class="btn btn-warning btn-md"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="<?=site_url('anggota/delete/'.$a['anggota_id'])?>" class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
  </div>

</div>

