<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-password.php';

$title= 'Change Password - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if(isset($_POST['simpan'])){
    if(updatePass($_POST)){
        echo "<script>
        alert('Password Berhasil Di Perbaharui ')
        document.location.href = 'change-pass.php';
        </script>";
    }
}

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg = '';
}

$alert1 = '<small class="text-danger font-italic pl-2">Konfirmasi Password tidak sama</small>';
$alert2 = '<small class="text-danger font-italic pl-2">Password Lama tidak sama</small>'

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="">Password</a></li>
         
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-key"></i> Change Password</h3>
                        <button type="submit" name="simpan" class="btn btn-primary float-right btn-sm"><i class="fa fa-edit"></i> Change</button>
                        <button type="reset" name="reset" class="btn btn-danger float-right btn-sm mr-1"><i class="fa fa-times"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-8 mb-3">
                            <div class="form-group">
                                <label for="curPass">Current Password</label>
                                <input type="password" name="curPass" id="curPass" class="form-control" placeholder="Masukan Password Anda saat ini" required>
                                <?php if($msg == 'err2'){
                                    echo $alert2;
                                } ?>
                            </div>
                            <div class="form-group">
                                <label for="newPass">New Password</label>
                                <input type="password" name="newPass" id="newPass" class="form-control" placeholder="Masukan Password Baru Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="confPass">Konfirmasi Password</label>
                                <input type="password" name="confPass" id="confPass" class="form-control" placeholder="Masukan Konfirmasi Password Baru Anda" required> 
                                <?php if($msg == 'err1'){
                                    echo $alert1;
                                } ?>
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