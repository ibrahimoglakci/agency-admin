<head>
    <title>
        Referanslar Listesi | <?=$sitebaslik?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Referanslar Listesi</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Referanslar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Referanslar Listesi</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Referanslar Listesi</h3>
                            <div class="col-md-11">
                                <a href="<?=SITE?>referans-ekle" class="btn btn-pink"
                                    style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                    YENİ
                                    EKLE</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="ref-tablo" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">Durum</th>
                                            <th class="border-bottom-0">ID</th>
                                            <th class="border-bottom-0">Başlık</th>
                                            <th class="border-bottom-0">Kategori</th>
                                            <th class="border-bottom-0">Link</th>
                                            <th class="border-bottom-0">Resim</th>
                                            <th class="border-bottom-0">Sıra Numarası</th>
                                            <th class="border-bottom-0">Tarih</th>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
				$veriler=$DB->CallData("referans_musteriler","","","ORDER BY ID ASC");
				if($veriler!=false)
				{
                    $sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
                        $sira++;
                        $kategori=$DB->CallData("categories","WHERE ID=?",array($veriler[$i]["kategori"]),"ORDER BY ID ASC",1);
						if($veriler[$i]["durum"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}

						?>
                                        <tr>
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                        class="custom-control-input aktifpasif<?=$veriler[$i]['ID']?>"
                                                        id="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]['ID']?>"
                                                        <?=$aktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                        onclick="aktifpasif(<?=$veriler[$i]['ID']?>,'referans_musteriler');">
                                                    <label class="label-success"
                                                        for="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>
                                            </td>

                                            <td><?=$veriler[$i]["ID"]?></td>
                                            <td><?=stripslashes($veriler[$i]["musteri_adi"])?></td>
                                            <td><?=stripslashes($kategori[0]["title"])?></td>
                                            <?php if($veriler[$i]["link"]==NULL) { $link='<span class="badge bg-danger badge-sm  me-1 mb-1 mt-1"> Link Yüklenmedi</span>';} else {$link=$veriler[$i]["link"];}?>
                                            <td><?=stripslashes($link)?></td>

                                            <?php if($veriler[$i]["resim"]!=NULL) { ?>
                                            <td><img src="<?=SITE?>assets/images/referanslar/<?=$veriler[$i]["resim"]?>" style="height: 60px; width: auto; margin-right: 8px; float: left;"></td>
                                            <?php } else { ?>
                                            <td>Resim Bulunmamaktadır.</td>
                                            <?php } ?>
                                            <td><?=$sira?></td>
                                            <td><?=$veriler[$i]["tarih"]?></td>
                                            <td style="display: inline-block; ">
                                                <a href="<?=SITE?>banner-duzenle/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-top: 15px; margin-right: 3px;"
                                                    class="btn btn-warning btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Referansı Düzenle"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu referansı düzenlemek için tıkla!"><i
                                                        class="fa fa-cog"></i>
                                                </a>
                                                
                                                <a onclick="referansSil('<?=SITE?>',<?=$veriler[$i]['ID']?>);"
                                                    style="margin-top: 15px; margin-right: 3px;" id="silmeAlani"
                                                    class="btn btn-danger btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Referansı Sil"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu referansı kaldırmak için tıkla!"><i
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
var SITE = '<?=SITE?>referans-sil/<?=$veriler[$i]["ID"]?>';

$(document).on("click", "#silmeAlani", function(e) {
    e.preventDefault();

    swal({
            title: "Silmek istediğinden emin misin?",
            text: "Ürününü silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.",
            icon: "warning",
            buttons: ["İptal Et", "Sil"],
            dangerMode: true,
        })
        .then((sil) => {
            if (sil) {

                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                }).then((silindi) => {
                    if (silindi) {
                        window.location = SITE;
                    }

                });

            } else {
                swal("Ürününü hala güvende tutuyoruz.", {
                    icon: "info",
                });
            }
        });
});
</script>