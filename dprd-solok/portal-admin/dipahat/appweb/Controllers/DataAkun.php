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
    }elseif((isset($_POST['_submit_special_ARPATEAM_'])) OR ($_GET['act']==="delete-galeri-video")){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-galeri-video":

                // Data file
                $link       = $base_url_admin."/galeri-video";
                $database   = "galeri_video";
                // Data file

                $ket        = $_POST['___in_ket_special_ARPATEAM'];
                $embed      = $_POST['___in_embed_special_ARPATEAM'];

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (ket,embed,tgl_update)
                                    VALUES(:ket,:embed,NOW())" );
                            
                    $stmt->bindParam(":ket", $ket, PDO::PARAM_STR);
                    $stmt->bindParam(":embed", $embed, PDO::PARAM_STR);
                        
                    $count = $stmt->execute();
                            
                    $insertId = $pdo->lastInsertId();

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

            case "edit-galeri-video":

                // Data file
                $link       = $base_url_admin."/galeri-video";
                $database   = "galeri_video";
                // Data file

                $id_galeri_video    = htmlspecialchars($_POST['___in_id_galeri_video_special_ARPATEAM']);
                $ket        = $_POST['___in_ket_special_ARPATEAM'];
                $embed      = $_POST['___in_embed_special_ARPATEAM'];

                try {
                    $sql = "UPDATE $database
                            SET ket             = :ket,
                                embed           = :embed,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_galeri_video
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_galeri_video", $id_galeri_video, PDO::PARAM_INT);
                    $statement->bindParam(":ket", $ket, PDO::PARAM_STR);
                    $statement->bindParam(":embed", $embed, PDO::PARAM_STR);

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

            case "delete-galeri-video":

                // Data file
                $link       = $base_url_admin."/galeri-video";
                $database   = "galeri_video";
                // Data file

                try{
                    $del = $pdo->query("DELETE FROM $database WHERE id_$database='$_GET[id]'");
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