<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("siparisler","WHERE `ID`=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/siparisler/".$resim))
			{
				unlink("assets/images/siparisler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM siparisler","WHERE `ID`=?",array($ID),1);

			
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>bekleyen-siparisler">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>bekleyen-siparisler">
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