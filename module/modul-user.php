<?php

if (userLogin()['level'] != 1) {
    header("location:" .$main_url. "eror-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi,$data['fullname']);
    $password = mysqli_real_escape_string($koneksi,$data['password']);
    $password2 = mysqli_real_escape_string($koneksi,$data['password2']);
    $level = mysqli_real_escape_string($koneksi,$data['level']);
    $address = mysqli_real_escape_string($koneksi,$data['address']);
    $gambar = mysqli_real_escape_string($koneksi,$_FILES['image']['name']);

    if ($password !== $password2) {
        echo "<script>
        alert('Password tidak Sama Dengan Konfirmasi Password, User Baru Gagal Di Registrasi')
        </script>";
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername =mysqli_query($koneksi , "SELECT username FROM tbl_user WHERE username = '$username' ");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo "<script>
        alert('Username Sudah Tersedia, User Baru Gagal Di Registrasi')
        </script>";
        return false;
    }

    if ($gambar != '') {
        $gambar = uploadImage();
    }else{
        $gambar = 'default.png';
    }
    // gambr tidak sesuai validasi

    if ($gambar == '') {
        return false;
    }

    $strUser= "INSERT INTO tbl_user VALUES ('','$username','$fullname','$pass','$address','$level','$gambar')";
    $result = mysqli_query($koneksi,$strUser);

    return mysqli_affected_rows($koneksi);
}

function selectUser1($level){
    $result = null;
    if ($level == 1 ){
        $result = "selected";
    }
    return $result;
}

function selectUser2($level){
    $result = null;
    if ($level == 2 ){
        $result = "selected";
    }
    return $result;
}

function selectUser3($level){
    $result = null;
    if ($level == 3 ){
        $result = "selected";
    }
    return $result;
}

function update($data){
    global $koneksi;
    $id = $data['id'];
    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi,$data['fullname']);
    $level = mysqli_real_escape_string($koneksi,$data['level']);
    $address = mysqli_real_escape_string($koneksi,$data['address']);
    $gambar = mysqli_real_escape_string($koneksi,$_FILES['image']['name']);
    $fotoLama = mysqli_real_escape_string($koneksi,$data['oldimage']);

    // cek username Sekarnag

    $queryUsername = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE user_id = $id");
    $dataUsername = mysqli_fetch_assoc($queryUsername);
    $curUsername = $dataUsername['username'];

    // cek username Bru

    $newUsername = mysqli_query($koneksi,"SELECT username FROM tbl_user WHERE username='$username'");

    if ($username !== $curUsername){
        if(mysqli_num_rows($newUsername)){
            echo "<script>
        alert('Username Sudah Terpakai, Update User Gagal Di Registrasi')
        </script>";
        return false;
        }
    }

    // cek gambar

    if($gambar != ''){
        $url = "data-user.php";
        $imgUser = uploadImage($url);
        if($fotoLama != 'default.png'){
            @unlink('../asset/img/' . $fotoLama);
        }
    }else{
        $imgUser = $fotoLama;
    }

    mysqli_query($koneksi,"UPDATE tbl_user SET
                            username = '$username',
                            fullname = '$fullname',
                            address = '$address',
                            level = '$level',
                            foto = '$imgUser' WHERE 
                            user_id = '$id'

                             ");
   
    return mysqli_affected_rows($koneksi);
}