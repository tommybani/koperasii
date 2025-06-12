<?=$this->session->flashdata('message') ? $this->session->flashdata('message') : "" ?>

<a class="btn btn-danger btn-md" href="<?=site_url('dashboard')?>"><< Kembali</a>
<br>
<br>
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
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#simpanan" data-toggle="tab">Simpanan</a></li>
          <li><a href="#pengambilan" data-toggle="tab">Penarikan Dana</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="simpanan">

            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="jenis_simpanan"> 
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>jenis Simpanan</th>
                    <th>Jumlah Simpanan</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  $sum=0;
                  foreach ($simpanan as $s) {
                    $sum += $s['jumlah'];
                  ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$s['tgl']?></td>
                      <td><?=$s['jenis_simpanan']?></td>
                      <td>Rp. <?=number_format($s['jumlah'])?></td>
                      <td style="text-align: center;">
                        <a class="btn btn-md btn-danger" 
                        href="<?=site_url('Api/delete_simpanan/'.$s['id_simpanan']."/".$s['anggota_no'])?>"><i class="glyphicon glyphicon-trash"></i></a>

                        <a target="_blank" class="btn btn-md btn-success" 
                        href="<?=site_url('simpanan/cetak/'.$s['id_simpanan'])?>"><i class="glyphicon glyphicon-print"></i></a>


                        <!-- <a class="btn btn-md btn-success" href="<?=site_url('Api/cetak/'.$s['id_simpanan'])?>"><i class="glyphicon glyphicon-print"></i></a> -->
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>

                <?php
                if (count($simpanan) > 0) { ?>

                  <tfoot>
                    <th colspan="3" style="text-align:right;">Total Simpanan</th>
                    <th colspan="2">Rp. <?=number_format($sum)?></th>
                  </tfoot>

                <?php } ?>
                
              </table>
            </div>
   
          </div>

          <div class="tab-pane" id="pengambilan">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" id="penarikan">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>jenis Simpanan</th>
                    <th>Jumlah Penarikan</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  $sum_tarik=0;
                  foreach ($pengambilan as $p) {
                    $sum_tarik += $p['jumlah'];
                  ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$p['tgl']?></td>
                      <td><?=$p['jenis_simpanan']?></td>
                      <td>Rp. <?=number_format($p['jumlah'])?></td>
                      <td style="text-align: center;">
                        <a class="btn btn-md btn-danger" 
                        href="<?=site_url('Api/delete_pengambilan/'.$p['id_ambil']."/".$p['anggota_no'])?>"><i class="glyphicon glyphicon-trash"></i></a>

                        <a target="_blank" class="btn btn-md btn-success" 
                        href="<?=site_url('pengambilan/cetak/'.$p['id_ambil'])?>"><i class="glyphicon glyphicon-print"></i></a>
                        <!-- <a class="btn btn-md btn-success" href="<?=site_url('Api/cetak/'.$s['id_simpanan'])?>"><i class="glyphicon glyphicon-print"></i></a> -->
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <?php
                if (count($pengambilan) > 0) { ?>

                  <tfoot>
                    <th colspan="3" style="text-align:right;">TotalPenarikan  Dana</th>
                    <th colspan="2">Rp. <?=number_format($sum_tarik)?></th>
                  </tfoot>
                  
                <?php } ?>
                
              </table>
            </div>
          </div>


        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>