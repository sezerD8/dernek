<?php 
 ob_start();
 include("../headers/headerAdmin.php");
    include("../baglanti.php");
    if(isset($_GET["id"])){
      $idGET = $_GET['id'];
      $sil = "DELETE FROM uyeodeme WHERE id = '$idGET'";
      $calistirSil = mysqli_query($baglanti, $sil);
              if($calistirSil){
                header('Refresh:2 ; URL=adminOdemeListele.php');
                echo '
                  <div class="alert alert-primary" role="alert">
                      Ödeme Silindi! Sayfa 2 Saniye içinde yenilenecektir.
                  </div>
                  ';
              }
              else{
                  echo '
                  <div class="alert alert-danger" role="alert">
                      Ödeme Silinemedi!
                  </div>
                  ';
              }
  }
?>
    <div class="container pt-5">
        <div class="card p-5 ">
        <form action="<?= htmlspecialchars('./adminOdemeEkle.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Ödeme Listele</h3>
            <?php
                    echo'
                    <table class="table">
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
                            <th scope="col">Kullanıcı</th>
                            <th scope="col">Sil</th>
                            <th scope="col">Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    
                    $sec= "SELECT * FROM uyeodeme";
                    $sonuc= mysqli_query($baglanti,$sec);
                    if ($sonuc !== false && $sonuc->num_rows > 0) 
                    {
                      while($cek = $sonuc->fetch_assoc()) 
                      {
                        
                      $id=$cek["id"];
                      
                      $yil=$cek["yil"];
                      $secYil= "SELECT * FROM yillar where id=$yil";
                      $sonucYil= mysqli_query($baglanti,$secYil);
                      $cekYil = $sonucYil->fetch_assoc();
                      $yilAdi = $cekYil['yil'];

                      $ay=$cek["ay"];
                      $secAy= "SELECT * FROM aylar where id=$ay";
                      $sonucAy= mysqli_query($baglanti,$secAy);
                      $cekAy = $sonucAy->fetch_assoc();
                      $ayAdi = $cekAy['ayAd'];

                      $aciklama=$cek["aciklama"];
                      $oAidat=$cek["odenenAidat"];
                      $borcAidat=$cek["borcAidat"];
                      $odenenDiger=$cek["odenenDiger"];
                      $borcDiger=$cek["borcDiger"];
                      $kazanc=$cek["kazanc"];
                      
                      $kullanicii=$cek["kullanici"];
                      $secKullanicii= "SELECT * FROM kullanicilar where id=$kullanicii";
                      $sonucKullanicii= mysqli_query($baglanti,$secKullanicii);
                      $cekKullanicii = $sonucKullanicii->fetch_assoc();
                      $kullaniciiAdi = $cekKullanicii['kullanici_adi'];
                      
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
                          <td>'.$kullaniciiAdi.'</td>
                          <td><a href="adminOdemeListele.php?id='.$id.'" type="submit" name="sil" class=" col-12 btn btn-danger">Sil</a></td>
                          <td><a href="adminOdemeDuzenle.php?id='.$id.'" type="submit" name="sil" class=" col-12 btn btn-primary">Düzenle</a></td>
                        </tr>
                      ';

                    }
                  } 
                    else 
                    {
                        echo '<td colspan=12"><h4 class="text-center">Henüz ödeme bilgisi yok!</h4></td>';
                    }
                
              ?>
                </tbody>
            </table>    
            <a href="adminOdemeEkle.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Ödeme Ekle</a>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

      ob_flush();
    ?>