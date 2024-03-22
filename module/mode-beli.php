<?php 



function generateNo(){
    global $koneksi;
    $queryNo = mysqli_query($koneksi, "SELECT max(no_beli) as maxno FROM tbl_beli_head");

    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row['maxno'];



    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno= "PB" . sprintf("%04s", $noUrut);

    return $maxno;
}

function insert ($data){
    global $koneksi;

    $no   = mysqli_real_escape_string($koneksi, $data ['noBeli']);
    $tgl   = mysqli_real_escape_string($koneksi, $data ['tglNota']);
    $kode   = mysqli_real_escape_string($koneksi, $data ['kodeBrg']);
    $nama   = mysqli_real_escape_string($koneksi, $data ['namaBrg']);
    $qty   = mysqli_real_escape_string($koneksi, $data ['qty']);
    $harga   = mysqli_real_escape_string($koneksi, $data ['harga']);
    $jmlHarga   = mysqli_real_escape_string($koneksi, $data ['jmlHarga']);


    $cekBrg = mysqli_query($koneksi, "SELECT * FROM tbl_beli_detail WHERE no_beli = '$no' AND kode_brg = '$kode'");
    
    if (mysqli_num_rows($cekBrg)){
        echo "<script> 
          alert ('Barang sudah ada , Anda Harus menghapusnya Dulu Jika menghapus Quantitynya');
            
            </script>";
            return false;
       }

    if (empty($qty)){
        echo "<script> 
        alert ('Quantity Barang Tidak Boleh Kosong');
    
        </script>";
        return false;
    }else {
        $sqlBeli = "INSERT INTO tbl_beli_detail VALUES ('','$no','$tgl','$kode','$nama',$qty,$harga,$jmlHarga)";
        mysqli_query($koneksi, $sqlBeli);
    }

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE id_barang = '$kode' ");

    return mysqli_affected_rows($koneksi);
}

function totalBeli ($nobeli){
    global $koneksi;

    $totalBeli = mysqli_query($koneksi, "SELECT sum(jumlah_harga) as total FROM tbl_beli_detail WHERE no_beli = '$nobeli' ");
    $data = mysqli_fetch_assoc($totalBeli);

    $total = $data ['total'];

    return $total;
}

function deleteBrg($idBrg, $idBeli, $qty){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_beli_detail WHERE kode_brg = '$idBrg' AND no_beli = '$idBeli'";

    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE id_barang = '$idBrg' ");

    return mysqli_affected_rows($koneksi);
}

function simpan ($data){
    global $koneksi;

    $nobeli = mysqli_real_escape_string($koneksi,$data['noBeli']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $supplier = mysqli_real_escape_string($koneksi, $data['supplier']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlBeli = "INSERT INTO tbl_beli_head VALUES ('$nobeli','$tgl','$supplier',$total,'$keterangan')";

    mysqli_query($koneksi, $sqlBeli);

    return mysqli_affected_rows($koneksi);

}


?>