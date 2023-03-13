<?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");
    
    $username_err = $tc_err =  $ad_err =  $soyad_err =  $tel_err= $yetki_err = $IDDuzenle = $kadiDuzenle =  $adiDuzenle = $soyadiDuzenle=$tcDuzenle=$telDuzenle =$rolDuzenle = "";
    

    if(isset($_POST['bilgi'])){
        include("../baglanti.php");
        $id = $_POST['id'];
        $sil = "SELECT * FROM kullanicilar WHERE id = '$id'";
        $calistirDuzenle = mysqli_query($baglanti, $sil);
                if($calistirDuzenle !== false && $calistirDuzenle->num_rows > 0){
                    while($cek = $calistirDuzenle->fetch_assoc()) 
                        {
                            $IDDuzenle=$cek["id"];
                            $kadiDuzenle=$cek["kullanici_adi"];
                            $adiDuzenle=$cek["adi"];
                            $soyadiDuzenle=$cek["soyadi"];
                            $tcDuzenle=$cek["tc"];
                            $telDuzenle=$cek["telefon"];
                            $rolDuzenle=$cek["rol"];
                        }
                    }
                    else{
                        echo '
                        <div class="alert alert-danger text-center" role="alert">
                            Girdiğiniz ID ile eşleşen sonuç bulunamadı!
                        </div>
                        ';
                    }
    }

    if(isset($_POST["kaydet"])){

        $id = $_POST['id'];
        if(strlen($_POST["kadi"]) == 0){
            $username_err="Kullanıcı adı boş geçilemez";
        }
        else{
            $kadi = $_POST["kadi"];
        }



        if(strlen($_POST["ad"]) == 0){
            $ad_err="Ad boş geçilemez";
        }
        else{
            $ad = $_POST["ad"];
        }

        if(strlen($_POST["soyad"]) == 0){
            $soyad_err="Soyad boş geçilemez";
        }
        else{
            $soyad = $_POST["soyad"];
        }


        
        if(strlen($_POST["tc"]) == 0){
            $tc_err="TC No boş geçilemez";
        }
        else if(strlen($_POST["tc"]) < 10){
            $tc_err="TC No en az 11 karakter olmalıdır";
        }
        else{
            $tc = $_POST["tc"];
        }



        if(strlen($_POST["tel"]) == 0){
            $tel_err="Tel No boş geçilemez";
        }
        else{
            $tel = $_POST["tel"];
        }


        if(strlen($_POST["yetki"]) == 0){
            $yetki_err="Yetki seçimi boş geçilemez";
        }
        else{
            $yetki = $_POST["yetki"];
        }

        

        if(isset($kadi) && isset($ad) && isset($soyad) && isset($tc) && isset($tel) && isset($yetki)){
            $ekle = "UPDATE kullanicilar SET kullanici_adi='$kadi', adi='$ad', soyadi='$soyad', tc='$tc', telefon='$tel', rol='$yetki' WHERE id=$id";
            $calistirDuzenle = mysqli_query($baglanti, $ekle);
                if($calistirDuzenle){
                    echo '<meta http-equiv="refresh" content="2">';
                    echo '
                    <div class="alert alert-primary" role="alert">
                        Kullanıcı Düzenlendi!
                    </div>
                    ';
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Kullanıcı Düzenlenemedi!
                    </div>
                    ';
                }
                mysqli_close($baglanti);
        }
    }
?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminUyeDuzenle.php')?>" method="POST">
            <h3 class="text-center pb-3">Kullanıcı Düzenle</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Kullanıcı ID</label>
                <div class="d-flex ">
                    <input name="id" class="me-4 form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ID" value="<?php echo isset($_GET['id']) ? $_GET['id'] : $IDDuzenle ?>">
                    <button name="bilgi" class="text-white col-4 btn btn-success">Bilgileri Getir</button>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Kullanıcı Adı</label>
                <input name="kadi" class="form-control <?php echo !empty($username_err) ? 'is-invalid': '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kullanıcı Adı" value="<?php echo $kadiDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?php
                    echo $username_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ad</label>
                <input name="ad" class="form-control <?php echo !empty($ad_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ad" value="<?php echo $adiDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $ad_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Soyad</label>
                <input name="soyad" class="form-control <?php echo !empty($soyad_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Soyad" value="<?php echo $soyadiDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $soyad_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">TC No</label>
                <input name="tc" class="form-control <?php echo !empty($tc_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="TC No" value="<?php echo $tcDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $tc_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefon</label>
                <input name="tel" class="form-control <?php echo !empty($tel_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telefon" value="<?php echo $telDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $tel_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputGroupSelect01">
                <?php
                            include("../baglanti.php");
                            $yetkiListele = "SELECT * FROM roller where id=$rolDuzenle";
                            $sonuc= mysqli_query($baglanti,$yetkiListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                $cek = $sonuc->fetch_assoc();
                                $yetkiID=$cek["id"];
                                $yetkiRol =$cek["rol"];;
                                echo '
                                    Rol (Mevcut: '.$yetkiRol.')
                                ';
                            } 
                            else 
                            {
                              echo "Rol";
                            }
          
                        ?>
                </label>
                <div class="input-group mb-3">
                    <select name="yetki" class="form-select" id="inputGroupSelect01">
                        <?php
                            $yetkiListele = "SELECT * FROM roller";
                            $sonuc= mysqli_query($baglanti,$yetkiListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $yetkiRol=$cek["rol"];
                                $yetkiID=$cek["id"];
          
                                echo '
                                    <option value='.$yetkiID.'>'.$yetkiRol.'</option>
                                ';
          
                              }
                            } 
                            else 
                            {
                              echo "Sonuç bulunamad.";
                            }
          
                        ?>
                    </select>
                </div>
            </div>            
            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Kullanıcı Düzenle</button>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>