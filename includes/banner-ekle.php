<head>
    <title>Banner Ekle | <?=$sitebaslik?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Banner Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Banner&Pano</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banner Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php
            if($_POST)
            {
                if(!empty($_POST["baslik"]) && !empty($_POST["sirano"]) && !empty($_FILES["resim"]["name"]))
                {
                   
                    $baslik=$DB->filter($_POST["baslik"]);
              $aciklama=$DB->filter($_POST["aciklama"]);
              $url=$DB->filter($_POST["url"]);
                    $sirano=$DB->filter($_POST["sirano"]);
                    
                   
                        $yukle=$DB->upload("resim","assets/images/banner/");
                        if($yukle!=false)
                        {
                            $ekle=$DB->RunQuery("INSERT INTO banner","SET baslik=?, aciklama=?, url=?,resim=?, durum=?, sirano=?, tarih=?",array($baslik,$aciklama,$url,$yukle,1,$sirano,date("Y-m-d")));
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
                            <div class="card-title">Banner Ekle</div>
                        </div>
                        <form action="" method="post" class="bannerEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Banner Başlık :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik"
                                            placeholder="Banner Başlığı...">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Açıklama :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Banner Açıklaması..."
                                            name="aciklama">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Banner URL :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Banner URL..." name="url">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sıra Numarası</label>
                                    <input type="number" class="form-control" placeholder="Sıra Numarası.."
                                        name="sirano" style="width:100px;" value="<?php $sirano=$DB->CallID("banner"); 
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
                                    <label class="col-md-3 form-label mb-4">Banner Resmi :</label>
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
                                        <button type="submit" name="ekle" class="btn btn-primary">Banner Ekle</button>
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