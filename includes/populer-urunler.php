<?php

$populer = $DB->CallData("paketler", "", "", "ORDER BY yapilansatis DESC", 4);


if ($populer != false) {



?>

    <head>
        <title>Popüler Ürünler | <?= $sitebaslik ?></title>
    </head>

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">En Çok Satan Ürünler</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Raporlar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">En Çok Satan Ürünler</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row row-cards">
                    <!-- COL-END -->
                    <div class="col-xl-12 col-lg-12">

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-11">
                                <div class="row">
                                    <?php
                                    for ($i = 0; $i < count($populer); $i++) {
                                        $kategori=$DB->CallData("categories","WHERE ID=?",array($populer[$i]["kategori"]),"ORDER BY ID ASC",1);

                                    ?>
                                        <div class="col-sm-6 col-md-6 col-xl-3 alert">
                                            <div class="card">
                                                <div class="product-grid6">
                                                    <div class="product-image6 p-5">

                                                        <?php
                                                        if (!empty($populer[$i]["resim"])) {
                                                        ?>
                                                            <a href="shop-description.html">
                                                                <img class="img-fluid br-7 w-100" src="<?= SITE ?>assets/images/paketler/<?php $populer[$i]["resim"]; ?>" alt="Paket Resmi">
                                                            </a>
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="product-content text-center">
                                                            <h1 class="title fw-bold fs-20"><a href="shop-description.html"><?= $populer[$i]["baslik"] ?></a></h1>
                                                            <?php
                                                            if ($populer[$i]["ifiyat"] == 1) {


                                                            ?>
                                                                <div class="price mb-2">₺<?= number_format($populer[$i]["indirimlifiyat"]) ?><span class="ms-4">₺<?= number_format($populer[$i]["fiyat"]) ?></span></div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="price mb-2">₺<?= number_format($populer[$i]["fiyat"]) ?></div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <span class="text-warning fs-18 fw-semibold"><?=$kategori[0]["title"]?></span>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <a href="cart.html" class="btn btn-primary mx-2 mb-1 w-sm"><i class="fe fe-shopping-cart me-2"></i>Add to cart</a>
                                                        <a href="javascript:void(0)" class="btn btn-light mx-2 mb-1 w-sm"><i class="fe fe-share-2 me-2 text-dark"></i>Share</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>


                                </div>

                            </div>
                        </div>
                        <!-- COL-END -->
                    </div>
                    <!-- ROW-1 CLOSED -->
                </div>
                <!-- ROW-1 END-->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->


<?php
}
?>