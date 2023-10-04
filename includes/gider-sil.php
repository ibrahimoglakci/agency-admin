<?php
if(!empty($_GET["ID"]) && !empty($_GET["kategori"]))
{
	$ID=$DB->filter($_GET["ID"]);
	$kategori=$DB->filter($_GET["kategori"]);

	if($kategori=="siparis-gideri") {
		$veri=$DB->CallData("siparisgider","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		$tablo='siparisgider';
	}
	else if($kategori=="sirket-gideri") {
		$veri=$DB->CallData("sirketgider","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		$tablo='sirketgider';
	}
	
		
		if($veri!=false)
		{
			$resim=$veri[0]["ek_dosya"];
			if(file_exists("assets/images/giderler/".$resim))
			{
				unlink("assets/images/giderler/".$resim);
			}
			$sil=$DB->RunQuery("DELETE FROM ". $tablo ."","WHERE ID=?",array($ID),1);

			
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>giderler">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>giderler">
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