<?php
    $hal        = "Bantuan";
    $database   = "bantuan";
    $link       = "bantuan";
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
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#TambahBantuan"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="TambahBantuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= $base_url_admin ?>/addBantuan" method="POST" data-parsley-validate="" class="modal-content">
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
                                            <input type="number" class="form-control" id="urutan" name="___in_urutan" placeholder="Cth: 1" min="1" required="">
                                            <label for="urutan">No Urut</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pertanyaan" name="___in_pertanyaan" placeholder="Cth: Bagaimana Mekanisme Pembayaran di #ARPATEAM?" required="">
                                            <label for="pertanyaan">Pertanyaan</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="jawaban" name="___in_jawaban" placeholder="Cth: This is the third item's accordion body. It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element." style="min-height: 150px" required=""></textarea>
                                            <label for="jawaban">Jawaban</label>
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
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <h4 class="card-header bg-pink">FAQ</h4>
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">

                                <?php
                                    $no     = 1;

                                    try {
                                        $query  = $pdo->prepare("
                                                SELECT *
                                                FROM $database
                                                ORDER BY urutan ASC");
                                        $query->execute();

                                        while($result = $query->fetch(PDO::FETCH_ASSOC)){
                                ?>

                                <div class="card mb-0">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="m-0 position-relative">
                                            <a class="custom-accordion-title text-reset d-block"
                                                data-bs-toggle="collapse" href="#collapse<?= $no ?>"
                                                aria-expanded="true" aria-controls="collapse<?= $no ?>">
                                                #<?= $no." ".$result['pertanyaan'] ?> <i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapse<?= $no ?>" class="collapse <?php if ($no===1) { echo 'show'; } ?>"
                                        aria-labelledby="headingOne"
                                        data-bs-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            <?= $result['jawaban'] ?>
                                            <hr class="my-2">

                                            <a role="button" data-bs-toggle="modal" href="#UbahBantuanFAQ<?= $no ?>" class="link-primary me-1"><i class="fas fa-edit"></i></a>

                                            <a role="button" onclick="confirmHapusBantuan('<?= $result['id_bantuan']; ?>')" class="link-danger"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div id="UbahBantuanFAQ<?= $no ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <form action="<?= $base_url_admin ?>/editBantuan" method="POST" data-parsley-validate="" class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
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
                                                        <input type="number" class="form-control" id="urutan" name="___in_urutan" placeholder="Cth: 1" min="1" value="<?= $result['urutan'] ?>" required="">
                                                        <label for="urutan">No Urut</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 my-1">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="pertanyaan" name="___in_pertanyaan" placeholder="Cth: Bagaimana Mekanisme Pembayaran di #ARPATEAM?" value="<?= $result['pertanyaan'] ?>" required="">
                                                        <label for="pertanyaan">Pertanyaan</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 my-1">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="jawaban" name="___in_jawaban" placeholder="Cth: This is the third item's accordion body. It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element." style="min-height: 150px" required=""><?= $result['jawaban'] ?></textarea>
                                                        <label for="jawaban">Jawaban</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                                <input type="hidden" name="___in_id_bantuan" value="<?= $result['id_bantuan'] ?>">
                                                <button type="submit" name="_submit_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal -->

                                <?php
                                            $no++;
                                        }
                                    }catch(Exception $e){
                                        var_dump($e);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->