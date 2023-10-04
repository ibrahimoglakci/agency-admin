<?php
date_default_timezone_set('Europe/Istanbul');


?>

<head>
    <title>
        Randevular | <?= $sitebaslik ?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Randevular</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Randevular</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Randevular</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Randevular</h3>
                            <div class="col-md-11">
                                <a href="<?= SITE ?>randevu-olustur" class="btn btn-pink" style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                    YENİ
                                    EKLE</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="randevu-tablo" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>


                                            <th class="border-bottom-0">Başlık</th>
                                            <th class="border-bottom-0">Durum</th>
                                            <th class="border-bottom-0">Not</th>
                                            <th class="border-bottom-0">Müşteri Ad Soyad</th>
                                            <th class="border-bottom-0">Müşteri Telefon</th>
                                            <th class="border-bottom-0">Kategori</th>
                                            <th class="border-bottom-0">Görüşme Tarihi</th>
                                            <th class="border-bottom-0">Randevu Tarihi</th>
                                            <th class="border-bottom-0">Randevu Saati</th>
                                            <th class="border-bottom-0">Kalan Gün</th>
                                            <th class="border-bottom-0">Paket Kodu</th>
                                            <th class="border-bottom-0">Müşteri Adres</th>
                                            <th class="border-bottom-0">Randevu Resim</th>
                                            <th class="border-bottom-0">Tarih</th>
                                            <?php
                                            $user = $DB->CallData("kullanicilar", "WHERE ID=?", array($_SESSION["ID"]), "ORDER BY ID ASC", 1);

                                            if ($user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "CEO" || $user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Müşteri Destek Elemanı") {
                                            ?>
                                                <th class="border-bottom-0">Randevu Ekleyen Üye</th>
                                            <?php
                                            }
                                            ?>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if($user[0]["kullanici"]=="serkankayaoglu" OR $user[0]["kullanici"]=="ibrahimoglakci") {
                                            $veriler = $DB->CallData("randevular", "", "", "ORDER BY randevu_tarihi DESC");
                                        }
                                        else {
                                            $veriler = $DB->CallData("randevular", "WHERE kullanici_id=?", array($user[0]["ID"]), "ORDER BY randevu_tarihi DESC");
                                        }
                                        
                                        if ($veriler != false) {
                                            $sira = 0;
                                            for ($i = 0; $i < count($veriler); $i++) {
                                                $sira++;
                                                setlocale(LC_ALL, 'tr_TR.UTF-8');

                                                $now =  strtotime($veriler[$i]["randevu_tarihi"]);
                                                $startdate = strtotime(date("Y-m-d"));
                                                $datediff = $now - $startdate;
                                                $randevuday = floor($datediff / 86400);

                                                $nowdate = strtotime($veriler[$i]["gorusme_tarihi"]);
                                                $today = date("d M Y", $nowdate);

                                                $nowdater = strtotime($veriler[$i]["randevu_tarihi"]);
                                                $todayr = date("d M Y", $nowdater);

                                                $gorusme_tarihi = $DB->convertMonthToTurkishCharacter($today);
                                                $randevu_tarihi = $DB->convertMonthToTurkishCharacter($todayr);


                                                $randevusaati = $veriler[$i]["randevu_saati"];

                                                $kategori = $DB->CallData("categories", "WHERE ID=?", array($veriler[$i]["kategori"]), "ORDER BY ID ASC", 1);

                                                if ($veriler[$i]["durum"] == 1) {
                                                    $aktifpasif = ' checked="checked"';
                                                } else {
                                                    $aktifpasif = '';
                                                }
                                                if ($randevuday == 1 or $randevuday == 0) {
                                                    $ekleyaklas = $DB->RunQuery("UPDATE randevular", "SET yaklasmadurum=? WHERE ID=?", array(2, $veriler[$i]["ID"]));
                                                    $randevucolor = "red";
                                                    $randevubgcolor = "rgba(246, 23, 23, 0.15);";
                                                } else if ($randevuday > 1) {
                                                    $randevucolor = "lime";
                                                    $randevubgcolor = 'rgba(92, 222, 3, 0.24)';
                                                    $ekleyaklas = $DB->RunQuery("UPDATE randevular", "SET yaklasmadurum=? WHERE ID=?", array(1, $veriler[$i]["ID"]));
                                                } else if ($randevuday < 0) {
                                                    $randevucolor = "gold";
                                                    $randevubgcolor = 'rgba(100, 122, 3, 0.24)';
                                                    $randevuday = "Süresi Doldu";
                                                    $ekleyaklas = $DB->RunQuery("UPDATE randevular", "SET yaklasmadurum=? WHERE ID=?", array(1, $veriler[$i]["ID"]));
                                                }
                                        ?>
                                                <tr style="background-color: <?= $randevubgcolor ?>">




                                                    <td><?= stripslashes($veriler[$i]["baslik"]) ?></td>

                                                    <td>
                                                        <div class="material-switch ">
                                                            <input type="checkbox" class="custom-control-input aktifpasif<?= $veriler[$i]['ID'] ?>" id="someSwitchOptionSuccess customSwitch3<?= $veriler[$i]['ID'] ?>" <?= $aktifpasif ?> value="<?= $veriler[$i]['ID'] ?>" onclick="aktifpasif(<?= $veriler[$i]['ID'] ?>,'randevular');">
                                                            <label class="label-success" for="someSwitchOptionSuccess customSwitch3<?= $veriler[$i]["ID"] ?>"></label>
                                                        </div>
                                                    </td>


                                                    <td><?= mb_substr(strip_tags(stripslashes($veriler[$i]["randevu_not"])), 0, 10, "UTF-8") ?>...</td>
                                                    <td><?= $veriler[$i]["musteri_adsoyad"] ?></td>
                                                    <td><?= $veriler[$i]["musteri_telefon"] ?></td>
                                                    <td><?= $kategori[0]["title"] ?> </td>
                                                    <td><?= $gorusme_tarihi ?></td>
                                                    <td style="color: <?= $randevucolor ?>"><?= $randevu_tarihi ?></td>
                                                    <td><?= $randevusaati ?> </td>
                                                    <td style="color: <?= $randevucolor ?>"><?= $randevuday ?> </td>
                                                    <td><?= $veriler[$i]["paketkodu"] ?></td>
                                                    <td><?= $veriler[$i]["musteri_adress"] ?></td>
                                                    <?php if ($veriler[$i]["resim"] != NULL) { ?>
                                                        <td><img src="<?= SITE ?>assets/images/randevular/<?= $veriler[$i]["resim"] ?>" alt="" width="200" height="200"></td>
                                                    <?php } else { ?>
                                                        <td>Resim Yüklenmedi</td>
                                                    <?php } ?>









                                                    <td><?= $veriler[$i]["tarih"] ?></td>
                                                    <?php
                                                    $randevuekleyen = $DB->CallData("kullanicilar", "WHERE ID=?", array($veriler[$i]["kullanici_id"]), "ORDER BY ID ASC", 1);
                                                    ?>
                                                    <td><?= $randevuekleyen[0]["adsoyad"] ?></td>
                                                    <td style="display: inline-block; ">
                                                        <a href="<?= SITE ?>randevu-duzenle/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Düzenle" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu düzenlemek için tıkla!"><i class="fa fa-cog"></i>
                                                        </a>
                                                        <a href=" <?= SITE ?>randevu-ertele/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-success btn-sm" data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Ertele" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu ertelemek için tıkla!"><i class="fa fa-calendar-plus-o"></i> </a>
                                                        <a onclick="randevuSil('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Kaldır" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu kaldırmak için tıkla!"><i class="fe fe-trash"></i>
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


<script>
    var SITE = '<?= SITE ?>randevu-sil/<?= $veriler[$i]["ID"] ?>';

    $(document).on("click", "#silmeAlani", function(e) {
        e.preventDefault();

        swal({
                title: "Silmek istediğinden emin misin?",
                text: "Randevuyu silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.",
                icon: "warning",
                buttons: ["İptal Et", "Sil"],
                dangerMode: true,
            })
            .then((sil) => {
                if (sil) {

                    swal("Harika! Randevu başarıyla silindi!", {
                        icon: "success",
                    }).then((silindi) => {
                        if (silindi) {
                            window.location = SITE;
                        }

                    });

                } else {
                    swal("Randevu hala güvende tutuyoruz.", {
                        icon: "info",
                    });
                }
            });
    });
</script>