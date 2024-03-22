<?php 



session_start();



if(!isset($_SESSION['ssLoginPOS'])){
    header("Location: ../auth/login.php");

}

require_once '../config.php';
require_once '../functions.php';
require_once '../module/mode-jual.php';

$title = 'Tranksaksi - HilmiPOS';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
require_once '../templates/sidebar.php';

$nojual = generateNo();

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penjualan Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item">Tambah Penjualan</li>                        
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section>
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-warning p-3">
                            <div class="form-group row mb-2">
                                <label for="noNota" class="col-sm-2 col-form-label">No Nota</label>
                                <div class="col-sm-4">
                                    <input type="text" name="noJual" class="form-control" value="<?= generateNo() ?>">
                                </div>
                                <label for="tglNota" class="col-sm-2 col-form-label">Tgl Nota</label>
                                <div class="col-sm-4">
                                    <input type="date" name="tglJual" id="tglNota" class="form-control" value="<?= @$_GET['tgl'] ? $_GET['tgl'] :   date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                              <label for="kodeBrg" class="col-sm-2 col-form-label">Barcode</label>
                              <div class="col-sm-10 input-group">
                                <input class="form-control" placeholder="Masukan Barcode Barang" type="text" name="barcode" id="barcode" value="<?= @$_GET['barcode'] ? $_GET['barcode'] :'' ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="icon-barcode">
                                        <i class="fas fa-barcode"></i>
                                    </span> 
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-outline card-danger pt-3 px-3 pb-2">
                                <h6 class="font-weight-bold text-right">Total Penjualan</h6>
                                <input type="hidden" name="total" value="">
                                <h1 class="font-weight-bold text-right" style="font-size: 40pt;">0</h1>
                      </div>
                    </div>
                    </div>
                  <div class="card pt pb-2 px-3">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group ">
                          <input type="hidden" value="<?= @$_GET['barcode'] ? $selectBrg['id_barang'] : '' ?>" name="kodeBrg">
                          <label for="namaBrg"> Nama Barang</label>
                          <input type="text" name="namaBrg" value="<?= @$_GET['barcode'] ? $selectBrg['nama_barang'] : '' ?>" class="form-control form-control-sm" id="namaBrg" readonly>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group ">
                          <label for="stok">Stok</label>
                          <input type="number" value="<?= @$_GET['barcode'] ? $selectBrg['stock'] : '' ?>" name="stok" class="form-control form-control-sm" id="stok" readonly>
                        </div>
                      </div>
                      <div class="col-sm-1">
                        <div class="form-group ">
                          <label for="satuan">Satuan</label>
                          <input type="text" name="satuan" value="<?= @$_GET['barcode'] ? $selectBrg['satuan'] : '' ?>" class="form-control form-control-sm" id="satuan" readonly>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group ">
                          <label for="harga">Harga</label>
                          <input type="number" value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>" name="harga" class="form-control form-control-sm" id="harga" readonly>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group ">
                          <label for="qty">Qty</label>
                          <input type="number" name="qty" value="<?= @$_GET['barcode'] ? 1 : '' ?>" class="form-control form-control-sm" id="qty" >
                        </div>
                      </div>
                     <div class="col-sm-2">
                        <div class="form-group ">
                          <label for="jmlHarga">Harga</label>
                          <input type="number" value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>" name="jmlHarga" class="form-control form-control-sm" id="jmlHarga" readonly>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-info btn-block" name="addbrg"> <i class="fas fa-cart-plus fa-sm"></i> Tambah Barang</button>
                  </div>
                  
                  <div class="card card-outline card-success table-responsive px-2">
                      <table class="table table-sm table-hover table-nowrap">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th >Nama Barang</th>
                            <th class="text-right">Harga</th>
                            <th class="text-center">Qty</th>
                            <th >Jumlah Harga</th>
                            <th class="text-center" widht="10%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                   </div>
                   <div class="row">
                   <div class="col-lg-4 p-2">
                      <div class="form-group row mb-2">
                       <label for="customer" class="col-sm-3 col-form-label col-form-label">Customer</label>
                       <div class="col-sm-9">
                         <select name="customer" id="customer" class="form-control form-control-sm">
                           <option value="">-- Pilih Customer --</option>
                                 <?php
                                    $customer = getDataSupplier("SELECT * FROM tbl_customer");
                                    foreach($customer as $spl) { ?>
                                          <option value="<?= $spl['nama'] ?>"><?= $spl['nama'] ?></option>
                                    <?php }
                                ?>

                         </select>
                       </div>
                       </div>
                       <div class="form-group row mb-2">
                        <label for="ktr" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                          <textarea name="ketr" id="ketr" class="form-control form-control-sm" ></textarea>
                        </div>
                       </div>
                   </div>
                   <div class="col-lg-4 py-2 px-3">
                    <div class="form-group row mb-2">
                        <label for="" class="col-sm-3 col-form-label">Bayar</label>
                        <div class="col-sm-9">
                            <input type="number" name="bayar" class="form-control form-control-sm text-right" id="bayar">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                        <div class="col-sm-9">
                            <input type="number" name="kembalian" class="form-control form-control-sm text-right" id="bayar" readonly>
                        </div>
                    </div>
                    
                   </div>
                   <div class="col-lg-4 p-2">
                           <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-sm btn-block"> <i class="fas fa-save "></i> Simpan</button>
                        </div>                        
                     
                </div>
            </form>
        </div>
    </section>

<?= require_once '../templates/footer.php' ?>