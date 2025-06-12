<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">FORM TAMBAH DATA PINJAMAN ANGGOTA</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="col-md-12">
			<form action="<?=base_url('pinjaman/add_action')?>" method="POST" enctype="multipart/form-data">


				<div class="row">

					<div class="form-group col-sm-6">
						<label>ID Pinjaman</label>
						<input type="text" name="id_pinjam" class="form-control" placeholder="ID Pinjaman" required readonly>
					</div>

					<div class="form-group col-sm-6">
						<label>No.Identitas</label>
						<input type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas" class="form-control" required disabled>
					</div>
					
				</div>
				

				<div class="row">

					<div class="form-group col-sm-6">
						<label>No.Anggota</label>
						<select name="anggota_no" id="anggota_no" class="form-control select2" autofocus required>
							<option value=""></option>
							<?php
							foreach (ViewAnggota() as $a) { ?>
								<option value="<?=$a->anggota_no?>"><?=$a->anggota?></option>
							<?php } ?>
						</select>
					
					</div>

					<div class="form-group col-sm-6">
						<label>Nama Anggota</label>
						<input type="text" name="nama_anggota" id="nama_anggota" placeholder="Nama Anggota" class="form-control" required disabled>
					</div>
					
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<label>Tanggal</label>
						<input type="date" name="tgl" class="form-control tanggal" placeholder="Pilih Tanggal" value="<?=date('Y-m-d')?>" readonly required>
					</div>

					<div class="form-group col-sm-6">
						<label>Jenis Kelamin</label>
						<input type="text" name="anggota_jk" id="anggota_jk" class="form-control" placeholder="Jenis Kelamin" disabled>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-sm-6">
						<label>Lama Pinjaman</label>
						<select name="lama" class="form-control lama">
							<option value="6">6 Bulan</option>
							<option value="10">10 Bulan</option>
							<option value="12">12 Bulan</option>
							<option value="24">24 Bulan</option>
						</select>
					</div>

					<div class="form-group col-sm-6">
						<label>Telepon</label>
						<input type="text" name="anggota_hp" id="anggota_hp" class="form-control" placeholder="Telepon" disabled>
					</div>
				</div>

				<div class="row">

					<div class="form-group has-feedback col-sm-6">
						<label>Bunga</label>
						<input type="text" name="bunga" placeholder="Bunga" class="form-control" onkeypress="return hanyaAngka(event)" maxlength="2" value="20" readonly>
						<span class="form-control-feedback">%</span>
					</div>

				    <div class="form-group col-sm-6">
				    	<label>Sisa Angsuran</label>
				    	<input type="text" name="sisa_angsuran" id="sisa_angsuran" placeholder="Sisa Angsuran" class="form-control" disabled>
				    </div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Jumlah Pinjaman</label>
						<input type="text" name="jumlah" class="form-control" onkeypress="return hanyaAngka(event)" onkeyup="oke(this.value)" placeholder="Jumlah" id="rupiah">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Biaya Admin</label>
						<input type="text" name="biaya_admin" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Biaya Admin" id="rupiah2" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Simpanan</label>
						<input type="text" name="simpanan" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Simpanan" id="rupiah3" readonly>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label>Jumlah Diterima</label>
						<input type="text" name="jumlah_diterima" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Jumlah Diterima" id="rupiah4" readonly>
					</div>
				</div>

		
				<div class="form-group">
					<a href="<?=base_url('pinjaman')?>" class="btn btn-danger btn-md pull-left"><< Kembali</a>

					<button type="submit" class="btn btn-primary btn-md pull-right" name="simpan" id="simpan">Simpan</button>
				</div>

				
			</form>
		</div>
  </div>

</div>


