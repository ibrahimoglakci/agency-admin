<head>
    <title>Resimler | <?=$sitebaslik?></title>
</head>

<?php 
  if(!empty($_GET["tablo"]) && !empty(intval($_GET["ID"])))
  {

    $tablo=$DB->filter($_GET["tablo"]);
    $ID=$DB->filter($_GET["ID"]);
    $paket=$DB->CallData("paketler","WHERE ID=?",array($_GET["ID"]));

 ?>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Paket Resimleri</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Paketler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paket Resimleri</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- DROPZONE OPEN -->
            <form action="<?=SITE?>ajax.php" method="post" class="dropzone" enctype="multipart/form-data">
                <input type="hidden" name="tablo" value="<?=$tablo?>">
                <input type="hidden" name="ID" value="<?=$ID?>">
            </form>

            <div class="row">
                <div class="col-md-12">
                    <a href="<?=SITE?>assets/images/resimler/<?=$_GET["tablo"]?>/<?=$_GET["ID"]?>" class="btn btn-success"
                        style="width: 100%; height: 60%; margin-bottom:30px; margin-top: 10px; font-weight: 600; font-size: 20px;">Onayla</a>
                </div>
            </div>

            <!-- DROPZONE CLOSED -->

            <!-- GALLERY DEMO OPEN -->
            <div class="col-lg-12" style="margin-top: 35px;">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">'<?=$paket[0]["baslik"]?>' adlı ürünün resimleri</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-wrap">
                            <div class="">
                                <div class="row">
                                    <?php
                                $veriler=$DB->CallData("resimler","WHERE tablo=? AND KID=?",array($tablo,$ID),"ORDER BY ID ASC");
                                if($veriler!=false)
                                {
                                $sira=0;
                                for($i=0;$i<count($veriler);$i++)
                                {
                                    $sira++;  
                                    ?>


                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4">
                                        <div class="file-image p-2">
                                            <div class="product-image">
                                                <a href="javascript:void(0);">
                                                    <img src="<?=SITE?>assets/images/resimler/<?=$tablo?>/<?=$veriler[$i]["resim"]?>"
                                                        alt="" style="height: 130px;" class="w-100">
                                                </a>
                                                <ul class="icons">
                                                    <li><a href="<?=SITE?>resim-sil/<?=$tablo?>/<?=$ID?>/<?=$veriler[$i]["ID"]?>"
                                                            class="bg-danger"><i class="fe fe-trash"></i></a></li>
                                                    <!-- <li><a href="javascript:void(0)" class="bg-secondary"><i
                                                                class="fe fe-download"></i></a></li> -->
                                                </ul>
                                                <a href="javascript:void(0);"><span
                                                        class="file-name"><?=$veriler[$i]["resim"]?></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                                ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GALLERY DEMO CLOSED -->



        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
<!--app-content closed-->


<?php 

  }
?>