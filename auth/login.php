<?php

session_start();

if (isset($_SESSION['ssLoginPOS'])) {

      header("Location: ../dashboard.php");
}

require_once '../config.php';

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $queryLogin = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE username='$username'");

    if(mysqli_num_rows($queryLogin)===1){
        $row = mysqli_fetch_assoc($queryLogin);
        if(password_verify($password, $row['password'])){
            // set session
            $_SESSION['ssLoginPOS'] = true;
            $_SESSION['ssUserPOS'] = $username;
            header("location: ../dashboard.php");
            exit();
        }else{
            echo "<script>
            alert('Password Salah');
            </script>";
            
        }
    }else {
        echo "<script>
        alert('Username tidak terdaftar');
        </script>";
        
    }
   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - HilmiPos (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $main_url ?>asset/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= $main_url ?>asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $main_url ?>asset/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="<?= $main_url ?>asset/img/1.jfif" type="image/x-icon">
  <link rel="stylesheet" href="../style.css">
</head>
<body class="hold-transition login-page" >
<div class="login-box slide-down" style="margin-top: -70px">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Hilmi</b>Pos</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" autocomplete="off" name="username" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
       
          <!-- /.col -->
          <div class="mb-4">
            <button type="submit" name="login" class="btn btn-primary btn-block ">Sign In</button>
          </div>
          <!-- /.col -->
    
      </form>

      <p class="mb-0 my-3 text-center">
       <strong>Copyright &copy; 2024 <span class="text-info">HilmiPos</span></strong>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= $main_url ?>../asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= $main_url ?>../asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $main_url ?>../asset/dist/js/adminlte.min.js"></script>
</body>
</html>
