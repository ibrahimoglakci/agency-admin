<?php
@session_destroy();
@ob_end_flush();
?>
<head>
    <title>Çıkış Yapılıyor... <?=$sitebaslik?></title>
</head>
<meta http-equiv="refresh" content="2;url=<?=SITE?>giris-yap" />
<?php

exit();
?>

