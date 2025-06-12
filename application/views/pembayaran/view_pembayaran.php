
  

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">RIWAYAT PEMBAYARAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">

    <a class="btn btn-danger btn-md pull-right" target="_blank" href="<?=site_url('pembayaran/cetak/'.$id)?>"><i class="glyphicon glyphicon-print"></i> Cetak</a>

    <br>
    <br>

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" id="anggota" style="width:100%">
        <thead>
          <tr class="bg-primary">
              <th width="5">No</th>
              <th>Cicilan</th>
              <th>Angsuran</th>
              <th>Bunga</th>
              <th width="150">Tanggal JT</th>
              <th width="150">Tanggal Bayar</th>
              <th>Jumlah Bayar</th>
          </tr> 
        </thead>

        <tbody>
          <?php
          $t_angsuran=0;
          $t_bunga=0;
          $t_jml=0;
          $no =1;
          if($pinjaman->num_rows()>0){

            foreach($pinjaman->result_array() as $db){
              $tgl = $db['tgl_jatuh_tempo'];
              $tgl_bayar = $db['tgl_bayar'];
              $jml = $db['jumlah_bayar'];

          ?>

          <tr>
            <td align="center"><?php echo $no; ?></td>
            <td><?php echo $db['cicilan']; ?></td>
            <td align="right">Rp.<?php echo number_format($db['angsuran']); ?></td>
            <td align="right">Rp.<?php echo number_format($db['bunga']); ?></td>
            <td align="center"><?php echo $tgl; ?></td>
            <td align="center"><?php echo $tgl_bayar; ?></td>
            <td align="right">Rp.<?php echo number_format($jml); ?></td>
          </tr>
          <?php 
            $t_angsuran = $t_angsuran+$db['angsuran'];
            $t_bunga = $t_bunga+$db['bunga'];
            $t_jml  = $t_jml+$jml;
            $no++;
          }
          ?>

          <?php }else{ ?>
            <tr>
              <td colspan="7" align="center" >Tidak Ada Data</td>
            </tr>
          <?php } ?>

          <tfoot>
            <tr class="bg-danger">
                <td colspan="2" >Total</td>
                <td align="right">Rp.<?php echo number_format($t_angsuran);?></td>
                <td align="right">Rp.<?php echo number_format($t_bunga);?></td>
                <td colspan="2"></td>
                <td align="right">Rp.<?php echo number_format($t_jml);?></td>
            </tr>
          </tfoot>

        </tbody>
      </table>
    </div>

  </div>

</div>