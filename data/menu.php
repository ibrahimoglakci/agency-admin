<?php
$user = $DB->CallData("kullanicilar", "WHERE state=? AND kullanici=?", array(1, $_SESSION["user"]), "ORDER BY ID ASC");


?>
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="<?= SITE ?>">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" height="70px" width="auto" class="header-brand-img desktop-logo" alt="logo">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" height="70px" width="auto" class="header-brand-img toggle-logo" alt="logo">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" height="70px" width="auto" class="header-brand-img light-logo" alt="logo">
                <img src="<?= SITE ?>assets/images/logo/srklogo.png" height="70px" width="auto" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Ana Menü</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?= SITE ?>"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Ana Sayfa</span></a>
                </li>

                <li class="slide">
                    <button type="button" id="install-app" style="display: none;" class="side-menu__item btn btn-info btn-sm btn-block" data-bs-toggle="slide" href="<?= SITE ?>"><i class="side-menu__icon fa fa-download"></i><span class="side-menu__label">Uygulamayı Yükle</span></button>
                </li>

                <script>
                    const installButton = document.getElementById('install-app');
                    let beforeInstallPromptEvent
                    window.addEventListener("beforeinstallprompt", function(e) {
                        e.preventDefault();
                        beforeInstallPromptEvent = e
                        installButton.style.display = 'block'
                        installButton.addEventListener("click", function() {
                            e.prompt();
                        });
                        installButton.hidden = false;
                    });
                    installButton.addEventListener("click", function() {
                        beforeInstallPromptEvent.prompt();
                    });
                </script>

                <?php

                if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı") {




                ?>
                    <li class="sub-category">
                        <h3>Genel İşlemler</h3>
                    </li>

                    <li>
                        <a class="side-menu__item" href="<?= SITE ?>modul-ekle"><i class="side-menu__icon fa fa-plus"></i><span class="side-menu__label">Modül Ekle</span></a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-files-o"></i><span class="side-menu__label">Sayfalar</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Sayfalar</a></li>
                            <li><a href="<?= SITE ?>blog" class="slide-item"> Blog</a></li>
                            <li><a href="<?= SITE ?>hizmetler" class="slide-item"> Hizmetler</a></li>
                            <li><a href="<?= SITE ?>referanslar" class="slide-item"> Referanslar</a></li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-th"></i><span class="side-menu__label">Paketler</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Paketler</a></li>
                            <li><a href="<?= SITE ?>paket-ekle" class="slide-item"> Paket ekle</a></li>
                            <li><a href="<?= SITE ?>paket-listesi" class="slide-item"> Paket Listesi</a></li>

                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-list-alt"></i><span class="side-menu__label">Banner/Slider</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Banner</a></li>
                            <li><a href="<?= SITE ?>banner-ekle" class="slide-item"> Banner Ekle</a></li>
                            <li><a href="<?= SITE ?>banner-listesi" class="slide-item"> Banner Listesi</a></li>

                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-align-left"></i><span class="side-menu__label">Kategoriler</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Kategoriler</a></li>
                            <li><a href="<?= SITE ?>kategori-ekle" class="slide-item"> Kategori Ekle</a></li>
                            <li><a href="<?= SITE ?>kategoriler" class="slide-item"> Kategori Listesi</a></li>

                        </ul>
                    </li>


                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-exchange"></i><span class="side-menu__label">İade</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">İade</a></li>
                            <li><a href="<?= SITE ?>iade-listesi" class="slide-item"> İade Listesi</a></li>
                            <li><a href="<?= SITE ?>tamamlanan-iadeler" class="slide-item"> Tamamlanmış İadeler</a></li>


                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-try"></i><span class="side-menu__label">Fiyatlar</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Fiyatlar</a></li>
                            <li><a href="<?= SITE ?>fiyat-liste" class="slide-item"> Fiyat Listesi</a></li>


                        </ul>
                    </li>

                <?php
                }

                ?>


                <li class="sub-category">
                    <h3>Sipariş ve Yönetim</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-shopping-bag"></i><span class="side-menu__label">Siparişler</span>

                        <?php


                        if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı") {
                            $bekleyensiparisler = $DB->CallData("siparisler", "WHERE durum=? AND onizleme_durum=?", array(1, 0), "ORDER BY ID ASC");
                            if ($bekleyensiparisler != false) {




                        ?>
                                <span class="badge rounded-pill bg-warning badge-sm me-1 mb-1 text-black"><?= count($bekleyensiparisler) ?></span>
                            <?php

                            } else {
                            ?>
                                <i class="angle fe fe-chevron-right"></i>
                            <?php
                            }
                        } else {
                            $onaylanansiparisler = $DB->CallData("siparisler", "WHERE durum=? AND onizleme_durum=? AND siparis_durumu!=? AND siparis_sorumlusu=?", array(1, 1, "Teslim Edildi", $user[0]["ID"]), "ORDER BY ID ASC");
                            if ($onaylanansiparisler != false) {
                            ?>
                                <span class="badge rounded-pill bg-danger badge-sm me-1 mb-1 text-white"><?= count($onaylanansiparisler) ?></span>
                        <?php
                            }
                        }

                        ?>



                    </a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Siparişler</a></li>
                        <?php

                        if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "Saha Satış Koordinatörü" || $user[0]["Rank"] == "Saha Satış Uzmanı") {




                        ?>
                            <li><a href="<?= SITE ?>siparis-olustur" class="slide-item"> Sipariş Oluştur</a></li>

                        <?php
                        }
                        ?>

                        <?php

                        if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı") {




                        ?>
                            <li>
                                <a href="<?= SITE ?>bekleyen-siparisler" class="slide-item"> Bekleyen Siparişler

                                    <?php
                                    $bekleyensiparisler = $DB->CallData("siparisler", "WHERE durum=? AND onizleme_durum=?", array(1, 0), "ORDER BY ID ASC");
                                    if ($bekleyensiparisler != false) {


                                    ?>
                                        <span class="badge rounded-pill bg-warning badge-sm text-danger m-1"><?= count($bekleyensiparisler) ?></span>
                                    <?php
                                    }

                                    ?>
                                </a>

                            </li>
                        <?php
                        }
                        ?>


                        <li><a href="<?= SITE ?>onaylanan-siparisler" class="slide-item"> Onaylanan Siparişler</a></li>

                        <?php

                        $onaylanansiparisler = $DB->CallData("siparisler", "WHERE durum=? AND onizleme_durum=? AND siparis_durumu!=? AND siparis_sorumlusu=?", array(1, 1, "Teslim Edildi", $user[0]["ID"]), "ORDER BY ID ASC");
                        if ($onaylanansiparisler != false) {



                        ?>

                            <span class="badge rounded-pill bg-warning badge-sm text-danger m-1"><?= count($onaylanansiparisler) ?></span>

                        <?php
                        }

                        ?>

                    </ul>
                </li>


                <?php

                if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "Saha Satış Uzmanı"  || $user[0]["Rank"] == "Saha Satış Koordinatörü" || $user[0]["Rank"] == "Müşteri Destek Elemanı") {



                ?>

                    <li class="sub-category">
                        <h3>Müşteri Hizmetleri</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-calendar"></i><span class="side-menu__label">Randevular


                            </span>
                            <?php
                            $yaklasanrandevular = $DB->CallData("randevular", "WHERE durum=? AND yaklasmadurum=?", array(1, 2), "ORDER BY ID ASC");
                            if ($yaklasanrandevular != false) {


                            ?>
                                <span class="badge rounded-pill bg-danger badge-sm me-1 mb-1"><?= count($yaklasanrandevular) ?></span>
                            <?php
                            }

                            ?>

                            <i class="angle fe fe-chevron-right"></i>

                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Randevular</a></li>
                            <li><a href="<?= SITE ?>randevu-olustur" class="slide-item"> Randevu Oluştur

                                </a></li>
                            <li><a href="<?= SITE ?>randevular" class="slide-item"> Randevularım
                                    <?php
                                    $yaklasanrandevular = $DB->CallData("randevular", "WHERE durum=? AND yaklasmadurum=?", array(1, 2), "ORDER BY ID ASC");
                                    if ($yaklasanrandevular != false) {


                                    ?>
                                        <span class="badge rounded-pill bg-danger badge-sm m-1"><?= count($yaklasanrandevular) ?></span>
                                    <?php
                                    }

                                    ?>
                                </a></li>

                        </ul>
                    </li>

                <?php
                }

                if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "Muhasebe") {
                ?>

                    <li class="sub-category">
                        <h3>Para Takibi</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-line-chart"></i><span class="side-menu__label">Raporlar</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Raporlar</a></li>
                            <li><a href="<?= SITE ?>gelirler" class="slide-item"> Gelirler</a></li>
                            <li><a href="<?= SITE ?>giderler" class="slide-item"> Giderler</a></li>
                            <li><a href="<?= SITE ?>populer-urunler" class="slide-item"> En çok satan ürünler</a></li>


                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-bank"></i><span class="side-menu__label">Vergiler</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Vergiler</a></li>
                            <li><a href="<?= SITE ?>vergi-rapolari" class="slide-item"> Vergiler Raporları</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="side-menu__item" href="<?= SITE ?>analiz-grafikleri"><i class="side-menu__icon ion ion-pie-graph"></i><span class="side-menu__label">Analiz Grafikleri</span></a>
                    </li>

                <?php } ?>

                <?php if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>

                    <li class="sub-category">
                        <h3>Mail Yönetimi</h3>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-envelope"></i><span class="side-menu__label">Mail Yönetimi</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Mail Yönetimi</a></li>
                            <li><a href="<?= SITE ?>posta-kutusu/" class="slide-item"> Posta Kutusu</a></li>
                            <li><a href="<?= SITE ?>posta-gonder" class="slide-item"> E-Posta Gönder</a></li>


                        </ul>
                    </li>
                <?php } ?>

                <?php if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı") { ?>

                    <li class="sub-category">
                        <h3>Site Ayarları</h3>
                    </li>

                    <li>
                        <a class="side-menu__item" href="<?= SITE ?>site-ayarlari"><i class="side-menu__icon fa fa-pencil-square"></i><span class="side-menu__label">Site
                                Ayarlarını Güncelle</span></a>
                    </li>
                <?php } ?>




                <li class="sub-category">
                    <h3>Kullanıcı İşlemleri</h3>
                </li>

                <?php if ($user[0]["Rank"] == "Yönetici" || $user[0]["Rank"] == "Web Yazılım Uzmanı" || $user[0]["Rank"] == "Muhasebe") { ?>

                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Ekip Üyeleri</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Ekip Üyeleri</a></li>
                            <li><a href="<?= SITE ?>uye-ekle" class="slide-item"> Ekip Üyesi Ekle</a></li>
                            <li><a href="<?= SITE ?>uye-listesi" class="slide-item"> Ekip Üye Listesi</a></li>
                            <li><a href="<?= SITE ?>uye-raporu" class="slide-item"> Ekip Üye raporu</a></li>


                        </ul>
                    </li>

                <?php } ?>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fa fa-vcard"></i><span class="side-menu__label">Profil</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Profil</a></li>
                        <li><a href="<?= SITE ?>profil" class="slide-item"> Profilini Düzenle</a></li>


                    </ul>
                <li>
                    <a class="side-menu__item" href="<?= SITE ?>cikis-yap"><i class="side-menu__icon fa fa-sign-out"></i><span class="side-menu__label">Çıkış Yap</span></a>
                </li>
                </li>



            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>