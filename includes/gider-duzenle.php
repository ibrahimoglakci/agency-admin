<head>
    <title>Gelir Ekle | <?= $sitebaslik ?></title>
</head>
<?php

if (!empty($_GET["kategori"]) && !empty(intval($_GET["ID"]))) {
    $ID = $DB->filter($_GET["ID"]);
    $kategoriget = $DB->filter($_GET["kategori"]);

    if ($kategoriget == 15) {
        $veri = $DB->CallData("siparisgider", "WHERE ID=?", array($ID), "ORDER BY ID ASC", 1);
    } else if ($kategoriget == 16) {
        $veri = $DB->CallData("sirketgider", "WHERE ID=?", array($ID), "ORDER BY ID ASC", 1);
    } else {
?>
        <meta http-equiv="refresh" content="0;url=<?= SITE ?>" />
    <?php
    }
} else {
    ?>
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>" />
<?php
}

$user = $DB->CallData("kullanicilar", "WHERE state=? AND mail=?", array(1, $_SESSION["mail"]), "ORDER BY ID ASC", 1);



if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı" or $user[0]["Rank"] == "Muhasebe") {




?>

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Gider Düzenle</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= SITE ?>gelirler">Giderler</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gider Düzenle</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if ($_POST) {
                            if (!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["miktar"])) {
                                $kategori = $DB->filter($_POST["kategori"]);

                                $baslik = $DB->filter($_POST["baslik"]);
                                $miktar = $DB->filter($_POST["miktar"]);

                                $gelirkod = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                                if ($kategori == 15) {
                                    if ($kategoriget == 15) {
                                        $sqlstate = "update";
                                        $table = "siparisgider";
                                    } else if ($kategoriget == 16) {
                                        $sqlstate = "insert";
                                        $deltable = "sirketgider";
                                        $table = "siparisgider";
                                    }
                                } else if ($kategori == 16) {
                                    if ($kategoriget == 16) {
                                        $sqlstate = "update";
                                        $table = "sirketgider";
                                    } else if ($kategoriget == 6u15) {
                                        $sqlstate = "insert";
                                        $deltable = "siparisgider";
                                        $table = "sirketgider";
                                    }
                                }

                                $kullanici_id = $_SESSION["ID"];

                                if (!empty($_FILES["resim"]["name"])) {
                                    $uzanti = $DB->uzanti($_FILES["resim"]["name"]);
                                    if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {
                                        $yukle = $DB->upload("resim", "assets/images/giderler/", "ds");
                                    } else {
                                        $yukle = $DB->upload("resim", "assets/images/giderler/");
                                    }

                                    if ($yukle != false) {

                                        if ($sqlstate = "update") {
                                            $ekle = $DB->RunQuery("UPDATE " . $table . "", "SET gider_numarasi=?, gider=?, kategori=?, ekleyen_uye=?, gider_adi=?, ek_dosya=?, tarih=? WHERE ID=?", array($gelirkod, $miktar, $kategori, $kullanici_id, $baslik, $yukle, date("Y-m-d"), $ID));
                                        } else  if ($sqlstate = "insert") {
                                            $sil = $DB->RunQuery("DELETE FROM " . $deltable . "", "WHERE ID=?", array($ID), 1);
                                            $ekle = $DB->RunQuery("INSERT INTO " . $table . "", "SET gider_numarasi=?, gider=?, kategori=?, ekleyen_uye=?, gider_adi=?, ek_dosya=?, tarih=?", array($gelirkod, $miktar, $kategori, $kullanici_id, $baslik, $yukle, date("Y-m-d")));
                                        }
                                    } else {


                        ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Dosya yüklenemedi.</div>
                                    <?php
                                    }
                                    if ($ekle != false) {
                                    ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Gider başarıyla düzenlendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?= SITE ?>giderler">


                                    <?php
                                    } else {
                                    ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                    <?php
                                    }
                                } else {
                                    if ($sqlstate = "update") {
                                        $ekle = $DB->RunQuery("UPDATE " . $table . "", "SET gider_numarasi=?, gider=?, kategori=?, ekleyen_uye=?, gider_adi=?, tarih=? WHERE ID=?", array($gelirkod, $miktar, $kategori, $kullanici_id, $baslik, date("Y-m-d"), $ID));
                                    } else  if ($sqlstate = "insert") {
                                        $sil = $DB->RunQuery("DELETE FROM " . $deltable . "", "WHERE ID=?", array($ID), 1);
                                        $ekle = $DB->RunQuery("INSERT INTO " . $table . "", "SET gider_numarasi=?, gider=?, kategori=?, ekleyen_uye=?, gider_adi=?, tarih=?", array($gelirkod, $miktar, $kategori, $kullanici_id, $baslik, date("Y-m-d")));
                                    }
                                    ?>

                                    <?php

                                    if ($ekle != false) {
                                    ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Gider başarıyla düzenlendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?= SITE ?>giderler">


                                    <?php
                                    } else {
                                    ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class="alert alert-warning"><i class="fa fa-triangle-exclamation"></i> Lütfen Boş Alanları Doldurunuz!</div>
                        <?php

                            }
                        }

                        ?>
                        <div class="card">



                            <div class="card-header">
                                <div class="card-title">Gelir Ekle</div>
                            </div>




                            <form action="" method="post" class="randevuEklemeFormu" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Kategori Seçiniz :</label>
                                        <div class="col-md-9">
                                            <select class="form-control select2" style="width: 100%;" name="kategori">
                                                <?php
                                                $sonuc = $DB->callCategory("giderler", $veri[0]["kategori"], -1);
                                                if ($sonuc != false) {

                                                    echo $sonuc;
                                                } else {
                                                    $paketlers = $DB->simpleCategory("giderler");



                                                    echo $paketlers;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>







                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Gider İsmi :</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="baslik" placeholder="Gelir İsmini Giriniz" value="<?= $veri[0]["gider_adi"] ?>">
                                        </div>
                                    </div>



                                    <div class="row mb-4">
                                        <label class="col-md-3 form-label">Gider Miktarı :</label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-info" id="button-addon1">₺</span>
                                                <input type="text" class="form-control" placeholder="Gelir Miktarını Giriniz" name="miktar" value="<?= $veri[0]["gider"] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            </div>
                                        </div>

                                    </div>




                                    <!--Row-->
                                    <div class="row">
                                        <label class="col-md-3 form-label mb-4">Ek dosya :</label>
                                        <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                            <input type="file" class="dropify" data-bs-height="100" name="resim" />
                                        </div>
                                    </div>
                                    <!--End Row-->
                                </div>

                                <div class="card-footer">
                                    <!--Row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="ekle" class="btn btn-success">Güncelle</button>
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
?>
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>" />
<?php
}

?>