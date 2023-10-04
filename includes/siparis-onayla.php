<?php
if(!empty($_GET["ID"]))
{
	$ID=$DB->filter($_GET["ID"]);
	
		$veri=$DB->CallData("siparisler","WHERE ID=? AND onizleme_durum=?",array($ID,0),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			
			$onayla=$DB->RunQuery("UPDATE siparisler","set onizleme_durum=?, siparis_durumu=? WHERE ID=?",array(1,"Sipariş Hazırlanıyor",$ID),1);

			
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