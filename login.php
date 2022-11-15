<?php
    include("cnn.php");

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );

    session_start();

    $errorEmpty = false;
    $errorEmail = false;

    if(isset($_POST['email']) || isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)) {
            $response['message'] = 'Preencha o campo Email';
            $errorEmpty = true;
        }else if(empty($password)) {
            $response['message'] = 'Preencha o campo Password';
            $errorEmpty = true;
        }else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['message'] = 'Introduza um email válido';
                $errorEmail = true;
            }else {
                if($errorEmpty == false && $errorEmail == false) {
                    $deash = md5($password);
                    try{
                        $sql = "SELECT * FROM utilizador WHERE email=:email AND password=:password;";
                        $stmt = $pdo -> prepare($sql);
                        $stmt -> execute(["email" => $email, "password" => $deash]);
                        $total = $stmt -> rowCount();

                        $dados = $stmt->fetchAll();
                        foreach ($dados as $dado => $item) {
                            $admin = $item['admin'];
                            $id = $item['id'];
                            $nome = $item['primeiroNome'];
                            $online = $item['online'];
                        }

                        $sql = "UPDATE utilizador SET online=:online WHERE id=:id;";
                        $stmt = $pdo -> prepare($sql);
                        $stmt -> execute(["online" => 1, "id" => $id]);
                        $total1 = $stmt -> rowCount();

                    }catch(PDOException $e){
                        $response['message'] = $e -> getMessage();
                    }
                    if(isset($_POST['lembrar'])) {
                        $lembrar = $_POST['lembrar'];
                        if(!empty($lembrar)) {
                            if($total == 1 && $total1 == 1) {
                                unset($_COOKIE['email']);
                                unset($_COOKIE['password']);
                                unset($_COOKIE['id']);
                                unset($_COOKIE['admin']);
                                unset($_COOKIE['nome']);
                                unset($_COOKIE['online']);
                                setcookie("email", $email, time() + 86400); //cookie de email
                                setcookie("password", $password, time() + 86400); //cookie de password
                                setcookie("id", $id, time() + 86400); //cookie de id
                                setcookie("admin", $admin, time() + 86400); //cookie de admin
                                setcookie("nome", $nome, time() + 86400); //cookie de nome
                                setcookie("online", $online, time() + 86400); //cookie de online
                                $response['message'] = "<script>window.location.href = 'home.php';</script>";
                            }else {
                                $response['message'] = 'Email ou Password incorretos';
                            }
                        }
                    }else {
                        if($total == 1 && $total1 == 1) {
                            unset($_COOKIE['email']);
                            setcookie('email', "", time() - 86500); 
                            unset($_COOKIE['password']);
                            setcookie('password', "", time() - 86500); 
                            unset($_COOKIE['id']);
                            setcookie('id', "", time() - 86500); 
                            unset($_COOKIE['admin']);
                            setcookie('admin', "", time() - 86500); 
                            unset($_COOKIE['nome']);
                            setcookie('nome', "", time() - 86500); 
                            unset($_COOKIE['online']);
                            setcookie('online', "", time() - 86500); 
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                            $_SESSION['id'] = $id;
                            $_SESSION['admin'] = $admin;
                            $_SESSION['nome'] = $nome;
                            $_SESSION['online'] = $online;
                            $response['message'] = "<script>window.location.href='home.php';</script>";
                        }else {
                            $response['message'] = 'Email ou Password incorretos';
                        }
                    }
                }
            }
        }
    }
    echo json_encode($response);
?>