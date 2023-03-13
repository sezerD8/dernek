<?php
    if(isset($_SESSION['kullanici_adi'])){
        if ($_SESSION['rol'] == 1) {
            header("location:admin/adminUyeEkle.php");
        }
        else if($_SESSION['rol'] == 2 ){
            header("location:site/denetim.php");
        }
        else if($_SESSION['rol'] == 3 ){
            header("location:site/users.php");
        }
        else{
            echo"Başarısız giriş!";
        }
    }

?>
<!doctype html>
<html>
    <head>
        <title>Hoş Geldiniz!</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/dist/css/icons/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="assets/css/util.css">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <meta charset="utf-8">
    </head>