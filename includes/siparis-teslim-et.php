<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("siparisler","WHERE ID=? AND onizleme_durum=?",array($ID,1),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			
			$teslimet=$DB->RunQuery("UPDATE siparisler","set siparis_durumu=? WHERE ID=?",array("Teslim Edildi",$ID),1);

			
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>onaylanan-siparisler">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>onaylanan-siparisler">
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