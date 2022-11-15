<?php
    include("cnn.php");
    session_start();

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );

    if(isset($_SESSION['id'])) {
        $idUtilizador = $_SESSION['id'];
    }else if(isset($_COOKIE['id'])) {
        $idUtilizador = $_COOKIE['id'];
    }

    $idTemplate = $_POST['idTemplate'];

    $data = $_POST['image'];
    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    $filename = uniqid() . "-" . time();
    $imagemDatabase = '/resources/imagesMemes/'.$filename.'.png';
    $file =  __DIR__. '/resources/imagesMemes/'.$filename.'.png';
    file_put_contents($file,$data);

    try{
        $sql = "INSERT INTO meme(imagemMeme, idTemplate, idUtilizador) values(:imagemMeme, :idTemplate, :idUtilizador);";

        $stmt = $pdo -> prepare($sql);
        $stmt -> execute(["imagemMeme" => $imagemDatabase, "idTemplate" => $idTemplate, "idUtilizador" => $idUtilizador]);
        
        $response['message'] = $file;
        $response['status'] = 2;

    }catch(PDOException $e){
        $response['message'] = $e -> getMessage();
        $response['status'] = 1;
    }
    echo json_encode($response);
?>