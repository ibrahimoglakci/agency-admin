
<head>

  <title>Site Ayarları | <?=$sitebaslik?></title>

</head>

<?php
	   if($_POST)
	   {
		   if(!empty($_POST["title"]) && !empty($_POST["key"]) && !empty($_POST["description"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["lng"]) && !empty($_POST["lat"]) && !empty($_POST["adress"]))
		   {
			   $title=$DB->filter($_POST["title"]);
			   $key=$DB->filter($_POST["key"]);
			   $description=$DB->filter($_POST["description"]);
         $email=$DB->filter($_POST["email"]);
			   $phone=$DB->filter($_POST["phone"]);
			   $lng=$DB->filter($_POST["lng"]);
         $lat=$DB->filter($_POST["lat"]);
         $adress=$DB->filter($_POST["adress"]);
			   
				   $update=$DB->RunQuery("UPDATE ayarlar","SET baslik=?, anahtar=?, aciklama=?, telefon=?, mail=?, adres=?, lat=?, lng=? WHERE ID=?",array($title,$key,$description,$phone,$email,$adress,$lat,$lng,1),1);
			  
			   if($update!=false)
			   {
				    ?>
                   <div class="alert alert-success col-md-12 text-center"><i class="fa fa-check-circle"></i> İşleminiz başarıyla kaydedildi.</div>
                   <?php
			   }
			   else
			   {
				    ?>
                   <div class="alert alert-danger col-md-12 text-center"><i class="fa fa-times-circle"></i> İşleminiz sırasında bir sorunla karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                   <?php
			   }
		   }
		   else
		   {
			   ?>
               <div class="alert alert-danger col-md-12 text-center"><i class="fa fa-times-circle"></i> Boş bıraktığınız alanları doldurunuz.</div>
               <?php
		   }
	   }
	   ?>

<head>
     <title>TSD | Site Ayarları</title>
</head>


<div class="main-content app-content mt-0">
  <div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

      <!-- PAGE-HEADER -->
      <div class="page-header">
        <h1 class="page-title">Site Ayarlarını Güncelle</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Ayarları</a></li>
            <li class="breadcrumb-item active" aria-current="page">Site Ayarlarını Güncelle</li>
          </ol>
        </div>
      </div>                
      
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            
            <div class="card-body">
              <form class="needs-validation" action="" method="POST" novalidate>
                <div class="form-row">
                  
                  <div class="col-xl-6 mb-3">
                    <label for="validationCustom01">Site Başlığı</label>
                    <input type="text" name="title" class="form-control" id="validationCustom01"
                    value="<?=$sitebaslik?>" required>
                    <div class="valid-feedback">Harika görünüyor!</div>
                  </div>
                  <div class="col-xl-6 mb-3">
                    <label for="validationCustom02">E-posta adresi</label>
                    <input type="text" name="email" class="form-control" id="validationCustom02"
                    value="<?=$sitemail?>">
                    <div class="valid-feedback">Harika görünüyor!</div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-xl-6 mb-3">
                    <label for="validationCustom03">Telefon Numarası</label>
                    <input type="text" name="phone" class="form-control" value="<?=$sitetelefon?>" id="validationCustom03"
                    >
                    <div class="invalid-feedback">Lütfen geçerli bir telefon numarası giriniz.</div>
                  </div>
                <div class="col-xl-6 mb-3">
                  <label for="validationCustom05">Adres</label>
                  <input type="text" name="adress" class="form-control" id="validationCustom05" value="<?=$siteadres?>"
                  required>
                </div>
                <div class="col-xl-6 mb-3">
                  <label for="validationCustom05">Konum Lat Kod</label>
                  <input type="text" name="lat" class="form-control" id="validationCustom05" value="<?=$sitelat?>"
                  required>
                </div>
                <div class="col-xl-6 mb-3">
                  <label for="validationCustom05">Konum Lng Kod</label>
                  <input type="text" name="lng" class="form-control" id="validationCustom05" value="<?=$sitelng?>"
                  required>
                
              </div>
              <div class="col-xl-12 mb-3">
                  <label for="validationCustom05">Site Açıklama</label>
                  <input type="text" name="description" class="form-control" id="validationCustom05" value="<?=$siteaciklama?>"
                  required>
                
              </div>
              <div class="col-xl-12 mb-3">
                  <label for="validationCustom05">Site Seo</label>
                  <input type="text" name="key" class="form-control" id="validationCustom05" value="<?=$siteanahtar?>"
                  required>
                
              </div>
              
              <button type="submit" class="btn btn-success mt-15 col-lg-12" name="setting-save">Bilgileri Kaydet</button>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>