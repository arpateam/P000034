<?php
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

<section class="container-fluid bg-success py-5">
    <div class="row justify-content-center py-5">
        <div class="col-md-10 col-lg-8 col-xl-5">
            <div class="card bg-transparent rounded-0">
                <img src="<?= $url_images ?>/pages/<?= $result['gambar'] ?>" alt="Gambar <?= $result['judul'] ?>" class="w-100">
            </div>
        </div>
    </div>
</section>