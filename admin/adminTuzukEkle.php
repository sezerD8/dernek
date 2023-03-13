<?php 
include("../headers/headerAdmin.php");
    include("../baglanti.php");
    include("../functions.php");
    dosyaEkle(1,"tuzuk","adminTuzukListele");

?>
    <div class="container pt-5">
        <div class="card p-5">
        <form action="<?= htmlspecialchars('./adminTuzukEkle.php')?>" method="POST" enctype="multipart/form-data">
            <h3 class="text-center pb-3">Tüzük Ekle</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Dosya Adı</label>
                <input name="dosyaAdi" class="form-control <?php echo !empty($dosyaAdi_err) ? 'is-invalid': '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dosya Adı">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?php
                    echo $dosyaAdi_err;
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Dosya</label>
                <div class="mb-3">
                    <input class="form-control" type="file" name="dosya" id="formFile">
                </div>               
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?php
                        echo $dosyaAdi_err;
                    ?>
                </div>
            </div>

            <button type="submit" name="kaydet" class="col-12 p-3 mt-3 btn btn-primary">Dosya Ekle</button>
                </tbody>
            </table> 
        </form>
        </div>
    </div>
    <?php
      include("../footers/footerAdmin.php");

    ?>