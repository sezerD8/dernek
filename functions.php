<?php

if (!function_exists('dosyaListele')) {
    function dosyaListele(int $dosyaID, $listeleSayfa){
        echo'
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dosya Adı</th>
                <th scope="col">Dosyayı Sil</th>
            </tr>
        </thead>
        <tbody>
        ';
        include("baglanti.php");
        $sec= "SELECT * FROM dosyalar where dosyaTuru=".$dosyaID."";
        $sonuc= mysqli_query($baglanti,$sec);
        if ($sonuc !== false && $sonuc->num_rows > 0) 
        {
            while($cek = $sonuc->fetch_assoc()) 
            {
            $id=$cek["id"];
            $dosyaAd=$cek["dosyaAdi"];
            $dosyaTuru=$cek["dosyaTuru"];

            echo '
                <tr>
                <th scope="row">'.$id.'</th>
                <td>'.$dosyaAd.'</td>
                <td><a href="'.$listeleSayfa.'.php?id='.$id.'" type="submit" name="sil" class=" col-8 col-sm-4 btn btn-danger">Sil</a></td>
                </tr>
            ';
            
            }
                                    
        } 
        else 
        {
            echo '
                <td colspan="3"><h4 class="text-center">Henüz Dosyanız yok!</h4></td>

            ';
        }
    
}

}

if (!function_exists('dosyaSil')) {
    
function dosyaSil(int $dosyaID, $dosyaAdi, $listeleSayfa){
    if(isset($_GET["id"])){
        $idGET = $_GET['id'];
        include("baglanti.php");
        $sec= "SELECT * FROM dosyalar where dosyaTuru=".$dosyaID."";
        $sonuc= mysqli_query($baglanti,$sec);
        if ($sonuc !== false && $sonuc->num_rows > 0) 
        {
            while($cek = $sonuc->fetch_assoc()) 
            {
            $dosyaAd=$cek["dosyaAdi"];
            unlink("../uploads/".$dosyaAdi."/".$dosyaAd);
            }
                                    
        } 
        else 
        {
            echo "";
        }
        include("baglanti.php");
        $sil = "DELETE FROM dosyalar WHERE id = '$idGET'";
        $calistirSil = mysqli_query($baglanti, $sil);
                if($calistirSil){
                    header("location:".$listeleSayfa.".php");
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        Başarısız!
                    </div>
                    ';
                }
    }
}

}



if (!function_exists('dosyaEkle')) {
    
    function dosyaEkle(int $dosyaID, $dosyaAd){
        if(isset($_POST["kaydet"])){
            $dosyaAdi_err ="";
            $maxBoyut = 1000000;
            $dosyaUzantisi = substr(strrchr($_FILES["dosya"]["name"],'.'),0);
            if(empty($_POST["dosyaAdi"])){
                echo'
                    <div class="alert alert-danger" role="alert">
                        Dosya Adı Boş Geçilemez!
                    </div>
                    ';
            }
            else{
                $dosyaAdi = $_POST['dosyaAdi'].rand(0,999).$dosyaUzantisi;
                $dosyaYolu = "../uploads/".$dosyaAd."/".$dosyaAdi;
                if($_FILES["dosya"]["size"] > $maxBoyut){
                    echo'
                    <div class="alert alert-danger" role="alert">
                        Dosya boyunu aştınız!
                    </div>
                    ';
                }
                
                else{
                    $d= $_FILES["dosya"]["type"];
                    if (
                        //DOSYA FİLTRE
                        
                        $d == "application/vnd.ms-excel" /*.xls*/|| 
                        $d == "application/pdf" /*.pdf*/|| 
                        $d == "application/msword" /*.doc*/|| 
                        $d == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" /*.xlsx*/||
                        $d == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" /*.docx*/
                        
                        
                        
                        ) {
                        if (is_uploaded_file($_FILES["dosya"]["tmp_name"])) {
                            $tasi = move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaYolu);
                            if ($tasi) {
                                include("baglanti.php");
                                $ekle = "INSERT INTO dosyalar (dosyaAdi, dosyaTuru, dosyaYolu) VALUES ('$dosyaAdi', '$dosyaID','$dosyaYolu')";
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
                                echo '
                                <div class="alert alert-success" role="alert">
                                    Dosya başarıyla yüklendi!
                                </div>
                                ';
                            }
                        }
                        else{
                            echo '
                            <div class="alert alert-danger" role="alert">
                                Dosya yüklenemedi!
                            </div>
                            ';
                        }
                    }
                    else{
                        echo '
                        <div class="alert alert-danger" role="alert">
                            Dosya uzantısı geçersiz! (Geçerli Dosya Uzantıları:.xls , .xlsx , .doc , .docx , .pdf)
                        </div>
                        ';
                    }
                }
            }
    
            
        }
    }
    
    }


?>