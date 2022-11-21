<?php
    switch ($_GET['act']) {
        case "daftar":
            $hal        = "Daftar Data Gejala";
            $hal2       = "Data Gejala";
            $database   = "gejala";
            $link       = "data-gejala";
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
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addDataGejala"><i class="fas fa-plus"></i> Tambah <?= $hal2 ?></button>

                    <div id="addDataGejala" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <form action="<?= $base_url_admin ?>/addDataGejala" method="POST" data-parsley-validate="" class="modal-content">
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

                                    <div class="col-md-4 my-1">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="no_urut" name="___in_no_urut" placeholder="Cth: 1" min="1" required="">
                                            <label for="no_urut">No Urut</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="kode_gejala" name="___in_kode_gejala" placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="kode_gejala">Kode Gejala</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nama_gejala" name="___in_nama_gejala" placeholder="Cth: Aldi Febriyanto" required="">
                                            <label for="nama_gejala">Nama Gejala</label>
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
                                    <th style="width: 10%">No. Urut</th>
                                    <th style="width: 20%">Kode Gejala</th>
                                    <th>Nama Gejala</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no=1;
                                    $queryData = $pdo->prepare("
                                            SELECT *
                                            FROM $database
                                            ORDER BY no_urut ASC");

                                    $queryData->execute();
                                    while($resultData = $queryData->fetch(PDO::FETCH_ASSOC)){
                                        
                                ?>

                                <tr>
                                    <td><?= $resultData['no_urut'] ?></td>
                                    <td><strong class="text-pink"><?= $resultData['kode_gejala'] ?></strong></td>
                                    <td class="text-wrap"><?= $resultData['nama_gejala'] ?></td>
                                    <td>
                                        <a role="button" data-bs-toggle="modal" data-bs-target="#UbahDataGejala<?= $resultData['kode_gejala'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Ubah</a>
                                        <a onclick="confirmHapusDataGejala('<?= $resultData['kode_gejala']; ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>

                                        <div id="UbahDataGejala<?= $resultData['kode_gejala'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <form action="<?= $base_url_admin ?>/editDataGejala" method="POST" data-parsley-validate="" class="modal-content">
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

                                                        <div class="col-md-4 my-1">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" id="no_urut" name="___in_no_urut" placeholder="Cth: 1" value="<?= $resultData['no_urut'] ?>" min="1" required="">
                                                                <label for="no_urut">No Urut</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 my-1">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="kode_gejala" name="___in_kode_gejala" placeholder="Cth: Aldi Febriyanto" value="<?= $resultData['kode_gejala'] ?>" required="">
                                                                <label for="kode_gejala">Kode Gejala</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 my-1">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="nama_gejala" name="___in_nama_gejala" placeholder="Cth: Aldi Febriyanto" value="<?= $resultData['nama_gejala'] ?>" required="">
                                                                <label for="nama_gejala">Nama Gejala</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                        <input type="hidden" name="___in_kode_gejala_lama" placeholder="Cth: Aldi Febriyanto" value="<?= $resultData['kode_gejala'] ?>">
                                                        <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>

                                <?php } ?>
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