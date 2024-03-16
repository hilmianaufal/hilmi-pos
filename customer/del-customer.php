<?php

session_start();

if(!$_SESSION['ssLoginPOS']){
    header("location: ../auth/login.php");
};

require_once '../functions.php';
require_once '../config.php';

$id_customer = $_GET['id'];
if(deleteCustomer($id_customer) > 0){
    header("location: data-customer.php?msg=deleted");
}