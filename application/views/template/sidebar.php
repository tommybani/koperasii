  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
          $apaitu = 'assets/user.jpg';
          if ($this->session->userdata('level') == 'anggota') {
            $apaitu = 'assets/anggota/'.$this->session->userdata('foto');
          }
          ?>
          <img src="<?=base_url($apaitu)?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('nama')?></p>
          <?=($this->session->userdata('level') == 'anggota') ? "Anggota" : "Admin"?>
        </div>
      </div>


      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>

        <?php
        if ($this->session->userdata('level') != 'anggota') { ?>


          <li <?=($this->uri->segment(1) == 'Dashboard' || $this->uri->segment(1) == 'dashboard') ? 'class="active"' : ""?>>
            <a href="<?=site_url('Dashboard')?>">
              <i class="fa fa-tachometer"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview <?=($this->uri->segment(1) == 'anggota') ? "active" : ""?>">
            <a href="#">
              <i class="fa fa-table"></i> <span>Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($this->uri->segment(1) == 'anggota') ? "active" : ""?>"><a href="<?=base_url('anggota')?>"><i class="fa fa-circle-o"></i> Anggota</a></li>
            </ul>
          </li>

          <li class="treeview <?=($this->uri->segment(1) == 'simpanan' || $this->uri->segment(1) == 'pengambilan' || $this->uri->segment(1) == 'pinjaman') ? "active" : ""?>">
            <a href="#">
              <i class="fa fa-money"></i> <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($this->uri->segment(1) == 'simpanan') ? "active" : ""?>"><a href="<?=base_url('simpanan')?>"><i class="fa fa-circle-o"></i> Simpanan</a></li>
              <li class="<?=($this->uri->segment(1) == 'pengambilan') ? "active" : ""?>"><a href="<?=base_url('pengambilan')?>"><i class="fa fa-circle-o"></i> Penarikan Dana</a></li>
              <li class="<?=($this->uri->segment(1) == 'pinjaman') ? "active" : ""?>"><a href="<?=base_url('pinjaman')?>"><i class="fa fa-circle-o"></i> Pinjaman</a></li>
              <li class="<?=($this->uri->segment(1) == 'pembayaran') ? "active" : ""?>"><a href="<?=base_url('pembayaran')?>"><i class="fa fa-circle-o"></i> Pembayaran</a></li>
            </ul>
          </li>


          <li class="treeview <?=($this->uri->segment(1) == 'laporan') ? "active" : ""?>">
            <a href="#">
              <i class="fa fa-table"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($this->uri->segment(2) == 'anggota') ? "active" : ""?>"><a href="<?=base_url('laporan/anggota')?>"><i class="fa fa-circle-o"></i> Anggota</a></li>

              <li class="<?=($this->uri->segment(2) == 'simpanan') ? "active" : ""?>"><a href="<?=base_url('laporan/simpanan')?>"><i class="fa fa-circle-o"></i> Simpanan</a></li>

              <li class="<?=($this->uri->segment(2) == 'penarikan') ? "active" : ""?>"><a href="<?=base_url('laporan/penarikan')?>"><i class="fa fa-circle-o"></i> Penarikan</a></li>

              <li class="<?=($this->uri->segment(2) == 'pinjaman') ? "active" : ""?>"><a href="<?=base_url('laporan/pinjaman')?>"><i class="fa fa-circle-o"></i> Pinjaman</a></li>

              <li class="<?=($this->uri->segment(2) == 'pembayaran') ? "active" : ""?>"><a href="<?=base_url('laporan/pembayaran')?>"><i class="fa fa-circle-o"></i> Pembayaran</a></li>

              <li class="<?=($this->uri->segment(2) == 'tunggakan') ? "active" : ""?>"><a href="<?=base_url('laporan/tunggakan')?>"><i class="fa fa-circle-o"></i> Tunggakan</a></li>

            </ul>
          </li>

         <!--  <li <?=($this->uri->segment(1) == 'Pengaturan' || $this->uri->segment(1) == 'pengaturan') ? 'class="active"' : ""?>>
            <a href="<?=site_url('Pengaturan')?>">
              <i class="fa fa-wrench"></i> <span>Pengaturan</span>
            </a>
          </li> -->
          
        <?php }else{ ?>

        <?php } ?>
        

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>