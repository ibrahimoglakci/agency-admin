<?php
if (!empty(intval($_GET["sipariskod"]))) {
    $sipariskod = $DB->filter($_GET["sipariskod"]);

    $user = $DB->CallData("kullanicilar", "WHERE state=? AND kullanici=?", array(1, $_SESSION["user"]), "ORDER BY ID ASC", 1);

    $veri = $DB->CallData("siparisler", "WHERE siparis_kodu=?", array($sipariskod), "ORDER BY ID ASC", 1);
    if ($veri != false) {
        $siparis = $veri[0];
        $kategori = $DB->CallData("categories", "WHERE ID=?", array($veri[0]["paket_kategori"]), "ORDER BY ID ASC", 1);

        $categories = $kategori[0];
        $paketler = $DB->CallData("paketler", "WHERE paketkodu=?", array($veri[0]["paketkodu"]), "ORDER BY ID ASC", 1);
        $paket = $paketler[0];

?>

        <head>
            <title>
                <?= $veri[0]["siparis_kodu"] ?> Siparişin Detayları | <?= $sitebaslik ?>
            </title>
        </head>

        <!--app-content open-->
        <div class="main-content app-content mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                <div class="main-container container-fluid">

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <h1 class="page-title">Sipariş Detayları</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bekleyen Sipariş Detayları</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row row-sm">
                                        <div class="col-xl-5 col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="product-carousel">
                                                        <div id="Slider" class="carousel slide border" data-bs-ride="false">
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">

                                                                    <img src="<?= SITE ?>assets/images/kategoriler/<?= $categories["resim"] ?>" alt="<?= $categories["title"] ?>" class="img-fluid mx-auto d-block">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                                            <div class="mt-2 mb-4">
                                                <h3 class="mb-3 fw-semibold">#<?= $siparis["siparis_kodu"] ?> kodlu siparişin detayları</h3>

                                                <h4 class="mt-4" style="font-weight: 800;"><b> Sipariş Notu</b></h4>
                                                <p class="text-warning"><?= $siparis["siparis_notu"] ?></p>
                                                <?php
                                                if ($user[0]["Rank"] == "Yönetici" OR $user[0]["Rank"] == "Web Yazılım Uzmanı") {
                                                ?>
                                                    <?php if ($paket["ifiyat"] == 1) { ?>
                                                        <h3 class="mb-4"><span class="me-2 fw-bold fs-25">₺<?= $paket["indirimlifiyat"] ?> /</span><span><del class="fs-18 text-muted">₺<?= $paket["fiyat"] ?></del></span></h3>
                                                    <?php } else { ?>
                                                        <h3 class="mb-4"><span class="me-2 fw-bold fs-25">₺<?= $paket["fiyat"] ?></span></h3>
                                                <?php }
                                                } ?>

                                                <div class=" mt-4 mb-5">
                                                    <span class="fw-bold me-2">Paket Kodu :</span><span class="fw-bold text-info font-weight-bold"><?= $paket["paketkodu"] ?> </span>
                                                    <a href="<?= SITE ?>paket-detay/<?= $paket["ID"] ?>" style="margin-left: 10px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Paketi Gör" data-bs-content="#<?= $paket["paketkodu"] ?> numaralı paketi görmek için tıkla!"><i class="fa fa-eye" style="color: #383e42;"></i>

                                                    </a>
                                                </div>
                                                <div class=" mt-4 mb-5"><span class="fw-bold me-2">Sipariş Durumu :</span><span class="fw-bold text-success"><?= $siparis["siparis_durumu"] ?></span></div>
                                                <?php
                                                if ($user[0]["Rank"] == "Yönetici" OR $user[0]["Rank"] == "Web Yazılım Uzmanı") {
                                                ?>
                                                    <div class=" mt-4 mb-5"><span class="fw-bold me-2">Ödeme Tipi :</span><span class="fw-bold text-secondary"><?= $siparis["odemetipi"] ?></span></div>
                                                <?php } ?>
                                                <div class=" mt-4 mb-5"><span class="fw-bold me-2">Paket Kategori :</span><span class="fw-bold text-danger"><?= $categories["title"] ?></span></div>

                                                <hr>
                                                <?php
                                                if ($siparis["onizleme_durum"] == 0) {
                                                ?>
                                                    <div class="btn-list mt-4">
                                                        <a onclick="siparisOnayla('<?= SITE ?>',<?= $siparis['ID'] ?>);" style="margin-right: 3px;" id="onaylaAlani" class="btn btn-success btn-large text-light" data-bs-toggle="popover" data-bs-trigger="hover" title="Siparişi Onayla" data-bs-content="<?= $siparis["siparis_kodu"] ?> numaralı siparişi onaylamak için tıkla!"><i class="fa fa-check-circle"></i>
                                                            Siparişi Kabul Et
                                                        </a>

                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="card productdesc">
                                <div class="card-body">
                                    <div class="panel panel-primary">
                                        <div class=" tab-menu-heading">
                                            <div class="tabs-menu1">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li><a href="#tab5" class="active" data-bs-toggle="tab">Detaylar</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    <h4 class="mb-5 mt-3 fw-bold">Sipariş Notu :</h4>
                                                    <p class="mb-5 fs-15 text-warning"><?= $siparis["siparis_notu"] ?></p>

                                                    <h4 class="mb-5 mt-3 fw-bold">Specifications :</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td class="fw-bold">Müşteri Ad Soyad</td>
                                                                <td> <?= $siparis["musteri_adsoyad"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold">Müşteri Telefon</td>
                                                                <td> <?= $siparis["musteri_telefon"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold">Müşteri Adres</td>
                                                                <td> <?= $siparis["musteri_adress"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold">Takip Kodu</td>
                                                                <td> #<?= $siparis["takipno"] ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                $sdate = strtotime($siparis["tarih"]);
                                                                $todays = date("H:i:s d M Y", $sdate);

                                                                $siparis_tarihi = $DB->convertMonthToTurkishCharacter($todays);
                                                                ?>
                                                                <td class="fw-bold">Sipariş Tarihi</td>
                                                                <td class="text-secondary"><?= $siparis_tarihi ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- ROW-1 CLOSED -->
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
}
?>