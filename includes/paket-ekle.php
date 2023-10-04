<head>
    <title>Paket Ekle | <?=$sitebaslik?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Paket Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Paketler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paket Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php
            if($_POST)
            {
                if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["sirano"]) && !empty($_POST["paketkodu"]) && !empty($_POST["fiyat"]) && !empty($_POST["aciklama"]))
                {
                    $kategori=$DB->filter($_POST["kategori"]);
                    $baslik=$DB->filter($_POST["baslik"]);
                    $anahtar=$DB->filter($_POST["anahtar"]);
                    $seflink=$DB->seflink($baslik);
                    $metin=$DB->filter($_POST["aciklama"],true);
                    $sirano=$DB->filter($_POST["sirano"]);
                    $paketkodu="AVTR-".$DB->filter($_POST["paketkodu"]);
                    $fiyat=$DB->filter($_POST["fiyat"]);
                    $indirimlifiyat=$DB->filter($_POST["indirimlifiyat"]);
                    $ifiyat=$DB->filter($_POST["ifiyat"]);

                    if($ifiyat==1) {
                        $iaktif=1;
                    }
                    else {
                        $iaktif=0;
                    }
                    $vitrindurum=1;

                   $checkpackage=$DB->CallData("paketler","WHERE paketkodu=?",array($paketkodu),"ORDER BY ID ASC",1);
                   if($checkpackage!=false) {
                    ?>
                     <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bu paket zaten eklenmiş.</div>
                    <?php
                    
                   }
                   else {
                            $yukle=$DB->upload("image","assets/images/paketler/");
                        if($yukle!=false)
                        {
                            $urunID =$DB->CallID("paketler");

                            
                            $ekle=$DB->RunQuery("INSERT INTO paketler","SET baslik=?, seflink=?, paketkodu=?, kategori=?, metin=?, resim=?, fiyat=?, indirimlifiyat=?, ifiyat=?, vitrindurum=?, anahtar=?, sirano=?, durum=?, tarih=?",array($baslik,$seflink,$paketkodu,$kategori,$metin,$yukle,$fiyat,$indirimlifiyat,$iaktif,$vitrindurum,$anahtar,$sirano,1,date("Y-m-d")));
                            
                            
                        }
                        else
                        {
                            $ekle=$DB->RunQuery("INSERT INTO paketler","SET baslik=?, seflink=?, paketkodu=?, kategori=?, metin=?, fiyat=?, indirimlifiyat=?, ifiyat=?, vitrindurum=?, anahtar=?, sirano=?, durum=?, tarih=?",array($baslik,$seflink,$paketkodu,$kategori,$metin,$fiyat,$indirimlifiyat,$iaktif,$vitrindurum,$anahtar,$sirano,1,date("Y-m-d")));
                            
                            ?>
                
                    <?php
                        }
                        if($ekle!=false)
                   {
                            ?>
                            <div class="alert alert-success"><i class="fa fa-check-circle"></i> Paket başarıyla eklendi.</div>
                            <meta http-equiv="refresh" content="1;url=<?=SITE?>paket-listesi">
                            

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


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Paket Ekle</div>
                        </div>
                        <form action="" method="post" class="urunEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" style="width: 100%;" name="kategori">
                                            <?php
                                            
					$sonuc=$DB->callCategory("paketler","",-1);
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
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Paket İsmi :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik" placeholder="Paket İsmi">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Fiyat :</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="fiyat">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">İndirimli Fiyat :</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="indirimlifiyat">
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">İndirimli Fiyat Aktif Olsun Mu? :</label>
                                    <div class="col-md-9">
                                    <label class="custom-switch form-switch mb-0">
                                          
                                          <input type="checkbox" name="ifiyat" class="custom-switch-input" value="Aktif">
                                          <span class="custom-switch-indicator"></span>


                                    </label>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Anahtar Kelime :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="anahtar">
                                    </div>
                                </div>

                                <?php
                                    $randompaketkod = substr(number_format(time() * rand(), 0, '', ''), 0,4);
                                    $checkpaket=$DB->CallData("paketler","WHERE paketkodu=?",array($randompaketkod),"ORDER BY ID ASC");
                                    if($checkpaket!=false) {
                                        $randompaketkod = substr(number_format(time() * rand(), 0, '', ''), 0,4);
                                    }
                                    
                                ?>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Paket Kodu :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="paketkodu" value="<?=$randompaketkod?>">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sıra Numarası</label>
                                    <input type="number" class="form-control" placeholder="Sıra Numarası.."
                                        name="sirano" style="width:100px;" value="<?php $sirano=$DB->CallID("paketler"); 
                                    if($sirano!=false)
                                    {
                                    echo $sirano;
                                    }
                                    else
                                    {
                                    echo "1";
                                    }
                                    
                                    ?>">

                                </div>



                                <!-- Row -->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Paket Açıklaması :</label>
                                    <div class="col-md-9 mb-4">
                                        <textarea class="content" name="aciklama"></textarea>
                                    </div>
                                </div>
                                <!--End Row-->

                                <!--Row-->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Paket Resmi :</label>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" data-bs-height="100" name="image" />
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" name="ekle" class="btn btn-primary">Paket Ekle</button>
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