 <title>Kategori Ekle | <?=$sitebaslik?></title>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Kategori Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Kategori</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Yeni Kategori Ekle</div>
                        </div>
                        <?php
                        if($_POST)
                        {
                            if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["metin"]) && !empty($_POST["description"]) && !empty($_POST["sirano"]))
                            {
                                $kategori=$DB->filter($_POST["kategori"]);
                                $baslik=$DB->filter($_POST["baslik"]);
                                $anahtar=$DB->filter($_POST["anahtar"]);
                                $metin=$DB->filter($_POST["metin"],true);
                                $seflink=$DB->seflink($baslik);
                                $description=$DB->filter($_POST["description"]);
                                $sirano=$DB->filter($_POST["sirano"]);
                                $categoryseflink=$DB->CallData("categories","WHERE ID=?",array($kategori),"ORDER BY ID ASC",1);
                                $kategoriseflink=$categoryseflink[0]["seflink"];

                                $checkcategories=$DB->CallData("categories","WHERE seflink=?",array($seflink),"ORDER BY ID ASC",1);
                                if($checkcategories!=false) {
                                    ?>
                                     <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bu kategori zaten eklenmiş.</div>
                                    <?php
                                    
                                }
                                else {
                                    if(!empty($_FILES["resim"]["name"]))
                                    {
                                        $yukle=$DB->upload("resim","assets/images/kategoriler/");
                                        if($yukle!=false)
                                        {
                                            $ekle=$DB->RunQuery("INSERT INTO categories","SET title=?, seflink=?, tables=?, resim=?, anahtar=?, description=?, state=?, sirano=?, date=?",array($baslik,$seflink,$kategoriseflink,$yukle,$anahtar,$description,1,$sirano,date("Y-m-d")));
                                        }
                                        else
                                        {   
                                            
                                                ?>
                                            
                                        <div class="alert alert-info"><i class="fa fa-times-circle"></i> Resim yükleme işleminiz başarısız.</div>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                        $ekle=$DB->RunQuery("INSERT INTO categories","SET title=?, seflink=?, tables=?, anahtar=?, description=?, state=?, sirano=?, date=?",array($baslik,$seflink,$kategoriseflink,$anahtar,$description,1,$sirano,date("Y-m-d")));
                                    }
                                    if($ekle!=false)
                                    {
                                            ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Kategori başarıyla eklendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>kategoriler">
                                        <?php
                                    }
                                    else
                                    {
                                            ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> İşleminiz sırasında bir sorunla karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
                                        <?php
                                    }
                                }

                                
                                
                                
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger"><i class="fa fa-triangle-exclamation"></i> Boş bıraktığınız alanları doldurunuz.</div>
                                <?php
                            }
                        }
                        ?>


                        <form action="" method="post" class="kategoriEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori İsmi :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="baslik" placeholder="Kategori İsmi">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Sıra Numarası :</label>
                                    <div class="col-md-9">
                                    <input type="number" class="form-control" placeholder="Sıra Numarası.."
                                            name="sirano" style="width:100px;" value="<?php $sirano=$DB->CallID("categories"); 
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
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Kategori Seç :</label>
                                    <div class="col-md-9">
                                    <select class="form-control select2" style="width: 100%;" name="kategori">
                                        <?php
                                        $sonuc=$DB->callCategory("modul");
                                        if($sonuc!=false)
                                        {
                                            
                                            echo $sonuc;

                                                            
                                        }
                                        else
                                        {
                                            $categories=$DB->simpleCategory("modul");
                                        

                                                            
                                            echo $categories;                      
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>

                                 <!-- Row -->
                                 <div class="row">
                                    <label class="col-md-3 form-label mb-4">Kategori Anahtar Kelime:</label>
                                    <div class="col-md-9 mb-4">
                                    <input type="text" class="form-control" name="anahtar" placeholder="Kategori Anahtar Kelime">
                                    </div>
                                </div>
                                <!--End Row-->

                                <!-- Row -->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Kategori Açıklaması:</label>
                                    <div class="col-md-9 mb-4">
                                    <input type="text" class="form-control" name="description" placeholder="Kategori Açıklaması">
                                    </div>
                                </div>
                                <!--End Row-->

                                 <!-- Row -->
                                 <div class="row">
                                    <label class="col-md-3 form-label mb-4">Kategori İçeriği :</label>
                                    <div class="col-md-9 mb-4">
                                        <textarea class="content" name="metin"></textarea>
                                    </div>
                                </div>
                                <!--End Row-->

                                <!--Row-->
                                <div class="row">
                                    <label class="col-md-3 form-label mb-4">Kategori Resim:</label>
                                    <div class="col-md-9">
                                    <input type="file" class="dropify" data-bs-height="100" name="resim" />
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>
                            <div class="card-footer">
                            <!--Row-->
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-success">Kategori Ekle</button>
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