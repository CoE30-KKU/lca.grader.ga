<?php
    ob_start();
    session_start(); if (!isset($_SESSION['dark_mode'])) $_SESSION['dark_mode'] = false;
    $start_time = microtime(TRUE);
    $dbhost = "203.159.94.111";
    $dbuser = "graderga";
    $dbpass = "8db!#yYvK]8Lw6F|37wz:UwU";
    $dbdatabase = "graderga";
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbdatabase); 
    mysqli_set_charset($conn, 'utf8');

    $private_key = md5("THANK YOU OTOG.CF, OTOG.ORG, PROGRAMMING.IN.TH, KIYAGO, GAREDAMI");

    if(!$conn)  die('Could not connect: ' . mysqli_error($conn));
    
    @ini_set('upload_max_size','128M');
    @ini_set('post_max_size','128M');
    @ini_set('max_execution_time','300');
    
    date_default_timezone_set('Asia/Bangkok');
?>
