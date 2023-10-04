<head>
    <title>Randevu Düzenle | <?=$sitebaslik?></title>
</head>
<?php

    if(!empty(intval($_GET["ID"])))
    {
      $ID=$DB->filter($_GET["ID"]);
      
        $veri=$DB->CallData("randevular","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
        if($veri!=false)
        {

            $user=$DB->CallData("kullanicilar","WHERE state=? AND mail=?",array(1,$_SESSION["mail"]),"ORDER BY ID ASC",1);



            if($user[0]["Rank"]=="Yönetici" OR $user[0]["Rank"]=="Web Yazılım Uzmanı" OR $user[0]["Rank"]=="Saha Satış Sorumlusu" OR $user[0]["Rank"]=="Saha Satış Koordinatörü") {

    


?>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Randevu Düzenle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Randevular</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Randevu Düzenle</li>
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
                        if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["gorusme_tarihi"]) && !empty($_POST["randevu_tarihi"]) && !empty($_POST["musteri_adsoyad"]) && !empty($_POST["musteri_email"]) && !empty($_POST["musteri_telefon"]) && !empty($_POST["randevu_not"]))
                        {
                            $kategori=$DB->filter($_POST["kategori"]);
                            $paketkod="SRK-".$DB->filter($_POST["paketkod"]);
                            $baslik=$DB->filter($_POST["baslik"]);
                            $seflink=$DB->seflink($baslik);
                            $gorusme_tarihi=$_POST["gorusme_tarihi"];
                            $randevu_tarihi=$_POST["randevu_tarihi"];
                            $randevu_saati=$DB->filter($_POST["randevu_saati"]);
                            $musteri_adsoyad=$DB->filter($_POST["musteri_adsoyad"]);
                            $musteri_email=$DB->filter($_POST["musteri_email"]);
                            $musteri_telefon=$DB->filter($_POST["musteri_telefon"]);
                            $musteri_adress=$DB->filter($_POST["musteri_adress"]);
                            $randevu_not=$DB->filter($_POST["randevu_not"],true);
                            $kullanici_id=$_SESSION["ID"];

       
                            if(!empty($_FILES["resim"]["name"])) {
			                
                                    $yukle=$DB->upload("resim","assets/images/randevular/");
                                    if($yukle!=false)
                                    {
                                        $randevuID =$DB->CallID("randevular");

                                        
                                        $ekle=$DB->RunQuery("UPDATE randevular","SET kullanici_id=?, kategori=?, paketkodu=?, baslik=?, seflink=?, gorusme_tarihi=?, randevu_tarihi=?, randevu_saati=?, musteri_adsoyad=?, musteri_email=?, musteri_telefon=?, musteri_adress=?, randevu_not=?, resim=? WHERE ID=?",array($kullanici_id,$kategori,$paketkod,$baslik,$seflink,$gorusme_tarihi,$randevu_tarihi,$randevu_saati,$musteri_adsoyad,$musteri_email,$musteri_telefon,$musteri_adress,$randevu_not,$yukle,$veri[0]["ID"]));
                                        
                                        
                                    }
                                    else
                                    {
                                        
                                        
                                        ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Resim yüklenemedi.</div>
                                <?php
                                    }
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Randevu başarıyla güncellendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>randevular">
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }
                                }


                                
                                else {

                                    $ekle=$DB->RunQuery("UPDATE randevular","SET kullanici_id=?, kategori=?, paketkodu=?, baslik=?, seflink=?, gorusme_tarihi=?, randevu_tarihi=?, randevu_saati=?, musteri_adsoyad=?, musteri_email=?, musteri_telefon=?, randevu_not=? WHERE ID=?",array($kullanici_id,$kategori,$paketkod,$baslik,$seflink,$gorusme_tarihi,$randevu_tarihi,$randevu_saati,$musteri_adsoyad,$musteri_email,$musteri_telefon,$randevu_not,$veri[0]["ID"]));
                                        
                                        ?>
                            
                                <?php
                                    
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Randevu başarıyla güncellendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>randevular">
                                        

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
                            <div class="card-title">Randevu Düzenle</div>
                        </div>

                       


                        <form action="" method="post" class="randevuEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori Seçiniz :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="kategori">
                                        <?php
					$sonuc=$DB->callCategory("paketler",$veri[0]["kategori"],-1);
					if($sonuc!=false)
					{
                        
                        echo $sonuc;

                                          
					}
					else
					{
                        $paketlers=$DB->simpleCategory("paketler");
                       

                                           
                         echo $paketlers;                      
					}
					?>
                                        </select>
                                    </div>
                                </div>


                                <?php 
                                $kodparcala=explode("-",$veri[0]["paketkodu"],2);

                                ?>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Paket Kodu :</label>
                                    <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-info" id="button-addon1">SRK-</span>
                                                <input type="text" class="form-control" name="paketkod" placeholder="" aria-label="Paket Kodunu Giriniz" aria-describedby="paket-kodu" value="<?=$kodparcala[1]?>">
                                                <a class="btn btn-success paketkodonay" data-bs-target="#modaldemo8" data-bs-toggle="modal" id="button-addon2" href="javascript:void(0)">Görüntüle</a>
                                            </div>
                                    </div>
                                    
                                </div>
                               
                               
                                        
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Randevu Başlığı :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik" placeholder="Randevu Başlığı" value="<?=$veri[0]["baslik"]?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Görüşme Tarihi :</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <input class="form-control" id="gdate" placeholder="MM/DD/YYYY" type="date" name="gorusme_tarihi" value="<?=$veri[0]["gorusme_tarihi"]?>">
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Randevu Tarihi :</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            
                                            <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <?php 
                                    
                                            ?>
                                            <input class="form-control" id="rdate" placeholder="GG/AA/YYYY" type="date" name="randevu_tarihi" value="<?=$veri[0]["randevu_tarihi"]?>">
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    input[type="date"] {
                                    position: relative;
                                    padding: 10px;
                                    }

                                    input[type="date"]::-webkit-calendar-picker-indicator {
                                    color: #ffffff;
                                    background: none;
                                    z-index: 1;
                                    }

                                    input[type="date"]:before {
                                    color: #ffffff;
                                    background: none;
                                    display: block;
                                    font-family: 'FontAwesome';
                                    content: '\f073';
                                    /* This is the calendar icon in FontAwesome */
                                    width: 30px;
                                    height: 30px;
                                    position: absolute;
                                    top: 12px;
                                    right: 0px;
                                    color: #ffffff;
                                    }

                                </style>
                                
                                <div class="row mb-4">
                                <label class="col-md-3 form-label">Randevu Saati :</label>
                                    <div class="col-md-9">
                                            
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <!-- input-group-text -->
                                                    <input class="form-control" id="tpBasic" name="randevu_saati" placeholder="Saat Seç" type="text" value="<?=$veri[0]["randevu_saati"]?>">
                                                </div>
                                            
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Ad Soyad :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Müşteri Ad Soyad" name="musteri_adsoyad" value="<?=$veri[0]["musteri_adsoyad"]?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri E-Posta :</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" placeholder="Müşteri E-Posta Adresi" name="musteri_email" value="<?=$veri[0]["musteri_email"]?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Telefon Numarası :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Müşteri Telefon Numarası" name="musteri_telefon" value="<?=$veri[0]["musteri_telefon"]?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Müşteri Adress :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Müşteri Adres" name="musteri_adress" value="<?=$veri[0]["musteri_adress"]?>">
                                    </div>
                                </div>




                                <!-- Row -->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Randevu Notu :</label>
                                    <div class="col-md-9 mb-4">
                                        <textarea class="content" name="randevu_not"><?=$veri[0]["randevu_not"]?></textarea>
                                    </div>
                                </div>
                                <!--End Row-->

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
                                        <button type="submit" name="ekle" class="btn btn-success">Randevu Güncelle</button>
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


<div class="modal fade" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title"></h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom" id="paketcektablo">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">Paket Kodu</th>
                                                        <th class="wd-15p border-bottom-0">Paket İsmi</th>
                                                        <th class="wd-15p border-bottom-0">Kategori</th>
                                                        <th class="wd-15p border-bottom-0">Fiyat</th>
                                                        <th class="wd-15p border-bottom-0">İşlem</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="paketlertable">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>







<?php
    }
    else {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
        <?php
    }
}
    }

?>