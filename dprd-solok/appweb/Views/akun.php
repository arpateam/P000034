<?php
    if (empty($_SESSION['_id_data_akun__'])) {
        echo "<script>window.location = '$base_url';</script>";
        die();
        exit();
    }

    try {
        $stmt  = $pdo->prepare("
                    SELECT judul, gambar
                    FROM page
                    WHERE id_page = ?
                ");

        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e) {
        var_dump($e);
        die();
        exit();
    }
?>

<section class="container-fluid bg-success py-2 text-light">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center my-5">

            <div class="col-lg-12 mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light rounded p-3">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>" class="link-warning fw-bold text-decoration-none"><i class="fa-solid fa-house"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $_SESSION['_nama_lgkp__'] ?></li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-10 mb-5 text-center">
                <h1 class="mb-3 mb-lg-4 fw-bolder text-uppercase text-warning">Halo <?= $_SESSION['_nama_lgkp__'] ?></h1>
            </div>
        </div>
    </div>
</section>