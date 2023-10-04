<?php

date_default_timezone_set('Europe/Istanbul');

$user = $DB->CallData("kullanicilar", "WHERE state=? AND kullanici=?", array(1, $_SESSION["user"]), "ORDER BY ID ASC");



?>



<head>

    <title>

        Onaylanan Siparişler | <?= $sitebaslik ?>

    </title>

</head>



<div class="main-content app-content mt-0">

    <div class="side-app">



        <!-- CONTAINER -->

        <div class="main-container container-fluid">



            <!-- PAGE-HEADER -->

            <div class="page-header">

                <h1 class="page-title">Onaylanan Siparişler</h1>

                <div>

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Onaylanan Siparişler</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Onaylanan Siparişler</li>

                    </ol>

                </div>



            </div>

            <!-- PAGE-HEADER END -->



            <div class="row row-sm">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Onaylanan Siparişler</h3>

                            

                        </div>





                        <div class="card-body">



                            <div class="table-responsive">

                                <table id="onaylanansiparisler" class="table table-bordered text-nowrap border-bottom">

                                    <thead>

                                        <tr>



                                            <th class="border-bottom-0">Sipariş Kodu</th>

                                            <?php if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>

                                                <th class="border-bottom-0">Teslim Et</th>
                                            <?php } ?>

                                            <th class="border-bottom-0">İşlem</th>

                                            <th class="border-bottom-0">Paket Kodu</th>

                                            <th class="border-bottom-0">Paket Kategori</th>

                                            <th class="border-bottom-0">Sipariş Durumu</th>

                                            <!--<th class="border-bottom-0">Sipariş Notu</th>-->
                                            <?php if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>

                                                <th class="border-bottom-0">Sipariş Sorumlusu</th>

                                            <?php } ?>





                                            <th class="border-bottom-0">Sipariş Aşama</th>

                                            <th class="border-bottom-0">Takip No</th>

                                            <th class="border-bottom-0">Müşteri Ad Soyad</th>

                                            <th class="border-bottom-0">Müşteri Telefon</th>







                                        </tr>

                                    </thead>

                                    <tbody>



                                        <?php



                                        if ($user[0]["Rank"] == "Grafik Tasarım Uzmanı") {

                                            $veriler = $DB->CallData("siparisler", "WHERE onizleme_durum=? AND siparis_sorumlusu=?", array(1, $user[0]["ID"]), "ORDER BY ID ASC");
                                        } else if ($user[0]["Rank"] == "Sosyal Medya Uzmanı") {

                                            $veriler = $DB->CallData("siparisler", "WHERE onizleme_durum=? AND siparis_sorumlusu=?", array(1, $user[0]["ID"]), "ORDER BY ID ASC");
                                        } else if ($user[0]["Rank"] == "Web Tasarım Uzmanı") {

                                            $veriler = $DB->CallData("siparisler", "WHERE onizleme_durum=? AND siparis_sorumlusu=?", array(1, $user[0]["ID"]), "ORDER BY ID ASC");
                                        } else if ($user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "CEO" || $user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Müşteri Destek Elemanı") {

                                            $veriler = $DB->CallData("siparisler", "WHERE onizleme_durum=?", array(1), "ORDER BY siparis_durumu ASC");
                                        }





                                        if ($veriler != false) {

                                            $sira = 0;

                                            for ($i = 0; $i < count($veriler); $i++) {

                                                $sira++;

                                                setlocale(LC_ALL, 'tr_TR.UTF-8');







                                                $nowdate = strtotime($veriler[$i]["tarih"]);

                                                $today = date("H:i:s / d M Y", $nowdate);



                                                $tarih = $DB->convertMonthToTurkishCharacter($today);





                                                $kategori = $DB->CallData("categories", "WHERE ID=?", array($veriler[$i]["paket_kategori"]), "ORDER BY ID ASC", 1);

                                                $paketler = $DB->CallData("paketler", "WHERE paketkodu=?", array($veriler[$i]["paketkodu"]), "ORDER BY ID ASC", 1);





                                                if ($veriler[$i]["siparis_durumu"] == "Sipariş Hazırlanıyor") {

                                                    $siparistextcolor = "warning";

                                                    $onaybgcolor = "rgba(165, 224, 211, 0.43)";
                                                }



                                                if ($veriler[$i]["siparis_durumu"] == "%25 Tamamlandı") {

                                                    $siparistextcolor = "primary";

                                                    $onaybgcolor = "rgba(181, 251, 184, 0.47)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "%35 Tamamlandı") {

                                                    $siparistextcolor = "primary";

                                                    $onaybgcolor = "rgba(146, 243, 151, 0.48)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "%50 Tamamlandı") {

                                                    $siparistextcolor = "primary";

                                                    $onaybgcolor = "rgba(93, 246, 101, 0.48)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "%75 Tamamlandı") {

                                                    $siparistextcolor = "primary";

                                                    $onaybgcolor = "rgba(64, 249, 74, 0.56)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "%99 Tamamlandı") {

                                                    $siparistextcolor = "primary";

                                                    $onaybgcolor = "rgba(11, 247, 23, 0.61)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "Sipariş Hazır") {

                                                    $siparistextcolor = "info";

                                                    $onaybgcolor = "rgba(0, 220, 11, 0.53)";
                                                }

                                                if ($veriler[$i]["siparis_durumu"] == "Teslim Edildi") {

                                                    $siparistextcolor = "success";

                                                    $onaybgcolor = "rgba(243, 164, 237, 0.38)";
                                                }









                                        ?>

                                                <tr id="tablebg">









                                                    <td>#<?= stripslashes($veriler[$i]["siparis_kodu"]) ?></td>



                                                    <?php

                                                    if ($veriler[$i]["siparis_durumu"] != "Teslim Edildi") {



                                                    ?>
                                                        <?php if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>
                                                            <td>

                                                                <a onclick="siparisTeslimEt('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-left: 15px;" id="teslimAlani" class="btn btn-primary btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Teslim Et" data-bs-content="#<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi teslim etmek için tıkla!"><i class="fa fa-check-circle"></i>

                                                                </a>

                                                            </td>

                                                        <?php } ?>



                                                    <?php } else { ?>

                                                        <td> <span style="color: lime; font-weight: 600;">Teslim Edildi</span></td>

                                                    <?php } ?>

                                                    <td style="display: inline-block; ">

                                                        <a href="<?= SITE ?>bekleyen-siparis-detay/<?= $veriler[$i]["siparis_kodu"] ?>" style="margin-left: 10px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Gör" data-bs-content="#<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi görmek için tıkla!"><i class="fa fa-eye" style="color: #383e42;"></i>

                                                        </a>



                                                    </td>








                                                    <td><?= $veriler[$i]["paketkodu"] ?></td>

                                                    <td><?= $kategori[0]["title"] ?> </td>



                                                    <td style="font-weight: 600;" id="durumtext"><span class="badge bg-<?= $siparistextcolor ?> transparent rounded-pill p-2 px-3"><?= $veriler[$i]["siparis_durumu"] ?></span></td>

                                                    <?php if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>
                                                        <?php
                                                        if ($veriler[$i]["siparis_sorumlusu"] != NULL) {
                                                            $sorumlu = $DB->CallData("kullanicilar", "WHERE ID=?", array($veriler[$i]["siparis_sorumlusu"]), "ORDER BY ID ASC", 1);
                                                        }
                                                        ?>

                                                        <td><?= $sorumlu[0]["adsoyad"] ?></td>

                                                    <?php
                                                    }

                                                    ?>







                                                    <td>

                                                        <?php

                                                        if ($veriler[$i]["siparis_durumu"] != "Teslim Edildi") {

                                                            if ($veriler[$i]["siparis_durumu"] == "Sipariş Hazırlanıyor") {

                                                                $hazirlaniyor = 'selected';
                                                                $selected25 = '';
                                                                $selected35 = '';
                                                                $selected50 = '';
                                                                $selected75 = '';
                                                                $selected99 = '';
                                                            }

                                                            if ($veriler[$i]["siparis_durumu"] == "%25 Tamamlandı") {

                                                                $selected25 = 'selected';
                                                                $hazirlaniyor = '';
                                                                $selected35 = '';
                                                                $selected50 = '';
                                                                $selected75 = '';
                                                                $selected99 = '';
                                                            }

                                                            if ($veriler[$i]["siparis_durumu"] == "%35 Tamamlandı") {

                                                                $selected35 = 'selected';
                                                                $hazirlaniyor = '';
                                                                $selected25 = '';
                                                                $selected50 = '';
                                                                $selected75 = '';
                                                                $selected99 = '';
                                                            }

                                                            if ($veriler[$i]["siparis_durumu"] == "%50 Tamamlandı") {

                                                                $selected50 = 'selected';
                                                                $hazirlaniyor = '';
                                                                $selected35 = '';
                                                                $selected25 = '';
                                                                $selected75 = '';
                                                                $selected99 = '';
                                                            }

                                                            if ($veriler[$i]["siparis_durumu"] == "%75 Tamamlandı") {

                                                                $selected75 = 'selected';
                                                                $hazirlaniyor = '';
                                                                $selected35 = '';
                                                                $selected50 = '';
                                                                $selected25 = '';
                                                                $selected99 = '';
                                                            }

                                                            if ($veriler[$i]["siparis_durumu"] == "%99 Tamamlandı") {

                                                                $selected99 = 'selected';
                                                                $hazirlaniyor = '';
                                                                $selected35 = '';
                                                                $selected50 = '';
                                                                $selected75 = '';
                                                                $selected25 = '';
                                                            }





                                                        ?>
                                                            <form action="<?= SITE ?>siparisdurumupdate" method="POST">
                                                                <select class="form-control select2" style="width: auto; color: #ffffff;" name="siparisdurum" id="siparisselect">

                                                                    <option value="" <?= $hazirlaniyor ?>>Sipariş Aşamasını Seçiniz</option>

                                                                    <option value="%25 Tamamlandı" <?= $selected25 ?>>%25 Tamamlandı</option>

                                                                    <option value="%35 Tamamlandı" <?= $selected35 ?>>%35 Tamamlandı</option>

                                                                    <option value="%50 Tamamlandı" <?= $selected50 ?>>%50 Tamamlandı</option>

                                                                    <option value="%75 Tamamlandı" <?= $selected75 ?>>%75 Tamamlandı</option>

                                                                    <option value="%99 Tamamlandı" <?= $selected99 ?>>%99 Tamamlandı</option>

                                                                </select>
                                                                <input type="hidden" name="sipariskodu" value="<?= $veriler[$i]["siparis_kodu"] ?>">


                                                                <button type="submit" style="margin-left: 15px;" id="siparisUpdateAlani" class="btn btn-info btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Sipariş Durumunu Güncelle" data-bs-content="#<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi Güncellemek için tıkla!"><i class="fa fa-check-circle"></i>

                                                                </button>
                                                            </form>





                                                        <?php } else { ?>

                                                            <span style="color: <?= $siparistextcolor ?>; font-weight: 600;">Teslim Edildi</span>

                                                        <?php } ?>

                                                    </td>

                                                    <td>#<?= $veriler[$i]["takipno"] ?></td>

                                                    <td><?= $veriler[$i]["musteri_adsoyad"] ?></td>

                                                    <td><?= $veriler[$i]["musteri_telefon"] ?></td>

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


<!--<script>
    function siparisGuncelle(SITE, sipariskod) {
        var guncellenecekdurum = $('select[name=siparisdurum] option').filter(':selected').val();
        if (guncellenecekdurum != "") {
            if (guncellenecekdurum == "%25 Tamamlandı") {
                urldurum = 25;
            } else if (guncellenecekdurum == "%35 Tamamlandı") {
                urldurum = 35;
            } else if (guncellenecekdurum == "%50 Tamamlandı") {
                urldurum = 50;
            } else if (guncellenecekdurum == "%75 Tamamlandı") {
                urldurum = 75;
            } else if (guncellenecekdurum == "%99 Tamamlandı") {
                urldurum = 99;
            }
        } else if (guncellenecekdurum == "") {
            urldurum = 0;
        }
        var url = SITE + 'siparisdurumupdate/' + sipariskod + '/' + guncellenecekdurum;
        $(document).on("click", "#siparisUpdateAlani", function(e) {

            swal({
                    title: "Güncellemek istediğinden emin misin?",
                    text: "Siparişi güncellemek üzeresin! Eğer güncellemek istediğinden eminsen 'Güncelle' butonuna tıkla.",
                    icon: "warning",
                    buttons: ["İptal Et", "Güncelle"],
                    dangerMode: true,
                })
                .then((guncelle) => {
                    if (guncelle) {

                        swal("Harika! Sipariş başarıyla güncellendi!", {
                            icon: "success",

                        }).then((guncellendi) => {
                            if (guncellendi) {
                                window.location = url;

                            }

                        });

                    } else {
                        swal("Siparişi hala güvende tutuyoruz.", {
                            icon: "info",
                        });
                    }
                });

        });
    }
</script>-->