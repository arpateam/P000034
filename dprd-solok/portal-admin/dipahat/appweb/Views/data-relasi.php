<?php
    switch ($_GET['act']) {
        case "daftar":
            $hal        = "Hubungan Gejala Dan Penyakit Tanaman Kopi";
            $hal2       = "Data Relasi";
            $database   = "relasi";
            $database2  = "penyakit";
            $database3  = "gejala";
            $link       = "data-relasi";
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h3><?= $hal ?></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url_admin ?>/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addDataRelasi"><i class="fas fa-plus"></i> Tambah <?= $hal2 ?></button>

                    <div id="addDataRelasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form action="<?= $base_url_admin ?>/addDataRelasi" method="POST" data-parsley-validate="" class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Form Tambah <?= $hal ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <h4 class="alert-heading">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg> PERHATIAN!
                                            </h4>
                                            <hr class="my-2">
                                            <ul class="mb-1">
                                                <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="no_urut" name="___in_no_urut" placeholder="Cth: 1" min="1" required="">
                                            <label for="no_urut">No Urut</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="kode_penyakit" name="___in_kode_penyakit" required="">
                                                <option value="">- Pilih Salah Satu -</option>
                                                <?php
                                                    try {
                                                        $no=1;
                                                        $queryPenyakit = $pdo->prepare("
                                                                SELECT *
                                                                FROM $database2
                                                                ORDER BY kode_penyakit ASC");

                                                        $queryPenyakit->execute();
                                                        while($resultPenyakit = $queryPenyakit->fetch(PDO::FETCH_ASSOC)){      
                                                ?>
                                                <option value="<?= $resultPenyakit['kode_penyakit'] ?>"><?= $resultPenyakit['kode_penyakit'] ?> [<?= $resultPenyakit['nama_penyakit'] ?>]</option>
                                                <?php
                                                        }
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                ?>
                                            </select>
                                            <label for="kode_penyakit">Pilih Penyakit</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="kode_gejala" name="___in_kode_gejala" required="">
                                                <option value="">- Pilih Salah Satu -</option>
                                                <?php
                                                    try {
                                                        $no=1;
                                                        $queryGejala = $pdo->prepare("
                                                                SELECT *
                                                                FROM $database3
                                                                ORDER BY kode_gejala ASC");

                                                        $queryGejala->execute();
                                                        while($resultGejala = $queryGejala->fetch(PDO::FETCH_ASSOC)){      
                                                ?>
                                                <option value="<?= $resultGejala['kode_gejala'] ?>"><?= $resultGejala['kode_gejala'] ?> [<?= $resultGejala['nama_gejala'] ?>]</option>
                                                <?php
                                                        }
                                                    } catch (Exception $e) {
                                                        var_dump($e);
                                                    }
                                                ?>
                                            </select>
                                            <label for="kode_gejala">Pilih Gejala</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                    <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Aturan</th>
                                    <th style="width: 35%">Jenis Penyakit</th>
                                    <th style="width: 55%">Gejala</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    try {
                                        $no=1;
                                        $queryData = $pdo->prepare("
                                                SELECT *
                                                FROM $database2
                                                ORDER BY no_urut ASC");

                                        $queryData->execute();
                                        while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){      
                                ?>

                                <tr>
                                    <td>R<?= $resultData['no_urut'] ?></td>
                                    <td class="text-wrap"><strong class="text-pink"><?= $resultData['kode_penyakit'] ?> [<?= $resultData['nama_penyakit'] ?>]</strong></td>
                                    <td class="text-wrap">
                                        <ul class="list-unstyled mb-0">

                                        <?php
                                            try {
                                                $no=1;
                                                $queryData2 = $pdo->prepare("
                                                        SELECT $database.id_relasi, $database.no_urut, $database.kode_penyakit, $database3.kode_gejala, $database3.nama_gejala
                                                        FROM $database
                                                        INNER JOIN $database3 ON $database.kode_gejala = $database3.kode_gejala
                                                        WHERE $database.kode_penyakit = ?
                                                        ORDER BY $database.no_urut ASC");

                                                $queryData2->bindValue(1, $resultData['kode_penyakit']);
                                                $queryData2->execute();
                                                while($resultData2 = $queryData2->fetch(PDO::FETCH_ASSOC)){      
                                        ?>

                                            <li>
                                                <i class="fas fa-arrow-right"></i> <?= $resultData2['kode_gejala'] ?> [<?= $resultData2['nama_gejala'] ?>]
                                                <a role="button" data-bs-toggle="modal" data-bs-target="#UbahDataRelasi<?= $resultData2['id_relasi'] ?>" class="link-primary"><i class="fas fa-edit"></i></a>
                                                <a onclick="confirmHapusDataRelasi('<?= $resultData2['id_relasi']; ?>')" class="link-danger"><i class="fas fa-trash-alt"></i></a>
                                            </li>

                                            <div id="UbahDataRelasi<?= $resultData2['id_relasi'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <form action="<?= $base_url_admin ?>/editDataRelasi" method="POST" data-parsley-validate="" class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Ubah <?= $hal2 ?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row">
                                                            <div class="col-12">
                                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                    <h4 class="alert-heading">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                                        </svg> PERHATIAN!
                                                                    </h4>
                                                                    <hr class="my-2">
                                                                    <ul class="mb-1">
                                                                        <li>Mohon pastikan anda mengisi <em>form</em> dibawah ini dengan lengkap dan benar!</li>
                                                                    </ul>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 my-1">
                                                                <div class="form-floating">
                                                                    <input type="number" class="form-control" id="no_urut" name="___in_no_urut" placeholder="Cth: 1" value="<?= $resultData2['no_urut']; ?>" min="1" required="">
                                                                    <label for="no_urut">No Urut</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 my-1">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="kode_penyakit" name="___in_kode_penyakit" required="">
                                                                        <option value="">- Pilih Salah Satu -</option>
                                                                        <?php
                                                                            try {
                                                                                $no=1;
                                                                                $queryPenyakit = $pdo->prepare("
                                                                                        SELECT *
                                                                                        FROM $database2
                                                                                        ORDER BY no_urut ASC");

                                                                                $queryPenyakit->execute();
                                                                                while($resultPenyakit = $queryPenyakit->fetch(PDO::FETCH_ASSOC)){      
                                                                        ?>
                                                                        <option value="<?= $resultPenyakit['kode_penyakit'] ?>" <?php if ($resultPenyakit['kode_penyakit']===$resultData2['kode_penyakit']) { echo 'selected'; } ?>><?= $resultPenyakit['kode_penyakit'] ?> [<?= $resultPenyakit['nama_penyakit'] ?>]</option>
                                                                        <?php
                                                                                }
                                                                            } catch (Exception $e) {
                                                                                var_dump($e);
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <label for="kode_penyakit">Pilih Penyakit</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 my-1">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="kode_gejala" name="___in_kode_gejala" required="">
                                                                        <option value="">- Pilih Salah Satu -</option>
                                                                        <?php
                                                                            try {
                                                                                $no=1;
                                                                                $queryGejala = $pdo->prepare("
                                                                                        SELECT *
                                                                                        FROM $database3
                                                                                        ORDER BY kode_gejala ASC");

                                                                                $queryGejala->execute();
                                                                                while($resultGejala = $queryGejala->fetch(PDO::FETCH_ASSOC)){      
                                                                        ?>
                                                                        <option value="<?= $resultGejala['kode_gejala'] ?>" <?php if ($resultGejala['kode_gejala']===$resultData2['kode_gejala']) { echo 'selected'; } ?>><?= $resultGejala['kode_gejala'] ?> [<?= $resultGejala['nama_gejala'] ?>]</option>
                                                                        <?php
                                                                                }
                                                                            } catch (Exception $e) {
                                                                                var_dump($e);
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <label for="kode_gejala">Pilih Gejala</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                            <input type="hidden" name="___in_id_relasi" placeholder="Cth: Aldi Febriyanto" value="<?= $resultData2['id_relasi'] ?>">
                                                            <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal -->

                                        <?php
                                                }
                                            } catch (Exception $e) {
                                                var_dump($e);
                                            }
                                        ?>

                                        </ul>
                                    </td>
                                </tr>

                                <?php
                                        }
                                    } catch (Exception $e) {
                                        var_dump($e);
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php
            break;
        default:
            echo "<script>window.location = '404';</script>";
    }
?>