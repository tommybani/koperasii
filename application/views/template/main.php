<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?=(isset($title)) ? $title : ''?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php (isset($content)) ? $this->load->view($content) : ''?>
    </section>

  </div>
<?php $this->load->view('template/footer'); ?>