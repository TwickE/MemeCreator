<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escolhe entre
        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.">
    <title>Meme Creator - Perfil</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/images/Logo.svg" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/principal/style.css" type="text/css" class="ficheiroCSS">
</head>

<body>
    <div id="menu"></div>
    <div style="margin-top: 150px; margin-bottom: 100px;" class="container">
        <div class="row">
            <div id="alertatemplateVerde" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Alterações guardadas com sucesso!</p>
            </div>
            <div id="alertatemplateVerde1" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Meme apagado com sucesso!</p>
            </div>
            <div class="col">
                <div class="col-12 d-flex justify-content-center text-center">
                    <h1 style="max-width: 464px; font-size: 48px; margin-bottom: 45px;">Perfil
                    </h1>
                </div>
                <img style="width: 250px; height: 250px; border: solid 3px black; border-radius: 125px; object-fit: cover;" class="mx-auto mb-5 d-block" id="imagemPerfil" src="../resources/imagesPerfil/noPhotoPerfil.png" alt="Foto de Perfil">
                <div class="col-xs-10 col-sm-6 mt-3 mx-auto">
                    <form action="" method="POST" id="perfilForm" novalidate>
                        <input class="inputes-login mx-auto d-block form-control mb-5" style="width: 350px;" type="file" name="imagePerfil" id="imagePerfil" required>
                        <div class="div-input my-4">
                            <input type="text" class="inputes-login col-12" name="primeiroNomePerfil" id="primeiroNomePerfil" required>
                            <label for="primeiroNomePerfil" class="form-label">Primeiro Nome</label>
                        </div>
                        <div class="div-input mb-4">
                            <input type="text" class="inputes-login col-12" name="ultimoNomePerfil" id="ultimoNomePerfil" required>
                            <label for="ultimoNomePerfil" class="form-label">Último Nome</label>
                        </div>
                        <div class="div-input mb-4">
                            <input type="text" class="inputes-login col-12" name="emailPerfil" id="emailPerfil" required>
                            <label for="emailPerfil" class="form-label">Email</label>
                        </div>

                        <p class="col mb-4 text-danger" id="perfilFormErro"></p>

                        <button type="submit" class="btn-login col-12" id="btnGuardarFormPerfil">Guardar Alterações</button>
                    </form>
                </div>
                <div class="col-12 d-block text-center">
                    <h1 style="margin-bottom: 45px; margin-top: 45px;" id="memesDeNomeUtilizador"></h1>
                </div>
                <?php
                    session_start();

                    if(isset($_SESSION['nome'])) {
                        $nome = $_SESSION['nome'];
                    }else if(isset($_COOKIE['nome'])) {
                        $nome = $_COOKIE['nome'];
                    }

                    echo "<script>document.getElementById('memesDeNomeUtilizador').innerText = 'Os Memes de $nome'</script>";
                ?>
                <div class="scrolling-wrapper col-xl-10 col-xs-12 mx-auto">
                    <?php
                        include("../cnn.php");
                        session_start();

                        if(isset($_SESSION['nome'])) {
                            $id = $_SESSION['id'];
                        }else if(isset($_COOKIE['nome'])) {
                            $id = $_COOKIE['id'];
                        }
                    
                        try{
                            $sql = "SELECT * FROM meme WHERE idUtilizador=:idUtilizador;";
                            $stmt = $pdo -> prepare($sql);
                            $stmt -> execute(["idUtilizador" => $id]);
                    
                            $dados = $stmt->fetchAll();
                            foreach ($dados as $dado => $item) {
                                ?>
                                    <div class="container-card">
                                        <div class="container-card-flex">
                                            <?php echo '<img src=..' . $item['imagemMeme']  . ' alt="imagemMeme"'.' id=Meme'.$item['id'].'>'; ?>
                                            <div>
                                                <button name="transferirMemePerfil" href="" style="width: 210px; margin-bottom: 5px;" type="button" class="btn btn-primary" download="" <?php echo 'data-idmeme=' . $item['id'] . ''; ?>><i style="margin-right: 5px;" class="fas fa-arrow-circle-down"></i>Transferir Meme</button>
                                                <button name="apagarMemePerfil" style="width: 210px;" type="button" class="btn btn-danger" <?php echo 'data-imagemmeme=' . $item['imagemMeme'] . ''; ?> <?php echo 'data-idmeme=' . $item['id'] . ''; ?>><i style="margin-right: 5px;" class="fas fa-trash"></i>Apagar Meme</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                    
                        }catch(PDOException $e){
                            /* '<script>console.log('.$e -> getMessage();.')</script>' */
                        }
                    ?>
                </div>
                <div class="col-xl-5 mx-auto">
                    <a href="criarMeme.php" style="text-decoration: none; color: inherit;"><button style="width: 100%;" class="btn-homePage" href="criarMeme.php">Criar Meme</button></a>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer"></footer>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/82445024cd.js" crossorigin="anonymous"></script>
    <script src="../js/principal/app.js"></script>
</body>

</html>

<?php
include("../cnn.php");
session_start();

try {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
    } else if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
    }

    $sql = "SELECT * FROM utilizador WHERE id=:id;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);
    $total = $stmt->rowCount();

    $dados = $stmt->fetchAll();
    foreach ($dados as $dado => $item) {
        $primeiroNome = $item['primeiroNome'];
        $ultimoNome = $item['ultimoNome'];
        $email = $item['email'];
        $imagem = $item['imagem'];
    }
    echo "<script>document.getElementById('imagemPerfil').src = '..$imagem'</script>";
    echo "<script>document.getElementById('primeiroNomePerfil').value = '$primeiroNome'</script>";
    echo "<script>document.getElementById('ultimoNomePerfil').value = '$ultimoNome'</script>";
    echo "<script>document.getElementById('emailPerfil').value = '$email'</script>";
} catch (PDOException $e) {
    $response['message'] = $e->getMessage();
}
?>