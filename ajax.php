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


if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && $_FILES && !empty($_FILES["file"]["tmp_name"]))
	{

		 $tablo=$DB->filter($_POST["tablo"]);
   		 $ID=$DB->filter($_POST["ID"]);
   		 $resim=$DB->uploadMulti("file",$tablo,$ID,"assets/images/resimler/".$tablo."/");
}

if($_POST)
{
	
	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["durum"]))
	{
		$tablo=$DB->filter($_POST["tablo"]);
		$ID=$DB->filter($_POST["ID"]);
		$durum=$DB->filter($_POST["durum"]);
		$guncelle=$DB->RunQuery("UPDATE ".$tablo,"SET durum=? WHERE ID=?",array($durum,$ID),1);
		if($guncelle!=false)
		{
			echo "TAMAM";
		}
		else
		{
			echo "HATA";
		}
	}
	else
	{
		echo "BOS";
	}

	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["ifiyat"]))
	{
		$tablo=$DB->filter($_POST["tablo"]);
		$ID=$DB->filter($_POST["ID"]);
		$ifiyat=$DB->filter($_POST["ifiyat"]);
		$guncellefiyat=$DB->RunQuery("UPDATE ".$tablo,"SET ifiyat=? WHERE ID=?",array($ifiyat,$ID),1);
		if($guncellefiyat!=false)
		{
			echo "TAMAMFIYAT";
		}
		else
		{
			echo "HATAFIYAT";
		}
	}
	else
	{
		echo "BOSFIYAT";
	}

	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["state"]))
	{
		$tablo=$DB->filter($_POST["tablo"]);
		$ID=$DB->filter($_POST["ID"]);
		$state=$DB->filter($_POST["state"]);
		$guncellekategori=$DB->RunQuery("UPDATE ".$tablo,"SET state=? WHERE ID=?",array($state,$ID),1);
		if($guncellekategori!=false)
		{
			echo "TAMAMKATEGORI";
		}
		else
		{
			echo "HATAKATEGORI";
		}
	}
	else
	{
		echo "BOSKATEGORI";
	}


	
	
}
?>