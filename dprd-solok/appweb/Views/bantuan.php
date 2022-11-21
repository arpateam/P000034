<?php
    try {
        $stmt  = $pdo->prepare("
                SELECT judul, gambar, img_share, deskripsi, slug, tgl_update
                FROM page
                WHERE id_page = ?");

        $stmt->bindValue(1, $_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e) {
        var_dump($e);
        die();
        exit();
    }
?>

<section class="container-fluid py-2 text-muted">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center my-5">

            <div class="col-lg-12 mb-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light rounded p-3">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>" class="link-warning fw-bold text-decoration-none"><i class="fa-solid fa-house"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $result['judul'] ?></li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-10 mb-5 text-center">
                <h1 class="mb-3 mb-lg-4 fw-bolder text-uppercase text-dark">Senang Rasanya Bisa Membantu</h1>
                <h4 class="text-muted">Silahkan baca beberapa pertanyaan dibawah ini jika Anda masih binggung dengan sistem <?= $nama_web ?></h4>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-md-7 col-lg-6 mb-5 mb-md-0 text-dark">
                        <div class="accordion my-5" id="BANTUAN" data-aos="fade-in" data-aos-duration="2000">
                            <?php
                                try{
                                    $no=1;
                                    $stmtBANTUAN = $pdo->prepare("
                                            SELECT id_bantuan, pertanyaan, jawaban
                                            FROM bantuan
                                            ORDER BY urutan ASC
                                    ");

                                    $stmtBANTUAN->execute();
                                    while($resultBANTUAN = $stmtBANTUAN->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $no ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#BANTUAN<?= $no ?>" aria-expanded="true" aria-controls="BANTUAN<?= $no ?>">
                                        #<?= $no." ".$resultBANTUAN['pertanyaan'] ?>
                                    </button>
                                </h2>
                                <div id="BANTUAN<?= $no ?>" class="accordion-collapse collapse <?php if($no===1){ echo 'show'; } ?>" aria-labelledby="heading<?= $no ?>" data-bs-parent="#BANTUAN">
                                    <div class="accordion-body">
                                        <?= $resultBANTUAN['jawaban'] ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        $no++;
                                    }
                                }catch(Exception $e){
                                    var_dump($e);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6 text-center text-md-end my-auto">
                        <img src="<?= $url_images ?>/pages/<?= $result['gambar'] ?>" alt="Gambar <?= $result['judul'] ?>" class="w-75">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>