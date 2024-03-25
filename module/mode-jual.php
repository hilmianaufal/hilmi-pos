<?php

function generateNo(){
    global $koneksi;
    $queryNo = mysqli_query($koneksi, "SELECT max(no_jual) as maxno FROM tbl_jual_head");

    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row['maxno'];



    $noUrut = (int) substr($maxno, 2, 4);
    $noUrut++;
    $maxno= "PJ" . sprintf("%04s", $noUrut);

    return $maxno;
}
 
function insertJual ($data){
  
        global $koneksi;
    
        $no   = mysqli_real_escape_string($koneksi, $data ['noJual']);
        $tgl   = mysqli_real_escape_string($koneksi, $data ['tglNota']);
        $kode   = mysqli_real_escape_string($koneksi, $data ['barcode']);
        $nama   = mysqli_real_escape_string($koneksi, $data ['namaBrg']);
        $qty   = mysqli_real_escape_string($koneksi, $data ['qty']);
        $harga   = mysqli_real_escape_string($koneksi, $data ['harga']);
        $jmlHarga   = mysqli_real_escape_string($koneksi, $data ['jmlHarga']);
        $stok   = mysqli_real_escape_string($koneksi, $data ['stok']);

        // cek brang sudah di input atau belum


    
        $cekBrg = mysqli_query($koneksi, "SELECT * FROM tbl_jual_detail WHERE no_jual = '$no' AND barcode = '$kode'");
        
        if (mysqli_num_rows($cekBrg)){
            echo "<script> 
              alert ('Barang sudah ada , Anda Harus menghapusnya Dulu Jika menghapus Quantitynya');
                
                </script>";
                return false;
           }

        //  Qty Barang tidak Boleh Kosong
           
    
        if (empty($qty)){
            echo "<script> 
            alert ('Quantity Barang Tidak Boleh Kosong');
        
            </script>";
            return false;
        }else if ($qty > $stok){
            echo "<script> 
            alert ('Stok Barang tidak Mencukupi');
        
            </script>";
            return false;
        }
        else {
            $sqlJual = "INSERT INTO tbl_jual_detail VALUES ('','$no','$tgl','$kode','$nama',$qty,$harga,$jmlHarga)";
            mysqli_query($koneksi, $sqlJual);
        }
    
        mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE barcode = '$kode' ");
    
        return mysqli_affected_rows($koneksi);

    


}

function totalJual ($nojual){
    global $koneksi;

    $totalJual = mysqli_query($koneksi, "SELECT sum(jumlah_harga) as total FROM tbl_jual_detail WHERE no_jual = '$nojual' ");
    $data = mysqli_fetch_assoc($totalJual);

    $total = $data ['total'];

    return $total;
}

function deleteBrg($barcode, $idJual, $qty){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_jual_detail WHERE barcode = '$barcode' AND no_jual = '$idJual'";

    mysqli_query($koneksi, $sqlDel);

    mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE barcode = '$barcode' ");

    return mysqli_affected_rows($koneksi);
}

function simpan ($data){
    global $koneksi;

    $nojual = mysqli_real_escape_string($koneksi,$data['noJual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $customer = mysqli_real_escape_string($koneksi, $data['customer']);
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);
    $bayar = mysqli_real_escape_string($koneksi, $data['bayar']);
    $kembalian = mysqli_real_escape_string($koneksi, $data['kembalian']);

    $sqlJual = "INSERT INTO tbl_jual_head VALUES ('$nojual','$tgl','$customer',$total,'$keterangan',$bayar,$kembalian)";

    mysqli_query($koneksi, $sqlJual);

    return mysqli_affected_rows($koneksi);

}
