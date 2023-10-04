<?php

date_default_timezone_set('Europe/Istanbul');

$user = $DB->CallData("kullanicilar", "WHERE `state`=? AND `kullanici`=?", array(1, $_SESSION["user"]), "ORDER BY ID ASC");

if ($user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Web Yazılım Uzmanı") {

?>



    <head>

        <title>

            Bekleyen Siparişler | <?= $sitebaslik ?>

        </title>

    </head>



    <div class="main-content app-content mt-0">

        <div class="side-app">



            <!-- CONTAINER -->

            <div class="main-container container-fluid">



                <!-- PAGE-HEADER -->

                <div class="page-header">

                    <h1 class="page-title">Bekleyen Siparişler</h1>

                    <div>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="javascript:void(0)">Bekleyen Siparişler</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Bekleyen Siparişler</li>

                        </ol>

                    </div>



                </div>

                <!-- PAGE-HEADER END -->



                <div class="row row-sm">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">

                                <h3 class="card-title">Bekleyen Siparişler</h3>

                               
                            </div>





                            <div class="card-body">



                                <div class="table-responsive">

                                    <table id="siparistable" class="table table-bordered text-nowrap border-bottom">

                                        <thead>

                                            <tr>



                                                <th class="border-bottom-0">Sipariş Kodu</th>

                                                <th class="border-bottom-0">Durum</th>

                                                <th class="border-bottom-0">Müşteri Ad Soyad</th>

                                                <th class="border-bottom-0">Müşteri Telefon</th>

                                                <th class="border-bottom-0">Paket Kodu</th>

                                                <th class="border-bottom-0">Paket Kategori</th>

                                                <th class="border-bottom-0">Sipariş Durumu</th>

                                                <th class="border-bottom-0">Sipariş Notu</th>



                                                <th class="border-bottom-0">İşlem</th>

                                                <th class="border-bottom-0">Takip No</th>

                                                <th class="border-bottom-0">Tarih & Saat</th>

                                                <th class="border-bottom-0">Müşteri Adres</th>







                                            </tr>

                                        </thead>

                                        <tbody>



                                            <?php


                                            $veriler = $DB->CallData("siparisler", "WHERE `onizleme_durum`=?", array(0), "ORDER BY ID ASC");




                                            if ($veriler != false) {

                                                $sira = 0;

                                                for ($i = 0; $i < count($veriler); $i++) {

                                                    $sira++;

                                                    setlocale(LC_ALL, 'tr_TR.UTF-8');



                                                    if ($veriler[$i]["paket_kategori"] == 5 or $veriler[$i]["paket_kategori"] == 6) {
                                                        $sorumlurank = "Grafik Tasarım Uzmanı";
                                                    }

                                                    if ($veriler[$i]["paket_kategori"] == 4 or $veriler[$i]["paket_kategori"] == 8 or $veriler[$i]["paket_kategori"] == 10) {
                                                        $sorumlurank = "Web Tasarım Uzmanı";
                                                        $sorumlurank2 = "Web Yazılım Uzmanı";
                                                    }

                                                    if ($veriler[$i]["paket_kategori"] == 9) {
                                                        $sorumlurank = "Video Grafik Uzmanı";
                                                    }




                                                    $nowdate = strtotime($veriler[$i]["tarih"]);

                                                    $today = date("H:i:s / d M Y", $nowdate);



                                                    $tarih = $DB->convertMonthToTurkishCharacter($today);





                                                    $kategori = $DB->CallData("categories", "WHERE `ID`=?", array($veriler[$i]["paket_kategori"]), "ORDER BY ID ASC", 1);



                                                    if ($veriler[$i]["onizleme_durum"] == 0) {

                                                        $siparisbgcolor = "rgba(190, 189, 119, 0.48)";
                                                    }







                                            ?>

                                                    <tr style="background-color: <?= $siparisbgcolor ?>" id="bekleyen-satiri">









                                                        <td>#<?= stripslashes($veriler[$i]["siparis_kodu"]) ?></td>



                                                        <td>

                                                            <a onclick="siparisOnayla('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-right: 3px;" id="onaylaAlani" class="btn btn-success btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Onayla" data-bs-content="<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi onaylamak için tıkla!"><i class="fa fa-check-circle"></i>

                                                            </a>

                                                        </td>



                                                        <td><?= $veriler[$i]["musteri_adsoyad"] ?></td>

                                                        <td><?= $veriler[$i]["musteri_telefon"] ?></td>

                                                        <td><?= $veriler[$i]["paketkodu"] ?></td>

                                                        <td><?= $kategori[0]["title"] ?> </td>



                                                        <td style="color: gold"><?= $veriler[$i]["siparis_durumu"] ?></td>

                                                        <td><?= mb_substr(strip_tags(stripslashes($veriler[$i]["siparis_notu"])), 0, 10, "UTF-8") ?>...</td>



                                                        <td>
                                                            <form action="<?= SITE ?>siparissorumlusu" method="POST">
                                                                <select class="form-control select2" style="width: auto; color: #ffffff;" name="siparissorumlu" id="siparisselect">

                                                                    <option value="">Sipariş Sorumlusunu Seçiniz</option>

                                                                    <?php
                                                                    $sorumlular = $DB->CallData("kullanicilar", "WHERE `Rank`=? OR `Rank`=?", array($sorumlurank,$sorumlurank2), "ORDER BY ID ASC");
                                                                    if ($sorumlular != false) {
                                                                        for ($so = 0; $so < count($sorumlular); $so++) {

                                                                            if ($veriler[$i]["siparis_sorumlusu"] != NULL && $sorumlular[$so]["ID"] == $veriler[$i]["siparis_sorumlusu"]) {


                                                                    ?>
                                                                                <option value="<?= $sorumlular[$so]["ID"] ?>" selected><?= $sorumlular[$so]["adsoyad"] ?></option>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <option value="<?= $sorumlular[$so]["ID"] ?>"><?= $sorumlular[$so]["adsoyad"] ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                                <input type="hidden" name="sipariskodu" value="<?= $veriler[$i]["siparis_kodu"] ?>">


                                                                <button type="submit" style="margin-left: 15px;" id="siparisUpdateAlani" class="btn btn-info btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Sipariş Durumunu Güncelle" data-bs-content="#<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi Güncellemek için tıkla!"><i class="fa fa-check-circle"></i>

                                                                </button>
                                                            </form>

                                                        </td>

                                                        <td style="display: inline-block; ">

                                                            <a href="<?= SITE ?>bekleyen-siparis-detay/<?= $veriler[$i]["siparis_kodu"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Gör" data-bs-content="<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi görmek için tıkla!"><i class="fa fa-eye" style="color: #383e42;"></i>

                                                            </a>

                                                            <a onclick="siparisSil('<?= SITE ?>',<?= $veriler[$i]['ID'] ?>);" style="margin-right: 3px;" id="silmeAlani" class="btn btn-danger btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Kaldır" data-bs-content="<?= $veriler[$i]["siparis_kodu"] ?> numaralı siparişi kaldırmak için tıkla!"><i class="fe fe-trash"></i>

                                                            </a>

                                                        </td>

                                                        <td>#<?= $veriler[$i]["takipno"] ?></td>

                                                        <td><?= $tarih ?></td>

                                                        <td><?= $veriler[$i]["musteri_adress"] ?></td>

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
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>">
<?php
}
?>