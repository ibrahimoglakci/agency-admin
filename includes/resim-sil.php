<?php
if(!empty($_GET["silinecekID"]))
{
	$ID=$DB->filter($_GET["silinecekID"]);
	$tablo=$DB->filter($_GET["tablo"]);
	
		$veri=$DB->CallData("resimler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/resimler/".$resim))
			{
				unlink("assets/images/resimler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM resimler","WHERE ID=?",array($ID),1);
			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>resimler/<?=$_GET["tablo"]?>/<?=$_GET["ID"]?>">
<?php
		}
		else
		{
			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>resimler/<?=$_GET["tablo"]?>/<?=$_GET["ID"]?>">
<?php
		}
}
else
{
	?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>">
<?php
}
 ?>