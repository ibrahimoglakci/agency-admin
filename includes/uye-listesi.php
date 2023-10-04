<?php
date_default_timezone_set('Europe/Istanbul');


?>

<head>
    <title>
        Üye Listesi | <?= $sitebaslik ?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Üyeler</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Üyeler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Üye Listesi</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Üyeler</h3>
                            <div class="col-md-11">
                                <a href="<?= SITE ?>uye-ekle" class="btn btn-pink" style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                    YENİ
                                    EKLE</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="uye-tablo" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>

                                            <th class="border-bottom-0">Üye Fotoğrafı</th>
                                            <th class="border-bottom-0">Üye ID</th>
                                            <th class="border-bottom-0">Durum</th>

                                            <th class="border-bottom-0">İsim Soyisim</th>
                                            <th class="border-bottom-0">Üye Telefon</th>
                                            <th class="border-bottom-0">Üye E-Posta</th>
                                            <th class="border-bottom-0">Katılma Tarihi</th>
                                            <th class="border-bottom-0">Üye Görevi</th>

                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $veriler = $DB->CallData("kullanicilar", "", "", "ORDER BY ID ASC");
                                        if ($veriler != false) {
                                            $sira = 0;
                                            for ($i = 0; $i < count($veriler); $i++) {
                                                $sira++;
                                                setlocale(LC_ALL, 'tr_TR.UTF-8');
                                                if ($veriler[$i]["state"] == 1) {
                                                    $aktifpasif = ' checked="checked"';
                                                } else {
                                                    $aktifpasif = '';
                                                }
                                                $nowdatek = strtotime($veriler[$i]["tarih"]);
                                                $todayk = date("d F Y", $nowdatek);

                                                $kullanicitarihi = $DB->convertMonthToTurkishCharacter($todayk);

                                                if (!empty($veriler[0]["image"])) {
                                                    $userimage = $veriler[$i]["image"];
                                                } else {
                                                    $userimage = "user-default.png";
                                                }

                                                if($veriler[$i]["Rank"]=="Yönetici") {
                                                    $badgecolor = "danger";
                                                }
                                                else if($veriler[$i]["Rank"]=="Web Yazılım Uzmanı") {
                                                    $badgecolor = "info";
                                                }
                                                else if($veriler[$i]["Rank"]=="Web Tasarım Uzmanı") {
                                                    $badgecolor = "info";
                                                }
                                                else if($veriler[$i]["Rank"]=="Grafik Tasarım Uzmanı") {
                                                    $badgecolor = "warning";
                                                }
                                                else if($veriler[$i]["Rank"]=="Saha Satış Koordinatörü") {
                                                    $badgecolor = "primary";
                                                }
                                                else if($veriler[$i]["Rank"]=="Saha Satış Uzmanı") {
                                                    $badgecolor = "primary";
                                                }

                                                $uyeposta=$veriler[$i]["mail"];
                                                $uyepostailkbes=mb_substr(strip_tags(stripslashes($uyeposta)), 0,3,"UTF-8");
                                                $parcalaposta=explode("@",$uyeposta);

                                                $gosterposta=$uyepostailkbes."*****@".$parcalaposta[1];

                                        ?>
                                                <tr>



                                                    <td class="align-middle text-center">
                                                        <img alt="image" class="avatar avatar-md br-7" src="<?= SITE ?>/assets/images/users/<?= $userimage ?>">
                                                    </td>
                                                    <td>#<?= stripslashes($veriler[$i]["ID"]) ?></td>

                                                    <td>
                                                        <div class="material-switch ">
                                                            <input type="checkbox" class="custom-control-input aktifpasif<?= $veriler[$i]['ID'] ?>" id="someSwitchOptionSuccess customSwitch3<?= $veriler[$i]['ID'] ?>" <?= $aktifpasif ?> value="<?= $veriler[$i]['ID'] ?>" onclick="kullaniciaktifpasif(<?= $veriler[$i]['ID'] ?>,'kullanicilar');">
                                                            <label class="label-success" for="someSwitchOptionSuccess customSwitch3<?= $veriler[$i]["ID"] ?>"></label>
                                                        </div>
                                                    </td>


                                                    <td><?= $veriler[$i]["adsoyad"] ?></td>
                                                    <td><?php if(!empty($veriler[$i]["phone"])) {echo $veriler[$i]["phone"];}else {echo '<span class="badge bg-default badge-sm  me-1 mb-1 mt-1">Telefon Numarası Yüklenmedi !</span>';} ?></td>
                                                    <td><?= $gosterposta ?></td>
                                                    <td><?= $kullanicitarihi ?> </td>
                                                    <td><span class="badge bg-<?=$badgecolor?> badge-sm  me-1 mb-1 mt-1"><?= $veriler[$i]["Rank"] ?></span></td>

                                                    <td style="display: inline-block; ">
                                                       <!--  <a href="<?= SITE ?>randevu-duzenle/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Düzenle" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu düzenlemek için tıkla!"><i class="fa fa-cog"></i>
                                                        </a>
                                                        <a href=" <?= SITE ?>randevu-ertele/<?= $veriler[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-success btn-sm" data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Ertele" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu ertelemek için tıkla!"><i class="fa fa-calendar-plus-o"></i> </a>
                                                        <a onclick="randevuSil('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Randevuyu Kaldır" data-bs-content="<?= $veriler[$i]["ID"] ?> numaralı randevuyu kaldırmak için tıkla!"><i class="fe fe-trash"></i>
                                                        </a> -->
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