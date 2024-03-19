<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-barang.php';

$title= 'Data Barang - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if (isset($_GET['msg'])){
    $msg = $_GET ['msg'];
}else {
    $msg= '';
}

$alert = '';


if($msg == 'deleted') {
    $id = $_GET['id'];
    $foto = $_GET['foto'];
    if(delBarang($id, $foto)){
    $alert = "<script>
            $(document).ready(function(){
              $(document).Toasts('create',{
                title : 'Sukses',
                body : 'Data Barang Berhasil Di Hapus',
                class : 'bg-success',
                icon : 'fas fa-check-circle' 
              })
            });
    </script>";
}
}
if($msg == 'updated') {
   
    $alert = "<script>
            $(document).ready(function(){
              $(document).Toasts('create',{
                title : 'Sukses',
                body : 'Data Barang Berhasil Di Update',
                position : 'bottomRight',
                class : 'bg-success',
                icon : 'fas fa-check-circle', 
                autohide : true,
                delay : 5000
              })
            });
    </script>";

}

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Barang</li>
              
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
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Data Barang</h3>
            <div class="card-tools">
              <a href="<?= $main_url ?>barang/form-barang.php" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Add Barang</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap " id="tblData">
              <thead>
                <tr>
                  <th>Gambar</th>
                  <th>Id Barang</th>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>              
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      $datas = getDataBarang("SELECT * FROM tbl_barang");
                      foreach($datas as $data) :
                ?>
                <tr>
                 <td><img src="../asset/img/<?= $data['gambar'] ?>" width="60px" class="rounded-circle" alt=""></td>
                  <td><?= $data['id_barang']?></td>
                  <td><?= $data ['barcode'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td class="text-center"><?= number_format( $data['harga_beli'],0,',','.') ?></td>
                  <td><?= number_format( $data['harga_jual'],0,',','.') ?></td>
                  <td>
                    <a href="form-barang.php?id=<?= $data['id_barang'] ?>&msg=editing" class="btn btn-warning" title="Edit Data"><i class="fas fa-user-edit"></i></a>
                    <a href="?id=<?=$data['id_barang'] ?>&foto=<?= $data['gambar'] ?>&msg=deleted" class="btn btn-danger" title="Edit Data" onclick="confirm('Apakah Yakin Ingin Menghapus User ini ?')"><i class="fas fa-trash"></i></a>
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
