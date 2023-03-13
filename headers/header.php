<?php
    if(!isset($_SESSION['kullanici_adi']))
    {
        header('location:../index.php');
    }
?>
<header>
    <nav class="navbar bg-body-tertiary mb-5 " style="background-color: #1f262d!important;">
        <div class="container justify-content-center p-2 " >
          <div>
            <?php
                if(isset($_SESSION['kullanici_adi'])){
                    if($_SESSION['rol'] == 1)
                    {
                        echo'
                            <a href="../admin/adminUyeEkle.php" class="navbar-brand fs-6 text-white">Admin Paneli</a>
                            <a href="../site/denetim.php" class="navbar-brand fs-6 text-white">Dosyalar</a>
                        ';
                    }
                    else if($_SESSION['rol'] == 2){
                        echo'                        
                            <a href="../site/denetim.php" class="navbar-brand fs-6 text-white">Dosyalar</a>
                        ';
                    }
                    echo'
                        <a href="../site/users.php" class="navbar-brand fs-6 text-white">'.$_SESSION['adi']." ".$_SESSION['soyadi'].'</a>
                        <a href="../cikis.php" class="navbar-brand fs-6 text-white">Çıkış Yap</a>
                    ';
                }
                else{
                    echo'
                        <button type="button" class="btn btn-outline-primary me-2 text-white"><a href="../index.php" class="text-decoration-none text-black">Giriş yap</a></button>
                    ';
                }
            ?>
          </div>
        </div>
      </nav>
  </header>