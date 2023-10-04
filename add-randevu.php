<?php
@session_start();
@ob_start();

define("DATA","data/");
define("PAGE","includes/");
define("CLASSES","class/");
include_once(DATA."connection.php");
define("SITE",$adminURL);
define("ANASITE",$siteURL);

$return=array();



                    if($_POST)
                    {
                        if(!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["gorusme_tarihi"]) && !empty($_POST["randevu_tarihi"]) && !empty($_POST["randevu_saati"]) && !empty($_POST["musteri_adsoyad"]) && !empty($_POST["musteri_email"]) && !empty($_POST["musteri_telefon"]) && !empty($_POST["randevu_not"]))
                        {
                            $kategori=$DB->filter($_POST["kategori"]);
                            $paketkod=$DB->filter($_POST["paketkod"]);
                            $baslik=$DB->filter($_POST["baslik"]);
                            $seflink=$DB->seflink($baslik);
                            $gorusme_tarihi=$_POST["gorusme_tarihi"];
                            $randevu_tarihi=$_POST["randevu_tarihi"];
                            $randevu_saati=$DB->filter($_POST["randevu_saati"]);
                            $musteri_adsoyad=$DB->filter($_POST["musteri_adsoyad"]);
                            $musteri_email=$DB->filter($_POST["musteri_email"]);
                            $musteri_telefon=$DB->filter($_POST["musteri_telefon"]);
                            $randevu_not=$DB->filter($_POST["randevu_not"],true);
                            $kullanici_id=$_SESSION["ID"];

                           
                            

                        $checkpackage=$DB->CallData("randevular","WHERE baslik=?",array($baslik),"ORDER BY ID ASC",1);
                        if($checkpackage!=false) {
                            ?>
                            <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bu randevu zaten eklenmiş.</div>
                            <?php
                            
                        }
                        else {
                            if(!empty($_FILES["resim"]["name"])) {
			                
                                    $yukle=$DB->upload("resim","assets/images/randevular/");
                                    if($yukle!=false)
                                    {
                                        $randevuID =$DB->CallID("randevular");

                                        
                                        $ekle=$DB->RunQuery("INSERT INTO randevular","SET kullanici_id=?, kategori=?, paketkodu=?, baslik=?, seflink=?, gorusme_tarihi=?, randevu_tarihi=?, randevu_saati=?, musteri_adsoyad=?, musteri_email=?, musteri_telefon=?, randevu_not=?, resim=?, durum=?, tarih=?",array($kullanici_id,$kategori,$paketkod,$baslik,$seflink,$gorusme_tarihi,$randevu_tarihi,$randevu_saati,$musteri_adsoyad,$musteri_email,$musteri_telefon,$randevu_not,$yukle,1,date("Y-m-d")));
                                        
                                        
                                    }
                                    else
                                    {
                                        
                                        
                                        ?>
                                        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Resim yüklenemedi.</div>
                                <?php
                                    }
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Randevu başarıyla eklendi.</div>
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }
                                }


                                
                                else {

                                    $ekle=$DB->RunQuery("INSERT INTO randevular","SET kullanici_id=?, kategori=?, paketkodu=?, baslik=?, seflink=?, gorusme_tarihi=?, randevu_tarihi=?, randevu_saati=?, musteri_adsoyad=?, musteri_email=?, musteri_telefon=?, randevu_not=?, durum=?, tarih=?",array($kullanici_id,$kategori,$paketkod,$baslik,$seflink,$gorusme_tarihi,$randevu_tarihi,$randevu_saati,$musteri_adsoyad,$musteri_email,$musteri_telefon,$randevu_not,1,date("Y-m-d")));
                                        
                                        ?>
                            
                                <?php
                                    
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Paket başarıyla eklendi.</div>
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }

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



