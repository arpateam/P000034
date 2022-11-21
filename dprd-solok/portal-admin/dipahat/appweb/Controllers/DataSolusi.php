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
    }elseif((isset($_POST['_submit_'])) OR ($_GET['act']==="delete-data-solusi")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_upload_gambar.php";
        require '../Libraries/fungsi_sitemap.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-data-solusi":

                // Data file
                $link       = $base_url_admin."/data-solusi";
                $database   = "solusi";
                // Data file

                $kode_penyakit  = $_POST['___in_kode_penyakit'];
                $solusi         = $_POST['___in_solusi'];

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (kode_penyakit,solusi,tgl_update)
                                    VALUES(:kode_penyakit,:solusi,NOW())" );
                            
                    $stmt->bindParam(":kode_penyakit", $kode_penyakit, PDO::PARAM_STR);
                    $stmt->bindParam(":solusi", $solusi, PDO::PARAM_STR);
                        
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

            case "edit-data-solusi":

                // Data file
                $link       = $base_url_admin."/data-solusi";
                $database   = "solusi";
                // Data file

                $id_solusi      = $_POST['___in_id_solusi_lama'];
                $kode_penyakit  = $_POST['___in_kode_penyakit'];
                $solusi         = $_POST['___in_solusi'];

                try {
                    $sql = "UPDATE $database
                            SET kode_penyakit   = :kode_penyakit,
                                solusi          = :solusi
                            WHERE id_solusi     = :id_solusi
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_solusi", $id_solusi, PDO::PARAM_STR);
                    $statement->bindParam(":kode_penyakit", $kode_penyakit, PDO::PARAM_STR);
                    $statement->bindParam(":solusi", $solusi, PDO::PARAM_STR);

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

            case "delete-data-solusi":

                // Data file
                $link       = $base_url_admin."/data-solusi";
                $database   = "solusi";
                // Data file

                try{
                    $del = $pdo->query("DELETE FROM $database WHERE id_solusi='$_GET[id]'");
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