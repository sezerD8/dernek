<?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");

    $aciklama_err = $oAidat_err= $bAidat_err= $oDiger_err =  $bDiger_err =  $borc_err =  $kazanc_err= $IDDuzenle = $aciklamaDuzenle =  
    $oAidatDuzenle = $bAidatDuzenle=$oDigerDuzenle=$bDigerDuzenle=$kazancDuzenle =$kullaniciDuzenle=$ayDuzenle=$yilDuzenle= "";
    
    if(isset($_POST['bilgi'])){
        include("../baglanti.php");
        $id = $_POST['id'];
        $sil = "SELECT * FROM uyeodeme WHERE id = $id";
        $calistirDuzenle = mysqli_query($baglanti, $sil);
                if($calistirDuzenle !== false && $calistirDuzenle->num_rows > 0){
                    while($cek = $calistirDuzenle->fetch_assoc()) 
                        {
                            $IDDuzenle=$cek["id"];
                            $aciklamaDuzenle=$cek["aciklama"];
                            $oAidatDuzenle=$cek["odenenAidat"];
                            $bAidatDuzenle=$cek["borcAidat"];
                            $oDigerDuzenle=$cek["odenenDiger"];
                            $bDigerDuzenle=$cek["borcDiger"];
                            $kazancDuzenle=$cek["kazanc"];
                            $kullaniciDuzenle=$cek["kullanici"];
                            $ayDuzenle=$cek["ay"];
                            $yilDuzenle=$cek["yil"];
                            
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

        $kullanici = $_POST["kullanici"];
        $ay = $_POST["ay"];
        $yil = $_POST["yil"];
        $id = $_POST["id"];

        if(strlen($_POST["aciklama"]) == 0){
            $aciklama_err="Açıklama boş geçilemez";
        }
        else{
            $aciklama = $_POST["aciklama"];
        }


        if(strlen($_POST["oAidat"]) == 0){
            $oAidat_err="Ödenen aidat boş geçilemez";
        }
        else{
            $oAidat = $_POST["oAidat"];
        }


        
        if(strlen($_POST["bAidat"]) == 0){
            $bAidat_err="Aidat borç boş geçilemez";
        }
        else{
            $bAidat = $_POST["bAidat"];
        }
        

        if(strlen($_POST["oDiger"]) == 0){
            $oDiger_err="Diğer ödenen geçilemez";
        }
        else{
            $oDiger = $_POST["oDiger"];
        }



        if(strlen($_POST["bDiger"]) == 0){
            $bDiger_err="Dieğr borç boş geçilemez";
        }
        else{
            $bDiger = $_POST["bDiger"];
        }


        
        if(strlen($_POST["kazanc"]) == 0){
            $kazanc_err="Kazanç boş geçilemez";
        }
        else{
            $kazanc = $_POST["kazanc"];
        }


        if(isset($aciklama) && isset($oAidat) && isset($bAidat) && isset($oDiger)&& isset($bAidat)&& isset($oAidat)&& isset($kazanc)&& isset($ay)&& isset($kullanici)&& isset($yil)){
            $ekle = "UPDATE uyeodeme SET ay='$ay',yil='$yil', aciklama='$aciklama', odenenAidat='$oAidat', borcAidat='$bAidat', odenenDiger='$oDiger', borcDiger='$bDiger', kazanc='$kazanc', kullanici='$kullanici' WHERE id=$id";
            $calistirEkle = mysqli_query($baglanti, $ekle);
                if($calistirEkle){
                    echo '<meta http-equiv="refresh" content="2">';
                    echo '
                    <div class="alert alert-primary" role="alert">
                        Eklendi! Sayfa 2 Saniye içinde yenilenecektir.
                    </div>
                    ';
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Başarısız!
                    </div>
                    ';
                }
                mysqli_close($baglanti);
        }
    }

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminOdemeDuzenle.php')?>" method="POST">
            <h3 class="text-center pb-3">Üye Ödeme Ekleme</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Ödeme ID</label>
                <div class="d-flex ">
                    <input name="id" class="me-4 form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ID" value="<?php echo isset($_GET['id']) ? $_GET['id'] : $IDDuzenle ?>">
                    <button name="bilgi" class="text-white col-4 btn btn-success">Bilgileri Getir</button>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Açıklama</label>
                <input name="aciklama" class="form-control <?php echo !empty($aciklama_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Açıklama" value="<?php echo $aciklamaDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $aciklama_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ödenen (Aidat)</label>
                <input type="number" step='0.01' name="oAidat" pattern="[0-9]+" class="form-control <?php echo !empty($oAidat_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ödenen Aidat" value="<?php echo $oAidatDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bAidat_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Borç (Aidat)</label>
                <input type="number" step='0.01' name="bAidat" pattern="[0-9]+" class="form-control <?php echo !empty($bAidat_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Borç Aidat" value="<?php echo $bAidatDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bAidat_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ödenen (Diğer)</label>
                <input type="number" step='0.01' name="oDiger" pattern="[0-9]+" class="form-control <?php echo !empty($oDiger_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diğer Ödenen" value="<?php echo $oDigerDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $oDiger_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Borç (Diğer)</label>
                <input type="number" step='0.01' name="bDiger" pattern="[0-9]+" class="form-control <?php echo !empty($bDiger_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diğer Borç" value="<?php echo $bDigerDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bDiger_err
                    ?>
                </div>
            </div>    
            <div class="form-group">
                <label for="exampleInputEmail1">Kazanç</label>
                <input type="number" step='0.01' pattern="[0-9]+" name="kazanc" class="form-control <?php echo !empty($kazanc_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kazanç" value="<?php echo $kazancDuzenle?>">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $kazanc_err
                    ?>
                </div>
            </div>    
            <div class="form-group">
                <label for="inputGroupSelect01">
                <?php
                            $ayListele = "SELECT * FROM kullanicilar where id=$kullaniciDuzenle";
                            $sonuc= mysqli_query($baglanti,$ayListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                $cek = $sonuc->fetch_assoc();
                                $kullaniciID=$cek["id"];
                                $kullaniciAdi =$cek["kullanici_adi"];
                                echo '
                                    Kullanıcı (Mevcut: '.$kullaniciAdi.')
                                ';
                            } 
                            else 
                            {
                              echo "Kullanıcı";
                            }
          
                        ?>
                </label>
                <div class="input-group mb-3">
                    <select name="kullanici" class="form-select" id="inputGroupSelect01">
                        <?php
                            $yetkiListele = "SELECT * FROM kullanicilar";
                            $sonuc= mysqli_query($baglanti,$yetkiListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $kullaniciID=$cek["id"];
                                $kullaniciAdi =$cek["kullanici_adi"];
          
                                echo '
                                    <option value='.$kullaniciID.'>'.$kullaniciAdi.'</option>
                                ';
          
                              }
                            } 
                            else 
                            {
                              echo "Sonuç bulunamadı.";
                            }
          
                        ?>
                    </select>
                </div>
            </div>    
            <div class="form-group">
                <label for="inputGroupSelect01">
                <?php
                            $ayListele = "SELECT * FROM aylar where id=$ayDuzenle";
                            $sonuc= mysqli_query($baglanti,$ayListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                $cek = $sonuc->fetch_assoc();
                                $ayID=$cek["id"];
                                $ayAdi =$cek["ayAd"];
                                echo '
                                    Ay (Mevcut: '.$ayAdi.')
                                ';
                            } 
                            else 
                            {
                              echo "Ay";
                            }
          
                        ?>
                </label>
                <div class="input-group mb-3">
                    <select name="ay" class="form-select" id="inputGroupSelect01">
                        <?php
                            $yetkiListele = "SELECT * FROM aylar";
                            $sonuc= mysqli_query($baglanti,$yetkiListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $ayID=$cek["id"];
                                $ayAdi =$cek["ayAd"];
          
                                echo '
                                    <option value='.$ayID.'>'.$ayAdi.'</option>
                                ';
          
                              }
                            } 
                            else 
                            {
                              echo "Sonuç bulunamadı.";
                            }
          
                        ?>
                    </select>
                </div>
            </div>    
            <div class="form-group">
                <label for="inputGroupSelect01">
                <?php
                            $yilListele = "SELECT * FROM yillar where id=$yilDuzenle";
                            $sonuc= mysqli_query($baglanti,$yilListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                $cek = $sonuc->fetch_assoc();
                                $yilID=$cek["id"];
                                $yilAdi =$cek["yil"];
                                echo '
                                    Yıl (Mevcut: '.$yilAdi.')
                                ';
                            } 
                            else 
                            {
                              echo "Yıl";
                            }
          
                        ?>
                </label>
                <div class="input-group mb-3">
                    <select name="yil" class="form-select" id="inputGroupSelect01">
                        <?php
                            $yilListele = "SELECT * FROM yillar";
                            $sonuc= mysqli_query($baglanti,$yilListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cekYil = $sonuc->fetch_assoc()) 
                              {
                                $yilID=$cekYil["id"];
                                $yilAdi=$cekYil["yil"];
                                echo '
                                    <option value='.$yilID.'>'.$yilAdi.'</option>
                                ';
          
                              }
                            } 
                            else 
                            {
                              echo "Sonuç bulunamadı.";
                            }
          
                        ?>
                    </select>
                </div>
            </div>            
            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Ödeme Ekle</button>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>