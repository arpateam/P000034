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

<section class="container-fluid py-2 text-light">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-center my-5">

            <div class="col-lg-10 mb-5">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light rounded p-3">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>" class="link-warning fw-bold text-decoration-none"><i class="fa-solid fa-house"></i> Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $result['judul'] ?></li>
                    </ol>
                </nav>
            </div>

            <?php if (empty($_SESSION['_id_data_akun__'])): ?>
                <div class="col-10 my-5">
                    <div class="row mb-5">
                        <div class="col-md-7 col-lg-6 my-auto text-dark text-center">
                            <h1 class="fw-bolder">ANDA BELUM <em>LOGIN</em></h1>
                            <p class="text-light">Silahkan <em>login</em> terlebih dahulu! Agar bisa menggunakan sistem ini!</p>
                            <a class="btn btn-lg btn-warning <?php if($_GET['module']=='galeri-gambar'){ echo 'active'; } ?>" data-bs-toggle="modal" href="#login" role="button"><i class="fa-solid fa-right-to-bracket"></i> LOGIN AKUN</a>
                        </div>
                        <div class="col-md-5 col-lg-6 text-center text-md-end my-auto">
                            <img src="<?= $url_images ?>/pages/<?= $result['gambar'] ?>" alt="Gambar <?= $result['judul'] ?>" class="w-75">
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-10">
                    <?php if (isset($_POST['submit'])): ?>
                        <div class="card">
                            <div class="card-header p-5 text-dark">
                                <h3 class="text-center fw-bolder">GEJALA TANAMAN ANDA</h3>
                                <ol class="lh-sm">
                                    <?php
                                        $countArray     = count($_POST['in_gejala']);
                                        for ($i=0; $i < $countArray; $i++) {
                                            try {
                                                $queryData = $pdo->prepare("
                                                    SELECT *
                                                    FROM gejala
                                                    WHERE kode_gejala = ?
                                                ");

                                                $queryData->bindValue(1, $_POST['in_gejala'][$i]);
                                                $queryData->execute();
                                                $resultData = $queryData->fetch(PDO::FETCH_ASSOC);
                                                echo "<li>".$resultData['nama_gejala']."</li>";
                                            } catch (Exception $e) {
                                                var_dump($e);
                                            }
                                        }
                                    ?>
                                </ol>
                            </div>
                            <div class="card-body text-center p-5 text-dark">
                                <h3 class="text-center fw-bolder">PENYAKTINYA ADALAH:</h3>
                                <?php
                                    
                                    try {
                                        $queryData = $pdo->prepare("
                                                SELECT *
                                                FROM penyakit
                                                ORDER BY no_urut ASC");

                                        $queryData->execute();
                                        while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                            $jml        = 0;
                                            $rule[]     = $resultData['nama_penyakit'];
                                            $KodeP[]    = $resultData['kode_penyakit'];
                                            for ($i=0; $i < $countArray; $i++) {
                                                try {
                                                    $queryData2 = $pdo->prepare("
                                                    SELECT relasi.id_relasi, relasi.no_urut, relasi.kode_penyakit, gejala.kode_gejala, gejala.nama_gejala
                                                    FROM relasi
                                                    INNER JOIN gejala ON relasi.kode_gejala = gejala.kode_gejala
                                                    WHERE relasi.kode_penyakit = ?
                                                    AND relasi.kode_gejala = ?
                                                    ORDER BY relasi.no_urut ASC");

                                                    $queryData2->bindValue(1, $resultData['kode_penyakit']);
                                                    $queryData2->bindValue(2, $_POST['in_gejala'][$i]);
                                                    $queryData2->execute();
                                                    if ($queryData2->rowCount()===1) {
                                                        $resultData2 = $queryData2->fetch(PDO::FETCH_ASSOC);
                                                        $jml+=1;
                                                    }
                                                } catch (Exception $e) {
                                                    var_dump($e);
                                                }
                                            }
                                            $jmlRule[] = $jml;
                                        }
                                    } catch (Exception $e) {
                                        var_dump($e);
                                    }

                                    $value  = max($jmlRule);
                                    $key    = array_search($value, $jmlRule);
                                    
                                ?>

                                <h1 class="fw-bolder text-muted"><?= $rule[$key] ?></h1>
                            </div>
                            <hr class="border border-success" />
                            <div class="card-body px-5 text-dark">
                                <h3 class="text-center fw-bolder">SOLUSI:</h3>

                                <?php
                                    $KPnya  = $KodeP[$key];
                                    try {
                                        $querySolusi = $pdo->prepare("
                                            SELECT solusi
                                            FROM solusi
                                            WHERE kode_penyakit = ?
                                        ");

                                        $querySolusi->bindValue(1, $KPnya);
                                        $querySolusi->execute();
                                        $resultSolusi = $querySolusi->fetch(PDO::FETCH_ASSOC);
                                    } catch (Exception $e) {
                                        var_dump($e);
                                    }
                                ?>

                                <p class="fw-bolder text-muted"><?= $resultSolusi['solusi'] ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-header text-center text-dark p-4">
                                <h4 class="fw-bold mb-0">Mohon Pilih Beberapa Gejala Pada Tanaman Kopi Anda</h4>
                            </div>
                            <form action="<?= $base_url ?>/diagnosis-penyakit" method="POST" class="card-body p-4 text-dark"  data-parsley-validate="">

                                <?php
                                    try {
                                        $queryData = $pdo->prepare("
                                            SELECT *
                                            FROM gejala
                                            ORDER BY no_urut ASC");

                                        $queryData->execute();
                                        while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="in_gejala[]" value="<?= $resultData['kode_gejala'] ?>" id="<?= $resultData['no_urut'] ?>">
                                    <label class="form-check-label fs-5" for="<?= $resultData['no_urut'] ?>">
                                        <?= $resultData['nama_gejala'] ?>
                                    </label>
                                </div>
                                <?php
                                        }
                                    } catch (Exception $e) {
                                        var_dump($e);
                                    }
                                ?>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-lg btn-success mt-4"><i class="fa-solid fa-magnifying-glass"></i> DIAGNOSIS</button>
                                </div>
                            </form>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>

        </div>
    </div>
</section>