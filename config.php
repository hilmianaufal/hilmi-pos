<?php 


date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'db_hilmipos';

$koneksi = mysqli_connect($host,$user,$pass,$db_name);

// if(mysqli_connect_errno()){
//     echo 'Koneksi Gagal' ;
//     exit();
// }else {
//     echo 'Koneksi Berhasil';
// }

$main_url = 'http://localhost/hilmi-pos/';
