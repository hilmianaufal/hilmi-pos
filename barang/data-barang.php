<?php

session_start();

if(!isset($_SESSION['ssLoginPOS'])){
  header("location: ../auth/login.php");
}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-barang.php';

$title= 'Data Barang - HilmiPos';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

if (isset($_GET['msg'])){
    $msg = $_GET ['msg'];
}else {
    $msg= '';
}

$alert = '';


if($msg == 'deleted') {
    $id = $_GET['id'];
    $foto = $_GET['foto'];
    if(delBarang($id, $foto)){
    $alert = "<script>
            $(document).ready(function(){
              $(document).Toasts('create',{
                title : 'Sukses',
                body : 'Data Barang Berhasil Di Hapus',
                class : 'bg-success',
                icon : 'fas fa-check-circle' 
              })
            });
    </script>";
}
}
if($msg == 'updated') {
   
    $alert = "<script>
            $(document).ready(function(){
              $(document).Toasts('create',{
                title : 'Sukses',
                body : 'Data Barang Berhasil Di Update',
                position : 'bottomRight',
                class : 'bg-success',
                icon : 'fas fa-check-circle', 
                autohide : true,
                delay : 5000
              })
            });
    </script>";

}

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Barang</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card">
           <?php 
           if($msg !== ''){
                echo $alert;
            }else {
                $alert='';
            } 
            ?>
          <div class="card-header">
            <h3 class="card-title "><i class="fas fa-list fa-sm"></i> Data Barang</h3>
            <div class="card-tools">
              <a href="<?= $main_url ?>barang/form-barang.php" class="btn btn-primary btn-sm"><i class="fas fa-plus fa-sm"></i> Add Barang</a>
            </div>
          </div>
          <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap " id="tblData">
              <thead>
                <tr>
                  <th>Gambar</th>
                  <th>Id Barang</th>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>              
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; 
                      $datas = getDataBarang("SELECT * FROM tbl_barang");
                      foreach($datas as $data) :
                ?>
                <tr>
                 <td><img src="../asset/img/<?= $data['gambar'] ?>" width="60px" class="rounded-circle" alt=""></td>
                  <td><?= $data['id_barang']?></td>
                  <td><?= $data ['barcode'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td class="text-center"><?= number_format( $data['harga_beli'],0,',','.') ?></td>
                  <td><?= number_format( $data['harga_jual'],0,',','.') ?></td>
                  <td>
                    <button class="btn btn-secondary" type="button" id="btnCetakBarcode" data-barcode="<?= $data['barcode']  ?>" data-nama="<?= $data['nama_barang'] ?>" title="cetak barcode"><i class="fas fa-barcode"></i></button>
                    <a href="form-barang.php?id=<?= $data['id_barang'] ?>&msg=editing" class="btn btn-warning" title="Edit Data"><i class="fas fa-user-edit"></i></a>
                    <a href="?id=<?=$data['id_barang'] ?>&foto=<?= $data['gambar'] ?>&msg=deleted" class="btn btn-danger" title="Edit Data" onclick="confirm('Apakah Yakin Ingin Menghapus User ini ?')"><i class="fas fa-trash"></i></a>
                </td>
               
                </tr>
                
                <?php endforeach ;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>
  <!-- modal untuk Cetak Barcode -->
    <div class="modal fade" id="mdlCetakBarcode">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cetak Barcode</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                  <label for="namaBrang" class="col-sm-3 col-form-label">Nama Barang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="namaBrang" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="barcode" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="jmlCetak" class="col-sm-3 col-form-label">Jumlah Cetak</label>
                  <div class="col-sm-9">
                    <input type="number" min="1" max ="10" value="1" title="Maximal 10" id="jmlCetak" class="form-control">
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="preview"> <i class="fas fa-print"></i> Cetak</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<script>

$(document).ready(function(){
    $(document).on('click', '#btnCetakBarcode', function(){
      $('#mdlCetakBarcode').modal('show');
      let barcode = $(this).data('barcode');
      let nama = $(this).data('nama');
      $('#namaBrang').val(nama);
      $('#barcode').val(barcode);
    })
})

$(document).on('click','#preview', function(){
  let barcode = $('#barcode').val()
  let jmlCetak = $('#jmlCetak').val()
  if(jmlCetak > 0 && jmlCetak <= 10){
    window.open('../report/r-barcode.php?barcode=' + barcode + '&jmlCetak=' + jmlCetak  )
  }
})

</script>






<?php 
require_once '../templates/footer.php';
?>
