<head>
    <title>
        Paket Listesi | <?=$sitebaslik?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Paketler Listesi</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Paketler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paket Listesi</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Paket Listesi</h3>
                            <div class="col-md-11">
                                <a href="<?=SITE?>paket-ekle" class="btn btn-pink"
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
                                            <th class="border-bottom-0">Paket Kodu</th>
                                            <th class="border-bottom-0">Başlık</th>
                                            <th class="border-bottom-0">İndirim Durumu</th>
                                            <th class="border-bottom-0">İndirimli Fiyat</th>
                                            <th class="border-bottom-0">Fiyat</th>
                                            <th class="border-bottom-0">Kategori</th>
                                            <th class="border-bottom-0">Tarih</th>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
				$veriler=$DB->CallData("paketler","","","ORDER BY ID ASC");
				if($veriler!=false)
				{
					$sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
						$sira++;
                        $kategori=$DB->CallData("categories","WHERE ID=?",array($veriler[$i]["kategori"]),"ORDER BY ID ASC",1);
                      
						if($veriler[$i]["durum"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}
                        if($veriler[$i]["ifiyat"]==1){$indirimaktifpasif=' checked="checked"';}else{$indirimaktifpasif='';}
						?>
                                        <tr>
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                        class="custom-control-input aktifpasif<?=$veriler[$i]['ID']?>"
                                                        id="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]['ID']?>"
                                                        <?=$aktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                        onclick="aktifpasif(<?=$veriler[$i]['ID']?>,'paketler');">
                                                    <label class="label-success"
                                                        for="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>
                                            </td>

                                            <td><?=$veriler[$i]["paketkodu"]?></td>
                                            <td><?=stripslashes($veriler[$i]["baslik"])?></td>
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                                class="custom-control-input indirimaktifpasif<?=$veriler[$i]['ID']?>"
                                                                id="someSwitchOptionSuccess indirimcustomSwitch3<?=$veriler[$i]['ID']?>"
                                                                <?=$indirimaktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                                onclick="indirimaktifpasif(<?=$veriler[$i]['ID']?>,'paketler');">
                                                            <label class="label-success"
                                                                for="someSwitchOptionSuccess indirimcustomSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>

                                            </td>
                                        
                                        
                                            <td><?= $veriler[$i]["indirimlifiyat"]?> ₺</td>
                                            <td><?=$veriler[$i]["fiyat"]?> ₺</td>
                                            <td><?= $kategori[0]["title"]?> </td>
                                            <td><?=$veriler[$i]["tarih"]?></td>
                                            <td style="display: inline-block; ">
                                                <a href="<?=SITE?>paket-duzenle/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-top: 15px; margin-right: 3px;"
                                                    class="btn btn-warning btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Paketi Düzenle"
                                                    data-bs-content="<?=$veriler[$i]["paketkodu"]?> kodlu paketi düzenlemek için tıkla!"><i
                                                        class="fa fa-cog"></i>
                                                </a>
                                                <a href=" <?=SITE?>resimler/paketler/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-top: 15px; margin-right: 3px;"
                                                    class="btn btn-success btn-sm" data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Paketin Resimlerini Yönet"
                                                    data-bs-content="<?=$veriler[$i]["paketkodu"]?> kodlu paketin resimlerini düzenlemek için tıkla!"><i
                                                        class="fa fa-cloud-upload"></i> </a>
                                                <a onclick="paketSil('<?=SITE?>',<?=$veriler[$i]['ID']?>);"
                                                    style="margin-top: 15px; margin-right: 3px;" id="silmeAlani"
                                                    class="btn btn-danger btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Paketi Kaldır"
                                                    data-bs-content="<?=$veriler[$i]["paketkodu"]?> kodlu paketi kaldırmak için tıkla!"><i
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


<script>
var SITE = '<?=SITE?>paket-sil/<?=$veriler[$i]["ID"]?>';

$(document).on("click", "#silmeAlani", function(e) {
    e.preventDefault();

    swal({
            title: "Silmek istediğinden emin misin?",
            text: "Paketi silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.",
            icon: "warning",
            buttons: ["İptal Et", "Sil"],
            dangerMode: true,
        })
        .then((sil) => {
            if (sil) {

                swal("Harika! Paket başarıyla silindi!", {
                    icon: "success",
                }).then((silindi) => {
                    if (silindi) {
                        window.location = SITE;
                    }

                });

            } else {
                swal("Paketini hala güvende tutuyoruz.", {
                    icon: "info",
                });
            }
        });
});
</script>