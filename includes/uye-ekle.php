<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';




?>

<head>
    <title>İşçi Ekle | <?=$sitebaslik?></title>
</head>

<?php 

                                    if($_POST) {
                                        if(!empty($_POST["adsoyad"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["gorev"])) {
                                            $adsoyad=$DB->filter($_POST['adsoyad']);     
                                            $email=$DB->filter($_POST['email']);
                                            $password1=md5(sha1($DB->filter($_POST['password'])));
                                            $password2=md5(sha1($DB->filter($_POST['password2'])));
                                            $username=$DB->filter($_POST['username']);
                                            $gorev=$DB->filter($_POST['gorev']);
                                            $phone=$DB->filter($_POST['telefon']);
                                            $seflink=$DB->seflink($adsoyad);
                                            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0,6);
                                            if($password1==$password2) {
                                                $password=$password1;
                                                
                                                $mailsettings=$DB->CallData("mail_ayarlari","WHERE ID=?",array(1),"ORDER BY ID ASC",1);
                                                if($mailsettings!=false) {
                                                $host=$mailsettings[0]["server"];
                                                $smtpusername=$mailsettings[0]["mail"];
                                                $smtppassword=$mailsettings[0]["sifre"];
                                                $smtpport=$mailsettings[0]["port"];
                                                $smtpsertifika=$mailsettings[0]["sertifika"];
                                                }
                                                
                                                
                                                $mail = new PHPMailer(true);
                                                try {
                                                    $mail -> SMTPDebug = 0;
                                                    $mail -> isSMTP();
                                                    $mail->CharSet = 'UTF-8';
                                                    $mail -> Host = $host;
                                                    $mail ->SMTPAuth = true;
                                                    $mail ->Username = $smtpusername;
                                                    $mail ->Password = $smtppassword;
                                                    $mail ->SMTPSecure = $smtpsertifika;
                                                    $mail ->Port = $smtpport;
                                                    $mail ->setFrom($smtpusername, 'SRK Reklam Ajansı');
                                                    $mail ->addAddress($email, $adsoyad);
                                                    $mail ->isHTML(true);
                                                    $mail ->Subject = 'E-Posta Doğrulaması';


                                                    $str = file_get_contents(PAGE."email-verify.php");
                                                    $str = str_replace('$verify', $verification_code, $str);
                                                    $str = str_replace('$isim', $adsoyad, $str);

                                                    $mail ->Body =  $str;
                                                    
                                                    
                                                    
                                                    $mail->send();
        
                                                    $add=$DB->RunQuery("INSERT INTO kullanicilar","SET adsoyad=?, seflink=?, kullanici=?, sifre=?, mail=?, Rank=?, phone=?, verification_code=?, email_verified_at=?, state=?, tarih=?",array($adsoyad,$seflink,$username,$password,$email,$gorev,$phone,$verification_code,NULL,2,date("Y-m-d"))); 
                                                    ?>

                                                <meta http-equiv="refresh" content="2;url=<?=SITE?>hesap-onay/<?=$email?>">

                                                <?php
                                                    if($add!=false) {
                                                        ?>
                                                        <div class="alert alert-success text-center">
                                                        <i class="fa fa-check-circle"></i> Ekip Üyesi başarıyla eklendi
                                                        </div>
                                                        
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <div class="alert alert-danger text-center">
                                                            <i class="fa fa-times-circle"></i> Ekip Üyesi eklenirken bir hata ile karşılaşıldı!
                                                        </div>
                                                        <?php
                                                        }
                                                }catch(Exception $e) {
                                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
                                                }

                                                
                                                
                                            }
                                            else {
                                                ?>
                                            <div class="alert alert-danger text-center">
                                                <i class="fa fa-times-circle"></i> Girilen şifreler birbirleri ile uyuşmuyor!
                                            </div>
                                            <?php
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


<div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Ekip Üyesi ekle</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Ekip</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ekip Üyesi Ekle</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->
                    
                        <!-- ROW OPEN -->
                      
                        <div class="row">
                        
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="needs-validation" action="" method="POST">
                                            <div class="form-row">
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom01">Ekip Üyesi Ad Soyad</label>
                                                    <input type="text" name="adsoyad" class="form-control" id="validationCustom01"
                                                        placeholder="Ahmet Demir" required>
                                                    <div class="valid-feedback">Güzel görünüyor!</div>
                                                </div>
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom02">Ekip Üyesi E-posta adresi</label>
                                                    <input type="email" name="email" class="form-control" id="validationCustom02"
                                                        placeholder="example@gmail.com" required>
                                                    <div class="valid-feedback">Güzel görünüyor!</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom03">Şifre</label>
                                                    <input type="password" autocomplete="off" name="password" class="form-control" id="validationCustom03"
                                                        required>
                                                    <div class="invalid-feedback">Lütfen şifre alanını boş bırakmayınız!</div>
                                                </div>
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom03">Şifre (Tekrar)</label>
                                                    <input type="password" autocomplete="off" name="password2" class="form-control" id="validationCustom03"
                                                        required>
                                                    <div class="invalid-feedback">Lütfen şifre alanını boş bırakmayınız!</div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-row">

                                            <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom03">Kullanıcı Adı</label>
                                                    <input type="text" autocomplete="off" name="username" class="form-control" id="validationCustom03"
                                                        required>
                                                    <div class="invalid-feedback">Lütfen kullanıcı adı alanını boş bırakmayınız!</div>
                                            </div>

                                            <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom03">Telefon Numarası</label>
                                                    <input type="text" autocomplete="off" name="telefon" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" id="validationCustom03"
                                                        required>
                                                    <div class="invalid-feedback">Lütfen telefon numarası alanını boş bırakmayınız!</div>
                                            </div>
                                            
                                            
                                               
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom04">Görev</label>
                                                    <select class="form-control select2" name="gorev" id="validationCustom04"
                                                        required>
                                                        <option selected value="">Seçiniz...</option>
                                                        <option value="Web Tasarım Uzmanı">Web Tasarım Uzmanı</option>
                                                        <option value="Grafik Tasarım Uzmanı">Grafik Tasarım Uzmanı</option>
                                                        <option value="Sosyal Medya Uzmanı">Sosyal Medya Uzmanı</option>
                                                        <option value="Saha Satış Koordinatörü">Saha Satış Koordinatörü</option>
                                                        <option value="Saha Satış Uzmanı">Saha Satış Uzmanı</option>
                                                        <option value="Muhasebe">Muhasebe</option>
                                                    </select>
                                                    <div class="invalid-feedback">Lütfen görev alanını boş bırakmayınız.</div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="invalidCheck" required>
                                                    <label class="form-check-label" for="invalidCheck">Kullanıcı sözleşmesini kabul ediyorum</label>
                                                    <div class="invalid-feedback">Sözleşmeyi kabul etmelisiniz.</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Ekip Üyesi Ekle</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                      
                            
                        </div>

                           
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
