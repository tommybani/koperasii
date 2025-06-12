<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">BAYAR PINJAMAN ANGGOTA</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <form method="POST" action="<?=site_url('pembayaran/add_action')?>">
      
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
            <label>NIK</label>
            <input type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas" class="form-control" required disabled>
          </div>
          
        </div>

        <div class="row">

          <div class="form-group col-sm-6">
            <label>Tanggal</label>
            <input type="date" name="tgl_bayar" class="form-control tanggal" placeholder="Pilih Tanggal" autocomplete="off" value="<?=date('Y-m-d')?>" readonly required>
          </div>  

          <div class="form-group col-sm-6">
            <label>Nama Anggota</label>
            <input type="text" name="nama_anggota" id="nama_anggota" placeholder="Nama Anggota" class="form-control" required disabled>
          </div>

        </div>

        <div class="row">

          <div class="form-group col-sm-6">
            <label>ID Pinjaman</label>
            <input type="text" name="id_pinjam" id="id_pinjam" class="form-control" placeholder="ID Pinjaman" autocomplete="off" readonly>
          </div>

          <div class="form-group col-sm-6">
            <label>Jenis Kelamin</label>
            <input type="text" name="anggota_jk" id="anggota_jk" class="form-control" placeholder="Jenis Kelamin" disabled>
          </div>
          
        </div>

         <div class="row">


          <div class="form-group col-sm-6">
            <label>Lama</label>
            <input type="text" name="lama" id="lama" class="form-control" placeholder="Lama Pinjaman" autocomplete="off" readonly>
          </div>

          <div class="form-group col-sm-6">
            <label>Sisa Angsuran</label>
            <input type="text" name="sisa_angsuran" id="sisa_angsuran" class="form-control" placeholder="Sisa Angsuran" readonly>
          </div>
          
        </div>

        <div class="row">

          <div class="form-group col-sm-6">
            <label>Bunga</label>
            <input type="text" name="bunga" id="bunga" class="form-control" placeholder="Bunga" autocomplete="off" readonly>

          </div>

          <div class="form-group col-sm-6">
            <label>Cicilan / Angsuran</label>
            <input type="text" name="angsuran" id="angsuran" class="form-control" placeholder="Cicilan / Angsuran" readonly>
          </div>
          
        </div>

        <div class="row">
          <div class="form-group col-sm-6">
            <label>Jumlah</label>
            <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" autocomplete="off" readonly>
          </div>
        </div>

        <div class="form-group">
          <a href="<?=base_url('pembayaran')?>" class="btn btn-danger btn-md pull-left"><< Kembali</a>

          <button type="submit" class="btn btn-primary btn-md pull-right" name="simpan" id="simpan">Simpan</button>
        </div>

    </form>
  </div>

</div>



<div id="view_pinjaman"></div>
