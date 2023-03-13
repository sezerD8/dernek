<?php 
 ob_start();
 include("../headers/headerAdmin.php");
    include("../functions.php");
    dosyaSil(1,"tuzuk","adminTuzukListele");

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminTuzukEkle.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Tüzük Listele</h3>
                <?php
                    include("../functions.php");
                    dosyaListele("1","adminTuzukListele");
                ?>
                </tbody>
            </table>    
            <a href="adminTuzukEkle.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Tüzük Dosyası Ekle</a>

        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

      ob_flush();
    ?>