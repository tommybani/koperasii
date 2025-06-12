<style type="text/css">
.tengah .tampil_data {
  margin:0px;
}
</style>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Laporan Penarikan Dana Anggota</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">

    

    <div class="tengah">
      <table width="100%">
        <tr>
          <td width="20%"><input type="radio" name="pilih" class="pilih" value="semua" checked="checked" /> Semua Data</td>
            <td></td>
        </tr>
        <tr>
          <td><input type="radio" name="pilih" class="pilih" value="tanggal" /> Tanggal</td>
          <td><input type="date" name="tanggal" id="tanggal" /></td>
        </tr>
          <tr>
            <td><input type="radio" name="pilih" class="pilih" value="anggota" /> Pilih Nomor Anggota</td>
              <td><input type="text" name="noanggota" placeholder="Masukkan Nomor Anggota" id="noanggota" /></td>
        </tr>
      </table>       
    </div>

    <div class="bawah">
      <div id="tombol_input">
          <center>
          <button name="cetak" id="cetak" class="btn btn-md btn-default" data-options="iconCls:'icon-print'"><i class="glyphicon glyphicon-print"></i> Cetak</button>
        </center>
      </div>      
    </div>

  </div>

</div>