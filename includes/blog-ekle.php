<head>
    <title>Blog Ekle | <?= $sitebaslik ?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Blog Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php
            if ($_POST) {
                if (!empty($_POST["baslik"]) && !empty($_POST["metin"])) {

                    $kategori = $DB->filter($_POST["kategori"]);
                    $baslik = $DB->filter($_POST["baslik"]);
                    $anahtar = $DB->filter($_POST["anahtar"]);
                    $aciklama = $DB->filter($_POST["aciklama"]);
                    $seflink = $DB->seflink($baslik);
                    $metin = $DB->filter($_POST["metin"], true);
                    $sirano = $DB->filter($_POST["sirano"]);

                    $userlist=$DB->CallData("kullanicilar","WHERE ID=?",array($_SESSION["ID"]),"ORDER BY ID ASC",1);
                    if($userlist!=false) {
                        $yazar=$userlist[0]["adsoyad"];
                    }
                    $yukle = $DB->upload("resim", "assets/images/blog/");
                    if ($yukle != false) {
                        $ekle = $DB->RunQuery("INSERT INTO blog", "SET baslik=?, seflink=?, kategori=?, metin=?, resim=?, anahtar=?, description=?, yazar=?, durum=?, sirano=?, tarih=?", array($baslik, $seflink, $kategori, $metin, $yukle, $anahtar, $aciklama, $yazar, 1, $sirano, date("Y-m-d")));
                    } else {
                       
                        $ekle = $DB->RunQuery("INSERT INTO blog", "SET baslik=?, seflink=?, kategori=?, metin=?, anahtar=?, description=?, yazar=?, durum=?, sirano=?, tarih=?", array($baslik, $seflink, $kategori, $metin, $anahtar, $aciklama, $yazar, 1, $sirano, date("Y-m-d")));
                    
                    }


                    if ($ekle != false) {
                    ?>
                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> İşleminiz başarıyla kaydedildi.</div>
                        <meta http-equiv="refresh" content="1;url=<?=SITE?>blog">
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> İşleminiz sırasında bir sorunla
                            karşılaşıldı. Lütfen daha sonra tekrar
                            deneyiniz.</div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning"><i class="fa fa-circle-exclamation"></i> Boş bıraktığınız alanları
                        doldurunuz.
                    </div>
            <?php
                }
            }

            ?>


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Blog Ekle</div>
                        </div>
                        <form action="" method="post" class="bannerEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Blog Başlık :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik" placeholder="Blog Başlığı...">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Açıklama :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Blog Açıklaması..." name="aciklama">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Anahtar Kelimeler :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Blog Anahtar Kelimeleri..." name="anahtar">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori Seç :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="kategori">
                                            <?php
                                            $sonuc = $DB->callCategory("paketler");
                                            if ($sonuc != false) {

                                                echo $sonuc;
                                            } else {
                                                $categories = $DB->simpleCategory("paketler");



                                                echo $categories;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row -->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Blog Metni :</label>
                                    <div class="col-md-9 mb-4">
                                        <textarea class="content" name="metin"></textarea>
                                    </div>
                                </div>
                                <!--End Row-->

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sıra Numarası</label>
                                    <input type="number" class="form-control" placeholder="Sıra Numarası.." name="sirano" style="width:100px;" value="<?php $sirano = $DB->CallID("blog");
                                                                                                                                                        if ($sirano != false) {
                                                                                                                                                            echo $sirano;
                                                                                                                                                        } else {
                                                                                                                                                            echo "1";
                                                                                                                                                        }

                                                                                                                                                        ?>">

                                </div>

                                <!--Row-->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Blog Resmi :</label>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" data-bs-height="100" name="resim" />
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" name="ekle" class="btn btn-primary">Blog Ekle</button>
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