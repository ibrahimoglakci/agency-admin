<?php
@session_start();
@ob_start();

define("DATA", "data/");
define("PAGE", "includes/");
define("CLASSES", "class/");
include_once(DATA . "connection.php");
define("SITE", $adminURL);
define("ANASITE", $siteURL);

if (empty($_SESSION["ID"]) && empty($_SESSION["name"]) && empty($_SESSION["mail"])) {
?>
    <meta http-equiv="refresh" content="0;url=<?= SITE ?>giris-yap">
<?php
    exit();
}

?>

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <?php include_once(DATA . "linkstop.php"); ?>

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('sw.js?v=3');
            });
        }
    </script>
</head>

<body class="app sidebar-mini ltr light-mode">

  
    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <?php include_once(DATA . "header.php"); ?>
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <?php include_once(DATA . "menu.php"); ?>



            <!--app-content open-->
            <?php
            if ($_GET && !empty($_GET["page"])) {
                $page = $_GET["page"] . ".php";
                if (file_exists(PAGE . $page)) {
                    include_once(PAGE . $page);
                } else {
                    include_once(PAGE . "main.php");
                }
            } else {
                include_once(PAGE . "main.php");
            }

            ?>


            <!--app-content close-->

        </div>




        <!-- Sidebar-right -->
        <?php include_once(DATA . "sidebar.php"); ?>
        <!--/Sidebar-right-->

        <!-- Country-selector modal-->



        <!-- FOOTER -->
        <?php include_once(DATA . "footer.php"); ?>
        <!-- FOOTER END -->

    </div>

    <?php include_once(DATA . "linkscripts.php"); ?>


    <script>
        var SITE = '<?= SITE ?>';



        function aktifpasif(ID, tablo) {
            var durum = 0;
            if ($(".aktifpasif" + ID).is(':checked')) {
                durum = 1;


            } else {
                durum = 2;

            }
            $.ajax({
                method: "POST",
                url: SITE + "ajax.php",
                data: {
                    "tablo": tablo,
                    "ID": ID,
                    "durum": durum
                },
                success: function(sonuc) {
                    if (sonuc == "TAMAM") {

                    } else if (sonuc == "HATA") {
                        alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                    }
                }
            });
        }

        function kullaniciaktifpasif(ID, tablo) {
            var durum = 0;
            if ($(".aktifpasif" + ID).is(':checked')) {
                durum = 1;


            } else {
                durum = 2;

            }
            $.ajax({
                method: "POST",
                url: SITE + "ajax.php",
                data: {
                    "tablo": tablo,
                    "ID": ID,
                    "state": durum
                },
                success: function(sonuc) {
                    if (sonuc == "TAMAM") {

                    } else if (sonuc == "HATA") {
                        alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                    }
                }
            });
        }

        function kategoriaktifpasif(ID, tablo) {
            var state = 0;
            if ($(".kategoriaktifpasif" + ID).is(':checked')) {
                state = 1;


            } else {
                state = 2;

            }
            $.ajax({
                method: "POST",
                url: SITE + "ajax.php",
                data: {
                    "tablo": tablo,
                    "ID": ID,
                    "state": state
                },
                success: function(sonuc) {
                    if (sonuc == "TAMAMKATEGORI") {

                    } else if (sonuc == "HATAKATEGORI") {
                        alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                    }
                }
            });
        }

        function indirimaktifpasif(ID, tablo) {
            var ifiyat = 0;
            if ($(".indirimaktifpasif" + ID).is(':checked')) {
                ifiyat = 1;


            } else {
                ifiyat = 2;

            }
            $.ajax({
                method: "POST",
                url: SITE + "ajax.php",
                data: {
                    "tablo": tablo,
                    "ID": ID,
                    "ifiyat": ifiyat
                },
                success: function(sonuc) {
                    if (sonuc == "TAMAMFIYAT") {

                    } else if (sonuc == "HATAFIYAT") {
                        alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                    }
                }
            });
        }


        var origTitle, animatedTitle, timer;
        var origTitle = document.title;

        function animateTitle(newTitle) {
            var currentState = false;
            // save original title
            animatedTitle = "Burayı Unutma! " + origTitle;
            timer = setInterval(startAnimation, 1000);

            function startAnimation() {
                // animate between the original and the new title
                document.title = currentState ? origTitle : animatedTitle;
                currentState = !currentState;
            }
        }

        function restoreTitle() {
            clearInterval(timer);
            document.title = origTitle; // restore original title
        }

        // Change page title on blur
        $(window).blur(function() {
            animateTitle();
        });

        // Change page title back on focus
        $(window).focus(function() {
            restoreTitle();
        });
    </script>



</body>

</html>