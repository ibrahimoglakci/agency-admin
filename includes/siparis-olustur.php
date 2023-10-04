<head>
    <title>Sipariş Oluştur | <?= $sitebaslik ?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Sipariş Oluştur</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sipariş Oluştur</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php
            if ($_POST) {
                if (!empty($_POST["selectpaket"]) && !empty($_POST["madsoyad"]) && !empty($_POST["mtelefon"]) && !empty($_POST["fiyat"]) && !empty($_POST["aciklama"])) {
                    $selectpaket = $DB->filter($_POST["selectpaket"]);
                    $paketkodnotext = explode("AVTR-", $selectpaket);
                    $siparispaketkod = $paketkodnotext[1];
                    $madsoyad=$DB->filter($_POST["madsoyad"]);
                    $secilenpaket = $DB->CallData("paketler", "WHERE paketkodu=?", array($selectpaket), "ORDER BY ID ASC", 1);
                    
                    $kategori = $secilenpaket[0]["kategori"];
                    $mtelefon = $DB->filter($_POST["mtelefon"]);
                    $madress = $DB->filter($_POST["madres"]);
                    $metin = $DB->filter($_POST["aciklama"], true);
                    $meposta = $DB->filter($_POST["meposta"]);
                    $fiyat = $DB->filter($_POST["fiyat"]);

                    $odemetipi = $DB->filter($_POST["odemetipi"]);

                    $sipariskod = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                    $takipno = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                    $paytr_id = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

                    if($secilenpaket[0]["yapilansatis"]==NULL) {
                        $satisarttir=1;

                    }
                    else {
                        $satisarttir=count($secilenpaket)+1;

                    }


                    $sepetekle = $DB->RunQuery("INSERT INTO siparissepet", "SET paketkod=?, musteri_adsoyad=?, musteri_adress=?, musteri_telefon=?, fiyat=?, durum=?, paytr_id=?", array($siparispaketkod, $madsoyad, $madress, $mtelefon, $fiyat, 0, $paytr_id));
                    $olustur = $DB->RunQuery("INSERT INTO siparisler", "SET siparis_kodu=?, musteri_adsoyad=?, musteri_telefon=?, musteri_adress=?,  paketkodu=?, siparis_durumu=?, siparis_notu=?, paket_kategori=?, takipno=?, siparis_tutari=?, odemetipi=?, onizleme_durum=?, ekleyen_uye=?, durum=?", array($sipariskod, $madsoyad, $mtelefon, $madress, $selectpaket, "Sipariş Alındı", $metin, $kategori, $takipno, $fiyat, $odemetipi,0,$_SESSION["ID"],1));
                    $satisekle = $DB->RunQuery("UPDATE paketler", "SET yapilansatis=? WHERE ID=?", array($satisarttir,$secilenpaket[0]["ID"]));
            ?>

                    <?php

                    if ($olustur != false) {
                    ?>
                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Sipariş başarıyla oluşturuldu.</div>
                        <meta http-equiv="refresh" content="1;url=<?= SITE ?>bekleyen-siparisler">


                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning"><i class="fa fa-triangle-exclamation"></i> Lütfen Boş Alanları Doldurunuz!</div>
            <?php

                }
            }

            ?>


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sipariş Oluştur</div>
                        </div>
                        <form action="" method="post" class="urunEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Paket Seçiniz :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="selectpaket">
                                            <?php
                                            $paketler = $DB->CallData("paketler", "WHERE durum=?", array(1), "ORDER BY ID ASC");

                                            if ($paketler != false) {
                                                for ($p = 0; $p < count($paketler); $p++) {
                                                    $paketcategory = $DB->CallData("categories", "WHERE ID=?", array($paketler[$p]["kategori"]), "ORDER BY ID ASC", 1);
                                            ?>
                                                    <option value="<?= $paketler[$p]["paketkodu"] ?>"><?= $paketler[$p]["baslik"] ?> Paket - <?= number_format($paketler[$p]["fiyat"]) ?>₺ / (<?= $paketcategory[0]["title"] ?>)</option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Ödeme Tipi Seçiniz :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="odemetipi">

                                            <option value="Nakit Ödeme">Nakit İle Ödeme</option>
                                            <option value="Banka Havale Ödeme">Banka Havale İle Ödeme</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Ad Soyad :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="madsoyad" placeholder="Müşteri Ad Soyad">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Adres :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="madres" placeholder="Müşteri Adres">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri E-Posta :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meposta" placeholder="Müşteri E-Posta">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Telefon Numarası :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="mtelefon" placeholder="Müşteri Telefon Numarası">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Fiyat :</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="fiyat">
                                    </div>
                                </div>


                                <!-- Row -->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Sipariş Açıklaması :</label>
                                    <div class="col-md-9 mb-4">
                                        <textarea class="content" name="aciklama"></textarea>
                                    </div>
                                </div>
                                <!--End Row-->

                                <!--Row-->

                                <!--End Row-->
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" name="ekle" class="btn btn-primary">Sipariş Oluştur</button>
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /ROW-1 CLOSED -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!--app-content closed-->