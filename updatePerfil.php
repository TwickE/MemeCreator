<?php
    include("cnn.php");
    session_start();

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );

    //define 1 megaByte
    define('MB', 1048576);

    $errorEmpty = false;
    $errorEmail = false;

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    }else if(isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
    }
    $primeiroNome = $_POST['primeiroNomePerfil'];
    $ultimoNome = $_POST['ultimoNomePerfil'];
    $email = $_POST['emailPerfil'];

    if(empty($primeiroNome)) {
        $response['message'] = 'Preencha o campo Primeiro Nome';
        $response['status'] = 1;
        $errorEmpty = true;
    }else if(empty($ultimoNome)) {
        $response['message'] = 'Preencha o campo Último Nome';
        $response['status'] = 1;
        $errorEmpty = true;
    }else if(empty($email)) {
        $response['message'] = 'Preencha o campo Email';
        $response['status'] = 1;
        $errorEmpty = true;
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = 'Introduza um email válido';
            $response['status'] = 1;
            $errorEmail = true;
    }else if($_FILES['imagePerfil']['size'] == 0) {
        try{
            $sql = "UPDATE utilizador SET primeiroNome=:primeiroNome, ultimoNome=:ultimoNome, email=:email  WHERE id=:id;";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute(["primeiroNome" => $primeiroNome, "ultimoNome" => $ultimoNome, "email" => $email, "id" => $id]);
            
            if(isset($_SESSION['id'])) {
                $_SESSION['email'] =  $email;
                $_SESSION['nome'] =  $primeiroNome;
            }else if(isset($_COOKIE['id'])) {
                unset($_COOKIE['email']);
                setcookie("email", $email, time() + 86400);
                
                unset($_COOKIE['nome']);
                setcookie("nome", $primeiroNome, time() + 86400);
            }

            $response['message'] = 'Utilizador OK';
            $response['status'] = 2;

        }catch(PDOException $e){
            $response['message'] = $e -> getMessage();
            $response['status'] = 1;
        }
    }else {
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["imagePerfil"]["name"], PATHINFO_EXTENSION );
        $newfilename   = $filename . "." . $extension;
        $size = $_FILES['imagePerfil']['size'];
        $tmp_name = $_FILES["imagePerfil"]["tmp_name"];
        $folder = "/resources/imagesPerfil/".$newfilename;
        $allowed_extensions = array("png", "jpg", "jpeg");

        try{
            $sql = "SELECT imagem FROM utilizador  WHERE id=:id;";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute(["id" => $id]);

            $dados = $stmt->fetchAll();
            foreach ($dados as $dado => $item) {
                $imagem = $item['imagem'];
            }

            //Apaga a imagem de perfil antiga
            if($imagem != "/resources/imagesPerfil/noPhotoPerfil.png") {
                $imagemAntiga = substr($imagem, 1);
                unlink($imagemAntiga);
            }

        }catch(PDOException $e){
            $response['message'] = $e -> getMessage();
            $response['status'] = 1;
        }
        
        if(!in_array($extension, $allowed_extensions)){
            $response['message'] = "Faça upload de um ficheiro .png, .jpg ou .jpeg";
            $response['status'] = 1;
        }else if($size >= 3*MB) {
            $response['message'] = "Faça upload de um ficheiro até 3MB";
            $response['status'] = 1;
        }else {
            try{
                move_uploaded_file($tmp_name, __DIR__.$folder);
                $sql = "UPDATE utilizador SET primeiroNome=:primeiroNome, ultimoNome=:ultimoNome, email=:email, imagem=:imagem  WHERE id=:id;";
                $stmt = $pdo -> prepare($sql);
                $stmt -> execute(["primeiroNome" => $primeiroNome, "ultimoNome" => $ultimoNome, "email" => $email, "imagem" => $folder, "id" => $id]);


                if(isset($_SESSION['id'])) {
                    $_SESSION['email'] =  $email;
                    $_SESSION['nome'] =  $primeiroNome;
                }else if(isset($_COOKIE['id'])) {
                    unset($_COOKIE['email']);
                    setcookie("email", $email, time() + 86400);
                    
                    unset($_COOKIE['nome']);
                    setcookie("nome", $primeiroNome, time() + 86400);
                }
                
                $response['message'] = 'Utilizador OK';
                $response['status'] = 2;

            }catch(PDOException $e){
                $response['message'] = $e -> getMessage();
                $response['status'] = 1;
            }
        }
    }
    echo json_encode($response);
?>