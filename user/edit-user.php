<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/modul-user.php';

$title= 'Update User-HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if(isset($_POST['update'])){
    if(update($_POST) ){
        echo "<script>
        alert('Update User Berhasil ')
        document.location.href = 'data-user.php';
        </script>";
       
    }
  }


$id = $_GET['id'];
$sqlEdit = "SELECT * FROM tbl_user WHERE user_id = $id";
$result = mysqli_query($koneksi,$sqlEdit);
$data = mysqli_fetch_assoc($result);
$level = $data['level'];


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
              <li class="breadcrumb-item active">Edit User</li>
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
                    <h3 class="card-title"><i class="fas fa-pen fa-sm"></i> Edit User</h3>
                    <button type="submit" name="update" class="btn btn-primary btn-sm float-right "><i class="fas fa-save"></i> Simpan</button>
                    <button type="reset" name="" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                      <input type="hidden" value="<?=$data['user_id'] ?>" name="id">
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" value="<?= $data['username'] ?>" name="username" class="form-control" id="username" placeholder="Masukan Username" autofocus autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" value="<?= $data['username'] ?>" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">-- Level User -</option>
                                    <option value="1" <?= selectUser1($level) ?>>Administrator</option>
                                    <option value="2" <?= selectUser2($level) ?>>Super Visor</option>
                                    <option value="3" <?= selectUser3($level) ?>>Operator</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                               <textarea name="address" class="form-control" id="address" cols="30" rows="3" required><?= $data['address'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                                <input type="hidden" name="oldimage" value="<?=$data['foto']?>">
                                <img src="../asset/img/<?= $data['foto'] ?>" class="profile-user-img img-circle mb-3" alt="">
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