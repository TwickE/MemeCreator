<?php
    include("cnn.php");

    $response = array(
        'online' => 1
    );

    session_start();
    if(isset($_SESSION['email'])) {
        $idSession = $_SESSION['id'];
        try{
            $sql = "UPDATE utilizador SET online=:online WHERE id=:id;";
            $stmt = $pdo -> prepare($sql);
            $stmt -> execute(["online" => 0, "id" => $idSession]);
            $total = $stmt -> rowCount();
        }catch(PDOException $e){
            echo $e -> getMessage();
        }
        $response['online'] = 0;
        session_destroy();
    }else {
        if(isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
            $idCookie = $_COOKIE['id'];
            $online = $_COOKIE['online'];
            try{
                $sql = "UPDATE utilizador SET online=:online WHERE id=:id;";
                $stmt = $pdo -> prepare($sql);
                $stmt -> execute(["online" => 0, "id" => $idCookie]);
                $total = $stmt -> rowCount();
            }catch(PDOException $e){
                echo $e -> getMessage();
            }
            
            $email = $_COOKIE['email'];
            $password = $_COOKIE['password'];
            $nome = $_COOKIE['nome'];
            $id = $_COOKIE['id'];
            $admin = $_COOKIE['admin'];

            setcookie("email", $email, time() + 6400);
            setcookie("password", $password, time() + 6400);
            setcookie("nome", $nome, time() + 6400);
            setcookie("id", $id, time() + 6400);
            setcookie("admin", $admin, time() + 6400);
            setcookie("online", $online, time() + 6400);

            $response['online'] = 0;
        }
    }
    echo json_encode($response);
?>