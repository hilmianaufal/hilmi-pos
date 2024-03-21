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


?>