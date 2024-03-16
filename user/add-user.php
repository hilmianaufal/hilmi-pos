<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
  exit();
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/modul-user.php';

$title= 'Tambah User-HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if(isset($_POST['simpan'])){
    if(insert($_POST)>0){
        echo "<script>
        alert('User Baru Berhasil Di Tambahkan')
        </script>";
       
    }
}


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url ?>user/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Add User</h3>
                    <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" name="" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" autofocus autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password" required>
                            </div>
                            <div class="form-group">
                                <label for="password2">Konfirmasi Password</label>
                                <input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">-- Level User -</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Operator</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                               <textarea name="address" class="form-control" id="address" cols="30" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                                <img src="<?= $main_url ?>asset/img/default.png" class="profile-user-img img-circle mb-3" alt="">
                                <input type="file" class="form-control" name="image">
                                <span class="text-sm">Type File Gambar Jpg | Png | Jpeg | Gif</span><br>
                                <span class="text-sm">Widht = Height</span>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        </div>


    </section>

<?php

require_once '../templates/footer.php'
?>