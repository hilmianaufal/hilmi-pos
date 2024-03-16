<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-customer.php';

$title= 'Data Customer - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if (isset($_GET['msg'])){
    $msg = $_GET ['msg'];
}else {
    $msg= '';
}

$alert = '';

if($msg == 'deleted'){
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="icon fas fa-times"></i>Customer Berhasil Di Hapus
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}



?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Data Customer</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card">
           <?php 
           if($msg !== ''){
                echo $alert;
            }else {
                $alert='';
            } 
            ?>
          <div class="card-header">
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Data Customer</h3>
            <div class="card-tools">
              <a href="<?= $main_url ?>customer/add-customer.php" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Add Customer</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap " id="tblData">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Deskripsi</th>
                  <th>Alamat</th>
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      $datas = getDataCustomer("SELECT * FROM tbl_customer");
                      foreach($datas as $data) :
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data ['nama'] ?></td>
                  <td><?= $data['telpon'] ?></td>
                  <td><?= $data['deskripsi'] ?></td>
                  <td><?= $data['alamat'] ?></td>
                  <td>
                    <a href="edit-customer.php?id=<?= $data['id_customer'] ?>" class="btn btn-warning" title="Edit Data"><i class="fas fa-user-edit"></i></a>
                    <a href="del-customer.php?id=<?=$data['id_customer'] ?>" class="btn btn-danger" title="Edit Data" onclick="confirm('Apakah Yakin Ingin Menghapus User ini ?')"><i class="fas fa-trash"></i></a>
                </td>
               
                </tr>
                
                <?php endforeach ;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>
  

<?php 
require_once '../templates/footer.php';
?>
