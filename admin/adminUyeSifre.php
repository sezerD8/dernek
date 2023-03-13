<?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");
    
    $sifre_err= $sifreTekrar_err= $IDDuzenle = $kadiDuzenle = $sifreDuzenle="";
    

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
                            $sifreDuzenle=$cek["parola"];
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
        

        if(isset($kadi) && isset($sifre) && isset($sifreTekrar)){
            $ekle = "UPDATE kullanicilar SET parola='$sifre' WHERE id=$id";
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
                        Kullanıcının Şifresi Değiştirildi!
                    </div>
                    ';
                }
                mysqli_close($baglanti);
        }
    }
?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminUyeSifre.php')?>" method="POST">
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
                <input name="kadi" class="form-control <?php echo !empty($username_err) ? 'is-invalid': '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" readonly placeholder="Kullanıcı Adı" value="<?php echo $kadiDuzenle?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Şifre</label>
                <input name="sifre" type="password" class="form-control <?php echo !empty($sifre_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Şifre" value="<?php echo $sifreDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $sifre_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Şifre Tekrar</label>
                <input name="sifreTekrar" type="password" class="form-control <?php echo !empty($sifreTekrar_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Şifre" value="<?php echo $sifreDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $sifre_err
                    ?>
                </div>
            </div>
            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Şifreyi Değiştir</button>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>