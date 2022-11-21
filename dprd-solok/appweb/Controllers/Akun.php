<?php

    session_start();
    // error_reporting(0);
    require "../Config/Db.php";
    require "../Config/AssetsWebsite.php";
    require "../Config/SetWebsite.php";

    if((isset($_POST['_submit_'])) OR ($_GET['act']==="logout-akun")){
        require '../../portal-admin/dipahat/appweb/Libraries/others.php';
        require "../../portal-admin/dipahat/appweb/Libraries/fungsi_form.php";

        switch ($_GET['act']) {
            case "add-akun":

                // Data file
                $link       = $base_url;
                $database   = "data_akun";
                // Data file

                // Cek username
                    $username   = preg_replace('/<[^<]+?>/', ' ', $_POST['___in_username']);

                    try{
                        $stmt   = $pdo->prepare("SELECT 
                                            username
                                            FROM $database
                                            WHERE username = ? LIMIT 1");

                        $stmt->bindValue(1, $username);
                        $stmt->execute();

                        $rowsCekUsername = $stmt->rowCount();

                        if ($rowsCekUsername>0) {
                            $_SESSION['_msg__'] = 'UsernameTerdaftar';
                            echo "<script>window.location(history.back(0))</script>";
                            exit();
                        }
                    }catch(Exception $e){
                        $_SESSION['_msg__'] = 'UsernameTerdaftar';
                        echo "<script>window.location(history.back(0))</script>";
                        exit();
                    }
                // End Cek username

                // Fungsi Password
                $password           = htmlspecialchars($_POST['___in_password']);
                $ulangi_password    = htmlspecialchars($_POST['___in_ulangi_password']);

                if ($password!=$ulangi_password) {
                    $_SESSION['_msg__'] = 'PasswordTidakSama';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                }else{
                    $password_enkrip    = password_hash($password, PASSWORD_DEFAULT);
                }
                // End Fungsi Password

                $nama_lgkp      = htmlspecialchars($_POST['___in_nama_lgkp']);
                $email          = htmlspecialchars($_POST['___in_email']);
                $jk             = htmlspecialchars($_POST['___in_jk']);
                $pekerjaan      = htmlspecialchars($_POST['___in_pekerjaan']);
                $alamat         = htmlspecialchars($_POST['___in_alamat']);
                $terakhir_login = NULL;
                $session        = NULL;

                try{
                    $stmt = $pdo->prepare("INSERT INTO $database
                                    (nama_lgkp,email,username,password,jk,pekerjaan,alamat,tgl_daftar,terakhir_login,session)
                                    VALUES(:nama_lgkp,:email,:username,:password,:jk,:pekerjaan,:alamat,NOW(),:terakhir_login,:session)" );
                            
                    $stmt->bindParam(":nama_lgkp", $nama_lgkp, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $password_enkrip, PDO::PARAM_STR);
                    $stmt->bindParam(":jk", $jk, PDO::PARAM_STR);
                    $stmt->bindParam(":pekerjaan", $pekerjaan, PDO::PARAM_STR);
                    $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
                    $stmt->bindParam(":terakhir_login", $terakhir_login, PDO::PARAM_STR);
                    $stmt->bindParam(":session", $session, PDO::PARAM_STR);

                    $count = $stmt->execute();
                            
                    $insertId = $pdo->lastInsertId();

                    if ($count>0) {
                        $_SESSION['_msg__'] = 'BerhasilDaftar';
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

            case "login-akun":

                // Data file
                $link       = $base_url."/akun";
                $database   = "data_akun";
                // Data file

                $myUsername = preg_replace('/<[^<]+?>/', '', $_POST['___in_username']);
                $myPassword = htmlspecialchars($_POST['___in_password']);

                try{
                    $stmt   = $pdo->prepare("SELECT 
                                        *
                                        FROM $database
                                        WHERE username = ? LIMIT 1");

                    $stmt->bindValue(1, $myUsername);
                    $stmt->execute();

                    $resultLogin    = $stmt->fetch(PDO::FETCH_ASSOC);
                    $rowsLogin      = $stmt->rowCount();

                    if ($rowsLogin>0){
                        if (password_verify($myPassword, $resultLogin['password'])>0) {
                            $session = hash('ripemd256', $myUsername).hash('sha256', date("Y-m-d H:i:s"));
                            try{
                                $sql = "UPDATE $database SET terakhir_login = now(), session = :session WHERE username = :username";
                                              
                                $statement = $pdo->prepare($sql);

                                $statement->bindParam(":username", $myUsername, PDO::PARAM_STR);
                                $statement->bindParam(":session", $session, PDO::PARAM_STR);

                                $count = $statement->execute();

                                if ($count>0) {
                                    // Jika berhasil
                                    $_SESSION['_alert__']           = '0';
                                    $_SESSION['_msg__']             = 'BerhasilLogin';
                                    $_SESSION['_session__']         = $session;
                                    $_SESSION['_id_data_akun__']    = $resultLogin['id_data_akun'];
                                    $_SESSION['_nama_lgkp__']       = $resultLogin['nama_lgkp'];
                                    $_SESSION['_email__']           = $resultLogin['email'];
                                    $_SESSION['_jk__']              = $resultLogin['jk'];
                                    $_SESSION['_pekerjaan__']       = $resultLogin['pekerjaan'];
                                    $_SESSION['_alamat__']          = $resultLogin['alamat'];
                                    echo "<script>window.location = '$link';</script>";
                                    die();
                                    exit();
                                }else{
                                    $_SESSION['_msg__'] = 'GagalLogin';
                                    echo "<script>window.location(history.back(0))</script>";
                                    exit();
                                    die();
                                }
                            }catch(PDOException $e){
                                $_SESSION['_msg__'] = 'GagalLogin';
                                echo "<script>window.location(history.back(0))</script>";
                                exit();
                                die();
                            }
                        }else{
                            $_SESSION['_msg__'] = 'GagalLogin';
                            echo "<script>window.location(history.back(0))</script>";
                            exit();
                            die();
                        }
                    }else{
                        $_SESSION['_msg__'] = 'GagalLogin';
                        echo "<script>window.location(history.back(0))</script>";
                        exit();
                        die();
                    }
                }catch(Exception $e) {
                    $_SESSION['_msg__'] = 'GagalLogin';
                    echo "<script>window.location(history.back(0))</script>";
                    exit();
                    die();
                }

                break;

            case "logout-akun":

                // Jika berhasil
                unset($_SESSION['_alert__']);
                unset($_SESSION['_msg__']);
                unset($_SESSION['_session__']);
                unset($_SESSION['_id_data_akun__']);
                unset($_SESSION['_nama_lgkp__']);
                unset($_SESSION['_email__']);
                unset($_SESSION['_jk__']);
                unset($_SESSION['_pekerjaan__']);
                unset($_SESSION['_alamat__']);
                session_unset();
                session_destroy();

                session_start();
                $_SESSION['_msg__'] = 'BerhasilLogout';
                echo "<script>window.location = '$base_url';</script>";
                die();
                exit();

                break;

            default:
                header("location: $base_url");
                die();
                exit();
        }
    }else{
        header("location: $base_url");
        die();
        exit();
    }