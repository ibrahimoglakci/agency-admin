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

$siparisreturn=array();

$starreturn=array();

$islemtipi=$DB->filter($_POST['islemtipi']);




if($_POST){

    switch ($islemtipi) {
        case 'paketcek':
            
                $paketkodu=$_POST["paketkodu"];
                
                $callpaket=$DB->CallData("paketler","WHERE paketkodu=?",array($paketkodu),"ORDER BY ID ASC",1);
                $paketkategori=$DB->CallData("categories","WHERE ID=?",array($callpaket[0]["kategori"]),"ORDER BY ID ASC",1);

                if($callpaket!=false)
                {
                    $return["durum"]='ok';
                    $return['paketkod']=$callpaket[0]["paketkodu"];
                    $return['paketismi']=$callpaket[0]["baslik"];
                    $return['paketseflink']=$callpaket[0]["seflink"];
                    if($paketkategori!=false)
                    {
                    $return['kategori']=$paketkategori[0]["title"];
                    }
                    $return['fiyat']=$callpaket[0]["fiyat"];
                    $return['indirimlifiyat']=$callpaket[0]["indirimlifiyat"];
                    $return['ifiyat']=$callpaket[0]["ifiyat"];
                    $return['islem']=$callpaket[0]["seflink"];

                    echo json_encode($return);
                }
                else
                {
                    $return["durum"]='no';
                    echo json_encode($return);
                }
            


            break;

        case 'siparisguncelle':
            $sipariskodu=$_POST["sipariskodu"];
            $siparisdurum=$_POST["siparisdurum"];
            $siparis=$DB->CallData("siparisler","WHERE siparis_kodu=?",array($sipariskodu),"ORDER BY ID ASC",1);
            if($siparis!=false) {
                $changedurum=$DB->RunQuery("UPDATE siparisler","SET siparis_durumu=? WHERE siparis_kodu=?",array($siparisdurum,$sipariskodu));
                if($changedurum!=false) {
                    $siparisreturn['islem']='ok';

                    echo json_encode($siparisreturn);
                }
            }

            break;

        case 'postayildizla':

            $postaID=$_POST["postaID"];

            $postacheck=$DB->CallData("postakutusu","WHERE ID=?",array($postaID),"ORDER BY tarih ASC",1);

            if($postacheck!=false) {
                $postastar = $postacheck[0]["starred"];

                if($postastar==0) {
                    $yildizla=$DB->RunQuery("UPDATE postakutusu","SET starred=? WHERE ID=?",array(1,$postaID));
                    if($yildizla!=false) {
                        $starreturn['durum']="yildizlandi";
                        echo json_encode($starreturn);
                    }
                }
                if($postastar==1) {
                    $cikar=$DB->RunQuery("UPDATE postakutusu","SET starred=? WHERE ID=?",array(0,$postaID));
                    if($cikar!=false) {
                        $starreturn['durum']="cikarildi";

                        echo json_encode($starreturn);
                    }
                }
            }

            break;

        
        
        default:
            # code...
            break;
    }

    

}
				   






