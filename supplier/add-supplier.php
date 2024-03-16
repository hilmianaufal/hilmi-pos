<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
  exit();
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-supplier.php';

$title= 'Supplier - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

$alert = '';

if(isset($_POST['simpan'])){
    if(insert($_POST)){
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fas fa-check"></i>Supplier Berhasil Di Tambahkan
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
            <h1 class="m-0">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>supplier/supplier.php">Data Supplier</a></li>
              <li class="breadcrumb-item">Data Supplier</li>                        
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" >
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Add Supplier</h3>
                    <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" name="" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 mb-3">
                        <?php if($alert !== ''){
                            echo $alert;
                        } ?>
                          <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder ="nama supplier" autofocus autocomplete="off" required>
                          </div>
                          <div class="form-group">
                            <label for="telpon">Telephone</label>
                            <input type="text" name="telpon" class="form-control" id="telpon" placeholder ="no telepon supplier" pattern="[0-9]{5,}"  required>
                          </div>
                          <div class="form-group">
                            <label for="keterangan">Deskripsi</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="1" class="form-control" placeholder="Keterangan Supplier" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="Alamat Supplier" required></textarea>
                          </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
<?php 
require_once '../templates/footer.php';
?>