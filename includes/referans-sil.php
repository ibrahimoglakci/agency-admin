<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("referans_musteriler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/referanslar/".$resim))
			{
				unlink("assets/images/referanslar/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM referans_musteriler","WHERE ID=?",array($ID),1);

			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>referanslar">
<?php
		}
		else
		{
			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>referanslar">
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