<?php
    include("cnn.php");
    session_start();

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );

    $idMeme = $_POST['idMeme'];

    try{
        $sql = "DELETE FROM meme WHERE id=:id;";

        $stmt = $pdo -> prepare($sql);
        $stmt -> execute(["id" => $idMeme]);

        $imagem = $_POST['imagemMeme'];
        $imagemAntiga = substr($imagem, 1);
        unlink($imagemAntiga);
        
        $response['message'] = "Tudo Ok!";
        $response['status'] = 2;

    }catch(PDOException $e){
        $response['message'] = $e -> getMessage();
        $response['status'] = 1;
    }
    echo json_encode($response);
?>