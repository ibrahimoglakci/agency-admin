<?php
if (!empty(intval($_GET["ID"]))) {
    $ID = $DB->filter($_GET["ID"]);

    $veri = $DB->CallData("paketler", "WHERE ID=?", array($ID), "ORDER BY ID ASC", 1);
    if ($veri != false) {
?>


        <head>
            <title>Paket Düzenle | <?= $sitebaslik ?></title>
        </head>

        <!--app-content open-->
        <div class="main-content app-content mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                <div class="main-container container-fluid">

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <h1 class="page-title">Paket Düzenle</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Paketler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Paket Düzenle</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <?php
                    if ($_POST) {
                        if (!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["sirano"]) && !empty($_POST["fiyat"]) && !empty($_POST["aciklama"])) {
                            $kategori = $DB->filter($_POST["kategori"]);
                            $baslik = $DB->filter($_POST["baslik"]);
                            $anahtar = $DB->filter($_POST["anahtar"]);
                            $seflink = $DB->seflink($baslik);
                            $metin = $DB->filter($_POST["aciklama"], true);
                            $sirano = $DB->filter($_POST["sirano"]);

                            $fiyat = $DB->filter($_POST["fiyat"]);
                            $indirimlifiyat = $DB->filter($_POST["indirimlifiyat"]);

                            if (isset($_POST["ifiyat"])) {
                                $ifiyat = $DB->filter($_POST["ifiyat"]);

                                if ($ifiyat == "Aktif") {
                                    $iaktif = 1;
                                } else {
                                    $iaktif = 0;
                                }
                            }
                            else {
                                $iaktif = 0;
                            }
                            $vitrindurum = 1;




                            $yukle = $DB->upload("image", "assets/images/paketler/");
                            if ($yukle != false) {
                                $urunID = $DB->CallID("paketler");


                                $ekle = $DB->RunQuery("UPDATE paketler", "SET baslik=?, seflink=?, kategori=?, metin=?, resim=?, fiyat=?, indirimlifiyat=?, ifiyat=?, vitrindurum=?, anahtar=?, sirano=? WHERE ID=?", array($baslik, $seflink, $kategori, $metin, $yukle, $fiyat, $indirimlifiyat, $iaktif, $vitrindurum, $anahtar, $sirano, $veri[0]["ID"]));
                            } else {
                                $ekle = $DB->RunQuery("UPDATE paketler", "SET baslik=?, seflink=?, kategori=?, metin=?, fiyat=?, indirimlifiyat=?, ifiyat=?, vitrindurum=?, anahtar=?, sirano=? WHERE ID=?", array($baslik, $seflink, $kategori, $metin, $fiyat, $indirimlifiyat, $iaktif, $vitrindurum, $anahtar, $sirano, $veri[0]["ID"]));

                    ?>

                            <?php
                            }
                            if ($ekle != false) {
                            ?>
                                <div class="alert alert-success"><i class="fa fa-check-circle"></i> Paket başarıyla kaydedildi.</div>
                                <?php echo $_POST["ifiyat"];?>
                                <meta http-equiv="refresh" content="1;url=<?= SITE ?>paket-listesi">


                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-warning"><i class="fa fa-triangle-exclamation"></i> Lütfen Boş Alanları Doldurunuz!</div>
                    <?php

                        }
                    }

                    ?>


                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Paket Düzenle</div>
                                </div>
                                <form action="" method="post" class="urunEklemeFormu" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Kategori :</label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" style="width: 100%;" name="kategori">
                                                    <?php
                                                    $sonuc = $DB->callCategory("paketler", $veri[0]["kategori"], -1);
                                                    if ($sonuc != false) {

                                                        echo $sonuc;
                                                    } else {
                                                        $paketlers = $DB->simpleCategory("paketler");



                                                        echo $paketlers;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Paket İsmi :</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="baslik" placeholder="Paket İsmi" value="<?= $veri[0]["baslik"] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Paket Rengi :</label>
                                            <div class="col-md-9">

                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Fiyat :</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="fiyat" value="<?= $veri[0]["fiyat"] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">İndirimli Fiyat :</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="indirimlifiyat" value="<?= $veri[0]["indirimlifiyat"] ?>">
                                            </div>
                                        </div>

                                        <?php
                                        if ($veri[0]["ifiyat"] == 1) {
                                            $ifiyatcheck = 'checked';
                                        } else {
                                            $ifiyatcheck = '';
                                        }

                                        if ($veri[0]["kampanyaliurun"] == 1) {
                                            $kampanyacheck = 'checked';
                                        } else {
                                            $kampanyacheck = '';
                                        }
                                        ?>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">İndirimli Fiyat Aktif Olsun Mu? :</label>
                                            <div class="col-md-9">
                                                <label class="custom-switch form-switch mb-0">

                                                    <input type="checkbox" name="ifiyat" class="custom-switch-input" value="Aktif" <?= $ifiyatcheck ?>>
                                                    <span class="custom-switch-indicator"></span>


                                                </label>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Kampanyalı Ürün Olsun Mu? :</label>
                                            <div class="col-md-9">
                                                <label class="custom-switch form-switch mb-0">

                                                    <input type="checkbox" name="ikampanya" class="custom-switch-input" value="Evet" <?= $kampanyacheck ?> >
                                                    <span class="custom-switch-indicator"></span>
                                                   
                                                   
                                                    <div class="pickr-container2"></div>
                                                    


                                                </label>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Anahtar Kelime : </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="anahtar" value="<?= $veri[0]["anahtar"] ?>">
                                            </div>
                                        </div>
                                        <?php
                                        $paketkodnotext = explode("AVTR-", $veri[0]["paketkodu"]);
                                        ?>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Paket Kodu :</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="paketkodu" disabled value="<?= $paketkodnotext[1] ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label">Sıra Numarası</label>
                                            <input type="number" class="form-control" placeholder="Sıra Numarası.." name="sirano" style="width:100px;" value="<?= $veri[0]["sirano"] ?>">

                                        </div>



                                        <!-- Row -->
                                        <div class="row">
                                            <label class="col-md-3 form-label mb-4">Paket Açıklaması :</label>
                                            <div class="col-md-9 mb-4">
                                                <textarea class="content" name="aciklama"> <?= stripslashes($veri[0]["metin"]) ?> </textarea>
                                            </div>
                                        </div>
                                        <!--End Row-->

                                        <!--Row-->
                                        <div class="row">
                                            <label class="col-md-3 form-label mb-4">Paket Resmi :</label>
                                            <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                                <?php if (isset($veri[0]["resim"])) { ?>
                                                    <img src="<?= SITE ?>assets/images/paketler/<?= $veri[0]["resim"] ?>" alt="">
                                                <?php } ?>
                                                <input type="file" class="dropify" data-bs-height="100" name="image" />
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" name="ekle" class="btn btn-success">Paketi Kaydet</button>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /ROW-1 CLOSED -->
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!--app-content closed-->


<?php
    } else {
        echo "Hatalı Bilgi gönderildi!";
    }
} else {
    echo "Bu sayfaya erişim izniniz bulunmamaktadır!";
}
?>