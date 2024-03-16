<?php

if (userLogin()['level'] == 3 ) {
    header("Location: eror-page.php");
    exit();
}

function insert ($data){
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);

    $sqlSupplier = "INSERT INTO tbl_supplier VALUES ('','$nama','$telpon','$keterangan','$alamat')";

    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);

}

function updateSupplier($data){
    global $koneksi;
    $id_supplier = $_GET['id'];
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);

    $sqlSupplier = "UPDATE tbl_supplier SET 
                    nama = '$nama',
                    telpon = '$telpon',
                    deskripsi = '$keterangan',
                    alamat = '$alamat'
                        WHERE 
                    id_supplier = '$id_supplier'
                        ";
    mysqli_query($koneksi, $sqlSupplier); 
    return mysqli_affected_rows($koneksi);

}