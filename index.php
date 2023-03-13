<?php 
    include("baglanti.php");
    session_start();

    $username_err = $sifre_err  ="";
    if(isset($_POST["giris"])){


        if(empty($_POST["kadi"])){
            $username_err="Kullanıcı adı boş geçilemez";
        }
        else{
            $kadi = $_POST["kadi"];
        }


        if(empty($_POST["sifre"])){
            $sifre_err="Şifre boş geçilemez";
        }
        else{
            $sifre = $_POST["sifre"];
        }


        if(isset($kadi) && isset($sifre)){
            
            $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kadi'";
            $calistirLogin = mysqli_query($baglanti,$secim);
            $kayitSayisi = mysqli_num_rows($calistirLogin);
            
            if ($kayitSayisi > 0) {
                $user = mysqli_fetch_assoc($calistirLogin);
                $userHash = $user["parola"];

                if(password_verify($sifre, $userHash)){
                    $_SESSION["kullanici_adi"]=$user["kullanici_adi"];
                    $_SESSION["id"]=$user["id"];
                    $_SESSION["adi"]=$user["adi"];
                    $_SESSION["soyadi"]=$user["soyadi"];
                    $_SESSION["tc"]=$user["tc"];
                    $_SESSION["telefon"]=$user["telefon"];
                    $_SESSION["rol"]=$user["rol"];
                    header('refresh:0');
                }

                else{
                    echo 
                    '
                    <div class="alert alert-danger m-0" role="alert">
                        Parola yanlış!
                    </div>
                    ';
                }
            }
            else{
                echo 
                '
                <div class="alert alert-danger m-0" role="alert">
                    Giriş başarısız!
                </div>
                ';
            }
            
            mysqli_close($baglanti);
        }
    }
        include('headers/headerIndex.php');
    ?>
  <body>
    <div class="d-flex flex-column justify-content-between" style="min-height:100vh;">
    
    
<div class="limiter m-0">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="<?= htmlspecialchars('index.php')?>" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Hoş geldiniz
					</span>
					<span class="login100-form-title p-b-48">
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input name="kadi" type="text" class="input100 <?php echo !empty($username_err) ? 'is-invalid': '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kullanıcı Adı">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?php
                            echo $username_err
                            ?>
                        </div>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input name="sifre" type="password" class="input100 <?php echo !empty($sifre_err) ? "is-invalid": "" ?>" id="exampleInputPassword1" placeholder="Şifre">
                        <div id="validationServerUsernameFeedback border-none" class="invalid-feedback">
                        <?php
                            echo $sifre_err
                            ?>
                        </div>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button name="giris" type="submit" class="login100-form-btn">
								Giriş
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    <?php
      include("footers/footer.php");
      ?>
    </div>






