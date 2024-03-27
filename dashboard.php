<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: auth/login.php");
  exit();
}

require_once'config.php';
require_once 'functions.php';
$title = 'Dashboard - HilmiPos';
require_once 'templates/header.php';
require_once 'templates/navbar.php';
require_once 'templates/sidebar.php';

$user = getDataUser("SELECT * FROM tbl_user");
$dataUser = count($user);

$supplier = getDataSupplier("SELECT * FROM tbl_supplier");
$dataSupplier = count($supplier);

$customer = getDataCustomer("SELECT * FROM tbl_customer");
$dataCustomer = count($customer);

$barang = getDataBarang("SELECT * FROM tbl_barang");
$dataBarang = count($barang)

?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $dataUser ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= $main_url ?>user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $dataSupplier ?></h3>

                <p>Suplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-bus"></i>
              </div>
              <a href="<?= $main_url ?>supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $dataCustomer ?></h3>

                <p>Customer</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="<?= $main_url ?>customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $dataBarang ?></h3>

                <p>Item Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="<?= $main_url ?>barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="card card-outline card-danger">
                <div class="card-header text-info">
                  <h5 class="card-title">Info Stok Barang</h5>
                  <h5><a href="stock" class="float-right"><i class="fas fa-arrow-alt-circle-right"></i></a></h5>
                </div>
                <table class="table">
                    <tbody>
                      <?php 
                      $stockMin = getDataBarang("SELECT * FROM tbl_barang WHERE stock < stock_minimal");

                      foreach($stockMin as $min) { ?>
                        <tr>
                          <td><?= $min['nama_barang'] ?></td>
                          <td class="text-danger">Stock Kurang</td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card card-outline card-success">
                <div class="card-header text-info">
                  <h5>Omset Penjualan</h5>
                </div>
                <div class="card-body text-primary">
                  <h2><span class="h4">Rp. </span><b><?= omset() ?></b></h2>
                </div>
              </div>
            </div>
          </div>

    </div>
    <!-- Main content -->
    <div class="content">
   </div>
    <!-- /.content -->
 <?= 
 require_once 'templates/footer.php';
 ?>
