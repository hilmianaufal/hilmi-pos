<?php

if (userLogin()['level'] == 3 ) {
    header("Location: eror-page.php");
    exit();
}

function generateId(){
    global $koneksi;

    $queryId = mysqli_query($koneksi, "SELECT max(id_barang) as maxid FROM tbl_barang");
    $data = mysqli_fetch_assoc($queryId);
    $maxid = $data['maxid'];

    $noUrut = (int)  substr($maxid, 4, 3);
    $noUrut++;
    $maxid = "BRG-" . sprintf("%03s", $noUrut);

    return $maxid;
}

function insert($data){
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $data['kode']);
    $barcode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $satuan = mysqli_real_escape_string($koneksi, $data['satuan']);
    $harga_beli = mysqli_real_escape_string($koneksi, $data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $data['harga_jual']);
    $stock_menimal = mysqli_real_escape_string($koneksi, $data['stock_minimal']);
    $gambar = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    $cekbarcode = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = '$barcode' ");

    if(mysqli_num_rows($cekbarcode) > 0){
        echo "<script>
            alert('Kode Barcode Sudah Ada, Barang Gagal Di Tambahkan');
        </script>";
        return false;
    }

    // upload Barang Gambar
    if($gambar != ''){
        $gambar = uploadImage(null ,$id);      
    }else{
        $gambar = 'barang.png';
    }

    // gmbr tidak sesuai Validasi

    if($gambar == ''){
        return false;
    }

    $strBrg= "INSERT INTO tbl_barang VALUES ('$id','$barcode','$nama',$harga_beli,$harga_jual,0,'$satuan',$stock_menimal,'$gambar')";
    $result = mysqli_query($koneksi,$strBrg);

    return mysqli_affected_rows($koneksi);

}