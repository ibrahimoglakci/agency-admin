<?php
if (!empty($_GET["ID"])) {
    $ID = $DB->filter($_GET["ID"]);

    $paket = $DB->CallData("paketler", "WHERE ID=?", array($ID), "ORDER BY ID ASC", 1);
    $kategori= $DB->CallData("categories", "WHERE ID=?", array($paket[0]["kategori"]), "ORDER BY ID ASC", 1);
}



?>


    <!--app-content open-->
    <div class="main-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container">
                <div class="">

                    <!-- ROW-6 OPEN -->
                    <div class="bg-landing section bg-image-style">
                        <div class="container">
                            <div class="row">
                                <h4 class="text-center fw-semibold">Paket Özellikleri </h4>
                                <span class="landing-title"></span>
                                <h2 class="text-center fw-semibold"><span class="text-primary"><?=$paket[0]["baslik"]?></span> Adlı Paketin Detayları.</h2>
                                <div class="pricing-tabs">
                                    <div class="pri-tabs-heading text-center">

                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane pb-0 active show" id="annualyear">
                                            <div class="row d-flex align-items-center justify-content-center">

                                                <div class="col-lg-4 col-xl-4 col-md-8 col-sm-12">
                                                    <div class="card p-3 border-primary pricing-card advanced reveal revealrotate">
                                                        <div class="card-header d-block text-justified pt-2">
                                                            <p class="fs-18 fw-semibold mb-1 pe-0"><?=$paket[0]["baslik"]?><?php if($paket[0]["kategori"]!=6) {echo " Paket";} ?><span class="tag bg-primary text-white float-end"><?=$kategori[0]["title"]?>
                                                                    </span></p>
                                                            <p class="text-justify fw-semibold mb-1"> <span class="fs-30 me-2">₺</span><span class="fs-30 me-1"><?=number_format($paket[0]["fiyat"])?></span><span class="fs-25"><span class="op-0-5 text-muted text-20">+</span>
                                                                    KDV</span></p>
                                                          
                                                        </div>
                                                        <div class="card-body pt-2">
                                                             <?= $paket[0]["metin"]; ?>
                                                        </div>
                                                        <div class="card-footer text-center border-top-0 pt-1">
                                                            <a href="tel:05079727070" class="btn btn-lg btn-primary-gradient text-white btn-block">
                                                                <span class="ms-4 me-4">Satın Al</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW-6 CLOSED -->




                </div>
            </div>
            <!-- CONTAINER CLOSED-->
        </div>
    </div>

    <!--app-content closed-->

