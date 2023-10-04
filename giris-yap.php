<?php
@session_start();
@ob_start();

define("DATA","data/");
define("PAGE","includes/");
define("CLASSES","class/");
include_once(DATA."connection.php");
define("SITE",$adminURL);
define("ANASITE",$siteURL);

if(!empty($_SESSION["ID"]) && !empty($_SESSION["name"]) && !empty($_SESSION["mail"]))
{
	?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>">
    <?php
	exit();
}
?>





<!doctype html>
    <html lang="en" dir="ltr">

    <head>
        
        <?php include_once(DATA."linkstop.php");?>
        <title>Giriş Yap | <?=$sitebaslik?></title>
    </head>

<?php 
    if(isset($_COOKIE["remember"]) && $_COOKIE["remember"] == "checked") {
        ?>
    <body class="app sidebar-mini ltr" >

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?=SITE?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                
                <!-- CONTAINER OPEN -->
                <div class="container-login100">
                    <div class="wrap-login100 p-6">

                    <?php
		if(isset($_POST["login"]))
		{
			if(!empty($_POST["password"]) && !empty($_COOKIE["user"]))
			{
				$user=$DB->filter($_COOKIE["user"]);
				$password=md5($DB->filter($_POST["password"]));
				$check=$DB->CallData("kullanicilar","WHERE kullanici=? AND sifre=?",array($user,$password),"ORDER BY ID ASC",1);
				if($check!=false)
				{
					$_SESSION["user"]=$check[0]["kullanici"];
					$_SESSION["name"]=$check[0]["adsoyad"];
					$_SESSION["mail"]=$check[0]["mail"];
					$_SESSION["ID"]=$check[0]["ID"];
                    $_SESSION["Rank"]=$check[0]["Rank"];
                    $_SESSION["image"]=$check[0]["image"];

					?>
                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> Başarıyla giriş yapıldı! Yönlendiriliyorsunuz...</div>
                    <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
                    <?php
					exit();
				}
				else
				{
					echo '<div class="alert alert-danger">Kullanıcı adı veya şifre hatalıdır.</div>';
				}
			}
			else
			{
				echo '<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>';
			}
		}
        if(isset($_POST["silCookie"])) {
            setcookie("remember", "", time() - (60*60*24*365));
            setcookie("name", "", time() - (60*60*24*365));
            setcookie("ID", "", time() - (60*60*24*365));
            setcookie("Rank", "", time() - (60*60*24*365));
            setcookie("user", "", time() - (60*60*24*365));
            setcookie("image", "", time() - (60*60*24*365));
            
            ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> Başarıyla çıkış yapıldı! Yönlendiriliyorsunuz...</div>
            <meta http-equiv="refresh" content="2;url=<?=SITE?>giris-yap" />
            <?php
        }
		?> 

                        <form class="login100-form validate-form" action="" method="POST">
                            <div class="text-center mb-4">
                                <img src="<?=SITE?>assets/images/users/<?php echo $_COOKIE["image"];?>" alt="lockscreen image" class="avatar avatar-xxl brround mb-2">
                                <h4><?php echo $_COOKIE["name"];?></h4>
                            </div>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle" data-bs-validate="Password is required">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" type="password" name="password" placeholder="Şifre">
                            </div>
                            <div class="container-login100-form-btn pt-0">
                                <button name="login" type="submit" class="login100-form-btn btn-primary">
                                        Giriş Yap
                                </button>
                            </div>
                          
                            
                            <div class="container-login100-form-btn pt-0">
                                <button type="submit" name="silCookie" class="btn btn-danger mt-2"><i class=" fe fe-alert-circle me-2"></i>Çıkış Yap</button>
                            </div>      
                        </form>
                        
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End GLOABAL LOADER -->

    </div>
    
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <?php include_once(DATA."linkscripts.php"); ?>

    </body>
    <?php
    }
    else
    {

    
?>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?=SITE?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page" >
            <div class="">

                <!-- CONTAINER OPEN -->
               

                <div class="container-login100">
                    <div class="wrap-login100 p-6">

    <?php
		if($_POST)
		{
			if(!empty($_POST["user"]) && !empty($_POST["password"]))
			{
				$user=$DB->filter($_POST["user"]);
				$password=md5($DB->filter($_POST["password"]));
				$check=$DB->CallData("kullanicilar","WHERE kullanici=? AND sifre=?",array($user,$password),"ORDER BY ID ASC",1);
				if($check!=false)
				{
					$_SESSION["user"]=$check[0]["kullanici"];
					$_SESSION["name"]=$check[0]["adsoyad"];
					$_SESSION["mail"]=$check[0]["mail"];
					$_SESSION["ID"]=$check[0]["ID"];
                    $_SESSION["Rank"]=$check[0]["Rank"];
                    $username=$check[0]["kullanici"];
                    $name=$check[0]["adsoyad"];
                    $usermail=$check[0]["mail"];
                    $userID=$check[0]["ID"];
                    $rank=$check[0]["Rank"];
                    $image=$check[0]["image"];
                    if(isset($_POST["remember"])) {
                        setcookie("remember", "checked", time() + (60*60*24*365));
                        setcookie("name", "$name", time() + (60*60*24*365));
                        setcookie("ID", "$userID", time() + (60*60*24*365));
                        setcookie("Rank", "$rank", time() + (60*60*24*365));
                        setcookie("user", "$username", time() + (60*60*24*365));
                        setcookie("image", "$image", time() + (60*60*24*365));
                    }
                    

					?>
                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> Başarıyla giriş yapıldı! Yönlendiriliyorsunuz...</div>
                    <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
                    <?php
					exit();
				}
				else
				{
					echo '<div class="alert alert-danger">Kullanıcı adı veya şifre hatalıdır.</div>';
				}
			}
			else
			{
				echo '<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>';
			}
		}
		?>

                        <form class="login100-form validate-form" action="" method="POST">
                            <span class="login100-form-title pb-5">
                                Giriş Yap
                            </span>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class="mx-0"><a href="#tab5" class="active" data-bs-toggle="tab">Yönetici / Ekip Girişi</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Kullanıcı adı gereklidir.">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="fa fa-user text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="text" name="user" placeholder="Kullanıcı adınız">
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="password" name="password" placeholder="Password">
                                            </div>
                                            <label class="custom-control custom-checkbox mt-4">
                                                <input type="checkbox" name="remember" class="custom-control-input">
                                                <span class="custom-control-label"> Beni Hatırla</span>
                                            </label>
                                            <div class="text-end pt-4">
                                            
                                                <p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Şifreni mi unuttun?</a></p>
                                            </div>
                                            
                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-primary">
                                                        Giriş Yap
                                                </button>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <?php include_once(DATA."linkscripts.php"); ?>

</body>

<?php 
    }
?>
</html>