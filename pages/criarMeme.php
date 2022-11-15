
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escolhe entre
        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.">
    <title>Meme Creator - Criar Meme</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/images/Logo.svg" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/godswearhats/jquery-ui-rotatable@1.1/jquery.ui.rotatable.css">
    <link rel="stylesheet" href="../css/principal/style.css" type="text/css" class="ficheiroCSS">
</head>

<body>
    <div id="menu"></div>
    <div style="margin-top: 150px; margin-bottom: 100px;" class="container">
        <div class="row">
            <div id="alertatemplateAmarelo" class="alerta alertaAmarelo col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-exclamation-triangle"></i>Escolha um template primeiro!</p>
            </div>
            <div id="alertatemplateVerde" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Meme guardado com sucesso!</p>
            </div>
            <div id="alertatemplateVerde1" class="alerta alertaVerde col-11 fixed-top mx-auto">
                <p><i style="margin-right: 5px;" class="fas fa-check-circle"></i>Meme apagado com sucesso!</p>
            </div>
            <div class="col">
                <div class="col-12 d-block text-center">
                    <h1 style="margin-bottom: 45px;" id="memesDeNomeUtilizador"></h1>
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
                <div class="scrolling-wrapper">
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
                                                <button name="transferir" href="" style="width: 210px; margin-bottom: 5px;" type="button" class="btn btn-primary" <?php echo 'data-idmeme=' . $item['id'] . ''; ?>><i style="margin-right: 5px;" class="fas fa-arrow-circle-down"></i>Transferir Meme</button>
                                                <button name="apagarMeme" style="width: 210px;" type="button" class="btn btn-danger" <?php echo 'data-imagemmeme=' . $item['imagemMeme'] . ''; ?> <?php echo 'data-idmeme=' . $item['id'] . ''; ?>><i style="margin-right: 5px;" class="fas fa-trash"></i>Apagar Meme</button>
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
                <div class="col-12 d-block text-center">
                    <h1 style="margin-bottom: 45px;">Criar Meme</h1>
                </div>
                <div class="noTouch">
                    <div class="SadTrollFace mb-3">
                        <img src="../resources/images/SadTrollFace.svg" id="sad-troll-face" alt="Sad Troll Face">
                    </div>
                    <h3 style="text-align: center; margin: 10px;">A criação de memes ainda não está dispnível para dispositivos touch!</h3>
                </div>
                <div class="touch d-flex justify-content-start mb-4">
                    <p class="numero-bola">1</p>
                    <h3 style="margin-bottom: 0px;">Escolha um temlate</h3>
                </div>
                <div class="touch scrolling-wrapper">
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
                                            <?php echo '<img src=..' . $item['imagem']  . ' alt="' . $item['nome'] . '">' ?>
                                            <div>
                                                <?php echo '<p>' . $item['nome'] . '</p>' ?>
                                                <button style="width: 210px;" type="button" class="btn btn-primary" name="usar"  <?php echo 'data-imagem=' . $item['imagem'] . ' data-id=' .$item['id'] . ' data-width='.$item['width'].' data-height='.$item['height'].''; ?>>Usar Template</button>
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
                <div class="touch d-flex justify-content-start mb-4">
                    <p class="numero-bola">2</p>
                    <h3 style="margin-bottom: 0px;">Personalize o template com frases</h3>
                </div>
                <div id="scroll1" style="margin-bottom: 45px;" class="touch row">
                    <div class="canvas-container col-xl-6 col-xs-12">
                        <div id="ImageMeme">
                            <div id="caixaTexto2" class="box">
                                <p style="margin-bottom: 0px;" id="texto2S"></p>
                            </div>
                            <div id="caixaTexto1" class="box">
                                <p style="margin-bottom: 0px;" id="texto1S"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xs-12">
                        <div class="containerTextoMeme">
                            <input type="text" id="texto1" name="texto1" placeholder="Texto #1" style="width: 100%; padding-left: 10px; border: none; border-radius: 7px 0px 0px 7px;">
                            <div style="display: flex; flex-direction: row;">
                                <div class="containerTextoMemeCor">
                                    <input id="containerTextoMemeCorP1" name="containerTextoMemeCorP1" type="color" value="#000000">
                                </div>
                                <div class="containerTextoMemeCor">
                                    <input id="containerTextoMemeCorS1" name="containerTextoMemeCorS1" type="color" value="#ffff00">
                                </div>
                                <div id="containerTextoMemeSettings1"><i style="color: white !important;" class="fas fa-cog fa-2x"></i></div>
                            </div>
                        </div>
                        <div id="containerSettings1" class="containerSettings">
                            <div class="containerAlign">
                                <div id="alignLeft1" class="btnAlign"><div class="fas fa-align-left fa-lg"></div></div>
                                <div id="alignCenter1" class="btnAlign"><i class="fas fa-align-center fa-lg"></i></div>
                                <div id="alignRight1" class="btnAlign"><i class="fas fa-align-right fa-lg"></i></div>
                            </div>
                            <div class="containerAlign">
                                <div id="bold1" class="btnAlign"><div class="fas fa-bold fa-lg"></div></div>
                                <div id="italic1" class="btnAlign"><i class="fas fa-italic fa-lg"></i></div>
                                <div id="underline1" class="btnAlign"><i class="fas fa-underline fa-lg"></i></div>
                            </div>
                            <div class="containerFontSize">
                                <p>Font Size:</p>
                                <input id="fontSize1" class="containerFontSizeInput" type="number" value="16">
                            </div>
                            <div class="containerFontSize">
                                <p>Font Shadow:</p>
                                <input id="shadowCheck1" type="checkbox" checked>
                            </div>
                            <div class="containerFontSize mb-3">
                                <p>Font UPPERCASE:</p>
                                <input id="capsCheck1" type="checkbox">
                            </div>
                        </div>
                        <div class="containerTextoMeme">
                            <input type="text" id="texto2" name="texto2" placeholder="Texto #2" style="width: 100%; padding-left: 10px; border: none; border-radius: 7px 0px 0px 7px;">
                            <div style="display: flex; flex-direction: row;">
                                <div class="containerTextoMemeCor">
                                    <input id="containerTextoMemeCorP2" name="containerTextoMemeCorP2" type="color" value="#000000">
                                </div>
                                <div class="containerTextoMemeCor">
                                    <input id="containerTextoMemeCorS2" name="containerTextoMemeCorS2" type="color" value="#ffff00">
                                </div>
                                <div id="containerTextoMemeSettings2"><i style="color: white !important;" class="fas fa-cog fa-2x"></i></div>
                            </div>
                        </div>
                        <div id="containerSettings2" class="containerSettings">
                            <div class="containerAlign">
                                <div id="alignLeft2" class="btnAlign"><div class="fas fa-align-left fa-lg"></div></div>
                                <div id="alignCenter2" class="btnAlign"><i class="fas fa-align-center fa-lg"></i></div>
                                <div id="alignRight2" class="btnAlign"><i class="fas fa-align-right fa-lg"></i></div>
                            </div>
                            <div class="containerAlign">
                                <div id="bold2" class="btnAlign"><div class="fas fa-bold fa-lg"></div></div>
                                <div id="italic2" class="btnAlign"><i class="fas fa-italic fa-lg"></i></div>
                                <div id="underline2" class="btnAlign"><i class="fas fa-underline fa-lg"></i></div>
                            </div>
                            <div class="containerFontSize">
                                <p>Font Size:</p>
                                <input id="fontSize2" class="containerFontSizeInput" type="number" value="16">
                            </div>
                            <div class="containerFontSize">
                                <p>Font Shadow:</p>
                                <input id="shadowCheck2" type="checkbox" checked>
                            </div>
                            <div class="containerFontSize mb-3">
                                <p>Font UPPERCASE:</p>
                                <input id="capsCheck2" type="checkbox">
                            </div>
                        </div>
                        <button class="btn btn-primary btnCriarMeme" id="continuar"><i style="margin-right: 10px;" class="fas fa-eye"></i>Previsualizar</button>
                        <p id="idTemplate" style="display: none;"></p>
                    </div>
                </div>
                <div id="scroll" class="visivel">
                    <div class="touch d-flex justify-content-start mb-4">
                        <p class="numero-bola">3</p>
                        <h3 style="margin-bottom: 0px;">Previsualize o seu Meme antes de Guardar ou Transferir</h3>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-between">
                            <div id="memeResult"></div>
                            <button id="guardarMeme" class="btn btn-primary btnCriarMeme"><i style="margin-right: 10px;" class="fas fa-save"></i>Guardar Meme</button>
                            <a id="transferirMeme" href="" class="btn btn-primary btnCriarMeme"><i style="margin-right: 10px;" class="fas fa-arrow-circle-down"></i>Transferir Meme</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer"></footer>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/godswearhats/jquery-ui-rotatable@1.1/jquery.ui.rotatable.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/html2canvas.js"></script>
    <script src="https://kit.fontawesome.com/82445024cd.js" crossorigin="anonymous"></script>
    <script src="../js/principal/app.js"></script>
    <script src="../js/principal/canvas.js"></script>
</body>

</html>