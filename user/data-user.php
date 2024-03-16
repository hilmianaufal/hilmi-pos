<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/modul-user.php';

$title= 'Tambah User-HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">Data Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Data User</h3>
            <div class="card-tools">
              <a href="<?= $main_url ?>user/add-user.php" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Add User</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap ">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Username</th>
                  <th>Fullname</th>
                  <th>Alamat</th>
                  <th>Level User</th>
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      $datas = getDataUser("SELECT * FROM tbl_user");
                      foreach($datas as $data) :
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><img src="../asset/img/<?= $data['foto'] ?>" class="rounded-circle"  width="50px"></td>
                  <td><?= $data['username'] ?></td>
                  <td><?= $data['fullname'] ?></td>
                  <td><?= $data['address'] ?></td>
                  <td>
                    <?php
                      if ($data['level'] == 1) {
                        echo "Administrator";
                      }else if($data['level'] == 2) {
                        echo "Supervisor";
                      }else{
                        echo "Operator";
                      }
                    ?>
                  </td>
                  <td>
                    <a href="edit-user.php?id=<?= $data['user_id'] ?>" class="btn btn-warning" title="Edit Data"><i class="fas fa-user-edit"></i></a>
                    <a href="del-user.php?id=<?=$data['user_id'] ?>&foto=<?= $data['foto'] ?>" class="btn btn-danger" title="Edit Data" onclick="confirm('Apakah Yakin Ingin Menghapus User ini ?')"><i class="fas fa-trash"></i></a>
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
require_once '../templates/footer.php'
?>