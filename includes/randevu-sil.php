<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("randevular","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/randevular/".$resim))
			{
				unlink("assets/images/randevular/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM randevular","WHERE ID=?",array($ID),1);

			
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>randevular">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="1;url=<?=SITE?>randevular">
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