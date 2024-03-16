<?php 


function updatePass($data){
    global $koneksi;
    $curPass = trim(mysqli_real_escape_string($koneksi, $_POST['curPass']));
    $newPass = trim(mysqli_real_escape_string($koneksi, $_POST['newPass']));
    $confPass = trim(mysqli_real_escape_string($koneksi, $_POST['confPass']));

    $userActive = userLogin()['username'];

    if ($newPass !== $confPass) {
        echo "<script>
        alert(' Password Gagal Di Perbaharui ')
        document.location.href = '?msg=err1';
        </script>";
    }

    if (!password_verify($curPass, userLogin()['password']) ) {
        echo "<script>
        alert('Password Gagal di Perbaharui')
        document.location.href = '?msg=err2';
        </script>";
        return false;
    } else {
        $pass = password_hash($newPass, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$userActive'");
        return mysqli_affected_rows($koneksi);
    }

}