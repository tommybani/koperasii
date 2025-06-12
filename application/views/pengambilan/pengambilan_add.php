<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">FORM TAMBAH DATA PENARIKAN DANA ANGGOTA</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-12">
			<form action="<?=base_url('pengambilan/add_action')?>" method="POST" enctype="multipart/form-data">

				<div class="row">

					<div class="form-group col-sm-6">
						<label>No.Anggota</label>
						<select name="anggota_no" id="anggota_no" class="form-control select2" required>
							<option value=""></option>
							<?php
							foreach (ViewAnggota() as $a) { ?>
								<option value="<?=$a->anggota_no?>"><?=$a->anggota?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-sm-6">
						<label>No.Identitas</label>
						<input type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas" class="form-control" required disabled>
					</div>
					
				</div>

				<div class="row">

					<div class="form-group col-sm-6">
						<label>Tanggal</label>
						<input type="date" name="tgl" class="form-control tanggal" placeholder="Pilih Tanggal" value="<?=date('Y-m-d')?>" readonly autocomplete="off">
					</div>	

					<div class="form-group col-sm-6">
						<label>Nama Anggota</label>
						<input type="text" name="nama_anggota" id="nama_anggota" placeholder="Nama Anggota" class="form-control" required disabled>
					</div>
				</div>

				<div class="row">

					<div class="form-group col-sm-6">
						<label>Jenis Simpanan</label>
						<select name="id_jenis" class="form-control jenis" required>
							<option value=""></option>
							<?php
							foreach (ViewJenis() as $j) { ?>
								<option value="<?=$j->id_jenis?>"><?=$j->jenis_simpanan?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group col-sm-6">
						<label>Jenis Kelamin</label>
						<input type="text" name="anggota_jk" id="anggota_jk" class="form-control" placeholder="Jenis Kelamin" disabled>
					</div>
					
				</div>

				<div class="row">

					<div class="form-group col-sm-6">
						<label>Jumlah</label>
						<input type="text" name="jumlah" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="Jumlah" id="rupiah" autocomplete="off">
					</div>

					<div class="form-group col-sm-6">
						<label>Telepon</label>
						<input type="text" name="anggota_hp" id="anggota_hp" class="form-control" placeholder="Telepon" disabled>
					</div>
				</div>

				<div class="row">
				  <div class="form-group col-md-6 col-md-offset-6">
					<label>Saldo</label>
					<input type="text" name="saldo" id="saldo" class="form-control" placeholder="Saldo" disabled>
				  </div>
				</div>
				
				<div class="form-group">
					<a href="<?=base_url('pengambilan')?>" class="btn btn-danger btn-md pull-left"><< Kembali</a>

					<button type="submit" class="btn btn-primary btn-md pull-right" name="simpan">Simpan</button>
				</div>

				
			</form>
		</div>
  </div>

</div>

