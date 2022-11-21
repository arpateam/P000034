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
    }elseif((isset($_POST['_submit_'])) OR (($_GET['act']==="delete-bantuan"))){
        require '../Libraries/others.php';
        require "../Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-bantuan":

                // Data file
                $link       = $base_url_admin."/bantuan";
                $database   = "bantuan";
                // Data file

                $urutan         = htmlspecialchars($_POST['___in_urutan']);
                $pertanyaan     = htmlspecialchars($_POST['___in_pertanyaan']);
                $jawaban        = $_POST['___in_jawaban'];

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (urutan,pertanyaan,jawaban,tgl_update)
                                    VALUES(:urutan,:pertanyaan,:jawaban,NOW())" );
                            
                    $stmt->bindParam(":urutan", $urutan, PDO::PARAM_STR);
                    $stmt->bindParam(":pertanyaan", $pertanyaan, PDO::PARAM_STR);
                    $stmt->bindParam(":jawaban", $jawaban, PDO::PARAM_STR);

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

            case "edit-bantuan":

                $id_bantuan = $_POST['___in_id_bantuan'];

                // Data file
                $link       = $base_url_admin."/bantuan";
                $database   = "bantuan";
                // Data file

                $urutan         = htmlspecialchars($_POST['___in_urutan']);
                $pertanyaan     = htmlspecialchars($_POST['___in_pertanyaan']);
                $jawaban        = $_POST['___in_jawaban'];

                try {
                    $sql = "UPDATE $database
                            SET urutan          = :urutan,
                                pertanyaan      = :pertanyaan,
                                jawaban         = :jawaban,
                                tgl_update      = NOW()
                            WHERE id_$database  = :id_bantuan
                        ";
                                  
                    $statement = $pdo->prepare($sql);

                    $statement->bindParam(":id_bantuan", $id_bantuan, PDO::PARAM_INT);
                    $statement->bindParam(":urutan", $urutan, PDO::PARAM_STR);
                    $statement->bindParam(":pertanyaan", $pertanyaan, PDO::PARAM_STR);
                    $statement->bindParam(":jawaban", $jawaban, PDO::PARAM_STR);

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

            case "delete-bantuan":

                $id_bantuan = $_GET['id'];

                // Data file
                $link       = $base_url_admin."/bantuan";
                $database   = "bantuan";
                // Data file

                try{
                    $del    = $pdo->query("DELETE FROM $database WHERE id_$database='$id_bantuan'");
                    $count  = $del->execute();

                    if ($count>0) {
                        $_SESSION['_msg__'] = 'Berhasil';
                        header("Location: $link");
                        die();
                        exit();
                    }
                }catch (PDOException $e) {
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