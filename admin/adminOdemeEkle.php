<?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");

    $aciklama_err = $oAidat_err= $bAidat_err= $oDiger_err =  $bDiger_err =  $borc_err =  $kazanc_err="";
    if(isset($_POST["kaydet"])){

        $kullanici = $_POST["kullanici"];
        $ay = $_POST["ay"];
        $yil = $_POST["yil"];

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
            $bDiger_err="Diğer borç boş geçilemez";
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
            $ekle = "INSERT INTO uyeodeme (ay, yil, aciklama, odenenAidat, borcAidat, odenenDiger, borcDiger, kazanc, kullanici) VALUES ('$ay','$yil', '$aciklama', '$oAidat', '$bAidat', '$oDiger', '$bDiger', '$kazanc', '$kullanici')";
            $calistirEkle = mysqli_query($baglanti, $ekle);
                if($calistirEkle){
                    echo '<meta http-equiv="refresh" content="2">';
                    echo '
                    <div class="alert alert-primary" role="alert">
                        Ödeme Eklendi! Sayfa 2 Saniye içinde yenilenecektir.
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
        <form action="<?= htmlspecialchars('./adminOdemeEkle.php')?>" method="POST">
            <h3 class="text-center pb-3">Üye Ödeme Ekleme</h3>
            
            <div class="form-group">
                <label for="exampleInputPassword1">Açıklama</label>
                <input name="aciklama" class="form-control <?php echo !empty($aciklama_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Açıklama">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $aciklama_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ödenen (Aidat)</label>
                <input type="number" step='0.01' name="oAidat" pattern="[0-9]+" class="form-control <?php echo !empty($oAidat_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ödenen Aidat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bAidat_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Borç (Aidat)</label>
                <input type="number" step='0.01' name="bAidat" pattern="[0-9]+" class="form-control <?php echo !empty($bAidat_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Borç Aidat">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bAidat_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ödenen (Diğer)</label>
                <input type="number" step='0.01' name="oDiger" pattern="[0-9]+" class="form-control <?php echo !empty($oDiger_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diğer Ödenen">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $oDiger_err
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Borç (Diğer)</label>
                <input type="number" step='0.01' name="bDiger" pattern="[0-9]+" class="form-control <?php echo !empty($bDiger_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diğer Borç">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $bDiger_err
                    ?>
                </div>
            </div>    
            <div class="form-group">
                <label for="exampleInputEmail1">Kazanç</label>
                <input type="number" step='0.01' pattern="[0-9]+" name="kazanc" class="form-control <?php echo !empty($kazanc_err) ? "is-invalid": "" ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kazanç">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?php
                    echo $kazanc_err
                    ?>
                </div>
            </div>    
            <div class="form-group">
                <label for="inputGroupSelect01">Kullanıcı</label>
                <div class="input-group mb-3">
                    <select name="kullanici" class="form-select" >
                        <?php
                            $kullaniciListele = "SELECT * FROM kullanicilar";
                            $sonuc= mysqli_query($baglanti,$kullaniciListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $kullaniciID=$cek["id"];
                                $kullaniciKadi=$cek["kullanici_adi"];
          
                                echo '
                                    <option value='.$kullaniciID.'>'.$kullaniciKadi.'</option>
                                ';
          
                              }
                            } 
                            else 
                            {
                              echo "<option>Sonuç Bulunamadı.</option>";
                            }
          
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputGroupSelect01">Ay</label>
                <div class="input-group mb-3">
                    <select name="ay" class="form-select" id="inputGroupSelect01">
                        <?php
                            $ayListele = "SELECT * FROM aylar";
                            $sonuc= mysqli_query($baglanti,$ayListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $ayID=$cek["id"];
                                $ayAdi=$cek["ayAd"];
          
                                echo '
                                    <option value='.$ayID.'>'.$ayAdi.'</option>
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
            <div class="form-group">
                <label for="inputGroupSelect01">Yıl</label>
                <div class="input-group mb-3">
                    <select name="yil" class="form-select" id="inputGroupSelect01">
                        <?php
                            $ayListele = "SELECT * FROM yillar";
                            $sonuc= mysqli_query($baglanti,$ayListele);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                              while($cek = $sonuc->fetch_assoc()) 
                              {
                                $yilID=$cek["id"];
                                $yilAdi=$cek["yil"];
          
                                echo '
                                    <option value='.$yilID.'>'.$yilAdi.'</option>
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
            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Ödeme Ekle</button>
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>