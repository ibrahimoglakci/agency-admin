<?php
@session_start();
@ob_start();

define("DATA","data/");
define("PAGE","includes/");
define("CLASSES","class/");
include_once(DATA."connection.php");
define("SITE",$adminURL);
define("ANASITE",$siteURL);



if (!empty($_POST["sipariskodu"]) && !empty($_POST["siparissorumlu"])) {

    $sipariskodu = $_POST["sipariskodu"];
    $siparissorumlu = $_POST["siparissorumlu"];
    if ($siparissorumlu == "") {
?>
        <meta http-equiv="refresh" content="0;url=<?= SITE ?>bekleyen-siparisler">
        <?php
    }
 
    $siparis = $DB->CallData("siparisler", "WHERE siparis_kodu=?", array($sipariskodu), "ORDER BY ID ASC", 1);

    if ($siparis != false) {
        $changedurum = $DB->RunQuery("UPDATE siparisler", "SET siparis_sorumlusu=? WHERE siparis_kodu=?", array($siparissorumlu, $sipariskodu));
        if ($changedurum != false) {


        ?>
            <meta http-equiv="refresh" content="0;url=<?= SITE ?>bekleyen-siparisler">
<?php
        }
    }
}
else {
    ?>
        <meta http-equiv="refresh" content="0;url=<?= SITE ?>bekleyen-siparisler">
        <?php
}
