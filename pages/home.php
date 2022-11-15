<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escolhe entre
        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.">
    <title>Meme Creator</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/images/Logo.svg" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/principal/style.css" type="text/css" class="ficheiroCSS">
</head>

<body>
    <div id="menu"></div>
    <div style="margin-top: 150px; margin-bottom: 100px;" class="container">
        <div class="row">
            <div id="alertatemplateAmarelo" class="alerta alertaAmarelo col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-exclamation-triangle"></i>Registe-se primeiro ou faça login para puder prosseguir!</p>
            </div>
            <div class="col-xl-6 col-xs-12">
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <h1 style="max-width: 464px; font-size: 48px; margin-bottom: 45px;">Cria os teus próprios Memes
                    </h1>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <p style="max-width: 617px; font-size: 24px; margin-bottom: 50px; color: #767676;">Escolhe entre
                        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
                        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.</p>
                </div>
                <div class="d-flex flex-row justify-content-xl-start justify-content-center">
                    <div class="d-flex flex-column justify-content-xl-start justify-content-center">
                        <button id="btnCriarMeme" style="margin-bottom: 45px;" class="btn-homePage mb-xs-5">Criar Meme</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xs-12 d-flex flex-column justify-content-center">
                <img style="max-width: 597px; object-fit: scale-down;" src="../resources/images/Home-Image.png"
                    alt="Imagem dos Memes">
            </div>
            <div style="margin-top: 45px;" class="col-xl-5 col-xs-12 order-xl-3">
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <h1 style="font-size: 48px; margin-bottom: 45px;">Memes dos nossos utilizadores</h1>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <p style="max-width: 617px; font-size: 24px; margin-bottom: 50px; color: #767676;">Aqui podes ver 
                    alguns memes já criados pelos nossos utilizadores, inspira-te e cria tu também memes incriveis como
                     estes.</p>
                </div>
            </div>
            <div class="col-xl-1 col-xs-0 order-xl-2"></div>
            <div style="margin-top: 45px;" class="col-xl-6 col-xs-11 mx-auto order-xl-1">
                <div class="scrolling-wrapper">
                    <?php
                        include("../cnn.php");

                        try{
                            $sql = "SELECT meme.*, utilizador.primeiroNome, template.nome FROM meme JOIN utilizador ON utilizador.id LIKE meme.idUtilizador JOIN template ON template.id LIKE meme.idTemplate LIMIT 10;";
                            $stmt = $pdo -> prepare($sql);
                            $stmt -> execute();
                    
                            $dados = $stmt->fetchAll();
                            foreach ($dados as $dado => $item) {
                                ?>
                                    <div class="container-card">
                                        <div class="container-card-flex">
                                            <?php echo '<img src=..' . $item['imagemMeme']  . ' alt="imagemMeme"'.'>'; ?>
                                            <div class="d-flex flex-column">
                                                <p style="font-weight: normal;"><b>Autor:</b> <?php echo $item['primeiroNome'] ?></p>
                                                <button type="button" name="informacoes" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" <?php $nome = $item['nome']; $replaced = str_replace(' ', '_', $nome); echo 'data-nometemplate='.$replaced; ?> <?php echo 'data-autormeme='.$item['primeiroNome'] ?> <?php echo 'data-imagemmeme='.$item['imagemMeme'] ?> <?php echo 'data-idmeme='.$item['id'] ?>><i style="margin-right: 10px;" class="fas fa-eye"></i>Mais Informações</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                    
                        }catch(PDOException $e){
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer"></footer>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal-content" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-row justify-content-center">
                <img style="max-width: 450px; object-fit: scale-down;" id="modalImagem" src="" alt="imagemMeme">
            </div>
            <div class="modal-footer d-flex flex-row justify-content-between">
                <p id="modalAutor"><b>Autor:</b> Frederico</p>
                <button id="modalTransferir" href="" type="button" class="btn btn-primary"><i style="margin-right: 5px;" class="fas fa-arrow-circle-down"></i>Transferir Meme</button>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/82445024cd.js" crossorigin="anonymous"></script>
    <script src="../js/principal/app.js"></script>
</body>

</html>