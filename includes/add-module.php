<head>
    <title>Modül Ekle | <?=$sitebaslik?></title>
</head>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Modül Ekle</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Modül Ekle</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modül Ekle</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?php 
                if($_POST) {
                    $run=$DB->AddModule();
                    if($run!=false) {
                    echo '<div class="alert alert-success" style="font-size: 18px;"><i class="fas fa-check-circle" style="font-size: 20px;"></i> Module has been successfully added.</div>';
                    ?>
                    <meta http-equiv="refresh" content="2;url=<?=SITE?>">
                    <?php
                    }
                    else {
                    echo '<div class="alert alert-danger"style="font-size: 18px;"><i class="fas fa-times-circle" style="font-size: 20px;"></i> Warning! An unexpected problem was encountered while creating a module.</div>';
                    }
                }

            ?>


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Modül Ekle</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Başlık</label>
                                <input type="text" class="form-control" name="title" placeholder="Modül İsmi Giriniz">
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="state" value="1" checked="checked">
                                <label class="form-check-label" for="exampleCheck1">Aktif Yap?</label>
                            </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Modül Ekle</button>
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