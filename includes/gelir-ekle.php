<head>
    <title>Gelir Ekle | <?=$sitebaslik?></title>
</head>
<?php


    $user=$DB->CallData("kullanicilar","WHERE state=? AND mail=?",array(1,$_SESSION["mail"]),"ORDER BY ID ASC",1);



    if($user[0]["Rank"]=="Yönetici" OR $user[0]["Rank"]=="Web Yazılım Uzmanı" OR $user[0]["Rank"]=="Muhasebe") {

    


?>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Gelir Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=SITE?>gelirler">Gelirler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gelir Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                <?php
                    if($_POST)
                    {
                        if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["miktar"]))
                        {
                            $kategori=$DB->filter($_POST["kategori"]);
                           
                            $baslik=$DB->filter($_POST["baslik"]);
                            $miktar=$DB->filter($_POST["miktar"]);

                            $gelirkod=substr(number_format(time() * rand(), 0, '', ''), 0,6);


                            
                            $kullanici_id=$_SESSION["ID"];                    
                     
                            if(!empty($_FILES["resim"]["name"])) {
                                $uzanti = $DB->uzanti($_FILES["resim"]["name"]);
                                if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {
                                    $yukle=$DB->upload("resim","assets/images/gelirler/","ds");
                                }
                                else {
                                    $yukle=$DB->upload("resim","assets/images/gelirler/");
                                }
                                    
                                    if($yukle!=false)
                                    {
                                       
                                        
                                        $ekle=$DB->RunQuery("INSERT INTO siparisgelir","SET gelir_numarasi=?, gelir=?, kategori=?, ekleyen_uye=?, gelir_adi=?, ek_dosya=?, tarih=?",array($gelirkod,$miktar,$kategori,$kullanici_id,$baslik,$yukle,date("Y-m-d")));
                                        
                                        
                                    }
                                    else
                                    {
                                        
                                        
                                        ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Dosya yüklenemedi.</div>
                                <?php
                                    }
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Gelir başarıyla eklendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>gelirler">
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }
                                }


                                
                                else {

                                    $ekle=$DB->RunQuery("INSERT INTO siparisgelir","SET gelir_numarasi=?, gelir=?, kategori=?, ekleyen_uye=?, gelir_adi=?, tarih=?",array($gelirkod,$miktar,$kategori,$kullanici_id,$baslik,date("Y-m-d")));
                                        
                                        ?>
                            
                                <?php
                                    
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Gelir başarıyla eklendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>gelirler">
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }

                                }
                        
                        
                        
                        

                        }
                        else {
                        ?>
                        <div class="alert alert-warning"><i class="fa fa-triangle-exclamation"></i> Lütfen Boş Alanları Doldurunuz!</div>
                        <?php
                        
                            }
                    }
                    
                    ?>
                    <div class="card">

                    
                        
                        <div class="card-header">
                            <div class="card-title">Gelir Ekle</div>
                        </div>

                       


                        <form action="" method="post" class="randevuEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori Seçiniz :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="kategori">
                                            <?php
					$sonuc=$DB->callCategory("gelirler","",-1);
					if($sonuc!=false)
					{
                        
                        echo $sonuc["ID"];

                                          
					}
					else
					{
                        $paketlers=$DB->simpleCategory("gelirler");
                       

                                           
                         echo $paketlers["ID"];                      
					}
					?>
                                        </select>
                                    </div>
                                </div>



                                           
                               
                               
                                        
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Gelir İsmi :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik" placeholder="Gelir İsmini Giriniz">
                                    </div>
                                </div>

                               

                              
                                <div class="row mb-4">
                                        <label class="col-md-3 form-label">Gelir Miktarı :</label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-info" id="button-addon1">₺</span>
                                                <input type="text" class="form-control" placeholder="Gelir Miktarını Giriniz" name="miktar" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            </div>
                                        </div>

                                    </div>


                               

                                <!--Row-->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Ek dosya :</label>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" data-bs-height="100" name="resim" />
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="ekle" class="btn btn-success">Gelir Ekle</button>
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /ROW-1 CLOSED -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
    
</div>
<!--app-content closed-->









<?php
    }
    else {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
        <?php
    }

?>