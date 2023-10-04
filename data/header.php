<?php
@session_start();
@ob_start();

if (empty($_SESSION["ID"]) && empty($_SESSION["name"]) && empty($_SESSION["mail"])) {

?>
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>">
<?php
    exit();
} else {
    $user = $DB->CallData("kullanicilar", "WHERE kullanici=?", array($_SESSION["user"]), "ORDER BY ID ASC", 1);
}
?>
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="<?= SITE ?>">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" class="header-brand-img desktop-logo" alt="SRK AJANS" width="150" height="50">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" class="header-brand-img light-logo1" alt="SRK AJANS" width="150" height="50">
            </a>
            <!-- LOGO -->

            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <div class="dropdown d-none">
                    <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                        <i class="fe fe-search"></i>
                    </a>
                    <div class="dropdown-menu header-search dropdown-menu-start">
                        <div class="input-group w-100 p-2">
                            <input type="text" class="form-control" placeholder="Search....">
                            <div class="input-group-text btn btn-primary">
                                <i class="fe fe-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- SEARCH -->

                          
                            

                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->
                            <?php
                            $siparisler = $DB->CallData("siparisler", "WHERE onizleme_durum=?", array(0), "ORDER BY ID ASC", 1);
                            
                            $randevular = $DB->CallData("randevular", "WHERE yaklasmadurum=?", array(2), "ORDER BY ID ASC", 1);
                            
                            
                            

                            if ($siparisler != false) {
                                $siparisnotify = true;
                            } else {
                                $siparisnotify = false;
                            }

                            if ($randevular != false) {
                                $randevunotify = true;
                            } else {
                                $randevunotify = false;
                            }
                            ?>
                            <div class="dropdown  d-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i>
                                    <?php if ($randevunotify == true || $siparisnotify == true) { ?>
                                        <span class=" pulse"></span>
                                    <?php } ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Bildirimler
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <?php

                                        $notifications = $DB->CallData("notifications", "WHERE state=?", array(1), "ORDER BY date DESC");
                                        if ($notifications != false) {
                                            for ($n = 0; $n < count($notifications); $n++) {
                                                # code...

                                                if ($notifications[$n]["notify_type"] == "yeni_siparis") {
                                                    $titlecolor = "#ffb600";
                                                    $iconbg = "primary";
                                                }
                                                if ($notifications[$n]["notify_type"] == "siparis_onay") {
                                                    $titlecolor = "#38b000";
                                                    $iconbg = "success";
                                                }
                                                $nownot = strtotime($notifications[$n]["date"]);
                                                $todaynot = date("d M Y - H:i:s", $nownot);

                                                $notdate = $DB->convertMonthToTurkishCharacter($todaynot);


                                        ?>
                                                <a class="dropdown-item d-flex" href="<?= $notifications[$n]["notify_url"] ?>">
                                                    <div class="me-3 notifyimg  bg-<?= $iconbg ?> brround box-shadow-primary">
                                                        <i class="fe fe-<?= $notifications[$n]["notify_icon"] ?>"></i>
                                                    </div>
                                                    <div class="mt-1 wd-80p">
                                                        <h5 class="notification-label mb-1" style="color: <?= $titlecolor ?>;"><?= $notifications[$n]["notify_name"] ?>
                                                        </h5>
                                                        <span class="notification-subtext" style="color: #c9e4ca"><?= $notdate ?></span>
                                                    </div>
                                                </a>

                                        <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-center p-3 text-muted">Tüm bildirimleri Gör</a>
                                </div>
                            </div>
                            <!-- NOTIFICATIONS -->

                            <div class="dropdown d-flex header-settings">
                                <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                    <i class="fe fe-align-right"></i>
                                </a>
                            </div>
                            <!-- SIDE-MENU -->
                            <div class="dropdown d-flex profile-1">
                                <?php
                                if (!empty($user[0]["image"])) {
                                    $userimage = $user[0]["image"];
                                } else {
                                    $userimage = "user-default.png";
                                }
                                ?>
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    <img src="<?= SITE ?>assets/images/users/<?= $userimage ?>" alt="profile-user" class="avatar  profile-user brround cover-image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold"><?= $user[0]["adsoyad"] ?></h5>
                                            <small class="text-muted"><?= $user[0]["Rank"] ?></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="<?= SITE ?>profil">
                                        <i class="dropdown-icon fe fe-user"></i> Profil
                                    </a>
                                    <a class="dropdown-item" href="<?= SITE ?>gelen-kutusu">
                                        <i class="dropdown-icon fe fe-mail"></i> Gelen kutusu
                                        <span class="badge bg-danger rounded-pill float-end">5</span>
                                    </a>
                                    <a class="dropdown-item" href="<?= SITE ?>cikis-yap">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> Çıkış Yap
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