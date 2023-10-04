<?php

if (!empty($_GET["ID"])) {
    $ID = $_GET["ID"];
} else {
?>
    <meta http-equiv="refresh" content="1;url=<?= SITE ?>posta-kutusu/">
<?php
}

$postadetay = $DB->CallData("postakutusu", "WHERE ID=?", array($ID), "ORDER BY tarih DESC", 1);
if($postadetay[0]["okundu_bilgisi"]==0) {
    $updateokundu=$DB->RunQuery("UPDATE postakutusu","SET okundu_bilgisi=? WHERE ID=?",array(1,$ID));
}
$unreadpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND okundu_bilgisi=?", array(1, 0), "ORDER BY tarih DESC");
$starredpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND starred=?  AND okundu_bilgisi=?", array(1, 1, 0), "ORDER BY tarih DESC");

?>

<title>Posta Gönder | <?= $sitebaslik ?></title>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Posta İçeriği</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Mail Yönetimi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Posta İçeriği</li>
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
                                <a href="<?= SITE ?>posta-kutusu/" class="list-group-item d-flex align-items-center mx-4">
                                    <span class="icons"><i class="ri-mail-line"></i></span> Posta Kutusu <span class="ms-auto badge bg-secondary bradius"><?php if ($unreadpostalar != false) {
                                                                                                                                                                echo count($unreadpostalar);
                                                                                                                                                            } ?></span>
                                </a>

                                <a href="<?= SITE ?>posta-kutusu/yildizlanmis-postalar" class="list-group-item d-flex align-items-center mx-4">
                                    <span class="icons"><i class="ri-star-line"></i></span> Yıldızlanmış Postalar<span class="ms-auto badge bg-success bradius"><?php if ($starredpostalar != false) {
                                                                                                                                                                    echo count($starredpostalar);
                                                                                                                                                                } ?></span>
                                </a>

                                <a href="<?= SITE ?>posta-gonder" class="list-group-item d-flex align-items-center mx-4">
                                    <span class="icons"><i class="ri-mail-send-line"></i></span> Posta Gönder
                                </a>
                                <a href="<?= SITE ?>posta-kutusu/cop-kutusu" class="list-group-item d-flex align-items-center mx-4">
                                    <span class="icons"><i class="ri-delete-bin-line"></i></span> Çöp Kutusu
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card" id="printcard">
                        <div class="card-header">
                            <h3 class="card-title"><?= $postadetay[0]["konu"] ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="email-media">
                                <div class="mt-0 d-sm-flex">
                                    <img class="me-2 rounded-circle avatar avatar-lg" src="<?= SITE ?>assets/images/users/user-default.png" alt="avatar">
                                    <div class="media-body pt-0">
                                        <div class="float-end d-none d-md-flex fs-15">
                                            <small class="me-3 mt-3 text-muted"><?= date("H:i:s", strtotime($postadetay[0]["tarih"])) ?> / <?= $DB->convertMonthToTurkishCharacter(date("m F Y", strtotime($postadetay[0]["tarih"]))); ?></small>
                                            <a id="yildizid" style="cursor: pointer;" site="<?=SITE?>" postaID="<?=$postadetay[0]['ID']?>" class="me-3 email-icon text-primary bg-primary-transparent" data-bs-toggle="tooltip" title="Yıldızla"><i class="<?php if($postadetay[0]["starred"]==0) {echo 'fe fe-star';}else if($postadetay[0]["starred"]==1) {echo 'fa fa-star';} ?>" id="icon-yildiz"></i></a>
                                            <a href="<?= SITE ?>posta-cevapla/<?= $postadetay[0]["gonderenmail"] ?>/<?= $postadetay[0]["ID"] ?>" class="me-3 email-icon text-secondary bg-secondary-transparent" data-bs-toggle="tooltip" title="Cevapla"><i class="fa fa-reply"></i></a>
                                            <div class="me-3">
                                            <a href="javascript:void(0)" class="text-danger email-icon bg-danger-transparent" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="<?= SITE ?>posta-cevapla/<?= $postadetay[0]["gonderenmail"] ?>/<?= $postadetay[0]["ID"] ?>"><i class="fe fe-share me-2"></i> Cevapla</a>
                                                    <a class="dropdown-item" href="<?= SITE ?>posta-sil/<?= $postadetay[0]["ID"] ?>"><i class="fe fe-trash me-2"></i>Sil</a>
                                                    <a class="dropdown-item" onclick="PrintDiv();"><i class="fe fe-printer me-2"></i>Yazdır</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-title text-dark font-weight-semibold mt-1"><?= $postadetay[0]["adsoyad"] ?> <span class="text-muted font-weight-semibold">( <?= $postadetay[0]["gonderenmail"] ?> )</span></div>
                                        <small class="mb-0">Gönderdiği kişi: SRK Destek ( <?= $sitemail ?> ) </small>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function PrintDiv() {
                                    var divToPrint = document.getElementById('printcard');
                                    var popupWin = window.open('', '_blank', 'width=900,height=900');
                                    popupWin.document.open();
                                    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                                    popupWin.document.close();
                                }
                            </script>

                            <div class="eamil-body mt-5">

                                <hr>
                                <p><?= $postadetay[0]["mesaj"] ?></p>

                                <hr>


                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary mt-1 mb-1" href="<?= SITE ?>posta-cevapla/<?= $postadetay[0]["gonderenmail"] ?>/<?= $postadetay[0]["ID"] ?>"><i class="fa fa-reply"></i> Cevapla</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End  Row -->

        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!--app-content closed-->