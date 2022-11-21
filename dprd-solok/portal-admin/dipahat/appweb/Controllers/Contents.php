<?php

	switch ($_SESSION['_level__']) {
		case 'Administrator':

			if($_GET['module']=='dashboard') { 
				include("appweb/Views/dashboard.php");
			}elseif($_GET['module']=='halaman') { 
				include("appweb/Views/pages.php");
			}elseif($_GET['module']=='data-penyakit') { 
				include("appweb/Views/data-penyakit.php");
			}elseif($_GET['module']=='data-gejala') { 
				include("appweb/Views/data-gejala.php");
			}elseif($_GET['module']=='data-relasi') { 
				include("appweb/Views/data-relasi.php");
			}elseif($_GET['module']=='data-solusi') { 
				include("appweb/Views/data-solusi.php");
			}elseif($_GET['module']=='data-akun') { 
				include("appweb/Views/data-akun.php");
			}elseif($_GET['module']=='laporan') { 
				include("appweb/Views/laporan.php");
			}elseif($_GET['module']=='bantuan') { 
				include("appweb/Views/bantuan.php");
			}elseif($_GET['module']=='data-akun') { 
				include("appweb/Views/data-akun.php");
			}elseif($_GET['module']=='pengaturan') { 
				include("appweb/Views/settings.php");
			}elseif($_GET['module']=='sitemap') { 
				include("appweb/Views/sitemap.php");
			}elseif($_GET['module']=='pegawai') { 
				include("appweb/Views/pegawai.php");
			}else{
				echo "<script>window.location = '404';</script>";
			}

			break;
		
		default:
		
			echo "<script>window.location = '404';</script>";

			break;
	}

?>