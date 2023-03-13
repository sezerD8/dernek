 <?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");
    
    $username_err = $tc_err= $sifre_err= $sifreTekrar_err =  $ad_err =  $soyad_err =  $tel_err= $yetki_err ="";
    if(isset($_POST["kaydet"])){


        if(strlen($_POST["kadi"]) == 0){
            $username_err="Kullanıcı adı boş geçilemez";
        }
        else{
            $kadi = $_POST["kadi"];
        }


        if(strlen($_POST["sifre"]) == 0){
            $sifre_err="Şifre boş geçilemez";
        }
        else if(strlen($_POST["sifre"]) < 4){
            $sifre_err="Şifre 4 karakterden büyük olmalıdır";
        }
        else{
            $sifre = password_hash($_POST["sifre"],PASSWORD_DEFAULT);
        }


        
        if(strlen($_POST["sifreTekrar"]) == 0){
            $sifreTekrar_err="Şifre boş geçilemez";
        }
        else if($_POST["sifreTekrar"] != $_POST["sifreTekrar"]){
            $sifreTekrar_err="Şifreler uyuşmuyor!";
        }
        else{
            $sifreTekrar = $_POST["sifreTekrar"];
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

        if(isset($kadi) && isset($sifre) && isset($sifreTekrar) && isset($ad) && isset($soyad) && isset($tc) && isset($tel) && isset($yetki)){
            $ekle = "INSERT INTO kullanicilar (kullanici_adi, parola, adi, soyadi, tc, telefon, rol) VALUES ('$kadi', '$sifre', '$ad', '$soyad', '$tc', '$tel', '$yetki' )";
            $calistirEkle = mysqli_query($baglanti, $ekle);
                if($calistirEkle){
                    echo '<meta http-equiv="refresh" content="2">';
                    echo '
                    <div class="alert alert-primary" role="alert">
                        Üye Eklendi! Sayfa 2 Saniye içinde yenilenecektir.
                    </div>
                    ';
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Ödeme Eklenemedi! Lütfen geçerli değerler giriniz.
                    </div>
                    ';
                }
                mysqli_close($baglanti);
        }
    }

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminUyeEkle.php')?>" method="POST">
            <h3 class="text-center pb-3">Kullanıcı Ekle</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Kullanıcı Adı</label>
                <input name="kadi" class="form-control <?php echo !empty($username_err) ? 'is-invalid': '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kullanıcı Adı">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?php
                    echo $username_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Şifre</label>
                <input name="sifre" type="password" class="form-control <?php echo !empty($sifre_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Şifre">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $sifre_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Şifre Tekrar</label>
                <input name="sifreTekrar" type="password" class="form-control <?php echo !empty($sifreTekrar_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Şifre">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $sifre_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ad</label>
                <input name="ad" class="form-control <?php echo !empty($ad_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ad">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $ad_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Soyad</label>
                <input name="soyad" class="form-control <?php echo !empty($soyad_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Soyad">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $soyad_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">TC No</label>
                <input name="tc" class="form-control <?php echo !empty($tc_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="TC No">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $tc_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telefon</label>
                <input name="tel" class="form-control <?php echo !empty($tel_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telefon">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $tel_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputGroupSelect01">Rol</label>
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
                              echo "Sonuç Bulunamadı.";
                            }
          
                        ?>
                    </select>
                </div>
            </div>            
            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Kullanıcı Ekle</button>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>