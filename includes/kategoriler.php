<head>
    <title>
        Kategoriler | <?=$sitebaslik?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Kategoriler</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Kategoriler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategoriler</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kategoriler</h3>
                            <div class="col-md-11">
                                <a href="<?=SITE?>kategori-ekle" class="btn btn-pink"
                                    style="float:right; margin-bottom:10px;"><i class="fa fa-plus-circle"></i>
                                    YENİ
                                    EKLE</a>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">Durum</th>
                                            <th class="border-bottom-0">ID</th>
                                            <th class="border-bottom-0">Başlık</th>
                                            <th class="border-bottom-0">Tablo</th>
                                            <th class="border-bottom-0">Tarih</th>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
				$veriler=$DB->CallData("categories","","","ORDER BY ID ASC");
				if($veriler!=false)
				{
					for($i=0;$i<count($veriler);$i++)
					{
                       
						if($veriler[$i]["state"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}
						?>
                                        <tr>
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                        class="custom-control-input kategoriaktifpasif<?=$veriler[$i]['ID']?>"
                                                        id="someSwitchOptionSuccess kategoricustomSwitch3<?=$veriler[$i]['ID']?>"
                                                        <?=$aktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                        onclick="kategoriaktifpasif(<?=$veriler[$i]['ID']?>,'categories');">
                                                    <label class="label-success"
                                                        for="someSwitchOptionSuccess kategoricustomSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>
                                            </td>

                                            <td><?=$veriler[$i]["ID"]?></td>
                                            <td><?=stripslashes($veriler[$i]["title"])?></td>
               
                                            <td><?= $veriler[$i]["tables"]?></td>
                                            <td><?=$veriler[$i]["date"]?></td>
                                            <td style="display: inline-block; ">
                                                <a href="<?=SITE?>kategori-duzenle/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-top: 15px; margin-right: 3px;"
                                                    class="btn btn-warning btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Kategoriyi Düzenle"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu kategoriyi düzenlemek için tıkla!"><i
                                                        class="fa fa-cog"></i>
                                                </a>
                                                
                                                <a onclick="kategoriSil('<?=SITE?>',<?=$veriler[$i]['ID']?>);"
                                                    style="margin-top: 15px; margin-right: 3px;" id="silmeAlani"
                                                    class="btn btn-danger btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Kategoriyi Sil"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> kodlu kategoriyi kaldırmak için tıkla!"><i
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
var SITE = '<?=SITE?>kategori-sil/<?=$veriler[$i]["ID"]?>';

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