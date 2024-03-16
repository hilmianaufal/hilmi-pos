<?php

require_once '../config.php';
require_once '../functions.php';


function insertCustomer ($data){
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data ['telpon']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);

    $sqlCustomer = "INSERT INTO tbl_customer VALUES 
                        ('','$nama','$telpon','$keterangan','$alamat')";
    mysqli_query($koneksi, $sqlCustomer);

    return mysqli_affected_rows($koneksi);

}

function updateCustomer($data){
    global $koneksi;

    $id = $data['id'];
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data ['telpon']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['keterangan']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);

    $sqlCustomer = "UPDATE tbl_customer SET
                    nama = '$nama',
                    telpon = '$telpon',
                    deskripsi = '$keterangan',
                    alamat = '$alamat'
                    WHERE id_customer = $id    
                    ";
    mysqli_query($koneksi,$sqlCustomer);
    return mysqli_affected_rows($koneksi);

    
}

?>