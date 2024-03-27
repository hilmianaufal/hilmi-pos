<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$datajual = getDataBarang("SELECT * FROM tbl_jual_head WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2' ");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
</head>
<body>

    <div  style="text-align:center;">
        <h2 style="margin-bottom: -15px;">Rekap Laporan Penjualan</h2>
        <h2 style="margin-bottom: 15px;">HilmiPos</h2>
    </div>

    <table>
        <thead>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; size: 3px; color: grey ">
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th style="width: 120px;">Tgl Penjualan</th>
                <th style="width: 120px;">ID Penjualan</th>
                <th style="width: 300px;">Customer</th>
                <th>Total Penjualan</th>
            </tr>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin: top 1px; size: 3px; color: grey ">
                </td>
            </tr>

        </thead>
        <tbody>
            <?php
                $no = 1;

                foreach($datajual as $data){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td align="center"><?= in_date($data['tgl_jual']) ?></td>
                        <td><?= $data['no_jual'] ?></td>
                        <td><?= $data['customer'] ?></td>
                        <td align="right"><?= number_format( $data['total'],0,',','.') ?></td>
                    </tr>
                <?php }
            ?>
        </tbody>
        <tfoot>
            <tr>
            <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin: top 1px; size: 3px; color: grey ">
                </td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print()
    </script>
    
</body>
</html>