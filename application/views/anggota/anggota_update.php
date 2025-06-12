<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">FORM EDIT DATA ANGGOTA</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-12">
			<form action="<?=base_url('anggota/update_action')?>" method="POST" enctype="multipart/form-data">

				<div class="row">

					<div class="form-group col-sm-6">
						<label>No.Anggota</label>
						<input type="text" name="anggota_no" id="anggota_no" class="form-control" placeholder="Nomor Anggota" value="<?=$anggota->anggota_no?>" autocomplete="off" required readonly>
					</div>

					<div class="form-group col-sm-6	">
						<label>NIK</label>
						<input type="text" name="anggota_no_identitas" maxlength="20" placeholder="No Identitas Anggota" class="form-control" onkeypress="return hanyaAngka(event)" autocomplete="off" value="<?=$anggota->anggota_no_identitas?>" autofocus  required>
					</div>
					
				</div>

				<div class="row">

					<div class="form-group col-sm-6">
						<label>Nama Anggota</label>
						<input type="text" name="anggota_nama" placeholder="Nama Anggota" class="form-control" value="<?=$anggota->anggota_nama?>" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" required>
					</div>

					<div class="form-group col-sm-6">
						<label>Password</label>
						<input type="password" name="anggota_password" placeholder="Password" class="form-control">
						<span class="text-danger">*Kosongkan Jika Tidak Ingin Merubah Password</span>
					</div>
					
				</div>

				<div class="row">

					<div class="form-group col-sm-6">
						<label>Tempat Lahir</label>
						<input type="text" name="anggota_tempat_lahir" placeholder="Tempat Lahir" class="form-control" value="<?=$anggota->anggota_tempat_lahir?>" autocomplete="off" required>
					</div>

					<div class="form-group col-sm-6">
						<label>Tanggal Lahir</label>
						<input type="date" name="anggota_tanggal_lahir" class="form-control tanggal" placeholder="Tanggal Lahir" value="<?=$anggota->anggota_tanggal_lahir?>" autocomplete="off" required>
					</div>
					
				</div>

				<div class="row">

					<div class="form-group col-md-6">
						<label>Jenis Kelamin</label>
						<select name="anggota_jk" class="form-control select2" required>
							<option value=""></option>
							<option value="L" <?=($anggota->anggota_jk == 'L') ? "selected" : ""?>>Laki - laki</option>
							<option value="P" <?=($anggota->anggota_jk == 'P') ? "selected" : ""?>>Perempuan</option>	
						</select>
					</div>

					<div class="form-group col-md-6">
						<label>No Telepon</label>
						<input type="text" name="anggota_hp" maxlength="20" placeholder="No Telepon" class="form-control" value="<?=$anggota->anggota_hp?>" onkeypress="return hanyaAngka(event)" autocomplete="off" required>
					</div>
					
				</div>

				<div class="form-group">
					<label>Foto Anggota</label>
					<input type="file" name="anggota_foto" accept="image/jpg,image/jpeg,image/png" class="form-control">
					<span class="text-danger">*Kosongkan Jika Tidak Ingin Mengubah Foto</span>
				</div>

				<div class="form-group">
					<label>Alamat</label>
					<textarea name="anggota_alamat" class="form-control" placeholder="Alamat"><?=$anggota->anggota_alamat?></textarea>
				</div>
				<div class="form-group">
					<a href="<?=base_url('anggota')?>" class="btn btn-danger btn-md pull-left"><< Kembali</a>

					<button type="submit" class="btn btn-primary btn-md pull-right" name="update">Update</button>
				</div>

				
			</form>
		</div>
  </div>

</div>

