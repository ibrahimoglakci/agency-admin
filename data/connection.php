<?php

include_once(CLASSES."class.upload.php");
include_once(CLASSES."DB.php");
$DB=new DB();
$ayarlar=$DB->CallData("ayarlar","WHERE ID=?",array(1),"ORDER BY ID ASC",1);
if($ayarlar!=false)
{
	$sitebaslik=$ayarlar[0]["baslik"];
	$siteanahtar=$ayarlar[0]["anahtar"];
	$siteaciklama=$ayarlar[0]["aciklama"];
	$sitetelefon=$ayarlar[0]["telefon"];
	$sitemail=$ayarlar[0]["mail"];
	$siteadres=$ayarlar[0]["adres"];
	$sitefax=$ayarlar[0]["fax"];
	$siteURL=$ayarlar[0]["url"];
    $adminURL=$ayarlar[0]["adminurl"];
	$sitelat=$ayarlar[0]["lat"];
	$sitelng=$ayarlar[0]["lng"];
}

?>
