<?php

	if($_GET['module']=='beranda') { 
		include("appweb/Views/beranda.php");
	}elseif($_GET['module']=='diagnosis-penyakit') { 
		include("appweb/Views/diagnosis-penyakit.php");
	}elseif($_GET['module']=='konsultasi') { 
		include("appweb/Views/konsultasi.php");
	}elseif($_GET['module']=='bantuan') { 
		include("appweb/Views/bantuan.php");
	}elseif($_GET['module']=='akun') { 
		include("appweb/Views/akun.php");
	}else{
		echo "<script>window.location = '404';</script>";
	}

?>