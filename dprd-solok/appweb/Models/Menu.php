<!-- <header class="container-fluid bg-dark">
    <div class="container px-0 px-sm-2">
        <div class="row justify-content-between py-2">
            <div class="col-auto">
                <a target="_blank" href="<?= $linkInstagram ?>" title="Instagram Kami" class="link-light text-decoration-none m-1"><i class="fa-brands fa-instagram"></i></a>
                <a target="_blank" href="<?= $linkFacebook ?>" title="Facebook Kami" class="link-light text-decoration-none m-1"><i class="fa-brands fa-facebook"></i></a>
                <a href="mailto:<?= $email ?>" title="Email Kami" class="link-light text-decoration-none m-1"><i class="fa-solid fa-envelope"></i></a>
            </div>

            <div class="col-auto">
                <a href="tel:<?= $nomorTelpSms ?>" title="Nomor Telpon Kami" class="link-light text-decoration-none small m-1"><i class="fa-solid fa-phone"></i> <span class="d-none d-lg-inline-block text-light"><?= $nomorTelpSms ?></span></a>
                <a title="Lokasi Kami" class="link-light text-decoration-none small m-1"><i class="fa-solid fa-location-dot"></i> <span class="d-none d-lg-inline-block text-light"><?= $alamat ?></span></a>
            </div>
        </div>
    </div>
</header> -->

<nav id="navbar_top" class="container-fluid navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container px-0 px-sm-2">
        <a class="navbar-brand" href="<?= $base_url ?>">
            <img src="<?= $base_url; ?>/assets/files/images/<?= $logoDesktop ?>" title="<?= $judulLogoDesktop; ?>" alt="Gambar <?= $judulLogoDesktop; ?>" id="navbar_brand" class="navbar-brand-100">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-start justify-content-lg-between" id="navbarSupportedContent">
            <hr class="border border-light d-block d-lg-none my-2">
            <div class="d-flex justify-content-start">
                <div class="p-0 bd-highlight d-none">Flex item 122</div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if($_GET['module']=='beranda'){ echo 'active'; } ?>" aria-current="page" href="<?= $base_url ?>" title="Beranda">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if($_GET['module']=='diagnosis-penyakit'){ echo 'active'; } ?>" href="<?= $base_url ?>/diagnosis-penyakit" title="Diagnosis Penyakit"><i class="fa-solid fa-clipboard"></i> Diagnosis Penyakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if($_GET['module']=='konsultasi'){ echo 'active'; } ?>" href="<?= $base_url ?>/konsultasi" title="Konsultasi"><i class="fa-solid fa-comments"></i> Konsultasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase <?php if($_GET['module']=='bantuan'){ echo 'active'; } ?>" href="<?= $base_url ?>/bantuan" title="Bantuan"><i class="fa-solid fa-circle-question"></i> Bantuan</a>
                </li>
            </ul>
            <div class="d-flex justify-content-center justify-content-lg-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link text-uppercase dropdown-toggle <?php if($_GET['module']=='akun'){ echo 'active'; } ?>" role="button" title="Akun" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user"></i> Akun
                        </a>
                        <ul class="dropdown-menu bg-warning fade-up shadow navbar-nav-scroll overflow-auto" aria-labelledby="navbarDropdown">
                            <?php if (empty($_SESSION['_id_data_akun__'])): ?>
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" href="#login" role="button"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" data-bs-toggle="modal" href="#daftar" role="button"><i class="fa-solid fa-pen-to-square"></i> Daftar</a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item <?php if($_GET['module']=='akun'){ echo 'active'; } ?>" href="<?= $base_url ?>/akun"><i class="fa-solid fa-user"></i> 
                                        <?php
                                            $cekNama    = strlen($_SESSION['_nama_lgkp__']);
                                            if ($cekNama>10) {
                                                echo substr($_SESSION['_nama_lgkp__'], 0, 10)." ...";
                                            }else{
                                                echo $_SESSION['_nama_lgkp__'];
                                            }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= $base_url ?>/keluarAkun"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Daftar -->
<div class="modal fade" id="daftar" tabindex="-1" aria-labelledby="daftarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= $base_url ?>/daftarAkun" method="POST" data-parsley-validate="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-success" id="daftarLabel">Form Daftar Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 my-1">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_lgkp" name="___in_nama_lgkp" placeholder="Cth: Aldi Febriyanto" required="">
                        <label for="nama_lgkp">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="___in_email" placeholder="Cth: info@johndie.com" required="">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-floating">
                        <select class="form-select" id="jk" name="___in_jk" required="">
                            <option value="">- Pilih Salah Satu -</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jk">Jenis Kelamin</label>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-floating">
                        <select class="form-select" id="pekerjaan" name="___in_pekerjaan" required="">
                            <option value="">- Pilih Salah Satu -</option>
                            <option value="Petani">Petani</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                        <label for="pekerjaan">Pekerjaan</label>
                    </div>
                </div>

                <div class="col-12 my-1">
                    <div class="form-floating">
                        <textarea class="form-control" name="___in_alamat" placeholder="Masukkan alamat lengkap anda..." style="min-height: 100px;" required=""></textarea>
                        <label for="alamat">Alamat</label>
                    </div>
                </div>

                <div class="col-md-12 mt-3 mb-1">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <span class="alert-heading">
                            <i class="fas fa-lock"></i> PENGATURAN KEAMANAN AKUN
                        </span>
                    </div>
                </div>

                <div class="col-md-12 my-1">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="___in_username" placeholder="Cth: johndie15" minlength="5" maxlength="20" onkeyup="this.value=this.value.replace(/[^a-z][^0-9]/g,'');" required="">

                        <label for="username">Username <small>(Cth: johndie15)</small></label>
                    </div>
                </div>

                <!-- Password -->
                <div class="col-md-6 my-2">
                    <label class="font-weight-bold" for="pass">Password <span id="buttonShowPassword" onclick="showPassword()"><i class="fas fa-eye-slash"></i></span></label>
                    <input type="password" id="pass" name="___in_password" class="form-control" placeholder="Masukkan Password anda..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="10" maxlength="20" required>
                    <div class="p-1" role="alert">
                        <h5 class="font-weight-bold text-warning"><i class="fas fa-exclamation-circle"></i> Ketentuan Password:</h5>

                        <span id="length" class="invalid">Minimal <strong>10 Karakter</strong>
                        </span>
                        <br />
                        <span id="letter" class="invalid">Kombinasi <strong>huruf kecil</strong></span>
                        <br />
                        <span id="capital" class="invalid">Kombinasi <strong>huruf besar</strong></span>
                        <br />
                        <span id="number" class="invalid">Kombinasi <strong>angka</strong>
                        </span>
                        <br />
                    </div>
                </div>
                <!-- Password -->

                <!-- Ulangi Password -->
                <div class="col-md-6 my-2">
                    <label class="font-weight-bold" for="passUlangi">Ulangi Password <span id="buttonShowUlangiPassword" onclick="showUlangiPassword()"><i class="fas fa-eye-slash"></i></span></label>
                    <input type="password" id="passUlangi" name="___in_ulangi_password" class="form-control" placeholder="Ulangi Password anda..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="10" maxlength="20" required>
                    <div class="form-text confirm-message p-1"></div>
                </div>
                <!-- Ulangi Password -->
            </div>
            <div class="modal-footer">
                <button type="submit" name="_submit_" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> DAFTAR</button>
            </div>
        </form>
    </div>
</div>

<!-- Login -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= $base_url ?>/masukAkun" method="POST" data-parsley-validate="" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-success" id="loginLabel">Form Login Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12 my-1">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="___in_username" placeholder="Cth: johndie15" minlength="5" maxlength="20" onkeyup="this.value=this.value.replace(/[^a-z][^0-9]/g,'');" required="">

                        <label for="username">Username <small>(Cth: johndie15)</small></label>
                    </div>
                </div>

                <!-- Password -->
                <div class="col-md-12 my-1">
                    <label for="pass" class="form-label">Password <span id="buttonShowPassword2" onclick="showPassword2()"><i class="fas fa-eye-slash"></i></span></label>
                    <input type="password" id="pass2" name="___in_password" class="form-control" placeholder="Masukkan password anda..." required="">
                </div>
                <!-- Password -->
            </div>
            <div class="modal-footer">
                <button type="submit" name="_submit_" class="btn btn-success"><i class="fa-solid fa-right-to-bracket"></i> LOGIN</button>
            </div>
        </form>
    </div>
</div>