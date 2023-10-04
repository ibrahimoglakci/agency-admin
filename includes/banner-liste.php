<head>
    <title>
        Banner Liste | <?=$sitebaslik?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Banner Listesi</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Banner</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Banner Listesi</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Banner Listesi</h3>
                            <div class="col-md-11">
                                <a href="<?=SITE?>banner-ekle" class="btn btn-pink"
                                    style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                    YENİ
                                    EKLE</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">Durum</th>
                                            <th class="border-bottom-0">ID</th>
                                            <th class="border-bottom-0">Başlık</th>
                                            <th class="border-bottom-0">Açıklama</th>
                                            <th class="border-bottom-0">URL</th>
                                            <th class="border-bottom-0">Resim</th>
                                            <th class="border-bottom-0">Sıra Numarası</th>
                                            <th class="border-bottom-0">Tarih</th>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
				$veriler=$DB->CallData("banner","","","ORDER BY ID ASC");
				if($veriler!=false)
				{
                    $sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
                        $sira++;
						if($veriler[$i]["durum"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}

						?>
                                        <tr>
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                        class="custom-control-input aktifpasif<?=$veriler[$i]['ID']?>"
                                                        id="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]['ID']?>"
                                                        <?=$aktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                        onclick="aktifpasif(<?=$veriler[$i]['ID']?>,'banner');">
                                                    <label class="label-success"
                                                        for="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>
                                            </td>

                                            <td><?=$veriler[$i]["ID"]?></td>
                                            <td><?=stripslashes($veriler[$i]["baslik"])?></td>
                                            <td><?=stripslashes($veriler[$i]["aciklama"])?></td>
                                            <td><?=$veriler[$i]["url"]?></td>
                                            <?php if($veriler[$i]["resim"]!=NULL) { ?>
                                            <td><img src="<?=SITE?>assets/images/banner/<?=$veriler[$i]["resim"]?>" style="height: 60px; width: auto; margin-right: 8px; float: left;"></td>
                                            <?php } else { ?>
                                            <td>Resim Bulunmamaktadır.</td>
                                            <?php } ?>
                                            <td><?=$sira?></td>
                                            <td><?=$veriler[$i]["tarih"]?></td>
                                            <td style="display: inline-block; ">
                                                <a href="<?=SITE?>banner-duzenle/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-top: 15px; margin-right: 3px;"
                                                    class="btn btn-warning btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Banneri Düzenle"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu banneri düzenlemek için tıkla!"><i
                                                        class="fa fa-cog"></i>
                                                </a>
                                                
                                                <a onclick="bannerSil('<?=SITE?>',<?=$veriler[$i]['ID']?>);"
                                                    style="margin-top: 15px; margin-right: 3px;" id="silmeAlani"
                                                    class="btn btn-danger btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Banneri Sil"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu banneri kaldırmak için tıkla!"><i
                                                        class="fe fe-trash"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        <?php
					}
				}
				?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- CONTAINER CLOSED -->


    </div>
</div>


