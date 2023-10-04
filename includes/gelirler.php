<?php
date_default_timezone_set('Europe/Istanbul');


?>

<head>
    <title>
        Gelirler | <?= $sitebaslik ?>
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
                    <h1 class="page-title">Gelirler</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Gelirler</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gelir Listesi</li>
                        </ol>
                    </div>

                </div>
                <!-- PAGE-HEADER END -->

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Gelirler</h3>
                                <div class="col-md-11">
                                    <a href="<?= SITE ?>gelir-ekle" class="btn btn-pink" style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                        YENİ
                                        EKLE</a>
                                </div>
                            </div>


                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="gelir-tablo" class="table table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr>


                                                <th class="border-bottom-0">Gelir Numarası</th>
                                                <th class="border-bottom-0">Gelir Adı</th>
                                                <th class="border-bottom-0">Gelir Kategorisi</th>
                                                <th class="border-bottom-0">Gelir Ücreti</th>
                                                <th class="border-bottom-0">Ek Dosya</th>

                                                <th class="border-bottom-0">Eklenme Tarihi</th>

                                                <?php
                                                $user = $DB->CallData("kullanicilar", "WHERE ID=?", array($_SESSION["ID"]), "ORDER BY ID ASC", 1);

                                                if ($user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "CEO" || $user[0]["Rank"] == "Yönetici") {
                                                ?>
                                                    <th class="border-bottom-0">Geliri Ekleyen Üye</th>
                                                <?php
                                                }
                                                ?>
                                                <th class="border-bottom-0">İşlem</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $veriler = $DB->CallData("siparisgelir", "", "", "ORDER BY tarih DESC");
                                            if ($veriler != false) {
                                                $sira = 0;
                                                for ($i = 0; $i < count($veriler); $i++) {
                                                    $sira++;
                                                    setlocale(LC_ALL, 'tr_TR.UTF-8');




                                                    $kategori = $DB->CallData("categories", "WHERE ID=?", array($veriler[$i]["kategori"]), "ORDER BY ID ASC", 1);
                                                    $gelirucreti = $veriler[$i]["gelir"];

                                                    if ($kategori[0]["title"] == "Sipariş Geliri") {
                                                        $gelircolor = "info";
                                                    } else if ($kategori[0]["title"] == "Diğer Gelirler") {
                                                        $gelircolor = "danger";
                                                    }


                                                    $tarih = date("d F Y", strtotime($veriler[$i]["tarih"]));
                                                    $turkcetarih =  $DB->convertMonthToTurkishCharacter($tarih);

                                            ?>
                                                    <tr>




                                                        <td><span class="badge rounded-pill bg-success badge-sm me-1 mb-1 mt-1" style="font-size: 13px;">#<?= stripslashes($veriler[$i]["gelir_numarasi"]) ?></span></td>


                                                        <td><?= $veriler[$i]["gelir_adi"] ?></td>

                                                        <td><span class="badge bg-<?= $gelircolor ?> badge-sm  me-1 mb-1 mt-1"><?= $kategori[0]["title"] ?></span> </td>

                                                        <td><?php echo number_format($gelirucreti); ?>₺</td>

                                                        <?php
                                                        if (!empty($veriler[$i]["ek_dosya"])) {
                                                            $uzanti = $DB->uzanti($veriler[$i]["ek_dosya"]);
                                                            if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {
                                                                $ekdosya = '<a href="' . SITE . 'assets/images/gelirler/' . $veriler[$i]["ek_dosya"] . '" download="' . $veriler[$i]["ek_dosya"] . '" class="btn btn-info"><i class="fe fe-download me-2"></i>' . $veriler[$i]["ek_dosya"] . '</a>';
                                                            } else {
                                                                $ekdosya = ' <img src="<?=SITE?>assets/images/gelirler/<?=$veriler[$i]["ek_dosya"]?>" alt="">';
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
                                                           <!--  <a href="<?= SITE ?>gelir-duzenle/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Geliri Düzenle" data-bs-content="#<?= $veriler[$i]["gelir_numarasi"] ?> numaralı geliri düzenlemek için tıkla!"><i class="fa fa-cog"></i>
                                                            </a> -->
                                                            <a onclick="gelirSil('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Geliri Sil" data-bs-content="#<?= $veriler[$i]["gelir_numarasi"] ?> numaralı geliri kaldırmak için tıkla!"><i class="fe fe-trash"></i>
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