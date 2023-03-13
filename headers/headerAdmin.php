<?php
  session_start();
  if(isset($_SESSION['kullanici_adi']) && $_SESSION['rol'] == 1 )
      echo'';
  else{
      header('location:../index.php');
  }
?>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ondamla Admin Paneli</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.webp">
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="../assets/dist/css/style.min.css" rel="stylesheet">
    <style type="text/css">
      .jqstooltip {
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0, 0, 0, 0.6);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        z-index: 10000;
      }
      .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
      }
      form{
        overflow-x:scroll;
      }
    </style>
  <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>
</head>

  <body>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <a class="navbar-brand justify-content-center" href="../index.php">
              <b class="logo-icon ps-2">
                <h3 style="color:#b85653;">ADMIN PANEL</h3>
              </b>
            </a>
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          </div>
          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5" style="background-color:transparent!important;">
            <ul class="navbar-nav float-start me-auto">
            </ul>
            <ul class="navbar-nav float-end">
              <li class="nav-item dropdown">
                  <h5><?php
                    if(isset($_SESSION['kullanici_adi'])){
                        echo'
                        <a href="../site/denetim.php" class="navbar-brand fs-6">Dosyalar</a>
                        <a href="../site/users.php" class="navbar-brand fs-6 p-0">'.$_SESSION["adi"]." ".$_SESSION["soyadi"].'</a>
                        ';
                    }
                    else{
                        echo'
                            <button type="button" class="btn btn-outline-primary me-2"><a href="../site/login.php" class="text-decoration-none text-black">Giriş yap</a></button>     
                        ';
                    }
            ?></h5>
              </li>
              <li class="nav-item dropdown d-flex align-items-center ">
                  <h5><?php
                    if(isset($_SESSION['kullanici_adi'])){
                        echo'
                        <a href="../cikis.php" class="navbar-brand fs-6 p-0">Çıkış Yap</a>
                        ';
                    }
                    else{
                        echo'
                            <button type="button" class="btn btn-outline-primary me-2"><a href="../index.php" class="text-decoration-none text-black">Giriş yap</a></button>     
                        ';
                    }
            ?>
            </h5>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4 in">
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="adminUyeListele.php" aria-expanded="false"><i class="mdi mdi-account-plus"></i><span class="hide-menu">Kullanıcı İşlemleri</span></a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="adminOdemeListele.php" aria-expanded="false"><i class="mdi mdi-currency-usd""></i><span class="hide-menu">Üye Ödeme İşlemleri</span></a>
              </li>
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">Dosya İşlemleri</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="adminTuzukListele.php" class="sidebar-link"
                      ><i class="mdi mdi-note-plus"></i
                      ><span class="hide-menu">Tüzük</span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="adminDeRaporuListele.php" class="sidebar-link"
                      ><i class="mdi mdi-note-plus"></i
                      ><span class="hide-menu">Denetim Raporu</span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="adminMuhasebeListele.php" class="sidebar-link"
                      ><i class="mdi mdi-note-plus"></i
                      ><span class="hide-menu">Muhasebe</span></a
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
      <div class="page-wrapper">