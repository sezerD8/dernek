<?php
    session_start();
    if(isset($_SESSION['kullanici_adi']) && $_SESSION['rol'] != 3 )
        echo'';
    else{
        header('location:../site/login.php');
    }
    if (!empty($_GET['file'])) {
        include("../baglanti.php"); 
        $dosyaAdi = basename($_GET['file']);
        $dosyaYolu= "SELECT * FROM dosyalar where dosyaAdi='$dosyaAdi'";
        $sonuc= mysqli_query($baglanti,$dosyaYolu);
        if ($sonuc !== false && $sonuc->num_rows > 0) 
        {
            while($cek = $sonuc->fetch_assoc()) 
            {
                $dosyaYol=$cek["dosyaYolu"];
                if(!empty($dosyaAdi) && file_exists($dosyaYol)){
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.$dosyaAdi.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize("".$dosyaYol.""));
                    ob_clean();
                    flush();
                    readfile($dosyaYol); 	
                    exit();
                }
                else{
                    echo '
                    <div class="alert alert-danger" role="alert">
                        İndirmek istediğiniz dosya bulunamadı!
                    </div>
                    ';
                }
            
            }
                                    
        } 

        
    }

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
        .file:hover{
            text-decoration: underline!important;
            cursor:pointer;
        }
        .file:nth-child(odd){
            background-color:#f2f2f2;
        }
    </style>
</head>
<body style="background-color:#f2f2f2;">
<div class="d-flex justify-content-between flex-column" style="min-height: 100vh;">
    <?php
        include('../headers/header.php')
    ?>
        <div class="container mx-auto justify-content-start pt-5" style="min-height: 100vh;">
            <div class="d-flex flex-column ">
                <div class="d-flex flex-row justify-content-center align-items-center col-12 border-bottom pb-2 mb-3">
                    <h4 class="col-4 text-center">Tüzük</h4>
                    <h4 class="col-4 text-center">Denetim Raporu</h4>
                    <h4 class="col-4 text-center">Muhasebe</h4>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-around">
                <div class="d-inline text-center col-4">
                    <?php
                            include("../baglanti.php");
                            $sec= "SELECT * FROM dosyalar where dosyaTuru=1";
                            $sonuc= mysqli_query($baglanti,$sec);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                while($cek = $sonuc->fetch_assoc()) 
                                {
                                $dosyaAd=$cek["dosyaAdi"];
                                
                                echo '
                                <a href="denetim.php?file='.$dosyaAd.'" class="py-3 d-block text-decoration-none file">'.$dosyaAd.'</a>
                                ';
                                
                                }
                                                        
                            } 
                            else 
                            {
                                echo "<h5>Henüz bir dosya eklenmemiş!</h5>";
                            }
                        ?>
                </div>
                <div class="d-inline text-center col-4">
                    <?php
                            $sec= "SELECT * FROM dosyalar where dosyaTuru=2";
                            $sonuc= mysqli_query($baglanti,$sec);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                while($cek = $sonuc->fetch_assoc()) 
                                {
                                $dosyaAd=$cek["dosyaAdi"];
                                
                                echo '
                                <a href="denetim.php?file='.$dosyaAd.'" class="py-3 d-block text-decoration-none file">'.$dosyaAd.'</a>
                                ';
                                
                                }
                                                        
                            } 
                            else 
                            {
                                echo "<h5>Henüz bir dosya eklenmemiş!</h5>";
                            }
                        ?>
                </div>
                <div class="text-center col-4">
                    <?php
                            $sec= "SELECT * FROM dosyalar where dosyaTuru=3";
                            $sonuc= mysqli_query($baglanti,$sec);
                            if ($sonuc !== false && $sonuc->num_rows > 0) 
                            {
                                while($cek = $sonuc->fetch_assoc()) 
                                {
                                $dosyaAd=$cek["dosyaAdi"];
                                
                                echo '
                                <a href="denetim.php?file='.$dosyaAd.'" class="py-3 d-block text-decoration-none file">'.$dosyaAd.'</a>
                                ';
                                
                                }
                                                        
                            } 
                            else 
                            {
                                echo "<h5>Henüz bir dosya eklenmemiş!</h5>";
                            }
                        ?>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
      include("../footers/footer.php");
      ?>
</div>