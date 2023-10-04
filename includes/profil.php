<?php
@session_start();
@ob_start();
if ($_GET["page"] == "profil") {
    $user = $DB->CallData("kullanicilar", "WHERE kullanici=?", array($_SESSION["user"]), "ORDER BY ID ASC", 1);
?>

    <head>
        <title><?= $_SESSION["name"] ?> | Profil</title>
    </head>


    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Profili Düzenle</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Profil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profilini Düzenle</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Şifreni değiştir</div>
                            </div>
                            <form action="" method="POST">
                                <?php
                                if ($_POST) {
                                    if ($_POST["currentpass"] && $_POST["newpass"] && $_POST["newpassagain"]) {
                                        $currentpass = $DB->filter($_POST["currentpass"]);
                                        $newpass = $DB->filter($_POST["newpass"]);
                                        $newpassagain = $DB->filter($_POST["newpassagain"]);

                                        $passcheck = $DB->CallData("kullanicilar", "WHERE sifre=?", array(md5(sha1($currentpass))), "ORDER BY ID ASC", 1);
                                        if ($passcheck == false) {
                                ?>
                                            <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Güncel Şifreniz Hatalıdır. Lütfen kontrol edip tekrar deneyiniz!</div>
                                            <?php
                                        } else {

                                            if ($newpass == $newpassagain) {
                                                if (strlen($newpass) > 7) {
                                                    if (preg_match('/[\'^£$%&*()}{@#~.?><>,|=_+¬-]/', $newpass)) {
                                                        if (preg_match('/[A-Z]/', $newpass)) {
                                                            if (empty($_FILES["image"]["name"])) {
                                                                $newpass = md5(sha1($newpass));

                                                                $updatepass = $DB->RunQuery("UPDATE kullanicilar", "SET sifre=? WHERE ID=?", array($newpass, $user[0]["ID"]));
                                                                if ($updatepass != false) {
                                            ?>
                                                                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> Yeni şifreniz başarıyla güncellendi. Artık başarıyla yeni şifreniz ile giriş yapabilirsiniz.</div>
                                                                    <meta http-equiv="refresh" content="1;url=<?= SITE ?>profil">

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Şifre oluşturulurken bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                                                                    <?php
                                                                }
                                                            } else {

                                                                $yukle = $DB->upload("image", "assets/images/users/");
                                                                if ($yukle != false) {
                                                                    $newpass = md5(sha1($newpass));

                                                                    $updatepass = $DB->RunQuery("UPDATE kullanicilar", "SET sifre=?, image=? WHERE ID=?", array($newpass, $yukle, $user[0]["ID"]));
                                                                    if ($updatepass != false) {
                                                                    ?> 
                                                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Yeni Şifreniz ve Profil Fotoğrafınız başarıyla güncellendi. Artık başarıyla yeni şifreniz ile giriş yapabilirsiniz.</div>
                                                                        <meta http-equiv="refresh" content="1;url=<?= SITE ?>profil">

                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Şifre oluşturulurken bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Resim Yükleme İşlemi Başarısız. Lütfen Daha Sonrra Tekrar Deneyiniz</div>
                                                            <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Yeni şifreniz büyük harf içermelidir. Lütfen büyük harf kullanmaya dikkat ediniz.</div>
                                                        <?php

                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Yeni şifreniz özel karakter içermelidir. Örnek karakterler: (/[\'^£$%&*()}{@#~?><>,|=_+¬-]/)</div>
                                                    <?php

                                                    }
                                                } else {
                                                    ?>
                                                    <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Yeni şifrenizin uzunluğu 7 karakterden fazla olmalıdır. Lütfen yeni şifrenizin uzunluğuna dikkat ediniz!</div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Girdiğiniz şifreler birbiriyle uyuşmamaktadır. Lütfen yeni şifrelerin birbiriyle aynı olmasına dikkat ediniz!</div>
                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning"><i class="fa fa-times-circle"></i> Lütfen boş bırakılan alanları doldurunuz!</div>
                                <?php
                                    }
                                }

                                ?>
                                <div class="card-body">
                                    <div class="text-center chat-image mb-5">
                                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                            <input type="file" id="ppimage" style="display: none;" name="image" onchange="document.getElementById('profileimage').src = window.URL.createObjectURL(this.files[0])">
                                            <label for="ppimage" style="cursor: pointer;"><img id="profileimage" alt="avatar" src="<?= SITE ?>assets/images/users/<?= $user[0]["image"] ?>" class="brround" width="100" height="80"></label>
                                            <style>
                                                #profileimage:hover {
                                                    opacity: 0.5;
                                                    transition: 0.7s ease;
                                                }
                                            </style>
                                        </div>
                                        <div class="main-chat-msg-name">
                                            <a href="profile.html">
                                                <h5 class="mb-1 text-dark fw-semibold"><?= $user[0]["adsoyad"] ?></h5>
                                            </a>
                                            <p class="text-muted mt-0 mb-0 pt-0 fs-13"><?= $user[0]["Rank"] ?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Şifreniz</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" name="currentpass" placeholder="Şifreniz">
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Yeni Şifre</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" name="newpass" placeholder="Yeni Şifre" autocomplete>
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Yeni Şifre (Tekrar)</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" name="newpassagain" placeholder="Yeni Şifre (Tekrar)" autocomplete>
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Kaydet </button>
                                </div>
                            </form>
                        </div>
                        <div class="card panel-theme">
                            <div class="card-header">
                                <div class="float-start">
                                    <h3 class="card-title">İletişim Bilgileri</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body no-padding">
                                <ul class="list-group no-margin">
                                    <li class="list-group-item d-flex ps-3">
                                        <div class="social social-profile-buttons me-2">
                                            <a class="social-icon text-primary" href=""><i class="fe fe-mail"></i></a>
                                        </div>
                                        <span class="my-auto"><?= $user[0]["mail"] ?></span>
                                    </li>
                                    <li class="list-group-item d-flex ps-3">
                                        <div class="social social-profile-buttons me-2">
                                            <a class="social-icon text-primary" href=""><i class="fe fe-phone"></i></a>
                                        </div>
                                        <span class="my-auto"><?= $user[0]["phone"] ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Profili Düzenle</h3>
                            </div>
                            <form action="<?=SITE?>changeprofile.php" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">Ad Soyad</label>
                                                <input type="text" class="form-control" id="exampleInputname" name="adsoyad" placeholder="Ad Soyad" value="<?= $user[0]["adsoyad"] ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-posta adresi</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="E-posta Adresi" disabled value="<?= $user[0]["mail"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputnumber">Telefon Numarası</label>
                                        <input type="number" class="form-control" id="exampleInputnumber" name="phone" placeholder="Telefon numarası" value="<?= $user[0]["phone"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputinstagram">İnstagram Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="exampleInputinstagram" name="instagram" placeholder="İnstagram Kullanıcı Adı" value="<?= $user[0]["instagram"] ?>">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtwitter">Twitter Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="exampleInputtwitter" name="twitter" placeholder="Twitter Kullanıcı Adı" value="<?= $user[0]["twitter"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputlinkedin">Linked-in Kullanıcı Adı</label>
                                        <input type="text" class="form-control" id="exampleInputlinkedin" name="linkedin" placeholder="Linked-in Kullanıcı Adı" value="<?= $user[0]["linkedin"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Hakkımda</label>
                                        <textarea class="form-control" name="about" rows="6">Hakkımda.........</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Doğum Tarihi</label>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <select class="form-control select2 form-select" name="birthday">
                                                    <option value="0">Gün</option>
                                                    <option value="1">01</option>
                                                    <option value="2">02</option>
                                                    <option value="3">03</option>
                                                    <option value="4">04</option>
                                                    <option value="5">05</option>
                                                    <option value="6">06</option>
                                                    <option value="7">07</option>
                                                    <option value="8">08</option>
                                                    <option value="9">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <select class="form-control select2 form-select" name="birthmonth">
                                                    <option value="0">Ay</option>
                                                    <option value="1">Ocak</option>
                                                    <option value="2">Şubat</option>
                                                    <option value="3">Mart</option>
                                                    <option value="4">Nisan</option>
                                                    <option value="5">Mayıs</option>
                                                    <option value="6">Haziran</option>
                                                    <option value="7">Temmuz</option>
                                                    <option value="8">Ağustos</option>
                                                    <option value="9">Eylül</option>
                                                    <option value="10">Ekim</option>
                                                    <option value="11">Kasım</option>
                                                    <option value="12">Aralık</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <select class="form-control select2 form-select" name="birthyear">
                                                    <option value="0">Yıl</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2001">2001</option>
                                                    <option value="1999">1999</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1970">1970</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-success my-1">Kaydet</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
            <!--CONTAINER CLOSED -->

        </div>
    </div>



<?php

}

?>