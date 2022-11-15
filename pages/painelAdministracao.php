<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escolhe entre
        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.">
    <title>Meme Creator - Painel de Administração</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/images/Logo.svg" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/principal/style.css" type="text/css" class="ficheiroCSS">
</head>

<body>
    <div id="menu"></div>
    <div style="margin-top: 150px; margin-bottom: 100px;" class="container">
        <div class="row d-flex justify-content-center">
            <div id="alertatemplateVerde" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Template criado com sucesso!</p>
            </div>
            <div id="alertatemplateVermelho" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Template desativado com sucesso!</p>
            </div>
            <!-- <div class="col-xl-3 col-xs-12 d-flex flex-column">
                <h1 style="font-size: 48px; margin-bottom: 45px;" class="mx-auto">Tree View</h1>
                
            </div>
            <div class="col-xl-1 col-xs-0"></div> -->
            <div class="col-xl-9 col-xs-12 d-flex flex-column">
                <div class="d-flex justify-content-center text-center">
                    <h1 style="font-size: 48px; margin-bottom: 45px;">Painel de Administração</h1>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <h3 style="margin-bottom: 25px;">Templates Existentes</h3>
                </div>
                <div class="scrolling-wrapper col-12">
                <?php
                    include("../cnn.php");
                
                    try{
                        $sql = "SELECT * FROM template WHERE ativo=:ativo;";
                        $stmt = $pdo -> prepare($sql);
                        $stmt -> execute(["ativo" => 1]);
                
                        $dados = $stmt->fetchAll();
                        foreach ($dados as $dado => $item) {
                            ?>
                                <div class="container-card">
                                    <div class="container-card-flex">
                                        <?php echo '<img src=..' . $item['imagem'] . ' alt="' . $item['nome'] . '">' ?>
                                        <div>
                                            <?php echo '<p>' . $item['nome'] . '</p>' ?>
                                            <button style="width: 210px;" type="button" class="btn btn-danger" name="del" <?php echo 'data-id=' . $item['id'] . ''; ?>><i
                                             style="margin-right: 5px;" class="fas fa-trash"></i>Apagar Template</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        
                        $response['message'] = 'Template OK';
                        $response['status'] = 2;
                
                    }catch(PDOException $e){
                        $response['message'] = $e -> getMessage();
                        $response['status'] = 1;
                    }
                ?>
                </div>
                <div class="col-12 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                    <h3 style="margin-bottom: 25px;">Criar Template</h3>
                </div>
                <form id="criarTemplateForm" action="" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="col-12 d-flex flex-xl-row flex-column">
                        <div class="col-xl-6 col-xs-12 my-auto">
                            <div class="div-input mb-4">
                                <input type="text" class="inputes-login col-12" name="nome" id="nome" required>
                                <label for="nome" class="form-label">Nome do Template</label>
                            </div>
                            <div class="mb-4">
                                <input type="file" class="inputes-login col-12 form-control" name="image" id="image" required>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-xl-5 col-xs-12 d-flex flex-column">
                            <h4 class="text-center mb-4">Previsualização da Imagem</h4>
                            <div class="d-flex justify-content-center">
                                <img id="imagePreviewTemplate" style="border: 2px solid black;" class="col-8" src="../resources/images/PreviewImage.png" alt="imagemSelecionadaPreview">
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4 text-danger" id="inserirTemplateFormErro"></div>
                    <button type="submit" class="btn-login col-12" id="btnInserirTemplateForm">Criar Template</button>
                </form>

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