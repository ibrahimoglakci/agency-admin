<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("banner","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/banner/".$resim))
			{
				unlink("assets/images/banner/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM banner","WHERE ID=?",array($ID),1);

			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>banner-listesi">
<?php
		}
		else
		{
			?>
<meta http-equiv="refresh" content="0;url=<?=SITE?>banner-listesi">
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