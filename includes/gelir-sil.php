<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("siparisgelir","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["ek_dosya"];
			if(file_exists("assets/images/gelirler/".$resim))
			{
				unlink("assets/images/gelirler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM siparisgelir","WHERE ID=?",array($ID),1);

			
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>gelirler">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>gelirler">
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