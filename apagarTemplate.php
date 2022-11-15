<?php
    include("cnn.php");

    $response = array(
        'status' => 0,
        'message' => 'Form submission failed'
    );
    $id = $_POST['id'];
    try{
        $sql = "UPDATE template SET ativo=:ativo WHERE id=:id;";

        $stmt = $pdo -> prepare($sql);
        $stmt -> execute(["ativo" => 0, "id" => $id]);
        
        $response['message'] = 'Template OK';
        $response['status'] = 2;
    }catch(PDOException $e){
        $response['message'] = $e -> getMessage();
        $response['status'] = 1;
    }
    echo json_encode($response);
?>