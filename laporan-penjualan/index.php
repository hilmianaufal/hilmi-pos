<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-barang.php';

$title= 'Laporan Penjualan - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

$penjualan = getDataBarang('SELECT * FROM tbl_jual_head');

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Penjualan</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Data Penjualan</h3>
            <div class="card-tools">
             <button type="button" data-toggle="modal" data-target="#mdlPeriodeJual" class="btn btn-sm btn-outline-primary float-lg-right"><i class="fas fa-print"></i> Cetak</button>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap " id="tblData">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Penjualan</th>
                  <th>Tgl Penjualan</th>
                  <th>Customer</th>
                  <th>Total Penjualan</th>              
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      
                      foreach($penjualan as $data) { ?>
                        <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['no_jual'] ?></td>                    
                        <td><?= in_date( $data['tgl_jual']) ?></td>                                       
                        <td><?= $data['customer'] ?></td>                    
                        <td class="text-center"><?= number_format($data['total'],0,',','.') ?></td>
                        <td><a href="detail-penjualan.php?id=<?= $data['no_jual'] ?>&tgl=<?= $data['tgl_jual'] ?>" class="btn btn-info btn-sm">Detail</a></td>      
                        </tr>              
                      <?php } ?>
               
                
                
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>


</div>
 <!-- modal untuk Cetak Barcode -->
 <div class="modal fade" id="mdlPeriodeJual">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Periode Penjualan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                  <label for="namaBrang" class="col-sm-3 col-form-label">Tanggal Awal</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="tgl1" >
                  </div>
              </div>

              <div class="form-group row">
                  <label for="namaBrang" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="tgl2" >
                  </div>
              </div>

            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-primary " onclick="printDoc()"><i class="fas fa-print"></i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <script>
        let tgl1 = document.getElementById('tgl1')
        let tgl2 = document.getElementById('tgl2')

        function printDoc(){
            if (tgl1.value != "" && tgl2.value != "") {
                window.open("../report/r-jual.php?tgl1=" + tgl1.value + "&tgl2=" + tgl2.value, "", "width=900, height=600, left=100")
            }
        }
    </script>
<?php require_once '../templates/footer.php'  ?>