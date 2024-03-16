<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';


$id = $_GET['id'];
$foto = $_GET['foto'];

if(delete($id, $foto)){
    echo "<script>
    alert('Data User Berhasil Di Hapus')
    document.location.href= 'data-user.php';
    </script>";
}else{
    echo "<script>
    alert('Data User Gagal Di Hapus')
    document.location.href= 'data-user.php';
    </script>";
}