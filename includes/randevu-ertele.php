<head>
    <title>Randevu Ertele | <?=$sitebaslik?></title>
</head>
<?php

    if(!empty(intval($_GET["ID"])))
    {
      $ID=$DB->filter($_GET["ID"]);
      
        $veri=$DB->CallData("randevular","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
        if($veri!=false)
        {

            $user=$DB->CallData("kullanicilar","WHERE state=? AND mail=?",array(1,$_SESSION["mail"]),"ORDER BY ID ASC",1);



            if($user[0]["Rank"]=="Yönetici" OR $user[0]["Rank"]=="Web Yazılım Uzmanı" OR $user[0]["Rank"]=="Saha Satış Sorumlusu" OR $user[0]["Rank"]=="Saha Satış Koordinatörü") {

    


?>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Randevu Ertele</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Randevular</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Randevu Ertele</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-12">
                <?php
                    if($_POST)
                    {
                        if(!empty($_POST["randevu_tarihi"]) && !empty($_POST["randevu_saati"]))
                        {
                            
                            $randevu_tarihi=$_POST["randevu_tarihi"];
                            $randevu_saati=$DB->filter($_POST["randevu_saati"]);
                           

       
                                    $ekle=$DB->RunQuery("UPDATE randevular","SET randevu_tarihi=?, randevu_saati=? WHERE ID=?",array($randevu_tarihi,$randevu_saati,$veri[0]["ID"]));
                                        
                                        ?>
                            
                                <?php
                                    
                                    if($ekle!=false)
                            {
                                        ?>
                                        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Randevu başarıyla ertelendi.</div>
                                        <meta http-equiv="refresh" content="1;url=<?=SITE?>randevular">
                                        

                                <?php
                                    }
                                    else {
                                        ?>
                                <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Bilinmeyen bir hata ile karşılaşıldı.</div>
                                <?php
                                    }

                                
                        
                        
                        
                        

                        }
                        else {
                        ?>
                        <div class="alert alert-warning"><i class="fa fa-triangle-exclamation"></i> Lütfen Boş Alanları Doldurunuz!</div>
                        <?php
                        
                            }
                    }
                    
                    ?>
                    <div class="card">

                    
                        
                        <div class="card-header">
                            <div class="card-title">Randevu Ertele</div>
                        </div>

                       


                        <form action="" method="post" class="randevuEklemeFormu" enctype="multipart/form-data">
                            <div class="card-body">
                                

                                

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Randevu Tarihi :</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            
                                            <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                            <?php 
                                    
                                            ?>
                                            <input class="form-control" id="rdate" placeholder="GG/AA/YYYY" type="date" name="randevu_tarihi" value="<?=$veri[0]["randevu_tarihi"]?>">
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    input[type="date"] {
                                    position: relative;
                                    padding: 10px;
                                    }

                                    input[type="date"]::-webkit-calendar-picker-indicator {
                                    color: #ffffff;
                                    background: none;
                                    z-index: 1;
                                    }

                                    input[type="date"]:before {
                                    color: #ffffff;
                                    background: none;
                                    display: block;
                                    font-family: 'FontAwesome';
                                    content: '\f073';
                                    /* This is the calendar icon in FontAwesome */
                                    width: 30px;
                                    height: 30px;
                                    position: absolute;
                                    top: 12px;
                                    right: 0px;
                                    color: #ffffff;
                                    }

                                </style>
                                
                                <div class="row mb-4">
                                <label class="col-md-3 form-label">Randevu Saati :</label>
                                    <div class="col-md-9">
                                            
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <!-- input-group-text -->
                                                    <input class="form-control" id="tpBasic" name="randevu_saati" placeholder="Saat Seç" type="text" value="<?=$veri[0]["randevu_saati"]?>">
                                                </div>
                                            
                                    </div>
                                </div>
                                
                               
                            </div>

                            <div class="card-footer">
                                <!--Row-->
                                <div class="row">
                                <div class="col-md-12">
                                        <button type="submit" name="ekle" class="btn btn-success">Randevu Güncelle</button>
                                    </div>
                                </div>
                                <!--End Row-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /ROW-1 CLOSED -->
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
    
</div>
<!--app-content closed-->


<div class="modal fade" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="modal-title"></h3><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom" id="paketcektablo">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-15p border-bottom-0">Paket Kodu</th>
                                                        <th class="wd-15p border-bottom-0">Paket İsmi</th>
                                                        <th class="wd-15p border-bottom-0">Kategori</th>
                                                        <th class="wd-15p border-bottom-0">Fiyat</th>
                                                        <th class="wd-15p border-bottom-0">İşlem</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="paketlertable">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>







<?php
    }
    else {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
        <?php
    }
}
    }

?>