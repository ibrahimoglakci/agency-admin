<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("paketler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/paketler/".$resim))
			{
				unlink("assets/images/paketler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM paketler","WHERE ID=?",array($ID),1);

			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>paket-listesi">
<?php
		}
		else
		{
			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>paket-listesi">
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