<?php 
if(!empty($_GET['email'])) {

  $email=$DB->filter($_GET["email"]);
  $check=$DB->CallData("kullanicilar","WHERE state=? AND mail=?",array(2,$email),"ORDER BY ID ASC",1);
  if($check!= false) {
   $value=$DB->CallData("kullanicilar","WHERE mail=?",array($email),"ORDER BY ID ASC",1);
   if($value!=false) {


     ?>

<head>

        <title>E-posta Onayı | <?=$sitebaslik?></title>
</head>

<div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Hesap Onay</h1>
                            
                        </div>
                        <!-- PAGE-HEADER END -->
                        <div class="container-login100">
                            <div class="wrap-login100 p-6">
                                <form class="login100-form validate-form" action="" method="POST">
                                    <span class="login100-form-title pb-5">
                                        E-posta Doğrulaması
                                    </span>
                                    <p class="text-muted">E-posta adresinize gelen kodu aşağıdaki bölüme girin ve onaylayın</p>
                                    <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="fa fa-solid fa-lock" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 border-start-0 ms-0 form-control" name="verifycode" type="text" placeholder="Kod">
                                    </div>
                                    <div class="submit">
                                        <button type="submit" class="btn btn-primary d-grid">Onayla</button>
                                    </div>
                                    <?php  
                                        if($_POST) {
                                            if(!empty($_POST["verifycode"]) && $value[0]["verification_code"]==$_POST["verifycode"]) {
                                                $verifycode=$DB->filter($_POST['verifycode']);
                                                if($value[0]["email_verified_at"]==NULL OR $value[0]["state"]==2) {
                                                    $add=$DB->RunQuery("UPDATE kullanicilar","SET email_verified_at=?, state=? WHERE mail=? AND verification_code=?",array(date("Y-m-d"),1,$email,$verifycode));
                                                    if($add!=false) {
                                                        ?>
                                                        <div class="alert alert-success text-center">
                                                            <i class="fa fa-check-circle"></i> Hesap onaylandı! Yönlendiriliyorsunuz...
                                                        </div>
                                                        <meta http-equiv="refresh" content="2;url=<?=SITE?>">
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                    <div class="alert alert-danger text-center">
                                                            <i class="fa fa-times-circle"></i> Hesap onaylanırken bir hata ile karşılaşıldı!
                                                        </div>
                                                        <?php
                                                    }
                                            
                                            
                                                }   
                                            

                                            
                                            
                                            }
                                            else {
                                                ?>
                                                <div class="alert alert-danger text-center">
                                                    <i class="fa fa-times-circle"></i> Lütfen boş alanları doldurunuz!
                                                </div>
                                                <?php
                                            }
                                        }

                                    ?>   
                                    
                                </form>
                            </div>
                        </div>
                      
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>

            <?php 
}
else {
  ?>
  <meta http-equiv="refresh" content="0;url=<?=SITE?>">
  <?php
}

}
else {
  ?>
  <meta http-equiv="refresh" content="0;url=<?=SITE?>">
  <?php

}

}
else {
 ?>
 <meta http-equiv="refresh" content="0;url=<?=SITE?>">
 <?php
}
?>
