<?php

    session_start();
    // error_reporting(0);
    require "../../../../appweb/Config/Db.php";
    require "../../../../appweb/Config/AssetsWebsite.php";
    require "../../../../appweb/Config/SetWebsite.php";

    if (empty($_SESSION['_session__'])) {
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }elseif((isset($_POST['_submit_'])) OR ($_GET['act']==="delete-data-penyakit")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-data-penyakit":

                // Data file
                $link       = $base_url_admin."/data-penyakit";
                $database   = "penyakit";
                // Data file

                $no_urut        = $_POST['___in_no_urut'];
                $kode_penyakit  = $_POST['___in_kode_penyakit'];
                $nama_penyakit  = $_POST['___in_nama_penyakit'];

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (no_urut,kode_penyakit,nama_penyakit)
                                    VALUES(:no_urut,:kode_penyakit,:nama_penyakit)" );
                            
                    $stmt->bindParam(":no_urut", $no_urut, PDO::PARAM_STR);
                    $stmt->bindParam(":kode_penyakit", $kode_penyakit, PDO::PARAM_STR);
                    $stmt->bindParam(":nama_penyakit", $nama_penyakit, PDO::PARAM_STR);
                        
                    $count = $stmt->execute();

                    if ($count>0) {
                        $_SESSION['_msg__'] = 'Berhasil';
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }     
                }catch(PDOException $e){
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            case "edit-data-penyakit":

                // Data file
                $link       = $base_url_admin."/data-penyakit";
                $database   = "penyakit";
                // Data file

                $no_urut  = $_POST['___in_no_urut'];

                if ($_POST['___in_kode_penyakit']!==$_POST['___in_kode_penyakit_lama']) {
                    $kode_penyakit      = $_POST['___in_kode_penyakit'];
                    $kode_penyakit_lama = $_POST['___in_kode_penyakit_lama'];
                }else{
                    $kode_penyakit      = $_POST['___in_kode_penyakit'];
                    $kode_penyakit_lama = $_POST['___in_kode_penyakit'];
                }
                
                $nama_penyakit  = $_POST['___in_nama_penyakit'];

                try {
                    $sql = "UPDATE $database
                            SET no_urut         = :no_urut,
                                kode_penyakit   = :kode_penyakit,
                                nama_penyakit   = :nama_penyakit
                            WHERE kode_penyakit = :kode_penyakit_lama
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":kode_penyakit_lama", $kode_penyakit_lama, PDO::PARAM_STR);
                    $statement->bindParam(":no_urut", $no_urut, PDO::PARAM_STR);
                    $statement->bindParam(":kode_penyakit", $kode_penyakit, PDO::PARAM_STR);
                    $statement->bindParam(":nama_penyakit", $nama_penyakit, PDO::PARAM_STR);

                    $count = $statement->execute();

                    if ($count>0) {
                        $_SESSION['_msg__']  = "Berhasil";
                        echo "<script>window.location = '$link'</script>";
                        die();
                        exit();
                    }
                }catch(PDOException $e){
                    $_SESSION['_msg__']  = "Gagal";
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            case "delete-data-penyakit":

                // Data file
                $link       = $base_url_admin."/data-penyakit";
                $database   = "penyakit";
                // Data file

                try{
                    $del = $pdo->query("DELETE FROM $database WHERE kode_penyakit='$_GET[id]'");
                    $del->execute();

                    $_SESSION['_msg__']  = "Berhasil";
                    echo "<script>window.location = '$link'</script>";
                    die();
                    exit();
                }catch(PDOException $e){
                    $_SESSION['_msg__'] = 'Gagal';
                    echo "<script>window.location(history.back(0))</script>";
                    die();
                    exit();
                }

                break;

            default:
                header("location: $base_url_admin/keluar-edit");
                die();
                exit();
        }
    }else{
        header("location: $base_url_admin/keluar-edit");
        die();
        exit();
    }