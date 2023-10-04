<?php
@session_start();
@ob_start();

define("DATA", "data/");
define("PAGE", "includes/");
define("CLASSES", "class/");
include_once(DATA . "connection.php");
define("SITE", $adminURL);
define("ANASITE", $siteURL);


if ($_POST) {
    if (!empty($_POST["adsoyad"]) && !empty($_POST["phone"])) {
        $adsoyad = $DB->filter($_POST["adsoyad"]);
        $email = $DB->filter($_POST["email"]);
        $phone = $DB->filter($_POST["phone"]);
        $instagram = $DB->filter($_POST["instagram"]);
        $twitter = $DB->filter($_POST["twitter"]);
        $linkedin = $DB->filter($_POST["linkedin"]);
        $birthday = $DB->filter($_POST["birthday"]);
        $birthmonth = $DB->filter($_POST["birthmonth"]);
        $birthyear = $DB->filter($_POST["birthyear"]);
        $userbirthday = $birthday . " - " . $birthmonth . " - " . $birthyear . "";

        $about = $DB->filter($_POST["about"], true);

        $updateprofile = $DB->RunQuery("UPDATE kullanicilar", "SET adsoyad=?, birthday=?, about=?, phone=?, instagram=?, twitter=?, linkedin=? WHERE ID=?", array($adsoyad, $userbirthday, $about, $phone, $instagram, $twitter, $linkedin, $_SESSION["ID"]));
        if ($updateprofile != false) {

?>
            <meta http-equiv="refresh" content="0;url=<?= SITE ?>profil">
        <?php

        } else {
        ?>
            <meta http-equiv="refresh" content="0;url=<?= SITE ?>profil">
<?php
        }
    }
}
