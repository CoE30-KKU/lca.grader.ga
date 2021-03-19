<?php
    $id = $_GET['id'];
    $codename = $_GET['codename'];
    //print_r("../file/judge/prob/$id/$codename*.pdf");
    $file = glob("../file/judge/prob/$id/$codename*.pdf");
    //print_r($file);
    if ($file) {
        header("Content-type: application/pdf");
        readfile($file[0]);
    } else {
        echo "Not Found.";
    }
?>