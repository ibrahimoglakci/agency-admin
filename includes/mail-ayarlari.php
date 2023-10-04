<?php 
$mailayarlar=$DB->CallData("mail_ayarlari","WHERE ID=?",array(1),"ORDER BY ID ASC",1);

if($mailayarlar!=false) {
?>


<title>Mail Ayarları | <?=$sitebaslik?></title>




<head>
   <title>TSD | Mail Ayarları</title>
</head>


<div class="main-content app-content mt-0">
<div class="side-app">

  <!-- CONTAINER -->
  <div class="main-container container-fluid">

    <!-- PAGE-HEADER -->
    <div class="page-header">
      <h1 class="page-title">Mail Ayarlarını Güncelle</h1>
      <div>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Mail Ayarları</a></li>
          <li class="breadcrumb-item active" aria-current="page">Mail Ayarlarını Güncelle</li>
        </ol>
      </div>
    </div>                
    
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          
          <div class="card-body">

          <?php
       
	   if($_POST)
	   {
		   if(!empty($_POST["smtp"]) && !empty($_POST["port"]) && !empty($_POST["sertifika"]) && !empty($_POST["smtpmail"]) && !empty($_POST["mailsifre"]))
		   {
			   $smtp=$DB->filter($_POST["smtp"]);
			   $port=$DB->filter($_POST["port"]);
			   $sertifika=$DB->filter($_POST["sertifika"]);
                $smtpmail=$DB->filter($_POST["smtpmail"]);
                $mailsifre=$DB->filter($_POST["mailsifre"]);
			   
				   $guncelle=$DB->RunQuery("UPDATE mail_ayarlari","SET server=?, port=?, sertifika=?, mail=?, sifre=? WHERE ID=?",array($smtp,$port,$sertifika,$smtpmail,$mailsifre,1),1);
			  
			   if($guncelle!=false)
			   {   
                    
				    ?>
                   <div class="alert alert-success"><i class="fa fa-check-circle"></i> İşleminiz başarıyla kaydedildi.</div>
                   <meta http-equiv="refresh" content="1;url=<?=SITE?>mail-ayarlari" />
                   <?php
			   }
			   else
			   {
				    ?>
                   <div class="alert alert-danger">İşleminiz sırasında bir sorunla karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                   <?php
			   }
		   }
		   else
		   {
			   ?>
               <div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
               <?php
		   }
	   }
	   ?>

            <form class="needs-validation" action="" method="POST" novalidate>
              <div class="form-row">
                
                <div class="col-xl-6 mb-3">
                  <label for="validationCustom01">SMTP Server</label>
                  <input type="text" name="smtp" class="form-control" id="validationCustom01"
                  value="<?=$mailayarlar[0]["server"]?>" required>
                  <div class="valid-feedback">Harika görünüyor!</div>
                </div>
                <div class="col-xl-6 mb-3">
                  <label for="validationCustom02">SMTP Port</label>
                  <input type="text" class="form-control" placeholder="SMTP Port" id="portinput" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="port" value="<?=$mailayarlar[0]["port"]?>">
                </div>
                <script>
                  document.querySelector('#portinput').addEventListener('keydown', (e) => {
                      e.target.value = e.target.value.replace(/(\d{4})(\d+)/g, '$1 $2')
                  })
                  /* Jquery */
                  $('#portinput').keyup(function() {
                    $(this).val($(this).val().replace(/(\d{4})(\d+)/g, '$1 $2'))
                  });
                </script>
                  <div class="valid-feedback">Harika görünüyor!</div>
              
             
              
                <div class="col-xl-6 mb-3">
                    <label>Mail Sertifika</label>
                    <input type="text" class="form-control" placeholder="Mail Sertifika" name="sertifika" value="<?=$mailayarlar[0]["sertifika"]?>">
                </div>
              <div class="col-xl-6 mb-3">
                <label>SMTP Email</label>
                <input type="email" class="form-control" placeholder="SMTP Email" name="smtpmail" value="<?=$mailayarlar[0]["mail"]?>">
                
              </div>
              <div class="col-xl-6 mb-3">
                 <label>SMTP Mail Şifre</label>
                <input type="password" class="form-control" placeholder="SMTP Email Şifre" name="mailsifre" value="<?=$mailayarlar[0]["sifre"]?>">
              </div>
              
            
            <button type="submit" class="btn btn-success mt-15 col-lg-12" name="setting-save">Bilgileri Kaydet</button>
          </form>
        
      </div>
    </div>
    
  </div>
</div>
</div>
</div>

<?php } ?>