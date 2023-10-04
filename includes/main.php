<?php
@session_start();
@ob_start();

if (empty($_SESSION["ID"]) && empty($_SESSION["name"]) && empty($_SESSION["mail"])) {
} else {
    $user = $DB->CallData("kullanicilar", "WHERE kullanici=?", array($_SESSION["user"]), "ORDER BY ID ASC", 1);

    if (!empty($user[0]["image"])) {
        $userimage = $user[0]["image"];
    } else {
        $userimage = "user-default.png";
    }


    if (!empty($user[0]["thumbnail"])) {
        $userthumbnail = $user[0]["thumbnail"];
    } else {
        $userthumbnail = "profile-background.jpg";
    }
}
?>

<head>
    <title>Admin Paneli | <?= $sitebaslik ?></title>
</head>

<?php
if ($user[0]["Rank"] == "Web Yazılım Uzmanı" or $user[0]["Rank"] == "Yönetici" or $user[0]["Rank"] == "Muhasebe") {
?>
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Ana Sayfa</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Ana Menü</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ana Sayfa</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">Toplam Masraf</h6>
                                                <h2 class="mb-0 number-font">₺<?= $DB->toplamMasraflar(); ?></h2>

                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">Toplam İşlem Gelir</h6>
                                                <h2 class="mb-0 number-font">₺<?= number_format($DB->toplamSiparisGelir()); ?></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">Toplam İşlem Maaliyet</h6>
                                                <h2 class="mb-0 number-font">₺<?= number_format($DB->toplamSiparisGider()); ?></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mt-2">
                                                <h6 class="">Toplam İşlem Kâr</h6>
                                                <h2 class="mb-0 number-font">₺<?= $DB->toplamSiparisKar(); ?></h2>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="chart-wrapper mt-1">
                                                    <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <small class="text-muted">Müşteriler</small>
                                            <h2 class="mb-2 mt-0"><?= $DB->totalCustomers(); ?></h2>
                                            <?php
                                            $musteri = $DB->totalCustomers();
                                            if ($musteri < 10) {
                                                $yuzdelikmusteri = $musteri / 10;
                                            } else if ($musteri == 10) {
                                                $yuzdelikmusteri = 1;
                                            } else if ($musteri > 10 && $musteri < 100) {
                                                $yuzdelikmusteri = $musteri / 100;
                                            } else if ($musteri == 100) {
                                                $yuzdelikmusteri = 1;
                                            } else if ($musteri > 100 && $musteri < 1000) {
                                                $yuzdelikmusteri = $musteri / 1000;
                                            }


                                            ?>
                                            <div id="circle" class="mt-3 mb-3 chart-dropshadow-secondary" title="<?= $yuzdelikmusteri ?>"></div>
                                            <div class="chart-circle-value-3 text-secondary fs-20"><i class="icon icon-user-follow"></i></div>
                                            <p class="mb-0 text-start"><span class="dot-label bg-secondary me-2"></span>Aylık müşteri durumu <span class="float-end">60%</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget text-center">
                                            <small class="text-muted">Toplam Satış</small>

                                            <h2 class="mb-2 mt-0">₺<?= number_format($DB->toplamSatis()); ?></h2>

                                            <?php
                                            $satis = $DB->toplamSatis();


                                            if($satis) {
                                                if ($satis > 1000 && $satis < 10000) {
                                                    $yuzdelik = $satis / 10000;
                                                } else if ($satis > 10000 && $satis < 100000) {
                                                    $yuzdelik = $satis / 100000;
                                                } else if ($satis > 100000 && $satis < 1000000) {
                                                    $yuzdelik = $satis / 1000000;
                                                }
                                            }
                                            else {
                                                $yuzdelik=0;
                                            }
                                            


                                            ?>
                                            <div id="circle-3" class="mt-3 mb-3 chart-dropshadow-danger" title="<?= $yuzdelik ?>"></div>

                                            <div class="chart-circle-value-3 text-danger fs-20"><i class="icon icon-basket"></i></div>
                                            <?php
                                            $currentdate = date("Y-m-d");

                                            $newdate = date("Y-m-d", strtotime('-1 month', strtotime($currentdate)));

                                            $returndate = date("F", strtotime($newdate));

                                            $turkishdate = $DB->convertMonthToTurkishCharacter($returndate);
                                            ?>
                                            <p class="mb-0 text-start"><span class="dot-label bg-danger me-2"></span><?= $turkishdate ?> Ayı Satış <span class="float-end">₺<?= $DB->aylikSatis(); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget text-center">
                                            <small class="text-muted">
                                                <?php 
                                                $toplamkar=$DB->toplamKar();
                                                if($toplamkar<0) {
                                                    echo 'Toplam Zarar';
                                                } 
                                                else {
                                                    echo 'Toplam Kar';
                                                }
                                                ?>
                                            </small>
                                            <h2 class="mb-2 mt-0">₺<?= $DB->toplamKar(); ?></h2>
                                            <div id="circle-1" class="mt-3 mb-3 chart-dropshadow-success"></div>
                                            <div class="chart-circle-value-3 text-success fs-20"><i class="icon icon-briefcase"></i></div>
                                            <?php
                                            $currentdatevergi = date("Y-m-d");

                                            $newdatevergi = date("Y-m-d", strtotime('-1 month', strtotime($currentdatevergi)));

                                            $returndatevergi = date("F", strtotime($newdatevergi));

                                            $turkishdatevergi = $DB->convertMonthToTurkishCharacter($returndatevergi);
                                            ?>
                                            <p class="mb-0 text-start"><span class="dot-label bg-success me-2"></span> Toplam Miktar <span class="float-end">₺<?= $toplamkar; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget text-center">
                                            <small class="text-muted">Toplam Ciro</small>
                                            <h2 class="mb-2 mt-0">₺<?= number_format($DB->toplamSiparisGelir()); ?></h2>

                                            <div id="circle-2" class="mt-3 mb-3 chart-dropshadow-warning"></div>
                                            <div class="chart-circle-value-3 text-warning fs-20"><i class="icon icon-chart"></i></div>
                                            <?php
                                            $currentdateciro = date("Y-m-d");

                                            $newdateciro = date("Y-m-d", strtotime('-1 month', strtotime($currentdateciro)));

                                            $returndateciro = date("F", strtotime($newdateciro));

                                            $turkishdateciro = $DB->convertMonthToTurkishCharacter($returndateciro);
                                            ?>
                                            <p class="mb-0 text-start"><span class="dot-label bg-warning me-2"></span> <?= $turkishdateciro ?> Ayı Ciro <span class="float-end">₺<?= number_format($DB->aylikCiroTutari()); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body pb-0">
                                        <div class="float-start">
                                            <p class="mb-1">Toplam Şirket Masrafı</p>
                                            <h2 class="counter mb-0">₺ <?= number_format($DB->toplamSirketGider()); ?></h2>
                                        </div>
                                        <div class="float-end">
                                            <span class="mini-stat-icon bg-info"><i class="fa fa-bar-chart"></i></span>
                                        </div>
                                    </div>
                                    <?php
                                    $toplammasraf = $DB->toplamMasraflar();

                                    $aylar = array();

                                    for ($ay = 1; $ay < 13; $ay++) {
                                        if ($ay < 10) {
                                            $ayismi = "0" . $ay;
                                        } else {
                                            $ayismi = $ay;
                                        }
                                        $baslamatarih = date("Y") . "-" . $ayismi . "-01";
                                        $bitistarih = date("Y") . "-" . $ayismi . "-31";

                                        $masrafsirketrapor = $DB->CallData("sirketgider", "WHERE tarih BETWEEN ? AND ?", array($baslamatarih, $bitistarih), "ORDER BY ID ASC");
                                        if ($masrafsirketrapor != false) {
                                            $sirketdeger = 0;
                                            for ($sirmas = 0; $sirmas < count($masrafsirketrapor); $sirmas++) {
                                                $sirketdeger = ($sirketdeger + $masrafsirketrapor[$sirmas]["gider"]);
                                            }
                                            $aylar[] = $sirketdeger;
                                        } else {
                                            $aylar[] = 0;
                                        }
                                    }


                                    ?>
                                    <div class="card-body pt-0 pb-0 border-top-0 overflow-hidden">
                                        <div class="chart-wrapper overflow-hidden">
                                            <canvas id="areaChart1" class="areaChart overflow-hidden chart-dropshadow-primary" ocak="<?= $aylar[0] ?>" subat="<?= $aylar[1] ?>" mart="<?= $aylar[2] ?>" nisan="<?= $aylar[3] ?>" mayis="<?= $aylar[4] ?>" haziran="<?= $aylar[5] ?>" temmuz="<?= $aylar[6] ?>" agustos="<?= $aylar[7] ?>" eylul="<?= $aylar[8] ?>" ekim="<?= $aylar[9] ?>" kasim="<?= $aylar[10] ?>" aralik="<?= $aylar[11] ?>"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="float-start">
                                            <p class="mb-1">Toplam İşlem Maliyet</p>
                                            <h2 class="counter mb-0">₺<?= number_format($DB->toplamSiparisGider()); ?></h2>
                                        </div>
                                        <div class="float-end">
                                            <span class="mini-stat-icon bg-danger"><i class="fa fa-money"></i></span>
                                        </div>
                                    </div>

                                    <?php


                                    $siparisaylar = array();

                                    for ($say = 1; $say < 13; $say++) {
                                        if ($say < 10) {
                                            $sayismi = "0" . $say;
                                        } else {
                                            $sayismi = $say;
                                        }
                                        $sbaslamatarih = date("Y") . "-" . $sayismi . "-01";
                                        $sbitistarih = date("Y") . "-" . $sayismi . "-31";

                                        $masrafsiparisrapor = $DB->CallData("siparisgider", "WHERE tarih BETWEEN ? AND ?", array($sbaslamatarih, $sbitistarih), "ORDER BY ID ASC");
                                        if ($masrafsiparisrapor != false) {
                                            $siparisdeger = 0;
                                            for ($sipmas = 0; $sipmas < count($masrafsiparisrapor); $sipmas++) {
                                                $siparisdeger = ($siparisdeger + $masrafsiparisrapor[$sipmas]["gider"]);
                                            }
                                            $siparisaylar[] = $siparisdeger;
                                        } else {
                                            $siparisaylar[] = 0;
                                        }
                                    }


                                    ?>
                                    <div class="card-body pt-0 pb-0 border-top-0 overflow-hidden">
                                        <div class="chart-wrapper">
                                            <canvas id="areaChart4" class="areaChart chart-dropshadow-danger" ocak="<?= $siparisaylar[0] ?>" subat="<?= $siparisaylar[1] ?>" mart="<?= $siparisaylar[2] ?>" nisan="<?= $siparisaylar[3] ?>" mayis="<?= $siparisaylar[4] ?>" haziran="<?= $siparisaylar[5] ?>" temmuz="<?= $siparisaylar[6] ?>" agustos="<?= $siparisaylar[7] ?>" eylul="<?= $siparisaylar[8] ?>" ekim="<?= $siparisaylar[9] ?>" kasim="<?= $siparisaylar[10] ?>" aralik="<?= $siparisaylar[11] ?>"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <?php
                                    $currentdatemusteri = date("Y-m-d");

                                    $newdatemusteri = date("Y-m-d", strtotime('-1 month', strtotime($currentdatemusteri)));

                                    $returndatemusteri = date("F", strtotime($newdatemusteri));

                                    $turkishdatemusteri = $DB->convertMonthToTurkishCharacter($returndatemusteri);
                                    ?>
                                    <div class="card-body pb-0">
                                        <div class="float-start">
                                            <p class="mb-1"> <?= $turkishdatemusteri ?> Ayı Ulaşılan Müşteri Sayısı</p>
                                            <h2 class="counter mb-0"><?= $DB->aylikUlasilanMusteriSayisi(); ?> Müşteri</h2>
                                        </div>
                                        <div class="float-end">
                                            <span class="mini-stat-icon bg-success"><i class="fa fa-send-o"></i></span>
                                        </div>
                                    </div>
                                    <?php


                                    $sipariaylikmusteri = array();

                                    for ($may = 1; $may < 13; $may++) {
                                        if ($may < 10) {
                                            $mayismi = "0" . $may;
                                        } else {
                                            $mayismi = $may;
                                        }
                                        $mbaslamatarih = date("Y") . "-" . $mayismi . "-01";
                                        $mbitistarih = date("Y") . "-" . $mayismi . "-31";

                                        $umusterirapor = $DB->CallData("ulasilan_musteriler", "WHERE tarih BETWEEN ? AND ?", array($mbaslamatarih, $mbitistarih), "ORDER BY ID ASC");
                                        if ($umusterirapor != false) {
                                            $umusterideger = 0;
                                            for ($umusterimas = 0; $umusterimas < count($umusterirapor); $umusterimas++) {
                                                $umusterideger = ($umusterideger + count($umusterirapor));
                                            }
                                            $sipariaylikmusteri[] = $umusterideger;
                                        } else {
                                            $sipariaylikmusteri[] = 0;
                                        }
                                    }


                                    ?>
                                    <div class="card-body pt-0 pb-0 border-top-0 overflow-hidden">
                                        <div class="chart-wrapper">
                                            <canvas id="areaChart2" class="areaChart chart-dropshadow-success" ocak="<?= $sipariaylikmusteri[0] ?>" subat="<?= $sipariaylikmusteri[1] ?>" mart="<?= $sipariaylikmusteri[2] ?>" nisan="<?= $sipariaylikmusteri[3] ?>" mayis="<?= $sipariaylikmusteri[4] ?>" haziran="<?= $sipariaylikmusteri[5] ?>" temmuz="<?= $sipariaylikmusteri[6] ?>" agustos="<?= $sipariaylikmusteri[7] ?>" eylul="<?= $sipariaylikmusteri[8] ?>" ekim="<?= $sipariaylikmusteri[9] ?>" kasim="<?= $sipariaylikmusteri[10] ?>" aralik="<?= $sipariaylikmusteri[11] ?>"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="float-start">
                                            <p class="mb-1"><?= date("Y"); ?> Ulaşılan Müşteri Sayısı</p>
                                            <h2 class="counter mb-0"><?= $DB->yillikUlasilanMusteriSayisi(); ?> Müşteri</h2>
                                        </div>
                                        <div class="float-end">
                                            <span class="mini-stat-icon bg-warning"><i class="fa fa-mail-reply"></i></span>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 pb-0 border-top-0 overflow-hidden">
                                        <div class="chart-wrapper">
                                            <canvas id="areaChart3" class="areaChart chart-dropshadow-warning"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $teslimedilensiparisler = $DB->CallData("siparisler", "WHERE siparis_durumu=?", array("Teslim Edildi"), "ORDER BY ID ASC");
                            $toplamsiparissayisi = $DB->CallData("siparisler", "WHERE onizleme_durum=?", array(1), "ORDER BY ID ASC");
                            if($toplamsiparissayisi!=false) {
                                $siparissayisi=count($toplamsiparissayisi);
                            }
                            else {
                                $siparissayisi=0;
                            }
                            
                            $ekipuyeleri = $DB->CallData("kullanicilar", "WHERE state=?", array(1), "ORDER BY ID ASC");
                            $totalziyaretci = $DB->CallData("ziyaretciler", "", "", "");


                            ?>
                            <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card-img-absolute circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                                                <img src="<?= SITE ?>assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-4">
                                                <h2 class="mb-2 fw-normal mt-2"><?= count($totalziyaretci); ?></h2>
                                                <h5 class="fw-normal mb-0">Toplam Ziyaretçi</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card-img-absolute circle-icon bg-secondary align-items-center text-center box-secondary-shadow bradius">
                                                <img src="<?= SITE ?>assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-briefcase fs-30 text-white mt-4"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-4">
                                                <h2 class="mb-2 fw-normal mt-2"><?= count($ekipuyeleri); ?></h2>
                                                <h5 class="fw-normal mb-0">Toplam Ekip Üyesi Sayısı</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card-img-absolute  circle-icon bg-success align-items-center text-center box-success-shadow bradius">
                                                <img src="<?= SITE ?>assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class="lnr lnr-gift fs-30 text-white mt-4"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-4">
                                                <h2 class="mb-2 fw-normal mt-2"><?= $siparissayisi; ?></h2>
                                                <h5 class="fw-normal mb-0">Toplam Sipariş Sayısı</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card-img-absolute circle-icon bg-danger align-items-center text-center box-danger-shadow bradius">
                                                <img src="<?= SITE ?>assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                                <i class=" lnr lnr-cart fs-30 text-white mt-4"></i>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-4">
                                                <h2 class="mb-2 fw-normal mt-2"><?php if($teslimedilensiparisler!=false) { echo count($teslimedilensiparisler);}else { echo 0;} ?></h2>
                                                <h5 class="fw-normal mb-0">Teslim Edilen Siparişler</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END -->

                <!-- ROW-2 -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= $DB->convertMonthToTurkishCharacter(date("F")) ?> Ayı Satış Analitiği</h3>
                            </div>
                            <?php


                            $toplamsiparisleray = array();

                            for ($teslimay = 1; $teslimay < 13; $teslimay++) {
                                if ($teslimay < 10) {
                                    $teslimayismi = "0" . $teslimay;
                                } else {
                                    $teslimayismi = $teslimay;
                                }
                                $tesaybaslamatarih = date("Y") . "-" . $teslimayismi . "-01";
                                $tesaybitistarih = date("Y") . "-" . $teslimayismi . "-31";

                                $tesayrapor = $DB->CallData("siparisler", "WHERE tarih BETWEEN ? AND ?", array($tesaybaslamatarih, $tesaybitistarih), "ORDER BY ID ASC");
                                if ($tesayrapor != false) {
                                    $tesaydeger = 0;

                                    $tesaydeger = ($tesaydeger + count($tesayrapor));

                                    $toplamsiparisleray[] = $tesaydeger;
                                } else {
                                    $toplamsiparisleray[] = 0;
                                }
                            }




                            $teslimedilensiparisay = array();

                            for ($top = 1; $top < 13; $top++) {
                                if ($top < 10) {
                                    $topismi = "0" . $top;
                                } else {
                                    $topismi = $top;
                                }
                                $topbaslamatarih = date("Y") . "-" . $topismi . "-01";
                                $topbitistarih = date("Y") . "-" . $topismi . "-31";

                                $toprapor = $DB->CallData("siparisler", "WHERE siparis_durumu=? AND tarih BETWEEN ? AND ?", array("Teslim Edildi", $topbaslamatarih, $topbitistarih), "ORDER BY ID ASC");
                                if ($toprapor != false) {
                                    $topdeger = 0;
                                    for ($topi = 0; $topi < count($toprapor); $topi++) {
                                        $topdeger = ($topdeger + count($toprapor));
                                    }
                                    $teslimedilensiparisay[] = $topdeger;
                                } else {
                                    $teslimedilensiparisay[] = 0;
                                }
                            }


                            ?>
                            <div class="card-body">
                                <div class="d-flex mx-auto text-center justify-content-center mb-4">
                                    <div class="d-flex text-center justify-content-center me-3"><span class="dot-label bg-primary my-auto"></span>Toplam Siparişler</div>
                                    <div class="d-flex text-center justify-content-center"><span class="dot-label bg-secondary my-auto"></span>Teslim Edilen Siparişler</div>
                                </div>
                                <div class="chartjs-wrapper-demo">
                                    <canvas id="transactions" class="chart-dropshadow" ocak="<?= $teslimedilensiparisay[0] ?>" subat="<?= $teslimedilensiparisay[1] ?>" mart="<?= $teslimedilensiparisay[2] ?>" nisan="<?= $teslimedilensiparisay[3] ?>" mayis="<?= $teslimedilensiparisay[4] ?>" haziran="<?= $teslimedilensiparisay[5] ?>" temmuz="<?= $teslimedilensiparisay[6] ?>" agustos="<?= $teslimedilensiparisay[7] ?>" eylul="<?= $teslimedilensiparisay[8] ?>" ekim="<?= $teslimedilensiparisay[9] ?>" kasim="<?= $teslimedilensiparisay[10] ?>" aralik="<?= $teslimedilensiparisay[11] ?>" topocak="<?= $toplamsiparisleray[0] ?>" topsubat="<?= $toplamsiparisleray[1] ?>" topmart="<?= $toplamsiparisleray[2] ?>" topnisan="<?= $toplamsiparisleray[3] ?>" topmayis="<?= $toplamsiparisleray[4] ?>" tophaziran="<?= $toplamsiparisleray[5] ?>" toptemmuz="<?= $toplamsiparisleray[6] ?>" topagustos="<?= $toplamsiparisleray[7] ?>" topeylul="<?= $toplamsiparisleray[8] ?>" topekim="<?= $toplamsiparisleray[9] ?>" topkasim="<?= $toplamsiparisleray[10] ?>" toparalik="<?= $toplamsiparisleray[11] ?>"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                        <div class="card overflow-hidden">
                            <div class="card-body pb-0 bg-recentorder">
                                <h3 class="card-title text-white">Son Siparişler</h3>
                                <div class="chartjs-wrapper-demo">
                                    <canvas id="recentorders" class="chart-dropshadow"></canvas>
                                </div>
                            </div>
                            <div id="flotback-chart" class="flot-background"></div>
                            <div class="card-body">
                                <div class="d-flex mb-4 mt-3">
                                    <div class="avatar avatar-md bg-secondary-transparent text-secondary bradius me-3">
                                        <i class="fe fe-check"></i>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 fw-semibold">Teslim Edilen Siparişler</h6>

                                        <p class="fw-normal fs-12"> <span class="text-success"><?= $DB->teslimedilenSiparisYuzdelikArtis(); ?>%</span>
                                            artış </p>
                                    </div>
                                    <div class=" ms-auto my-auto">
                                        <p class="fw-bold fs-20"> <?php if($teslimedilensiparisler!=false) { echo count($teslimedilensiparisler);}else { echo 0;} ?></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="avatar  avatar-md bg-pink-transparent text-pink bradius me-3">
                                        <i class="fe fe-x"></i>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 fw-semibold">İptal edilen Siparişler</h6>
                                        <p class="fw-normal fs-12"> <span class="text-success"><?= $DB->iptaledilenSiparisYuzdelikArtis(); ?>%</span>
                                            artış </p>
                                    </div>
                                    <div class=" ms-auto my-auto">
                                        <?php
                                        $iptaledilensiparisler = $DB->CallData("siparisler", "WHERE siparis_durumu=?", array("İptal Edildi"), "ORDER BY ID ASC");
                                        if ($iptaledilensiparisler != false) {
                                            $totaliptalsiparis = count($iptaledilensiparisler);
                                        } else {
                                            $totaliptalsiparis = 0;
                                        }
                                        ?>
                                        <p class="fw-bold fs-20 mb-0"> <?= $totaliptalsiparis ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title fw-semibold">Tarayıcı Kullanımı</h4>
                            </div>
                            <div class="card-body">
                                <div class="browser-stats">
                                    <div class="row mb-4">
                                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                            <img src="assets/images/browsers/chrome.svg" class="img-fluid" alt="img">
                                        </div>
                                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between mb-1">
                                                <?php
                                                $zchrome = $DB->ziyaretciChrome();
                                                if ($zchrome < 100) {
                                                    $pchrome = $zchrome;
                                                } else if ($zchrome > 100 && $zchrome < 1000) {
                                                    $pchrome = $zchrome / 100;
                                                } else if ($zchrome > 1000 && $zchrome < 10000) {
                                                    $pchrome = $zchrome / 1000;
                                                }
                                                ?>
                                                <h6 class="mb-1">Google Chrome</h6>
                                                <h6 class="fw-semibold mb-1"><?= $zchrome ?> </h6>
                                            </div>
                                            <div class="progress h-2 mb-3">
                                                <div class="progress-bar bg-primary" style="width: <?= $pchrome ?>%;" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                            <img src="assets/images/browsers/opera.svg" class="img-fluid" alt="img">
                                        </div>
                                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between mb-1">
                                                <?php
                                                $zopera = $DB->ziyaretciOpera();
                                                if ($zopera < 100) {
                                                    $popera = $zopera;
                                                } else if ($zopera > 100 && $zopera < 1000) {
                                                    $popera = $zopera / 100;
                                                } else if ($zopera > 1000 && $zopera < 10000) {
                                                    $popera = $zopera / 1000;
                                                }
                                                ?>
                                                <h6 class="mb-1">Opera</h6>
                                                <h6 class="fw-semibold mb-1"><?= $zopera ?> </h6>
                                            </div>
                                            <div class="progress h-2 mb-3">
                                                <div class="progress-bar bg-secondary" style="width: <?= $popera ?>%;" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                            <img src="assets/images/browsers/ie.svg" class="img-fluid" alt="img">
                                        </div>
                                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between mb-1">
                                                <?php
                                                $zie = $DB->ziyaretciIE();
                                                if ($zie < 100) {
                                                    $pie = $zie;
                                                } else if ($zie > 100 && $zie < 1000) {
                                                    $pie = $zie / 100;
                                                } else if ($zie > 1000 && $zie < 10000) {
                                                    $pie = $zie / 1000;
                                                }
                                                ?>
                                                <h6 class="mb-1">Internet Explorer</h6>
                                                <h6 class="fw-semibold mb-1"><?= $zie ?> </h6>
                                            </div>
                                            <div class="progress h-2 mb-3">
                                                <div class="progress-bar bg-success" style="width: <?= $pie ?>%;" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                            <img src="assets/images/browsers/firefox.svg" class="img-fluid" alt="img">
                                        </div>
                                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between mb-1">
                                                <?php
                                                $zff = $DB->ziyaretciFireFox();
                                                if ($zff < 100) {
                                                    $pff = $zff;
                                                } else if ($zff > 100 && $zff < 1000) {
                                                    $pff = $zff / 100;
                                                } else if ($zff > 1000 && $zff < 10000) {
                                                    $pff = $zff / 1000;
                                                }
                                                ?>
                                                <h6 class="mb-1">Firefox</h6>
                                                <h6 class="fw-semibold mb-1"><?= $zff ?></h6>
                                            </div>
                                            <div class="progress h-2 mb-3">
                                                <div class="progress-bar bg-danger" style="width: <?= $pff ?>%;" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                            <img src="assets/images/browsers/browser.png" class="img-fluid" alt="img">
                                        </div>
                                        <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                            <div class="d-flex align-items-end justify-content-between mb-1">
                                                <?php
                                                $zdiger = $DB->ziyaretciDiger();
                                                if ($zdiger < 100) {
                                                    $pdiger = $zdiger;
                                                } else if ($zdiger > 100 && $zdiger < 1000) {
                                                    $pdiger = $zdiger / 100;
                                                } else if ($zdiger > 1000 && $zdiger < 10000) {
                                                    $pdiger = $zdiger / 1000;
                                                }
                                                ?>
                                                <h6 class="mb-1">Diğer</h6>
                                                <h6 class="fw-semibold mb-1"><?= $zdiger ?></h6>
                                            </div>
                                            <div class="progress h-2 mb-3">
                                                <div class="progress-bar bg-warning" style="width: <?= $pdiger ?>%;" role="progressbar"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-2 END -->






            </div>
            <!-- CONTAINER END -->


        </div>
    </div>
<?php

} else {



?>
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Profil</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="wideget-user mb-2">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="panel profile-cover">
                                                    <div class="profile-cover__action bg-img img-responsive" style="background:url(<?= SITE ?>assets/images/thumbnails/<?= $userthumbnail ?>) 0 0/cover no-repeat"></div>
                                                    <div class="profile-cover__img">
                                                        <div class="profile-img-1">

                                                            <img class="img-responsive" src="<?= SITE ?>assets/images/users/<?= $userimage ?>" alt="<?= $user[0]["adsoyad"] ?>">

                                                        </div>
                                                        <div class="profile-img-content text-dark text-start">
                                                            <div class="text-dark">
                                                                <h3 class="h3 mb-2"><?= $user[0]["adsoyad"] ?></h3>
                                                                <h5 class="text-muted"><?= $user[0]["Rank"] ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="px-0 px-sm-4">
                                                    <div class="social social-profile-buttons mt-5 float-end">
                                                        <div class="mt-3">
                                                            <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                                            <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                                            <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>
                                                            <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>
                                                            <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                            <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="main-profile-contact-list">
                                            <div class="me-5">
                                                <div class="media mb-4 d-flex">
                                                    <div class="media-icon bg-secondary bradius me-3 mt-1">
                                                        <i class="fe fe-edit fs-20 text-white"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="text-muted">Posts</span>
                                                        <div class="fw-semibold fs-25">
                                                            328
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="me-5 mt-5 mt-md-0">
                                                <div class="media mb-4 d-flex">
                                                    <div class="media-icon bg-danger bradius text-white me-3 mt-1">
                                                        <span class="mt-3">
                                                            <i class="fe fe-users fs-20"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="text-muted">Followers</span>
                                                        <div class="fw-semibold fs-25">
                                                            937k
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="me-0 mt-5 mt-md-0">
                                                <div class="media">
                                                    <div class="media-icon bg-primary text-white bradius me-3 mt-1">
                                                        <span class="mt-3">
                                                            <i class="fe fe-cast fs-20"></i>
                                                        </span>
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="text-muted">Following</span>
                                                        <div class="fw-semibold fs-25">
                                                            2,876
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">About</div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h5>Biography<i class="fe fe-edit-3 text-primary mx-2"></i></h5>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
                                                <a href="javascript:void(0)">Read more</a>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-briefcase fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>San Francisco, CA </strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-map-pin fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>Francisco, USA</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-phone fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>+125 254 3562 </strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-mail fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>georgeme@abc.com </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Skills</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tags">
                                            <a href="javascript:void(0)" class="tag">Laravel</a>
                                            <a href="javascript:void(0)" class="tag">Angular</a>
                                            <a href="javascript:void(0)" class="tag">HTML</a>
                                            <a href="javascript:void(0)" class="tag">Vuejs</a>
                                            <a href="javascript:void(0)" class="tag">Codiegniter</a>
                                            <a href="javascript:void(0)" class="tag">JavaScript</a>
                                            <a href="javascript:void(0)" class="tag">Bootstrap</a>
                                            <a href="javascript:void(0)" class="tag">PHP</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Work & Education</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="main-profile-contact-list">
                                            <div class="me-5">
                                                <div class="media mb-4 d-flex">
                                                    <div class="media-icon bg-primary  mb-3 mb-sm-0 me-3 mt-1">
                                                        <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                            <path fill="#fff" d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3M18.82 9L12 12.72L5.18 9L12 5.28L18.82 9M17 16L12 18.72L7 16V12.27L12 15L17 12.27V16Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="font-weight-semibold mb-1">Web Designer at <a href="javascript:void(0)" class="btn-link">Spruko</a></h6>
                                                        <span>2018 - present</span>
                                                        <p>Past Work: Spruko, Inc.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="me-5 mt-5 mt-md-0">
                                                <div class="media mb-4 d-flex">
                                                    <div class="media-icon bg-success text-white mb-3 mb-sm-0 me-3 mt-1">
                                                        <svg style="width:24px;height:24px;margin-top:-8px" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M20,6C20.58,6 21.05,6.2 21.42,6.59C21.8,7 22,7.45 22,8V19C22,19.55 21.8,20 21.42,20.41C21.05,20.8 20.58,21 20,21H4C3.42,21 2.95,20.8 2.58,20.41C2.2,20 2,19.55 2,19V8C2,7.45 2.2,7 2.58,6.59C2.95,6.2 3.42,6 4,6H8V4C8,3.42 8.2,2.95 8.58,2.58C8.95,2.2 9.42,2 10,2H14C14.58,2 15.05,2.2 15.42,2.58C15.8,2.95 16,3.42 16,4V6H20M4,8V19H20V8H4M14,6V4H10V6H14M12,9A2.25,2.25 0 0,1 14.25,11.25C14.25,12.5 13.24,13.5 12,13.5A2.25,2.25 0 0,1 9.75,11.25C9.75,10 10.76,9 12,9M16.5,18H7.5V16.88C7.5,15.63 9.5,14.63 12,14.63C14.5,14.63 16.5,15.63 16.5,16.88V18Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="font-weight-semibold mb-1">Studied at <a href="javascript:void(0)" class="btn-link">University</a></h6>
                                                        <span>2004-2008</span>
                                                        <p>Graduation: Bachelor of Science in Computer Science</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                
                                <div class="card border p-0 shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media mt-0">
                                                <div class="media-user me-2">
                                                    <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="<?= SITE ?>assets/images/users/16.jpg"></div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                    <small class="text-muted">just now</small>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="dropdown show">
                                                    <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                        <span class=""><i class="fe fe-more-vertical"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                            <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer user-pro-2">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class="avatar-list avatar-list-stacked">
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/12.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/9.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/4.jpg)"></span>
                                                    <span class="avatar brround text-primary">+28</span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="d-flex mt-1">
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                    <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border p-0 shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media mt-0">
                                                <div class="media-user me-2">
                                                    <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="<?= SITE ?>assets/images/users/16.jpg"></div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                    <small class="text-muted">Sep 26 2019, 10:14am</small>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="dropdown show">
                                                    <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                        <span class=""><i class="fe fe-more-vertical"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex">
                                                <a href="gallery.html" class="w-30 m-2"><img src="<?= SITE ?>assets/images/media/22.jpg" alt="img" class="br-5"></a>
                                                <a href="gallery.html" class="w-30 m-2"><img src="<?= SITE ?>assets/images//media/24.jpg" alt="img" class="br-5"></a>
                                            </div>
                                            <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                            <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer user-pro-2">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class="avatar-list avatar-list-stacked">
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/12.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/9.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/4.jpg)"></span>
                                                    <span class="avatar brround text-primary">+28</span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="d-flex mt-1">
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                    <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border p-0 shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="media mt-0">
                                                <div class="media-user me-2">
                                                    <div class=""><img alt="" class="rounded-circle avatar avatar-md" src="<?= SITE ?>assets/images/users/16.jpg"></div>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-0 mt-1">Peter Hill</h6>
                                                    <small class="text-muted">Sep 24 2019, 09:14am</small>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="dropdown show">
                                                    <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                                                        <span class=""><i class="fe fe-more-vertical"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete Post</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Personal Settings</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="d-flex">
                                                <a href="gallery.html" class="w-30 m-2"><img src="<?= SITE ?>assets/images/media/26.jpg" alt="img" class="br-5"></a>
                                                <a href="gallery.html" class="w-30 m-2"><img src="<?= SITE ?>assets/images/media/23.jpg" alt="img" class="br-5"></a>
                                                <a href="gallery.html" class="w-30 m-2"><img src="<?= SITE ?>assets/images/media/21.jpg" alt="img" class="br-5"></a>
                                            </div>
                                            <h4 class="fw-semibold mt-3">There is nothing more beautiful.</h4>
                                            <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer user-pro-2">
                                        <div class="media mt-0">
                                            <div class="media-user me-2">
                                                <div class="avatar-list avatar-list-stacked">
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/12.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/9.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/2.jpg)"></span>
                                                    <span class="avatar brround" style="background-image: url(<?= SITE ?>assets/images/users/4.jpg)"></span>
                                                    <span class="avatar brround text-primary">+28</span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-0 mt-2 ms-2">28 people like your photo</h6>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="d-flex mt-1">
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-heart"></i></span></a>
                                                    <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i></span></a>
                                                    <a class="new text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-share-2"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Followers</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <div class="media overflow-visible">
                                                <img class="avatar brround avatar-md me-3" src="<?= SITE ?>assets/images/users/18.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle mt-2">
                                                    <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                    <p class="text-muted mb-0">johan@gmail.com</p>
                                                </div>
                                                <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                    <button class="btn btn-sm btn-primary" type="button">Follow</button>
                                                </div>
                                            </div>
                                            <div class="media overflow-visible mt-sm-5">
                                                <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                                <div class="media-body valign-middle mt-2">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                    <p class="text-muted mb-0">lilliangore</p>
                                                </div>
                                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                    <button class="btn btn-sm btn-secondary" type="button">Follow</button>
                                                </div>
                                            </div>
                                            <div class="media overflow-visible mt-sm-5">
                                                <img class="avatar brround avatar-md me-3" src="<?= SITE ?>assets/images/users/2.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle mt-2">
                                                    <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                    <p class="text-muted mb-0">harryuqt</p>
                                                </div>
                                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                    <button class="btn btn-sm btn-danger" type="button">Follow</button>
                                                </div>
                                            </div>
                                            <div class="media overflow-visible mt-sm-5">
                                                <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                                <div class="media-body valign-middle mt-2">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                    <p class="text-muted mb-0">harris@gmail.com</p>
                                                </div>
                                                <div class="media-body valign-middle text-end overflow-visible mt-1">
                                                    <button class="btn btn-sm btn-success" type="button">Follow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Our Latest News</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <div class="media media-xs overflow-visible">
                                                <img class="avatar bradius avatar-xl me-3" src="<?= SITE ?>assets/images/users/12.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">John Paige</a>
                                                    <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <img class="avatar bradius avatar-xl me-3" src="<?= SITE ?>assets/images/users/2.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Peter Hill</a>
                                                    <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <img class="avatar bradius avatar-xl me-3" src="<?= SITE ?>assets/images/users/9.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                    <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <img class="avatar bradius avatar-xl me-3" src="<?= SITE ?>assets/images/users/4.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Harry Fisher</a>
                                                    <p class="text-muted mb-0">There are many variations of passages of Lorem Ipsum available ...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Friends</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-pro-1">
                                            <div class="media media-xs overflow-visible">
                                                <img class="avatar brround avatar-md me-3" src="<?= SITE ?>assets/images/users/18.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle">
                                                    <a href="javascript:void(0)" class=" fw-semibold text-dark">John Paige</a>
                                                    <p class="text-muted mb-0">Web Designer</p>
                                                </div>
                                                <div class="">
                                                    <div class="social social-profile-buttons float-end">
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <span class="avatar cover-image avatar-md brround bg-pink me-3">LQ</span>
                                                <div class="media-body valign-middle mt-0">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Lillian Quinn</a>
                                                    <p class="text-muted mb-0">Web Designer</p>
                                                </div>
                                                <div class="">
                                                    <div class="social social-profile-buttons float-end">
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <img class="avatar brround avatar-md me-3" src="<?= SITE ?>assets/images/users/2.jpg" alt="avatar-img">
                                                <div class="media-body valign-middle mt-0">
                                                    <a href="javascript:void(0)" class="text-dark fw-semibold">Harry Fisher</a>
                                                    <p class="text-muted mb-0">Web Designer</p>
                                                </div>
                                                <div class="">
                                                    <div class="social social-profile-buttons float-end">
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media media-xs overflow-visible mt-5">
                                                <span class="avatar cover-image avatar-md brround me-3 bg-primary">IH</span>
                                                <div class="media-body valign-middle mt-0">
                                                    <a href="javascript:void(0)" class="fw-semibold text-dark">Irene Harris</a>
                                                    <p class="text-muted mb-0">Web Designer</p>
                                                </div>
                                                <div class="">
                                                    <div class="social social-profile-buttons float-end">
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                        <a class="social-icon bg-white" href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->

            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <!--app-content closed-->
<?php
}
?>