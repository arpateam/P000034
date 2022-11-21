<?php
    session_start();
    error_reporting(0);
    require "appweb/Config/SetWebsite.php";
    require "appweb/Config/Db.php";
    require "appweb/Config/AssetsWebsite.php";
    require "appweb/Functions/others.php";

    if ($_SESSION['_msg__']==="Gagal") {
        $_SESSION['_alert__']   = 0;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="Berhasil") {
        $_SESSION['_alert__']   = 1;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="BerhasilDaftar") {
        $_SESSION['_alert__']   = 2;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="BerhasilLogin") {
        $_SESSION['_alert__']   = 3;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="UsernameTerdaftar") {
        $_SESSION['_alert__']   = 4;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="PasswordTidakSama") {
        $_SESSION['_alert__']   = 5;
        $_SESSION['_msg__']     = NULL;
    }elseif ($_SESSION['_msg__']==="BerhasilLogout") {
        $_SESSION['_alert__']   = 6;
        $_SESSION['_msg__']     = NULL;
    }else{
        $_SESSION['_alert__']   = NULL;
        $_SESSION['_msg__']     = NULL;
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <?php require "appweb/Controllers/SEO_v6.php"; ?>

    <link rel="icon" type="image/x-icon" href="<?= $url_images; ?>/<?= $icon; ?>" />

    <link rel="stylesheet" href="<?= $base_url; ?>/assets/css/bootstrap.css">

    <!--Plugins -->
    <style>@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');</style>
    <link href="<?= $base_url; ?>/assets/plugins/fontawesome-6.0.0/css/all.css" rel="stylesheet">
    <link href="<?= $base_url; ?>/assets/plugins/aos/dist/aos.css" rel="stylesheet">
    <link href="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $base_url_admin ?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= $base_url_admin ?>/assets/libs/validation-pass-arpateam/css/style.css">

    <!--End Plugins -->
    <base href="<?= $base_url; ?>/">
</head>
<body>

    <div class="container-fluid px-0">
        <?php require "appweb/Models/Header.php"; ?>
        <?php require "appweb/Controllers/Contents.php"; ?>
        <?php require "appweb/Models/Footer.php"; ?>
    </div>


    <a href="javascript:" id="return-to-top"><i class="fa-solid fa-angle-up"></i></a>

    <script src="<?= $base_url; ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= $base_url; ?>/assets/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        // Popover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        // Popover

        document.addEventListener("DOMContentLoaded", function(){
            // make it as accordion for smaller screens
            if (window.innerWidth > 992) {
                document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){
                    everyitem.addEventListener('mouseover', function(e){
                        let el_link = this.querySelector('a[data-bs-toggle]');
                        if(el_link != null){
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.add('show');
                            nextEl.classList.add('show');
                        }
                    });
                    everyitem.addEventListener('mouseleave', function(e){
                        let el_link = this.querySelector('a[data-bs-toggle]');
                        if(el_link != null){
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.remove('show');
                            nextEl.classList.remove('show');
                        }
                    })
                });
            }
            // end if innerWidth
            
            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    document.getElementById("navbar_top").classList.add("fixed-top");

                    document.getElementById("navbar_brand").classList.add("navbar-brand-50");
                    document.getElementById("navbar_brand").classList.remove("navbar-brand-100");

                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector(".navbar").offsetHeight;
                    document.body.style.paddingTop = navbar_height + "px";
                } else {
                    document.getElementById("navbar_top").classList.remove("fixed-top");

                    document.getElementById("navbar_brand").classList.remove("navbar-brand-50");
                    document.getElementById("navbar_brand").classList.add("navbar-brand-100");

                    // remove padding top from body
                    document.body.style.paddingTop = "0";
                } 
            });
        });

        // ===== Scroll to Top ==== 
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200);    // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200);   // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });
        // ===== Scroll to Top ====
    </script>

    <!-- Plugins -->
        <script src="<?= $base_url_admin ?>/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

        <script src="<?= $base_url_admin ?>/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?= $base_url_admin ?>/assets/js/pages/form-wizard.init.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/dropify/js/dropify.min.js"></script>
        <script src="<?= $base_url_admin ?>/assets/js/pages/form-fileuploads.init.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/parsleyjs/parsley.min.js"></script>
        <script src="<?= $base_url_admin ?>/assets/js/pages/form-validation.init.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/validation-pass-arpateam/js/validation.js"></script>
        <script src="<?= $base_url_admin ?>/assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- Show Password -->
            <script>
                function showPassword() {
                    // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
                    var x = document.getElementById('pass').type;

                    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
                    if (x == 'password') {

                        //ubah form input password menjadi text
                        document.getElementById('pass').type = 'text';
                        
                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowPassword').innerHTML = `<i class="fas fa-eye"></i>`;
                    }else{

                        //ubah form input password menjadi text
                        document.getElementById('pass').type = 'password';

                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowPassword').innerHTML = `<i class="fas fa-eye-slash"></i>`;
                    }
                }
                function showPassword2() {
                    // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
                    var x = document.getElementById('pass').type;

                    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
                    if (x == 'password') {

                        //ubah form input password menjadi text
                        document.getElementById('pass2').type = 'text';
                        
                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowPassword2').innerHTML = `<i class="fas fa-eye"></i>`;
                    }else{

                        //ubah form input password menjadi text
                        document.getElementById('pass2').type = 'password';

                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowPassword2').innerHTML = `<i class="fas fa-eye-slash"></i>`;
                    }
                }
                function showUlangiPassword() {

                    // membuat variabel berisi tipe input dari id='passUlangi', id='passUlangi' adalah form input password 
                    var x = document.getElementById('passUlangi').type;

                    //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
                    if (x == 'password') {

                        //ubah form input password menjadi text
                        document.getElementById('passUlangi').type = 'text';
                        
                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowUlangiPassword').innerHTML = `<i class="fas fa-eye"></i>`;
                    }else{

                        //ubah form input password menjadi text
                        document.getElementById('passUlangi').type = 'password';

                        //ubah icon mata terbuka menjadi tertutup
                        document.getElementById('buttonShowUlangiPassword').innerHTML = `<i class="fas fa-eye-slash"></i>`;
                    }
                }
            </script>
        <!-- Show Password -->

        <?php if ($_SESSION['_alert__']===0): ?>
            <script>
                Swal.fire({ title: "GAGAL!", text: "Silahkan coba lagi!", icon: "error" });
            </script>
        <?php elseif ($_SESSION['_alert__']===1): ?>
            <script>
                Swal.fire({ title: "BERHASIL!", text: "Data anda terkirim dan telah kami terima!", icon: "success" });
            </script>
        <?php elseif ($_SESSION['_alert__']===2): ?>
            <script>
                Swal.fire({ title: "SELAMAT!", text: "Akun anda sudah terdaftar, silahkan login menggunakan akun anda!", icon: "success" });
            </script>
        <?php elseif ($_SESSION['_alert__']===3): ?>
            <script>
                Swal.fire({ title: "BERHASIL LOGIN!", text: "Yeay, anda sudah berhasil login ke akun!", icon: "success" });
            </script>
        <?php elseif ($_SESSION['_alert__']===4): ?>
            <script>
                Swal.fire({ title: "USERNAME TERDAFTAR!", text: "Mohon masukkan username yang lain!", icon: "error" });
            </script>
        <?php elseif ($_SESSION['_alert__']===5): ?>
            <script>
                Swal.fire({ title: "GAGAL!", text: "Mohon masukkan password anda kembali!", icon: "error" });
            </script>
        <?php elseif ($_SESSION['_alert__']===6): ?>
            <script>
                Swal.fire({ title: "BERHASIL LOGOUT!", text: "Anda berhasil logout dari akun!", icon: "success" });
            </script>
        <?php endif ?>
    <!--End Plugins -->
</body>
</html>