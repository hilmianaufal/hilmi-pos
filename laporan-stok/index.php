<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-barang.php';

$title= 'Laporan Penjualan - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

$stokBrg = getDataBarang('SELECT * FROM tbl_barang');

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stok Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Stok</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <section class="content">
      <div class="container-fluid">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Stok</h3>
            <div class="card-tools">
                <a href="<?= $main_url ?>report/r-stok.php" class="btn-sm btn-outline-primary btn float-right" target="_blank  "><i class="fas fa-print"></i> Cetak</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap " id="tblData">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Satuan</th>
                  <th>Jumlah Stok</th>
                  <th>Stok Minimal</th>              
                  <th>Status</th>              
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      
                      foreach($stokBrg as $data) { ?>
                        <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id_barang'] ?></td>                    
                        <td><?= $data['nama_barang'] ?></td>                                       
                        <td><?= $data['satuan'] ?></td>                    
                        <td><?= $data['stock'] ?></td>                    
                        <td><?= $data['stock_minimal'] ?></td> 
                        <td>
                        <?php
                        if ($data['stock']< $data['stock_minimal']) { 
                            echo "<span class='text-danger'> Stock Kurang </span>";
                             
                         }else {
                            echo "<span class='text-success'> Stock Cukup </span>";
                         }
                        ?>
                        </td>
                        </tr>              
                      <?php } ?>
               
                
                
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>


    </div>
</div>



<?php require_once '../templates/footer.php' ?>