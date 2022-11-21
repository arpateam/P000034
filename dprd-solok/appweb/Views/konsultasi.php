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
                <h1 class="fw-bolder text-uppercase text-dark">Selamat Datang di Website <?= $nama_web ?></h1>
                <h3 class="mb-3 mb-lg-4 fw-bolder text-uppercase text-dark">(<?= $slogan ?>)</h3>
                <h4 class="text-muted">Jika ada sesuatu hal yang ingin ditanyakan, silahkan konsultasikan dengan mengisi <em>form</em> dibawah ini!</h4>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-md-7 col-lg-6 mb-3 mb-md-0 text-dark">
                        <form action="<?= $base_url ?>/addKonsultasi" method="POST" data-parsley-validate="">
                            <div class="card pt-4">
                                <div class="card-title text-center">
                                    <h3 class="fw-bolder"><em>Form</em> Konsultasi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nama_lgkp" name="___in_nama_lgkp" placeholder="Cth: Aldi Febriyanto" required="">
                                        <label for="nama_lgkp">Nama Lengkap</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="___in_pesan" placeholder="Masukkan Pesan anda..." style="min-height: 150px;" required=""></textarea>
                                        <label for="pesan">Pesan</label>
                                    </div>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <button type="submit" name="_submit_" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i> KIRIM</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-6 text-center text-md-end my-auto">
                        <img src="<?= $url_images ?>/pages/<?= $result['gambar'] ?>" alt="Gambar <?= $result['judul'] ?>" class="w-75">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>