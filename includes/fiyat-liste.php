<head>

    <title>Fiyat Listesi | <?= $sitebaslik ?></title>

</head>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Fiyat Listesi</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Fiyatlar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fiyat Listesi</li>
                    </ol>
                </div>

            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="fiyat-tablo" class="table table-bordered text-nowrap border-bottom">
                                    <thead>
                                        <tr>


                                            <th class="border-bottom-0">Paket Kodu</th>
                                            <th class="border-bottom-0">Paket Adı</th>
                                            <th class="border-bottom-0">Paket Kategorisi</th>
                                            <th class="border-bottom-0">Paket Fiyatı</th>
                                            <th class="border-bottom-0">Paket İndirimli Fiyatı</th>
                                            <th class="border-bottom-0">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>



                                        <?php
                                        $fiyatlar = $DB->CallData("paketler", "WHERE durum=?", array(1), "ORDER BY ID ASC");
                                        if ($fiyatlar != false) {
                                            for ($i = 0; $i < count($fiyatlar); $i++) {
                                                $kategori = $DB->CallData("categories", "WHERE ID=?", array($fiyatlar[$i]["kategori"]), "ORDER BY ID ASC", 1);
                                        ?>
                                                <tr>
                                                    <td><span class="badge bg-info badge-sm  me-1 mb-1 mt-1"><?= $fiyatlar[$i]["paketkodu"]; ?></span> </td>
                                                    <td><?= $fiyatlar[$i]["baslik"]; ?></td>
                                                    <td><?= $kategori[0]["title"]; ?></td>
                                                    <td><span class="badge bg-success badge-large  me-1 mb-1 mt-1"><?= $fiyatlar[$i]["fiyat"]; ?>₺</span></td>
                                                    <td><span class="badge bg-primary badge-large  me-1 mb-1 mt-1"><?= $fiyatlar[$i]["indirimlifiyat"]; ?>₺</span></td>
                                                    <td style="display: inline-block; ">
                                                            <a href="<?= SITE ?>paket-detay/<?= $fiyatlar[$i]["ID"] ?>" style="margin-right: 3px;" class="btn btn-warning btn-sm " data-bs-toggle="popover" data-bs-trigger="hover" title="Geliri Düzenle" data-bs-content="#<?= $veriler[$i]["paketkodu"] ?> numaralı paketi görmek için tıkla!"><i class="fa fa-eye" style="color: #000"></i>
                                                            </a>
                                                           
                                                        </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>





                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>