<?php

session_start();

if(!$_SESSION['ssLoginPOS']){
    header("location: ../auth/login.php");
};

require_once '../functions.php';
require_once '../config.php';

$id = $_GET['id'];

if(deleteSupplier($id) > 0 ){
    header("location: supplier.php?msg=deleted");
}