<?php
    switch ($_GET['act']) {
        default:
            $hal        = "Data Akun";
            $database   = "data_akun";
            $link       = "data-akun";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <h3><?= $hal ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                </ol>
            </nav>
        </div>

        <div class="row mt-3 justify-content-center">
            <!--Pricing Column-->
            <?php
                $query = $pdo->query("
                        SELECT *
                        FROM $database
                        ORDER BY tgl_daftar DESC");
                while($result = $query->fetch(PDO::FETCH_ASSOC)){
            ?>

            <div class="col-xl-4">
                <div class="card">
                    <div class="text-center card-body">
                        <div>
                            <h2 class="text-light"><?= $result['nama_lgkp'] ?></h2>
                            <p class="text-muted mb-0"><em><i class="fas fa-venus-mars"></i> <?= $result['jk'] ?></em></p>
                            <p class="text-muted mb-0"><em><i class="fas fa-envelope-open-text"></i> <?= $result['email'] ?></em></p>
                            <p class="text-muted"><em><i class="fas fa-user-tie"></i> <?= $result['pekerjaan'] ?></em></p>

                            <small class="text-secondary"><i class="fas fa-info-circle"></i> Tanggal Daftar: <?= indoTglWithTime($result['tgl_daftar']) ?></small>
                            <br />
                            <small class="text-secondary"><i class="fas fa-info-circle"></i> Terakhir Login: <?= indoTglWithTime($result['terakhir_login']) ?></small>

                            <hr>

                            <span class="badge bg-success p-1 text-wrap"><?= $result['alamat'] ?></span>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <?php } ?>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php } ?>