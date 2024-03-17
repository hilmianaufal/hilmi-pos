<?php

session_start();



if(!isset($_SESSION['ssLoginPOS'])){
    header("Location: ../auth/login.php");

}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-barang.php';

$title = 'Form Customer - HilmiPOS';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

$alert = '';

if(isset($_POST['simpan'])){
    if(insertCustomer($_POST)){
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check"></i>Customer Berhasil Di Tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
}


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>customer/data-customer.php">Data Barang</a></li>
              <li class="breadcrumb-item">Add Barang</li>                        
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Tambah Barang</h3>
                    <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" name="" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8 mb-3 pr-3">
                        <div class="form-group">
                            <label for="kode">Kode Barang</label>
                            <input type="text" value="<?= generateId() ?>" name="kode" class="form-control" id="kode"  autofocus autocomplete="off" readonly>
                         </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" class="form-control" id="barcode"  autofocus autocomplete="off" required>
                         </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama"  autofocus autocomplete="off" required>
                         </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select name="satuan" id="satuan" class="form-control" required>
                                <option value="">-- Satuan Barang --</option>
                                <option value="piece"> Piece </option>
                                <option value="botol">Botol</option>
                                <option value="Kaleng">Kaleng</option>
                                <option value="Kaleng">Pouch</option>
                            </select>
                         </div>
                         <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" id="harga_beli" placeholder = "Rp 0"  autocomplete="off" required>
                         </div>
                         <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" id="harga_jual" placeholder = "Rp 0"  autocomplete="off" required>
                         </div>
                         <div class="form-group">
                            <label for="stock_minimal">Stock Minimal</label>
                            <input type="number" name="stock_minimal" class="form-control" id="stock_minimal" placeholder = "Rp 0"  autocomplete="off" required>
                         </div>
                        </div>
                        <div class="col-md-4 text-center px-3">
                            <img src="<?= $main_url?>asset/img/barang.png" class="profile-user-img rounded-circle mb-3 mt-4" widht="50px" alt="">
                            <input type="file" name="image" class="form control"><br> 
                            <span class="text-sm">Type File Jpg, Png, Jpeg dan Gif</span>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </section>


<?php require_once '../templates/footer.php' ?>