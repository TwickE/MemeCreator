<?php
    include("cnn.php");

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );

    $errorEmpty = false;
    $errorEmail = false;

    if(isset($_POST['primeiroNome']) || isset($_POST['ultimoNome']) || isset($_POST['email']) || 
    isset($_POST['password']) || isset($_POST['confirmarPassword']) || isset($_POST['admin'])) {

        $primeiroNome = $_POST['primeiroNome'];
        $ultimoNome = $_POST['ultimoNome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmarPassword = $_POST['confirmarPassword'];
        $admin = $_POST['admin'];
        if(isset($admin)){
            $admin = 1;
        }else{
            $admin = 0;
        }

        if(empty($primeiroNome)) {
            $response['message'] = 'Preencha o campo Primeiro Nome';
            $errorEmpty = true;
        }else if(empty($ultimoNome)) {
            $response['message'] = 'Preencha o campo Último Nome';
            $errorEmpty = true;
        }else if(empty($email)) {
            $response['message'] = 'Preencha o campo Email';
            $errorEmpty = true;
        }else if(empty($password)) {
            $response['message'] = 'Preencha o campo Password';
            $errorEmpty = true;
        }else if(!empty($confirmarPassword)) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['message'] = 'Introduza um email válido';
                $errorEmail = true;
            }else {
                if($errorEmpty == false && $errorEmail == false) {
                    if($password == $confirmarPassword) {
                        $number = preg_match('@[0-9]@', $password);
                        $uppercase = preg_match('@[A-Z]@', $password);
                        $lowercase = preg_match('@[a-z]@', $password);
                        $specialChars = preg_match('@[^\w]@', $password);
                        if(strlen($password) < 6 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                            $response['message'] = 'Introduza uma password alfanumérica que contenha pelo menos 6 caractéres, dos quais um deverá ser uma letra minuscula, outro uma letra maiuscula, um número e um caracter especial';
                        } else {
                            $hash = md5($password);
                            try{
                                $sql = "SELECT * FROM utilizador WHERE email=:email;";
                                $stmt = $pdo -> prepare($sql);
                                $stmt -> execute(["email" => $email]);
                                $total = $stmt->rowCount();
                            }catch(PDOException $e){
                                $response['message'] = $e -> getMessage();
                            }
                            if($total == 1){
                                $response['message'] = 'Este Email já se encontra registado';
                            }else {
                                try {
                                    $sql = "INSERT INTO utilizador(primeiroNome, ultimoNome, email, password, admin, online)
                                     values(:primeiroNome, :ultimoNome, :email, :password, :admin, :online);";

                                    $stmt = $pdo -> prepare($sql);
                                    $stmt -> execute(["primeiroNome" => $primeiroNome, "ultimoNome" => $ultimoNome, 
                                    "email" => $email, "password" => $hash, "admin" => $admin, "online" => 0]);
                                    
                                    $response['message'] = 'Utilizador registado';
                                    $response['status'] = 1;
                                }catch(PDOException $e){
                                    $response['message'] = $e -> getMessage();
                                }
                            }
                        }
                    }else {
                        $response['message'] = 'As passwords não coincidem';
                    }
                }
                else{
                    $response['message'] = '111';
                }
            }
        }else {
            $response['message'] = 'Preencha o campo Confirmar Password';
            $errorEmpty = true;
        }

    }

    echo json_encode($response);
?>