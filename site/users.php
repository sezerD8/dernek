<?php
  session_start();
  include("../baglanti.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ondamla</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
    </style>
</head>
<body style="background-color:#f2f2f2;">
    <?php
        include('../headers/header.php')
    ?>
    <div class="container px-5 pt-5 mt-5" style="min-height:100vh; overflow-x:scroll;">
        <div class="info d-flex">
            <div class="userInfo col-md-10">
                <p class="mb-2 fw-bold">Adı: <span class="fw-normal"><?php echo $_SESSION['adi'] ?></span></p>
                <p class="mb-2 fw-bold">Soyadı: <span class="fw-normal"><?php echo $_SESSION['soyadi'] ?></span></p>
                <p class="mb-2 fw-bold">TC: <span class="fw-normal"><?php echo $_SESSION['tc'] ?></span></p>
                <p class="mb-2 fw-bold">Telefon: <span class="fw-normal"><?php echo $_SESSION['telefon'] ?></span></p>
            </div>
        </div>
        <hr>
        <div class="dataContainer">
            <h3 class="text-center mt-5">ÖDEME ÇİZELGESİ</h3>
            <table class="table">
                <tbody>
                <?php
                    echo'
                    <table class="text-center table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ay</th>
                            <th scope="col">Yıl</th>
                            <th scope="col">Açıklama</th>
                            <th scope="col">Ödenen (Aidat)</th>
                            <th scope="col">Borç (Aidat)</th>
                            <th scope="col">Ödenen (Diğer)</th>
                            <th scope="col">Borç (Diğer)</th>
                            <th scope="col">Kazanç</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                
                    $sec= "SELECT * FROM uyeodeme where kullanici=".$_SESSION['id']."";
                    $sonuc= mysqli_query($baglanti,$sec);
                    if ($sonuc !== false && $sonuc->num_rows > 0) 
                  {
                    while($cek = $sonuc->fetch_assoc()) 
                    {
                      $id=$cek["id"];
                      $ay=$cek["ay"];

                      $secAy= "SELECT * FROM aylar where id=$ay";
                      $sonucAy= mysqli_query($baglanti,$secAy);
                      $cekAy = $sonucAy->fetch_assoc();
                      $ayAdi = $cekAy['ayAd'];
                      
                      $yil=$cek["yil"];

                      $secYil= "SELECT * FROM yillar where id=$yil";
                      $sonucYil= mysqli_query($baglanti,$secYil);
                      $cekYil = $sonucYil->fetch_assoc();
                      $yilAdi = $cekYil['yil'];

                      $aciklama=$cek["aciklama"];
                      $oAidat=$cek["odenenAidat"];
                      $borcAidat=$cek["borcAidat"];
                      $odenenDiger=$cek["odenenDiger"];
                      $borcDiger=$cek["borcDiger"];
                      $kazanc=$cek["kazanc"];

                      echo '
                        <tr>
                          <th scope="row">'.$id.'</th>
                          <td>'.$ayAdi.'</td>
                          <td>'.$yilAdi.'</td>
                          <td class="text-break">'.$aciklama.'</td>
                          <td>'.$oAidat.'</td>
                          <td>'.$borcAidat.'</td>
                          <td>'.$odenenDiger.'</td>
                          <td>'.$borcDiger.'</td>
                          <td>'.$kazanc.'</td>
                        </tr>
                      ';

                    }
                  } 
                    else 
                    {
                        echo '
                        <tr>
                          <th colspan="9" class="text-center p-5" scope="row">ÖDEME KAYDINIZ BULUNMAMAKTADIR!</th>
                        </tr>
                        ';
                    }
                
              ?>
                </tbody>
              </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
      include("../footers/footer.php");
      ?>