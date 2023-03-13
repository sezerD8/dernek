<?php 
 ob_start();
    include("../headers/headerAdmin.php");
    include("../functions.php");
    dosyaSil(2,"denetimRaporu","adminDeRaporuListele");

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminDeRaporuListele.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Denetim Raporu Listele</h3>
                    <?php
                        include("../functions.php");
                        dosyaListele("2","adminDeRaporuListele");
                    ?>
                </tbody>
            </table>    
            <a href="adminDeRaporuEkle.php" type="submit" name="listele" class="col-12 p-3 mt-3 btn btn-primary">Denetim Raporu Dosyası Ekle</a>

        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

      ob_flush();
    ?>