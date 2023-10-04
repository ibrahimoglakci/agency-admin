<?php
date_default_timezone_set('Europe/Istanbul');


?>

<head>
    <title>
        Siparişler | <?=$sitebaslik?>
    </title>
</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Siparişler</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Siparişler</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siparişler</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Siparişler</h3>
                            <div class="col-md-11">
                                <a href="<?=SITE?>siparis-ekle" class="btn btn-pink"
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
                                            
                                            <th class="border-bottom-0">Sipariş Kodu</th>
                                            <th class="border-bottom-0">Müşteri Ad Soyad</th>
                                            <th class="border-bottom-0">Müşteri Telefon</th>
                                            <th class="border-bottom-0">Paket Kodu</th>
                                            <th class="border-bottom-0">Paket Kategori</th>
                                            <th class="border-bottom-0">Sipariş Durumu</th>
                                            <th class="border-bottom-0">Sipariş Notu</th>
                                            <th class="border-bottom-0">Takip No</th>
                                            <th class="border-bottom-0">İşlem</th>
                                            <th class="border-bottom-0">Tarih & Saat</th>
                                            <th class="border-bottom-0">Müşteri Adres</th>
                                            
                                            

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
				$veriler=$DB->CallData("siparisler","","","ORDER BY ID ASC");
				if($veriler!=false)
				{
					$sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
						$sira++;
                        setlocale(LC_ALL, 'tr_TR.UTF-8');
                        
                       

                        $nowdate=strtotime($veriler[$i]["tarih"]);
                        $today = date("H:i:s / d M Y",$nowdate);

                        $tarih=$DB->convertMonthToTurkishCharacter($today);


                       $kategori=$DB->CallData("categories","WHERE ID=?",array($veriler[$i]["paket_kategori"]),"ORDER BY ID ASC",1);

                       if($veriler[$i]["onizleme_durum"]==0) {
                        $siparisbgcolor="rgba(253, 166, 0, 0.19)";

                       }
                       else if($veriler[$i]["onizleme_durum"]==2) {
                        $siparisbgcolor="rgba(255, 0, 3, 0.38)";

                       }
                       else {
                        $siparisbgcolor="transparent";
                        }

                      
						
						?>
                                        <tr style="background-color: <?=$siparisbgcolor?>">
                                            
                                            <td>
                                                <div class="material-switch ">
                                                    <input type="checkbox"
                                                        class="custom-control-input aktifpasif<?=$veriler[$i]['ID']?>"
                                                        id="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]['ID']?>"
                                                        <?=$aktifpasif?> value="<?=$veriler[$i]['ID']?>"
                                                        onclick="aktifpasif(<?=$veriler[$i]['ID']?>,'siparisler');">
                                                    <label class="label-success"
                                                        for="someSwitchOptionSuccess customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                                                </div>
                                            </td>

                                            
                                            <td><?=stripslashes($veriler[$i]["baslik"])?></td>
                                            

                                            <td><?=mb_substr(strip_tags(stripslashes($veriler[$i]["randevu_not"])), 0,10,"UTF-8")?>...</td>
                                            <td><?=$veriler[$i]["musteri_adsoyad"]?></td>
                                            <td><?=$veriler[$i]["musteri_telefon"]?></td>
                                            <td><?= $kategori[0]["title"]?> </td>
                                            <td><?=$gorusme_tarihi?></td>
                                            <td style="color: <?=$randevucolor?>"><?=$randevu_tarihi?></td>
                                            <td><?=$randevusaati?> </td>
                                            <td style="color: <?=$randevucolor?>"><?= $randevuday?> </td>
                                            <td><?=$veriler[$i]["paketkodu"]?></td>
                                            <td><?=$veriler[$i]["musteri_adress"]?></td>
                                            
                                            
                                            
                                            




                                            
                                            <td><?=$veriler[$i]["tarih"]?></td>
                                            <td style="display: inline-block; ">
                                                <a href="<?=SITE?>randevu-duzenle/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-right: 3px;"
                                                    class="btn btn-warning btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Randevuyu Düzenle"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> numaralı randevuyu düzenlemek için tıkla!"><i
                                                        class="fa fa-cog"></i>
                                                </a>
                                                <a href=" <?=SITE?>randevu-ertele/<?=$veriler[$i]["ID"]?>"
                                                    style="margin-right: 3px;"
                                                    class="btn btn-success btn-sm" data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Randevuyu Ertele"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> numaralı randevuyu ertelemek için tıkla!"><i
                                                        class="fa fa-calendar-plus-o"></i> </a>
                                                <a onclick="randevuSil('<?=SITE?>',<?=$veriler[$i]['ID']?>);"
                                                    style="margin-right: 3px;" id="silmeAlani"
                                                    class="btn btn-danger btn-sm " data-bs-toggle="popover"
                                                    data-bs-trigger="hover" title="Randevuyu Kaldır"
                                                    data-bs-content="<?=$veriler[$i]["ID"]?> numaralı randevuyu kaldırmak için tıkla!"><i
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
var SITE = '<?=SITE?>randevu-sil/<?=$veriler[$i]["ID"]?>';

$(document).on("click", "#silmeAlani", function(e) {
    e.preventDefault();

    swal({
            title: "Silmek istediğinden emin misin?",
            text: "Randevuyu silmek üzeresin! Eğer silmek istediğinden eminsen 'Sil' butonuna tıkla.",
            icon: "warning",
            buttons: ["İptal Et", "Sil"],
            dangerMode: true,
        })
        .then((sil) => {
            if (sil) {

                swal("Harika! Randevu başarıyla silindi!", {
                    icon: "success",
                }).then((silindi) => {
                    if (silindi) {
                        window.location = SITE;
                    }

                });

            } else {
                swal("Randevu hala güvende tutuyoruz.", {
                    icon: "info",
                });
            }
        });
});
</script>