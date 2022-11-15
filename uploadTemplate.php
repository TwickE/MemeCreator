<?php
    include("cnn.php");
    session_start();

    $response = array(
        'status' => 0,
        'teste' => '',
        'message' => 'Form submission failed'
    );

    //define 1 megaByte
    define('MB', 1048576);

    $errorEmpty = false;

    $nome = $_POST['nome'];

    if(isset($_SESSION['id'])) {
        $utilizador = $_SESSION['id'];
    }else if(isset($_COOKIE['id'])) {
        $utilizador = $_COOKIE['id'];
    }
    
    if(empty($nome)) {
        $response['message'] = 'Preencha o campo Nome do Template';
        $response['status'] = 1;
        $errorEmpty = true;
    }else if($_FILES['image']['size'] == 0) {
        $response['message'] = 'Faça upload de um ficheiro de imagem';
        $response['status'] = 1;
        $errorEmpty = true;
    }else{
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
        $newfilename   = $filename . "." . $extension;
        $size = $_FILES['image']['size'];
        $tmp_name = $_FILES["image"]["tmp_name"];
        $folder = "/resources/imagesTemplates/".$newfilename;
        $allowed_extensions = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
        
        if(!in_array($extension, $allowed_extensions)){
            $response['message'] = "Faça upload de um ficheiro .png, .jpg ou .jpeg";
            $response['status'] = 1;
        }else if($size >= 3*MB) {
            $response['message'] = "Faça upload de um ficheiro até 3MB";
            $response['status'] = 1;
        }else {
            try{
                move_uploaded_file($tmp_name, __DIR__.$folder);
                $urlNovo = substr($folder, 1);
                list($width, $height) = getimagesize($urlNovo);

                $sql = "INSERT INTO template(nome, imagem, width, height, ativo, idUtilizador) values(:nome, :imagem, :width, :height, :ativo, :idUtilizador);";

                $stmt = $pdo -> prepare($sql);
                $stmt -> execute(["nome" => $nome, "imagem" => $folder, "width" => $width, "height" => $height, "ativo" => 1, "idUtilizador" => $utilizador]);
                
                $response['message'] = 'Template OK';
                $response['teste'] = $tmp_name.__DIR__.$folder;
                $response['status'] = 2;

            }catch(PDOException $e){
                $response['message'] = $e -> getMessage();
                $response['status'] = 1;
            }
        }
    }
    echo json_encode($response);
?>