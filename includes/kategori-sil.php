<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("categories","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("assets/images/kategoriler/".$resim))
			{
				unlink("assets/images/kategoriler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM categories","WHERE ID=?",array($ID),1);

			
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kategoriler">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kategoriler">
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