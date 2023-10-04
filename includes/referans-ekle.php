<head>
    <title>Referans Ekle | <?=$sitebaslik?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Referans Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Referans</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Referans Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php
            if($_POST)
            {
                if(!empty($_POST["musteri_adi"]) && !empty($_POST["sirano"]) && !empty($_POST["kategori"]))
                {
                   
                    $musteriadi=$DB->filter($_POST["musteri_adi"]);
                    $kategori=$DB->filter($_POST["kategori"]);
                    $link=$DB->filter($_POST["link"]);
                    

                    $sirano=$DB->filter($_POST["sirano"]);
                    
                   
                        $yukle=$DB->upload("resim","assets/images/referanslar/");
                        if($yukle!=false)
                        {
                            $ekle=$DB->RunQuery("INSERT INTO referans_musteriler","SET musteri_adi=?, kategori=?, link=?, resim=?, sirano=?, durum=?, tarih=?",array($musteriadi,$kategori,$link,$yukle,$sirano,1,date("Y-m-d")));
                        }
                        else
                        { 
                 $ekle=false;
                             ?>
            <div class="alert alert-info"><i class="fa fa-times-circle"></i> Resim yükleme işleminiz başarısız.</div>
            <?php
                        }
                    
                    
                    if($ekle!=false)
                    {
                         ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> İşleminiz başarıyla kaydedildi.</div>
            <meta http-equiv="refresh" content="1;url=<?=SITE?>referans-ekle">
            <?php
                    }
                    else
                    {
                         ?>
            <div class="alert alert-danger"><i class="fa fa-times-circle"></i> İşleminiz sırasında bir sorunla
                karşılaşıldı. Lütfen daha sonra tekrar
                deneyiniz.</div>
            <?php
                    }
                }
                else
                {
                    ?>
            <div class="alert alert-danger"><i class="fa fa-circle-exclamation"></i> Boş bıraktığınız alanları
                doldurunuz.
            </div>
            <?php
                }
            }
            
            ?>


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Referans Ekle</div>
                        </div>
                        <form action="" method="post" class="bannerEklemeFormu" enctype="multipart/form-data">
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
                                    <label class="col-md-3 form-label">Müşteri/Şirket Adı :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="musteri_adi"
                                            placeholder="Müşteri/Şirket Adı...">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Link :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="link"
                                            placeholder="Referans Linki">
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sıra Numarası</label>
                                    <input type="number" class="form-control" placeholder="Sıra Numarası.."
                                        name="sirano" style="width:100px;" value="<?php $sirano=$DB->CallID("referans_musteriler"); 
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

                                <!--Row-->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Referans Resmi :</label>
                                    <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                        <input type="file" class="dropify" data-bs-height="100" name="resim" />
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <button type="submit" name="ekle" class="btn btn-primary">Referans Ekle</button>
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