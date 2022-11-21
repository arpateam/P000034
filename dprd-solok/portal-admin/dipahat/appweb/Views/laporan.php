<?php
    switch ($_GET['act']) {
        case "edit-berita":
            $hal                = "Berita";
            $penyimpananGambar  = "$base_url/assets/files/images/berita";
            $database           = "berita";
            $link               = "berita";

            $query  = $pdo->query("
                    SELECT *
                    FROM $database
                    WHERE slug='$_GET[slug]'");
            $rows   = $query->rowCount();

            if ($rows>0) {
                $result     = $query->fetch(PDO::FETCH_ASSOC);
            }else{
                echo "<script>window.location.href = '$base_url_admin/$link';</script>";
                die();
                exit();
            }
?>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="container">
            <h3><?= $result['judul'] ?></h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $hal ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $result['judul'] ?></li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="<?= $base_url_admin ?>/editBerita" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Ubah <?= $hal ?></h4>
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
                                            <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                            <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="col-md-12 my-1">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Lorem ipsum dolor sit amet" value="<?= $result['judul'] ?>" required="">
                                        <label for="judul">Judul <?= $hal ?></label>
                                    </div>
                                </div>

                                <!-- file preview template -->
                                    <div class="col-12 my-3">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-default-file="<?= $penyimpananGambar ?>/<?= $result['gambar'] ?>" data-height="450" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>
                                <!-- file preview template -->

                                <div class="col-12 my-2">
                                    <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test"><?= $result['deskripsi'] ?></textarea>
                                </div><!-- end col -->

                                <div class="col-12 my-1">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="slug-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#slug-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="slug-<?= $result['slug']; ?>" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                            <button class="nav-link" id="keywords-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#keywords-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="keywords-<?= $result['slug']; ?>" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                            <button class="nav-link" id="description-<?= $result['slug']; ?>-tab" data-bs-toggle="tab" data-bs-target="#description-<?= $result['slug']; ?>" type="button" role="tab" aria-controls="description-<?= $result['slug']; ?>" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="slug-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="slug-<?= $result['slug']; ?>-tab">
                                            <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" value="<?= $result['slug']; ?>" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                        </div>
                                        <div class="tab-pane fade" id="keywords-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="keywords-<?= $result['slug']; ?>-tab">
                                            <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"><?= $result['keyword']; ?></textarea>
                                        </div>
                                        <div class="tab-pane fade" id="description-<?= $result['slug']; ?>" role="tabpanel" aria-labelledby="description-<?= $result['slug']; ?>-tab">
                                            <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memerikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"><?= $result['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="___in_id_berita_special_ARPATEAM" value="<?= $result['id_berita']; ?>">
                                <input type="hidden" name="___in_id_sitemap_special_ARPATEAM" value="<?= $result['id_sitemap']; ?>">
                                <input type="hidden" name="___in_gambar_lama_special_ARPATEAM" value="<?= $result['gambar']; ?>">
                                <input type="hidden" name="___in_slug_lama_special_ARPATEAM" value="<?= $result['slug']; ?>">
                                <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                            </div>
                        </form>
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
            $hal                = "Berita";
            $penyimpananGambar  = "$base_url/assets/files/images/berita";
            $database           = "berita";
            $link               = "berita";
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
                            <li class="breadcrumb-item"><a href="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $hal ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto my-auto">
                    <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addBerita"><i class="fas fa-plus"></i> Tambah <?= $hal ?></button>

                    <div id="addBerita" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-xl">
                            <form action="<?= $base_url_admin ?>/addBerita" method="POST" data-parsley-validate="" class="modal-content" enctype="multipart/form-data">
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
                                                <li>Ukuran File Gambar maksimal <strong>2MB</strong>!</li>
                                                <li>Pengaturan <strong>SEO</strong> mohon di lengkapi dengan aturan yang berlaku!</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="judul" name="___in_judul_special_ARPATEAM" placeholder="Lorem ipsum dolor sit amet" required="">
                                            <label for="judul">Judul <?= $hal ?></label>
                                        </div>
                                    </div>

                                    <!-- file preview template -->
                                    <div class="col-12 my-2">
                                        <div class="form-floating">
                                            <input type="file" data-plugins="dropify" data-height="450" id="gambar" accept="image/webp, image/jpeg, image/jpg, image/png, image/gif" name="___in_gambar_special_ARPATEAM" required="">
                                            <label for="gambar">Gambar</label>
                                        </div>
                                    </div>

                                    <div class="col-12 my-2">
                                        <textarea name="___in_deskripsi_special_ARPATEAM" id="myEditorFroala" value="Test"></textarea>
                                    </div><!-- end col -->

                                    <div class="col-12 my-1">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="slug-tab" data-bs-toggle="tab" data-bs-target="#slug" type="button" role="tab" aria-controls="slug" aria-selected="true">Slug <span data-bs-toggle="tooltip" data-bs-placement="top" title="Slug adalah teks yang akan diletakkan setelah nama domain dan menjadi bagian dari permalink."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="keywords-tab" data-bs-toggle="tab" data-bs-target="#keywords" type="button" role="tab" aria-controls="keywords" aria-selected="false">Keywords <span data-bs-toggle="tooltip" data-bs-placement="top" title="Keyword adalah kata atau frasa yang diketikkan orang di kolom mesin pencarian seperti Google, Bing atau Yahoo."><i class="fas fa-info-circle text-warning"></i></span></button>
                                                <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description blog adalah sebuah keterangan singkat tentang apa isi sebuah blog. Tujuan dibuatnya mudah saja, untuk menggambarkan apa saja yang ditulis di dalam blog tersebut."><i class="fas fa-info-circle text-warning"></i></span></button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="slug" role="tabpanel" aria-labelledby="slug-tab">
                                                <input type="text" class="form-control" name="___in_slug_special_ARPATEAM" placeholder="Cth: jasa-pembuatan-website-toko-online">
                                            </div>
                                            <div class="tab-pane fade" id="keywords" role="tabpanel" aria-labelledby="keywords-tab">
                                                <textarea class="form-control" rows="3" name="___in_keyword_special_ARPATEAM" placeholder="Cth: Website Toko Online, Toko Online Murah, Web Developer Toko Online Jogja"></textarea>
                                            </div>
                                            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                                                <textarea class="form-control" rows="3" name="___in_description_special_ARPATEAM" placeholder="Cth: Jasa Website Toko Online Murah di Jogja memerikan layanan terbaik untuk membantu usaha anda agar sukses di dunia Online"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="fas fa-times"></i> BATAL</button>
                                    <button type="submit" name="_submit_special_ARPATEAM_" class="btn btn-info waves-effect waves-light"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
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
                        <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Judul</th>
                                    <th width="15%">Tanggal Terbit</th>
                                    <th width="15%">Tanggal Update</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $no=1;
                                    $query = $pdo->query("
                                            SELECT id_berita, judul, slug, tgl_terbit, tgl_update
                                            FROM $database
                                            ORDER BY id_berita DESC");
                                    while($result = $query->fetch(PDO::FETCH_ASSOC)){
                                        
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><strong class="text-pink"><?= $result['judul'] ?></strong></td>
                                    <td><?= indoTgl($result['tgl_terbit']) ?></td>
                                    <td><?= indoTgl($result['tgl_update']) ?></td>
                                    <td>
                                        <a href="<?= $base_url_admin ?>/berita/<?= $result['slug'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <a onclick="confirmHapusBerita('<?= $result['id_berita']; ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--Pricing Column-->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div> <!-- content -->

<?php } ?>