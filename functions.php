<?php 

function uploadImage($url = null, $name = null){

    $namafile = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tmp = $_FILES['image']['tmp_name'];
    // validasi file Gambar yang boleh di upload

    $extensiGambarValid = ['jpg','jpeg', 'png', 'gif', 'jfif']; 
    $extensiGambar = explode('.',$namafile);
    $extensiGambar = strtolower(end($extensiGambar));

    if (!in_array($extensiGambar, $extensiGambarValid)) {
        if($url != ''){
            echo "<script>
            alert('File Yang Anda Upload Bukan Gambar, Data Gagal Di update');
            document.location.href = ' . $url .';
            </script>";
            // die();
            return false; // Jika Anda ingin pesan kesalahan ditampilkan dan eksekusi skrip PHP berlanjut, gunakan return false
        } else {
            echo "<script>
            alert('File Yang Anda Upload Bukan Gambar, Data Gagal Di Tambahkan')
            </script>";
            return false;
        }
    }
    // validasi Ukuran Gamabar Max 1MB
    if ($ukuran > 1000000) {
        if($url != ''){
            echo "<script>
            alert('File Yang Anda Upload Melebihi 1 MB, Data Gagal Di update');
            document.location.href = ' . $url .';
            </script>";
            // die();
            return false; // Jika Anda ingin pesan kesalahan ditampilkan dan eksekusi skrip PHP berlanjut, gunakan return false
        } else {
            echo "<script>
            alert('Ukuran Gambar Tidak Boleh Melebihi 1 MB, Data Gagal Di Tambahkan')
            </script>";
            return false;
        }
    }
            if ($name != '') {
                
                $namaFileBaru = $name . '.' . $extensiGambar;
            }else {

                $namaFileBaru = rand(10, 1000) . '-' . $extensiGambar;
            }

    move_uploaded_file($tmp, '../asset/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function getDataUser ($sql){
    global $koneksi;


    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while($data = mysqli_fetch_assoc($result)){
        $rows[] = $data;
    }
    return $rows;

}

function delete($id, $foto){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_user WHERE user_id=$id";
    mysqli_query($koneksi, $sqlDel);

    if ($foto != 'default.png') {
        unlink('../asset/img/' . $foto);
    }
    return mysqli_affected_rows($koneksi);
}

function userLogin (){
    $userActive = $_SESSION['ssUserPOS'];
    $dataUser = getDataUser("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}

function userMenu(){
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segment = explode('/', $uri_path);
    $menu = $uri_segment[2];
    return $menu;
}

function menuHome (){
    if (userMenu() == 'dashboard.php') {
        $result = 'active';
    }else {
        $result = null;
    }
    return $result;
}

function menuSetting (){
    if(userMenu() == 'user'){
        $result = 'menu-is-opening menu-open';
    }else {
        $result = null;
    }
    return $result;
}

function menuUser (){
    if (userMenu() == 'user') {
        $result = 'active';
    }else {
        $result = null;
    }
    return $result;
}

function getDataSupplier ($sql){
    global $koneksi;
    $querySupplier = mysqli_query($koneksi, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($querySupplier)){
    $rows[] = $row;
    }
    return $rows;
}

function deleteSupplier($id){
    global $koneksi;
    
    mysqli_query($koneksi, "DELETE FROM tbl_supplier WHERE id_supplier = '$id'");
    return mysqli_affected_rows($koneksi);
}

function menuMaster (){
    if(userMenu() == 'supplier'){
        $result = 'menu-is-opening menu-open';
    }else {
        $result = null;
    }
    return $result;
}

function getDataCustomer ($sql){
    global $koneksi;
    $result = mysqli_query($koneksi, $sql );
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
    }
    return $rows;
}

function menuMasterCustomer (){
    if(userMenu() == 'customer' or userMenu() == 'barang'){
        $result = 'menu-is-opening menu-open';
    }else {
        $result = null;
    }
    return $result;
}

function deleteCustomer ($id){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tbl_customer WHERE id_customer = $id");
    return mysqli_affected_rows($koneksi);
}
function getDataBarang($sql){
    global $koneksi;
    $result = mysqli_query($koneksi,$sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function menuBarang (){
    if (userMenu() == 'barang') {
        $result = 'active';
    }else {
        $result = null;
    }
    return $result;
}
function menuCustomer (){
    if (userMenu() == 'customer') {
        $result = 'active';
    }else {
        $result = null;
    }
    return $result;
}
function menuSupplier (){
    if (userMenu() == 'supplier') {
        $result = 'active';
    }else {
        $result = null;
    }
    return $result;
}

function delBarang($id, $foto){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_barang WHERE id_barang= '$id'";
    mysqli_query($koneksi, $sqlDel);

    if ($foto != 'barang.png') {
        unlink('../asset/img/' . $foto);
    }
    return mysqli_affected_rows($koneksi);
}