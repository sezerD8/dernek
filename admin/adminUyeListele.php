<?php 
 ob_start();
 include("../headers/headerAdmin.php");
    include("../baglanti.php");
    if(isset($_GET["id"])){
        $idGET = $_GET['id'];
        $sil = "DELETE FROM kullanicilar WHERE id = '$idGET'";
        $calistirSil = mysqli_query($baglanti, $sil);
                if($calistirSil){
                    header('Refresh:2 ; URL=adminUyeListele.php');
                    echo '
                    <div class="alert alert-primary" role="alert">
                        Üye Silindi! Sayfa 2 Saniye içinde yenilenecektir.
                    </div>
                    ';
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Üye Silinemedi!
                    </div>
                    ';
                }
    }

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminTuzukEkle.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Üye Listele</h3>
            <?php
                    echo'
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">Adı</th>
                            <th scope="col">Soyadı</th>
                            <th scope="col">TC</th>
                            <th scope="col">Tel</th>
                            <th scope="col">Sil</th>
                            <th scope="col">Düzenle</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                
                    $sec= "SELECT * FROM kullanicilar";
                    $sonuc= mysqli_query($baglanti,$sec);
                    if ($sonuc !== false && $sonuc->num_rows > 0) 
                    {
                        while($cek = $sonuc->fetch_assoc()) 
                        {
                        $id=$cek["id"];
                        $kullaniciAdi=$cek["kullanici_adi"];
                        $adi=$cek["adi"];
                        $soyadi=$cek["soyadi"];
                        $tc=$cek["tc"];
                        $tel=$cek["telefon"];

                        echo '
                            <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$kullaniciAdi.'</td>
                            <td>'.$adi.'</td>
                            <td>'.$soyadi.'</td>
                            <td>'.$tc.'</td>
                            <td>'.$tel.'</td>
                            <td><a href="adminUyeListele.php?id='.$id.'" type="submit" name="sil" class=" col-12 btn btn-danger">Sil</a></td>
                            <td><a href="adminUyeDuzenle.php?id='.$id.'" type="submit" name="sil" class=" col-12 btn btn-primary">Düzenle</a></td>
                            </tr>
                        ';

                        }
                    } 
                    else 
                    {
                        echo '<td colspan=8"><h4 class="text-center">Henüz kullanıcı bilgisi yok!</h4></td>';
                    }
                
              ?>
                </tbody>
            </table>    
            <a href="adminUyeEkle.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Üye Ekle</a>
            <a href="adminUyeSifre.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Üye Şifre Değiştir</a>

        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

      ob_flush();
    ?>