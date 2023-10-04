<head>
    <title>Analiz Grafikleri | <?= $sitebaslik ?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Analiz Grafikleri</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Analizler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analiz Grafikleri</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Yıllık Gelir Analitiği</h3>
                        </div>

                        <div class="card-body">
                            <div id="chart-pie" class="chartsh"></div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Yıllık Ciro Dağılımı</h3>
                        </div>
                        <?php

                        $ygeliraylar = array();

                        for ($yay = 1; $yay < 13; $yay++) {
                            if ($yay < 10) {
                                $yayismi = "0" . $yay;
                            } else {
                                $yayismi = $yay;
                            }
                            $baslamatarih = date("Y") . "-" . $yayismi . "-01";
                            $bitistarih = date("Y") . "-" . $yayismi . "-31";

                            $yillikgelir = $DB->CallData("siparisgelir", "WHERE tarih BETWEEN ? AND ?", array($baslamatarih, $bitistarih), "ORDER BY ID ASC");
                            if ($yillikgelir != false) {
                                $yillikgelirdeger = 0;
                                for ($ygel = 0; $ygel < count($yillikgelir); $ygel++) {
                                    $yillikgelirdeger = ($yillikgelirdeger + $yillikgelir[$ygel]["gelir"]);
                                }
                                $ygeliraylar[] = $yillikgelirdeger;
                            } else {
                                $ygeliraylar[] = 0;
                            }
                        }


                        ?>
                        <div class="card-body">
                            <div id="chart-pie4" class="chartsh" ocak="<?= $ygeliraylar[0] ?>" subat="<?= $ygeliraylar[1] ?>" mart="<?= $ygeliraylar[2] ?>" nisan="<?= $ygeliraylar[3] ?>" mayis="<?= $ygeliraylar[4] ?>" haziran="<?= $ygeliraylar[5] ?>" temmuz="<?= $ygeliraylar[6] ?>" agustos="<?= $ygeliraylar[7] ?>" eylul="<?= $ygeliraylar[8] ?>" ekim="<?= $ygeliraylar[9] ?>" kasim="<?= $ygeliraylar[10] ?>" aralik="<?= $ygeliraylar[11] ?>"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ROW-1 CLOSE -->

         


               <!--  <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">combination of bar & line chart</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-combination" class="chartsh"></div>
                        </div>
                    </div>
                </div>
 -->
            </div>
            <!-- ROW-2 CLOSE -->
        </div>
        <!-- CONTAINER CLOSE -->
    </div>
</div>
<!--app-content closed-->