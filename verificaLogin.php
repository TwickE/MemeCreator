<?php
    include("cnn.php");

    session_start();
    $response = array(
        'status' => 0,
        'email' => "",
        'admin' => 0,
        'id' => 0,
        'nome' => "",
        'online' => 0
    );

    if(isset($_SESSION['email'])) {
        $response['status'] = 1;
        $response['email'] = $_SESSION['email'];
        $response['admin'] = $_SESSION['admin'];
        $response['id'] = $_SESSION['id'];
        $response['nome'] = $_SESSION['nome'];
        $response['online'] = $_SESSION['online'];
    }else if(isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
        try{
            $sql = "SELECT online FROM utilizador WHERE id=:id;";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute(["id" => $_COOKIE['id']]);
            $total = $stmt -> rowCount();

            $dados = $stmt->fetchAll();
            foreach ($dados as $dado => $item) {
                $online = $item['online'];
            }
        }catch(PDOException $e){
            $response['message'] = $e -> getMessage();
        }
        if($online == 0) {
            $response['status'] = 2;
        }else {
            $response['status'] = 1;
            $response['email'] = $_COOKIE['email'];
            $response['admin'] = $_COOKIE['admin'];
            $response['id'] = $_COOKIE['id'];
            $response['nome'] = $_COOKIE['nome'];
            $response['online'] = $_COOKIE['online'];
        } 
    }else{
        $response['status'] = 0;
    }
    echo json_encode($response);
?>