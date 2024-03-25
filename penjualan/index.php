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

$kode = @$_GET['barcode'] ? @$_GET['barcode'] : '';

if($kode){
  $tglNota = $_GET['tgl'];
  $dataBrg = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = '$kode'");
  $selectBrg = mysqli_fetch_assoc($dataBrg);

  if (!mysqli_num_rows($dataBrg)) {
    echo "<script> 
    alert('Barang dengan Barcode tersebut tidak ada');
    document.location = '?tgl=$tgl';

    </script>";
  }

}

if (isset($_POST['addbrg'])) {
    $tgl = $_POST ['tglNota'];
    if (insertJual($_POST)) {
      echo "<script> 
          alert('Data Berhasil Di Simpan');
          document.location = '?tgl=$tgl';
      
      </script>";
  }
}
if (isset($_GET['msg'])){
  $msg = $_GET ['msg'];
}else {
  $msg= '';
}

if($msg == 'deleted'){
  $barcode = $_GET['barcode'];
  $idJual = $_GET['idjual'];
  $qty = $_GET['qty'];
  $tgl = $_GET['tgl'];

  deleteBrg($barcode, $idJual,$qty);
  echo "<script> 
  document.location = '?tgl=$tgl';

  </script>";
}

if (isset($_GET['msg'])){
  $msg = $_GET ['msg'];
}else {
  $msg= '';
}

if($msg == 'deleted'){
  $barcode = $_GET['barcode'];
  $idJual = $_GET['idjual'];
  $qty = $_GET['qty'];
  $tgl = $_GET['tgl'];

  deleteBrg($barcode, $idJual,$qty);
  echo "<script> 
  alert('Barang Telah Di Hapus');
  document.location = '?tgl=$tgl';

  </script>";
}

if (isset($_POST['simpan'])) {
  $nota = $_POST ['noJual'];
 
  if (simpan($_POST)) {
      echo "<script> 

          alert('Data Penjualan Berhasil Di Simpan');
          window.onload = function () {
            let win = window.open('../report/r-struk.php?nota=$nota', 'Struk Belanja', 'widht=260,height=400,left=10,top=10','_blank')
            if(win){
              win.focus();
              window.location = 'index.php';
            }
          }
      
      </script>";
  }
}
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
                                    <input type="date" name="tglNota" id="tglNota" class="form-control" value="<?= @$_GET['tgl'] ? $_GET['tgl'] :   date('Y-m-d') ?>" required>
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
                                <input type="hidden" name="total" id="total" value="<?= totalJual($nojual) ?>">
                                <h1 class="font-weight-bold text-right"   style="font-size: 40pt;"><?= number_format(totalJual($nojual),0,',','.') ?></h1>
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
                            <th>Barcode</th>
                            <th >Nama Barang</th>
                            <th class="text-right">Harga Jual</th>
                            <th class="text-center">Qty</th>
                            <th >Jumlah Harga</th>
                            <th class="text-center" widht="10%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1 ;
                            $brgDetail = getDataBarang("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nojual'");

                            foreach($brgDetail as $detail){ ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $detail['barcode'] ?></td>
                                  <td><?= $detail['nama_barang'] ?></td>
                                  <td class="text-right"><?= number_format( $detail['harga_jual'],0,',','.') ?></td>
                                  <td class="text-center"><?= $detail['qty'] ?></td>
                                  <td><?= $detail['jumlah_harga'] ?></td>
                                  <td class="text-center">
                                    <a href="?barcode=<?= $detail['barcode'] ?>&idjual=<?= $detail['no_jual'] ?>&qty=<?= $detail['qty'] ?>&tgl=<?= $detail['tgl_jual'] ?>&msg=deleted" class="btn btn-sm btn-danger" title="hpus brang" onclick="return confirm('Yakin ingin Menghapus Barang ini ?')"> <i class="fas fa-trash"></i></a>
                                  </td>
                                </tr>
                            <?php 
                            }
                          
                          ?>
                        </tbody>
                      </table>
                   </div>
                   <div class="row">
                   <div class="col-lg-4 p-2">
                      <div class="form-group row mb-2">
                       <label for="customer" class="col-sm-3 col-form-label col-form-label">Customer</label>
                       <div class="col-sm-9">
                         <select name="customer" id="customer" class="form-control form-control-sm">
                        
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
                            <input type="number" name="kembalian" class="form-control form-control-sm text-right" id="kembalian" readonly>
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

    <script>
      let barcode = document.getElementById('barcode')
      let tgl  = document.getElementById('tglNota')
      let qty = document.getElementById('qty')
      let harga = document.getElementById('harga')
      let jmlHarga = document.getElementById('jmlHarga')
      let bayar  = document.getElementById('bayar')
      let kembalian  = document.getElementById('kembalian')
      let total  = document.getElementById('total')

      barcode.addEventListener('change', function(){
        document.location.href = '?barcode=' + barcode.value + '&tgl=' + tgl.value;
      })

      qty.addEventListener('input', function(){
        jmlHarga.value = qty.value * harga.value;
      })
      bayar.addEventListener('input', function(){
        kembalian.value = parseFloat(bayar.value) - parseFloat(total.value);
      })

    </script>

<?= require_once '../templates/footer.php' ?>