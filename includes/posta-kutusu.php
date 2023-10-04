<?php



if (!empty($_GET["postadurum"]) && $_GET["postadurum"] == "okunmus-postalar") {

    $postalar = $DB->CallData("postakutusu", "WHERE durum=? AND okundu_bilgisi=?", array(1, 1), "ORDER BY tarih DESC");
    $pagename = "Okunmuş";
    $activeposta = "active";
    $activestar = "";
    $activecop="";

    if (empty($_GET['pagination'])) {
        $page = 1;
    } else {
        $page = strip_tags($_GET['pagination']);
    }
}
if (!empty($_GET["postadurum"]) && $_GET["postadurum"] == "okunmamis-postalar") {
    $postalar = $DB->CallData("postakutusu", "WHERE durum=? AND okundu_bilgisi=?", array(1, 0), "ORDER BY tarih DESC");
    $pagename = "Okunmamış";
    $activeposta = "active";
    $activestar = "";
    $activecop="";
}
if (!empty($_GET["postadurum"]) && $_GET["postadurum"] == "yildizlanmis-postalar") {
    $postalar = $DB->CallData("postakutusu", "WHERE durum=? AND starred=?", array(1, 1), "ORDER BY tarih DESC");
    $pagename = "Yıldızlanmış";
    $activestar = "active";
    $activeposta = "";
}
if (!empty($_GET["postadurum"]) && $_GET["postadurum"] == "cop-kutusu") {
    $postalar = $DB->CallData("postakutusu", "WHERE durum=?", array(2), "ORDER BY tarih DESC");
    $pagename = "Silinen";
    $activestar = "";
    $activeposta = "";
    $activecop="active";
} else {
    if (empty($_GET["postadurum"])) {
        $postalar = $DB->CallData("postakutusu", "WHERE durum=?", array(1), "ORDER BY tarih DESC");
        $pagename = "";
        $activestar = "";
        $activeposta = "active";
        $activecop="";
    }
}


$unreadpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND okundu_bilgisi=?", array(1, 0), "ORDER BY tarih DESC");
$starredpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND starred=? AND okundu_bilgisi=?", array(1, 1, 0), "ORDER BY tarih DESC");




?>

<title>Posta Kutusu | <?= $sitebaslik ?></title>


<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"><?= $pagename ?> Posta Kutusu</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Mail Yönetimi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Posta Kutusu</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-3">
                    <div id="scroll-stickybar" class="position-lg-relative w-100">
                        <div class="card">
                            <div class="list-group list-group-transparent mb-0 mail-inbox pb-3">
                                <div class="mt-4 mx-4 mb-4 text-center">
                                    <a href="<?= SITE ?>posta-gonder" class="btn btn-primary btn-lg d-grid">Mail Gönder</a>
                                </div>
                                <a href="<?= SITE ?>posta-kutusu/" class="list-group-item d-flex align-items-center <?= $activeposta ?> mx-4">
                                    <span class="icons"><i class="ri-mail-line"></i></span> Posta Kutusu <span class="ms-auto badge bg-secondary bradius"><?php if ($unreadpostalar != false) {
                                                                                                                                                                echo count($unreadpostalar);
                                                                                                                                                            } ?></span>
                                </a>

                                <a href="<?= SITE ?>posta-kutusu/yildizlanmis-postalar" class="list-group-item d-flex align-items-center <?= $activestar ?> mx-4">
                                    <span class="icons"><i class="ri-star-line"></i></span> Yıldızlanmış Postalar<span class="ms-auto badge bg-success bradius"><?php if ($starredpostalar != false) {
                                                                                                                                                                    echo count($starredpostalar);
                                                                                                                                                                } ?></span>
                                </a>

                                <a href="<?= SITE ?>posta-gonder" class="list-group-item d-flex align-items-center mx-4">
                                    <span class="icons"><i class="ri-mail-send-line"></i></span> Posta Gönder
                                </a>
                                <a href="<?= SITE ?>posta-kutusu/cop-kutusu" class="list-group-item d-flex align-items-center <?=$activecop?> mx-4">
                                    <span class="icons"><i class="ri-delete-bin-line"></i></span> Çöp Kutusu
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body p-6">
                            <div class="inbox-body">
                                <div class="mail-option">
                                    <div class="chk-all">
                                        <div class="btn-group">
                                            <?php
                                            if ($_GET["postadurum"] == "okunmus-postalar") {
                                            ?>
                                                <a data-bs-toggle="dropdown" href="<?= SITE ?>posta-kutusu/" class="btn mini all" aria-expanded="false">
                                                    Okunmuş Postalar
                                                    <i class="fa fa-angle-down "></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-start">
                                                    <li><a href="<?= SITE ?>posta-kutusu/"> Hepsi</a></li>
                                                    <li><a href="<?= SITE ?>posta-kutusu/okunmamis-postalar"> Okunmamış Postalar</a></li>
                                                </ul>
                                                <?php

                                                ?>

                                            <?php
                                            } else if ($_GET["postadurum"] == "okunmamis-postalar") {
                                            ?>
                                                <a data-bs-toggle="dropdown" href="<?= SITE ?>posta-kutusu/" class="btn mini all" aria-expanded="false">
                                                    Okunmamış Postalar
                                                    <i class="fa fa-angle-down "></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-start">
                                                    <li><a href="<?= SITE ?>posta-kutusu/"> Hepsi</a></li>
                                                    <li><a href="<?= SITE ?>posta-kutusu/okunmus-postalar"> Okunmuş Postalar</a></li>
                                                </ul>
                                                <?php

                                                ?>

                                            <?php
                                            }else if ($_GET["postadurum"] == "cop-kutusu") {
                                                ?>
                                                    <a data-bs-toggle="dropdown" href="<?= SITE ?>posta-kutusu/" class="btn mini all" aria-expanded="false">
                                                    Silinen Postalar
                                                   
                                                </a>
    
                                                <?php
                                                
                                            } else {

                                            ?>
                                                <a data-bs-toggle="dropdown" href="<?= SITE ?>posta-kutusu/" class="btn mini all" aria-expanded="false">
                                                    Hepsi
                                                    <i class="fa fa-angle-down "></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-start">
                                                    <li><a href="<?= SITE ?>posta-kutusu/okunmus-postalar"> Okunmuş Postalar</a></li>
                                                    <li><a href="<?= SITE ?>posta-kutusu/okunmamis-postalar"> Okunmamış Postalar</a></li>
                                                </ul>
                                            <?php

                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <a onclick="location.reload();" class="btn mini tooltips">
                                            <i class=" fa fa-refresh"></i>
                                        </a>
                                    </div>

                                   
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-inbox table-hover text-nowrap mb-0">
                                        <tbody>
                                            <?php
                                            if ($postalar != false) {
                                                for ($i = 0; $i < count($postalar); $i++) {


                                            ?>
                                                    <tr class="<?php if ($postalar[$i]["okundu_bilgisi"] == 0) {
                                                                    echo "unread";
                                                                } ?>">
                                                        <td class="inbox-small-cells">
                                                            
                                                        </td>
                                                        <td class="inbox-small-cells" style="cursor: default;"><i id="icon-yildizlist" class="fa fa-star <?php if ($postalar[$i]["starred"] == 1) {
                                                                                                                echo 'inbox-started';
                                                                                                            } ?>"></i></td>

                                                        <td class="view-message dont-show <?php if ($postalar[$i]["okundu_bilgisi"] == 0) {
                                                                                                echo "fw-semibold";
                                                                                            } ?> clickable-row" data-href='<?= SITE ?>posta-detay/<?= $postalar[$i]["ID"] ?>'><?= $postalar[$i]["baslik"] ?></td>
                                                        <td class="view-message clickable-row" data-href='<?= SITE ?>posta-detay/<?= $postalar[$i]["ID"] ?>'><?= $postalar[$i]["konu"] ?></td>
                                                        <td class="view-message text-end <?php if ($postalar[$i]["okundu_bilgisi"] == 0) {
                                                                                                echo "fw-semibold";
                                                                                            } ?> clickable-row" data-href='<?= SITE ?>posta-detay/<?= $postalar[$i]["ID"] ?>'><?= date("H:i:s", strtotime($postalar[$i]["tarih"])) ?> / <?= $DB->convertMonthToTurkishCharacter(date("m F Y", strtotime($postalar[$i]["tarih"]))); ?></td>
                                                    </tr>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td>Herhangi bir posta bulunmamaktadır.</td>
                                                </tr>

                                            <?php
                                            }
                                            ?>


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<ul class="pagination mb-4">
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1">Önceki</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                        <li class="page-item page-next">
                            <a class="page-link" href="javascript:void(0)">Sonraki</a>
                        </li>
                    </ul>-->
                </div>
            </div>
            <!-- ROW-1 CLOSED -->
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<!--app-content closed-->