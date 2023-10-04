<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$unreadpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND okundu_bilgisi=?", array(1, 0), "ORDER BY tarih DESC");
$starredpostalar = $DB->CallData("postakutusu", "WHERE durum=? AND starred=? AND okundu_bilgisi=?", array(1, 1, 0), "ORDER BY tarih DESC");

?>

<title>Posta Gönder | <?= $sitebaslik ?></title>

<!--app-content open-->


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Posta Gönder</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Mail Yönetimi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Posta Gönder</li>
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

                                <a href="<?= SITE ?>posta-gonder" class="list-group-item d-flex align-items-center active mx-4">
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Yeni Posta Gönder</h3>
                        </div>
                        <div class="card-body">

                            <form action="" method="POST">
                                <?php
                                if ($_POST) {
                                    if (!empty($_POST["alacak"]) or !empty($_POST["konu"]) or !empty($_POST["mesaj"])) {
                                        $alacak = $DB->filter($_POST["alacak"]);
                                        $konu = $DB->filter($_POST["konu"]);
                                        $mesaj = $DB->filter($_POST["mesaj"], true);

                                        $mailsettings = $DB->CallData("mail_ayarlari", "WHERE ID=?", array(1), "ORDER BY ID ASC", 1);
                                        if ($mailsettings != false) {
                                            $host = $mailsettings[0]["server"];
                                            $smtpusername = $mailsettings[0]["mail"];
                                            $smtppassword = $mailsettings[0]["sifre"];
                                            $smtpport = $mailsettings[0]["port"];
                                            $smtpsertifika = $mailsettings[0]["sertifika"];
                                        }


                                        $posta = new PHPMailer(true);
                                        try {
                                            $posta->SMTPDebug = 0;
                                            $posta->isSMTP();
                                            $posta->CharSet = 'UTF-8';
                                            $posta->Host = $host;
                                            $posta->SMTPAuth = true;
                                            $posta->Username = $smtpusername;
                                            $posta->Password = $smtppassword;
                                            $posta->SMTPSecure = $smtpsertifika;
                                            $posta->Port = $smtpport;
                                            $posta->setFrom($smtpusername, "SRK AJANS DESTEK EKIBI");
                                            $posta->addAddress($alacak, "SRK AJANS DESTEK EKIBI");
                                            $posta->isHTML(true);
                                            $posta->Subject = $konu;




                                            $posta->Body =  $mesaj;



                                            $posta->send();
                                ?>
                                            <div class="alert alert-success"><i class="fa fa-check-circle"></i> Mail Başarıyla Gönderildi. </div>
                                            <meta http-equiv="refresh" content="1;url=<?= SITE ?>posta-kutusu/">
                                <?php
                                        } catch (Exception $e) {
                                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                        }
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="col-xl-2 form-label">Kime:</label>
                                        <div class="col-xl-10">
                                            <input type="email" class="form-control" name="alacak" value="<?php if (!empty($_GET["gonderilecek"])) {
                                                                                                                echo htmlspecialchars($_GET["gonderilecek"]);
                                                                                                            } ?>" <?php if (!empty($_GET["gonderilecek"])) {
                                                                                                                        echo 'disabled';
                                                                                                                    } ?> >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="col-xl-2 form-label">Kopya Alacak Kişi:</label>
                                        <div class="col-xl-10">
                                            <input type="email" class="form-control" name="bcc">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="col-xl-2 form-label">Konu</label>
                                        <div class="col-xl-10">
                                            <input type="text" class="form-control" name="konu">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($_GET["gonderilecek"]) && !empty($_GET["cevaplananID"])) {
                                    $cevaplanan = $DB->CallData("postakutusu", "WHERE ID=?", array($_GET["cevaplananID"]), "ORDER BY ID ASC", 1);

                                ?>
                                    <div class="form-group">
                                        <div class="row ">
                                            <label class="col-xl-2 form-label">Alıntılanan Mesaj</label>
                                            <div class="col-xl-10">
                                                <textarea class="form-control" name="alintilama" rows="5" disabled><?= $cevaplanan[0]["mesaj"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php

                                }
                                ?>
                                <div class="form-group">
                                    <div class="row ">
                                        <label class="col-xl-2 form-label">Mesaj</label>
                                        <div class="col-xl-10">
                                            <textarea class="content" name="mesaj"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row ">
                                        <button class="btn btn-success btn-space mb-0" type="submit">Gönder</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-sm-flex">

                            <div class="btn-list ms-auto my-auto">
                                <button class="btn btn-danger btn-space mb-0" onclick="window.history.back();">İptal Et</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--End Row -->
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<!--app-content closed-->