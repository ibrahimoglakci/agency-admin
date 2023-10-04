<?php
date_default_timezone_set('Europe/Istanbul');


?>

<head>
    <title>
        Giderler | <?= $sitebaslik ?>
    </title>
</head>

<?php
$user = $DB->CallData("kullanicilar", "WHERE state=? AND mail=?", array(1, $_SESSION["mail"]), "ORDER BY ID ASC", 1);



if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı" or $user[0]["Rank"] == "Muhasebe") {

?>

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Giderler</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Giderler</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gider Listesi</li>
                        </ol>
                    </div>

                </div>
                <!-- PAGE-HEADER END -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Giderler</h3>
                                <div class="col-md-11">
                                    <a href="<?= SITE ?>gider-ekle" class="btn btn-pink" style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                        YENİ
                                        EKLE</a>
                                </div>
                            </div>


                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="gider-tablo" class="table table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr>


                                                <th class="border-bottom-0">Gider Numarası</th>
                                                <th class="border-bottom-0">Gider Adı</th>
                                                <th class="border-bottom-0">Gider Kategorisi</th>
                                                <th class="border-bottom-0">Gider Ücreti</th>
                                                <th class="border-bottom-0">Ek Dosya</th>

                                                <th class="border-bottom-0">Eklenme Tarihi</th>

                                                <?php
                                                $user = $DB->CallData("kullanicilar", "WHERE ID=?", array($_SESSION["ID"]), "ORDER BY ID ASC", 1);

                                                if ($user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "Muhasebe" || $user[0]["Rank"] == "Yönetici") {
                                                ?>
                                                    <th class="border-bottom-0">Gideri Ekleyen Üye</th>
                                                <?php
                                                }
                                                ?>
                                                <th class="border-bottom-0">İşlem</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $veriler = $DB->CallData("sirketgider", "WHERE kategori=?", array(16), "ORDER BY tarih DESC");
                                            if ($veriler != false) {
                                                
                                                for ($i = 0; $i < count($veriler); $i++) {
                                                   
                                                    setlocale(LC_ALL, 'tr_TR.UTF-8');




                                                    $kategori = $DB->CallData("categories", "WHERE ID=?", array($veriler[$i]["kategori"]), "ORDER BY ID ASC", 1);
                                                    $giderucreti = $veriler[$i]["gider"];

                                                    if ($kategori[0]["title"] == "Sipariş Gideri") {
                                                        $gelircolor = "info";
                                                    } else if ($kategori[0]["title"] == "Şirket Gideri") {
                                                        $gelircolor = "danger";
                                                    }


                                                    $tarih = date("d F Y", strtotime($veriler[$i]["tarih"]));
                                                    $turkcetarih =  $DB->convertMonthToTurkishCharacter($tarih);

                                            ?>
                                                    <tr>




                                                        <td><span class="badge rounded-pill bg-success badge-sm me-1 mb-1 mt-1" style="font-size: 13px;">#<?= stripslashes($veriler[$i]["gider_numarasi"]) ?></span></td>


                                                        <td><?= $veriler[$i]["gider_adi"] ?></td>

                                                        <td><span class="badge bg-<?= $gelircolor ?> badge-sm  me-1 mb-1 mt-1"><?= $kategori[0]["title"] ?></span> </td>

                                                        <td><?php echo number_format($giderucreti); ?>₺</td>

                                                        <?php
                                                        if (!empty($veriler[$i]["ek_dosya"])) {
                                                            $uzanti = $DB->uzanti($veriler[$i]["ek_dosya"]);
                                                            if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {
                                                                $ekdosya = '<a href="' . SITE . 'assets/images/giderler/' . $veriler[$i]["ek_dosya"] . '" download="' . $veriler[$i]["ek_dosya"] . '" class="btn btn-info"><i class="fe fe-download me-2"></i>' . $veriler[$i]["ek_dosya"] . '</a>';
                                                            } else {
                                                                $ekdosya = ' <img src="'.SITE.' assets/images/giderler/'.$veriler[$i]["ek_dosya"].'" alt="" style="width: 80px; height: 80px;">';
                                                            }
                                                        } else {
                                                            $ekdosya = '<div class="alert alert-warning" role="alert">
                                                        <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                                        <span class="alert-inner--text">Herhangi bir dosya yüklenmedi!</span>
                                                    </div>';
                                                        }
                                                        ?>

                                                        <td><?php echo $ekdosya; ?></td>

                                                        <td><?= $turkcetarih ?></td>
                                                        <?php
                                                        $gelirekleyen = $DB->CallData("kullanicilar", "WHERE ID=?", array($veriler[$i]["ekleyen_uye"]), "ORDER BY ID ASC", 1);
                                                        ?>
                                                        <td><?= $gelirekleyen[0]["adsoyad"] ?></td>
                                                        <td style="display: inline-block; ">
                                                           <!--  <a href="<?= SITE ?>gider-duzenle/<?=$kategori[0]["ID"]?>/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Gideri Düzenle" data-bs-content="#<?= $veriler[$i]["gider_numarasi"] ?> numaralı gideri düzenlemek için tıkla!"><i class="fa fa-cog"></i>
                                                            </a> -->
                                                            <a onclick="giderSil('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>,'<?=$kategori[0]['seflink']?>');" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Gideri Sil" data-bs-content="#<?= $veriler[$i]["gider_numarasi"] ?> numaralı gideri kaldırmak için tıkla!"><i class="fe fe-trash"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
<!--                                      ********************************   Sipariş Giderleri            *******************************************-->

                                            <?php
                                            $verilersiparis = $DB->CallData("siparisgider", "WHERE kategori=?", array(15), "ORDER BY tarih DESC");
                                            if ($verilersiparis != false) {
                                               
                                                for ($is = 0; $is < count($verilersiparis); $is++) {
                                                   
                                                    setlocale(LC_ALL, 'tr_TR.UTF-8');




                                                    $kategorisiparis = $DB->CallData("categories", "WHERE ID=?", array($verilersiparis[$is]["kategori"]), "ORDER BY ID ASC", 1);
                                                    $siparisucreti = $verilersiparis[$is]["gider"];

                                                    if ($kategorisiparis[0]["title"] == "Sipariş Gideri") {
                                                        $sipariscolor = "info";
                                                    } else if ($kategorisiparis[0]["title"] == "Şirket Gideri") {
                                                        $sipariscolor = "danger";
                                                    }


                                                    $tarihsiparis = date("d F Y", strtotime($verilersiparis[$is]["tarih"]));
                                                    $turkcetarihsiparis =  $DB->convertMonthToTurkishCharacter($tarihsiparis);

                                            ?>
                                                    <tr>




                                                        <td><span class="badge rounded-pill bg-success badge-sm me-1 mb-1 mt-1" style="font-size: 13px;">#<?= stripslashes($verilersiparis[$is]["gider_numarasi"]) ?></span></td>


                                                        <td><?= $verilersiparis[$is]["gider_adi"] ?></td>

                                                        <td><span class="badge bg-<?= $sipariscolor ?> badge-sm  me-1 mb-1 mt-1"><?= $kategorisiparis[0]["title"] ?></span> </td>

                                                        <td><?php echo number_format($siparisucreti); ?>₺</td>

                                                        <?php
                                                        if (!empty($verilersiparis[$is]["ek_dosya"])) {
                                                            $uzantisiparis = $DB->uzanti($verilersiparis[$is]["ek_dosya"]);
                                                            if ($uzantisiparis == "doc" || $uzantisiparis == "docx" || $uzantisiparis == "pdf" || $uzantisiparis == "xlsx" || $uzantisiparis == "xls" || $uzantisiparis == "ppt" || $uzantisiparis == "xml" || $uzantisiparis == "mp4" || $uzantisiparis == "avi" || $uzantisiparis == "mov") {
                                                                $ekdosyasiparis = '<a href="' . SITE . 'assets/images/giderler/' . $verilersiparis[$is]["ek_dosya"] . '" download="' . $verilersiparis[$is]["ek_dosya"] . '" class="btn btn-info"><i class="fe fe-download me-2"></i>' . $verilersiparis[$is]["ek_dosya"] . '</a>';
                                                            } else {
                                                                $ekdosyasiparis = ' <img src="'. SITE . 'assets/images/giderler/'.$verilersiparis[$is]["ek_dosya"].'" alt="" style="width: 100px; height: 85px;">';
                                                            }
                                                        } else {
                                                            $ekdosyasiparis = '<div class="alert alert-warning" role="alert">
                                                        <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                                        <span class="alert-inner--text">Herhangi bir dosya yüklenmedi!</span>
                                                    </div>';
                                                        }
                                                        ?>

                                                        <td align="center"><?php echo $ekdosyasiparis; ?></td>

                                                        <td><?= $turkcetarihsiparis ?></td>
                                                        <?php
                                                        $siparisekleyen = $DB->CallData("kullanicilar", "WHERE ID=?", array($verilersiparis[$is]["ekleyen_uye"]), "ORDER BY ID ASC", 1);
                                                        ?>
                                                        <td><?= $siparisekleyen[0]["adsoyad"] ?></td>
                                                        <td style="display: inline-block; ">
                                                           <!--  <a href="<?= SITE ?>gider-duzenle/<?=$kategorisiparis[0]["ID"]?>/<?= $verilersiparis[$is]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Gideri Düzenle" data-bs-content="#<?= $verilersiparis[$is]["gider_numarasi"] ?> numaralı gideri düzenlemek için tıkla!"><i class="fa fa-cog"></i>
                                                            </a> -->
                                                            <a onclick="giderSil('<?= SITE ?>',<?= $verilersiparis[$is]['ID'] ?>,'<?=$kategorisiparis[0]['seflink']?>');" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Gideri Sil" data-bs-content="#<?= $verilersiparis[$is]["gider_numarasi"] ?> numaralı gideri kaldırmak için tıkla!"><i class="fe fe-trash"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- CONTAINER CLOSED -->


        </div>
    </div>

<?php

} else {
?>
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>" />
<?php
}

?>