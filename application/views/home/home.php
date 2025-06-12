<div class="row">

	<div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="img-responsive img-rounded img-thumbnail" src="<?=base_url($img)?>" alt="User profile picture">

          <h3 class="profile-username text-center"><?=$anggota['anggota_nama']?></h3>
          <p class="text-muted text-center"><?=$anggota['anggota_no']?></p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong>NIK</strong>

          <p class="text-muted">
            <?=$anggota['anggota_no_identitas']?>
          </p>

          <hr>

          <strong>Tempat, Tanggal Lahir</strong>

          <p class="text-muted">
            <?=$anggota['anggota_tempat_lahir']?>, <?=$anggota['anggota_tanggal_lahir']?>
          </p>

          <hr>

          <strong>Jenis Kelamin</strong>

          <p class="text-muted">
            <?=($anggota['anggota_jk'] == 'L') ? "Laki-laki" : "" ?>
          </p>

          <hr>

          <strong>Alamat</strong>

          <p class="text-muted">
            <?=$anggota['anggota_alamat']?>
          </p>

          <hr>


        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#simpanan" data-toggle="tab">Simpanan</a></li>
          <li><a href="#detailsimpanan" data-toggle="tab">Detail Simpanan</a></li>
          <li><a href="#pinjaman" data-toggle="tab">Pinjaman</a></li>
          
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="simpanan">

            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover"
              id="jenis_simpanan"> 

              <thead>
                
                <tr>
                  <th width="5">No</th>
                    <th width="50">Nomor</th>
                    <th>NIK</th>
                    <th>Nama Anggota</th>
                    <th>Jenis Kelamin</th>
                    <th>Jumlah Simpanan</th>
                    <th>Jumlah Pengambilan</th>
                    <th>Saldo</th>
              </tr>

            </thead>
            <tbody>
              <?php
              $no=1;
              foreach($dt_simpanan->result_array() as $db){
                  if($db['anggota_jk']=='L'){
                    $sex = 'Laki-laki';
                  }else{
                    $sex = 'Perempuan';
                  }

                  $saldo = $db['jumlah_simpanan'] - $db['jumlah_pengambilan']
              ?>    
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td align="center"><?php echo $db['anggota_no']; ?></td>
              <td align="center"><?php echo $db['anggota_no_identitas']; ?></td>
              <td><?php echo $db['anggota_nama']; ?></td>
              <td align="center"><?php echo $sex; ?></td>
              <td align="right"><?php echo number_format($db['jumlah_simpanan']); ?></td>
              <td align="right"><?php echo number_format($db['jumlah_pengambilan']); ?></td>
              <td align="right"><?php echo number_format($saldo); ?></td>
            </tr> 

                <?php } ?>
                </tbody>
              </table>
            </div>
   
          </div>

          <div class="tab-pane" id="detailsimpanan">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="detail_jenis_simpanan">

                  <thead>
                    <tr>
                        <th width="5">No</th>
                        <th width="150">Tanggal</th>
                        <th>Jenis Simpanan</th>
                        <th>Jumlah Simpanan</th>
                        <th>Jumlah Pengambilan</th>
                        <th>Saldo</th>
                    </tr>
                  </thead>

                  <tbody>

                    <?php

                      $simpan=0;
                      $ambil = 0;
                      $saldo = 0;
                      $no =1;
                      
                      foreach($detail->result_array() as $dbb){
                      $tgl = $dbb['tgl'];
                      $jenis = $this->M_home->nama_jenis($dbb['id_jenis']); 
                      $ket = $dbb['ket'];
                      if($ket=='simpan'){
                        $simpan = $dbb['jumlah'];
                        $ambil = 0;
                      }else{
                        $simpan = 0;
                        $ambil = $dbb['jumlah'];
                      }
                        $saldo = $saldo+$simpan-$ambil;//$db['jumlah_simpanan'] - $db['jumlah_pengambilan']
                    ?>

                    <tr>
                      <td align="center"><?php echo $no++; ?></td>
                      <td align="center"><?php echo $tgl; ?></td>
                      <td align="left"><?php echo $jenis; ?></td>
                      <td align="right"><?php echo number_format($simpan); ?></td>
                      <td align="right"><?php echo number_format($ambil); ?></td>
                      <td align="right"><?php echo number_format($saldo); ?></td>
                    </tr>

                  <?php } ?>
                  </tbody>

                </table>
            </div>

          </div>

          <div class="tab-pane" id="pinjaman">

            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="jenis_pinjaman">

                <thead>

                  <tr>
                    <th width="5">No</th>
                    <th width="50">Nomor</th>
                    <th>Tanggal</th>
                    <th>Nomor Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Jenis Kelamin</th>
                    <th>Lama</th>
                    <th>Jumlah</th>
                    <th>Bunga</th>
                    <th>Jumlah Bayar</th>
                    <th>Jumlah Cicilan</th>
                    <th>Sisa</th>
                    <th>Action</th>
                  </tr>

                </thead>

                <tbody>

                  <?php
                  $no=1;
                  foreach($pinjaman->result_array() as $da){
                      if($da['anggota_jk']=='L'){
                        $sex = 'Laki-laki';
                      }else{
                        $sex = 'Perempuan';
                      }
                      $jml_bayar = $da['jumlah']+($da['jumlah']*$da['bunga']/100);
                      $jml_cicilan = $this->M_home->jmlCicilan($da['id_pinjam']);
                      $sisa = $jml_bayar-$jml_cicilan;
                  ?>
                  <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td align="center"><?php echo $da['id_pinjam']; ?></td>
                    <td align="center"><?php echo $da['tgl']; ?></td>
                    <td align="center"><?php echo $da['anggota_no']; ?></td>
                    <td><?php echo $da['anggota_nama']; ?></td>
                    <td align="center"><?php echo $sex; ?></td>
                    <td align="center"><?php echo $da['lama']." Bulan"; ?></td>
                    <td align="right"><?php echo number_format($da['jumlah']); ?></td>
                    <td align="center"><?php echo $da['bunga']."%"; ?></td>
                    <td align="right"><?php echo number_format($jml_bayar); ?></td>
                    <td align="right"><?php echo number_format($jml_cicilan); ?></td>
                    <td align="right"><?php echo number_format($sisa); ?></td>
                    <td align="center">
                      <a target="_blank" href="<?=site_url('pinjaman/cetak/'.$da['id_pinjam'])?>" class="btn btn-md btn-danger"><i class="glyphicon glyphicon-print"></i>
                      
                      </a>
                    </td>
                  </tr>

                <?php } ?>

                </tbody>

              </table>
            </div>

          </div>


        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>

</div>

