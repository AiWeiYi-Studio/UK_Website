<?php
session_start();
define('ROOT_PATH', dirname(__FILE__));
require './code.class.php';
$_ukyun = new ValidateCode();
$_ukyun->doimg();
$_SESSION['ukyun_code'] = $_ukyun->getCode();
?>