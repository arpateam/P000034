<?php

    session_start();
    // error_reporting(0);
    require "../Config/Db.php";
    require "../Config/AssetsWebsite.php";
    require "../Config/SetWebsite.php";

    if(isset($_POST['_submit_'])){
        require '../../portal-admin/dipahat/appweb/Libraries/others.php';

        $nama_lgkp      = htmlspecialchars($_POST['___in_nama_lgkp']);
        $pesan          = htmlspecialchars($_POST['___in_pesan']);

        echo "<script>window.location = 'https://api.whatsapp.com/send?phone=telpWhatsApp($nomorWhatsApp)&text=Hallo%20Nama%20Saya%20$nama_lgkp...%0ASaya%20ingin%20konsultasi%0A%0A*$pesan*'</script>";

    }else{
        header("location: $base_url");
        die();
        exit();
    }