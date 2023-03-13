<?php 
 ob_start();
 include("../headers/headerAdmin.php");
    include("../functions.php");
    dosyaSil(3,"muhasebe","adminMuhasebeListele");

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminMuhasebeListele.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Muhasebe Listele</h3>
                <?php
                    include("../functions.php");
                    dosyaListele("3","adminMuhasebeListele");
                ?>
                </tbody>
            </table>    
            <a href="adminMuhasebeEkle.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Muhasebe Dosyası Ekle</a>

        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

      ob_flush();
    ?>