 <div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="<?= $base_url ?>/assets/files/images/avatar/<?= $_SESSION['_avatar__'] ?>" alt="<?= $_SESSION['_nama__'] ?>" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                <div class="dropdown">
                    <a href="<?= $base_url_admin ?>/#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"><?= $_SESSION['_nama__'] ?></a>
                </div>

            <p class="text-muted left-user-info"><?= $_SESSION['_level__'] ?></p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="<?= $base_url_admin ?>/pegawai/profil" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="<?= $base_url_admin ?>/keluar-admin">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php if ($_SESSION['_level__']==="Administrator"): ?>
                <ul id="side-menu">
                    <li>
                        <a href="<?= $base_url_admin ?>/dashboard" class="<?php if($_GET['module']=='dashboard'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li class="menu-title bg-body mt-2">MANAJEMEN KONTEN</li>
                    <li>
                        <a href="<?= $base_url_admin ?>/page/beranda" class="<?php if($_GET['module']=='tentang' AND $_GET['id']=='1'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-home-edit"></i>
                            <span> Beranda </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/#DiagnosisPenyakit" data-bs-toggle="collapse" class="<?php if(($_GET['module']=='data-penyakit') OR ($_GET['module']=='data-gejala') OR ($_GET['module']=='data-relasi') OR ($_GET['module']=='data-solusi') OR ($_GET['module']=='tentang' AND $_GET['id']=='2')){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-clipboard-edit"></i>
                            <span> Diagnosis Penyakit </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="DiagnosisPenyakit">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="<?= $base_url_admin ?>/data-penyakit" class="<?php if($_GET['module']=='data-penyakit'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Data Penyakit </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/data-gejala" class="<?php if($_GET['module']=='data-gejala'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Data Gejala </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/data-relasi" class="<?php if($_GET['module']=='data-relasi'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Data Relasi </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/data-solusi" class="<?php if($_GET['module']=='data-solusi'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Data Solusi </span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="<?= $base_url_admin ?>/laporan" class="<?php if($_GET['module']=='laporan'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Daftar Laporan </span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="<?= $base_url_admin ?>/page/diagnosis-penyakit" class="<?php if($_GET['module']=='tentang' AND $_GET['id']=='2'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Pengaturan SEO </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/page/konsultasi" class="<?php if($_GET['module']=='tentang' AND $_GET['id']=='3'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-comment-text-multiple"></i>
                            <span> Konsultasi </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/#Bantuan" data-bs-toggle="collapse" class="<?php if(($_GET['module']=='bantuan') OR ($_GET['module']=='tentang' AND $_GET['id']=='4')){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-chat-alert"></i>
                            <span> Bantuan </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Bantuan">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="<?= $base_url_admin ?>/bantuan" class="<?php if($_GET['module']=='bantuan'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Bantuan </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/page/bantuan" class="<?php if($_GET['module']=='tentang' AND $_GET['id']=='4'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Pengaturan SEO </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/#DataAkun" data-bs-toggle="collapse" class="<?php if(($_GET['module']=='data-akun') OR ($_GET['module']=='tentang' AND $_GET['id']=='5')){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-account-group"></i>
                            <span> Data Akun </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="DataAkun">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="<?= $base_url_admin ?>/data-akun" class="<?php if($_GET['module']=='data-akun'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Daftar Data Akun </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url_admin ?>/page/akun" class="<?php if($_GET['module']=='tentang' AND $_GET['id']=='5'){ echo 'link-light'; } ?>">
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                        <span> Pengaturan SEO </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-title bg-body mt-2">FITUR WEBSITE</li>
                    <li>
                        <a href="<?= $base_url_admin ?>/pengaturan" class="<?php if($_GET['module']=='pengaturan'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-cogs"></i>
                            <span> Pengaturan Website </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $base_url_admin ?>/sitemap" class="<?php if($_GET['module']=='sitemap'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-sitemap"></i>
                            <span> Sitemap </span>
                        </a>
                    </li>

                    <li class="menu-title bg-body mt-2">MANAJEMEN PEGAWAI</li>
                    <li>
                        <a href="<?= $base_url_admin ?>/pegawai" class="<?php if($_GET['module']=='pegawai'){ echo 'link-light'; } ?>">
                            <i class="mdi mdi-card-account-details-star"></i>
                            <span> Data Pegawai </span>
                        </a>
                    </li>
                </ul>
            <?php endif ?>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>