<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Escolhe entre
        dezenas de templates dos mais populares memes. Com o <b>Meme Creator</b> podes criar os teus
        próprios memes de uma maneira fácil, simples e gratuita, experimenta já.">
    <title>Meme Creator - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="../resources/images/Logo.svg" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/principal/style.css" type="text/css" class="ficheiroCSS">
</head>

<body>
    <div id="menu"></div>
    <div style="margin-top: 100px; margin-bottom: 100px;" class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h1 class="font-h1 text-center">Entrar</h1>
            </div>
            <div class="col-xs-10 col-sm-6 mt-3 mx-auto">
                <form action="" method="POST" id="loginForm" novalidate>
                    <div class="div-input mb-4">
                        <input type="text" class="inputes-login col-12" name="email" id="email" required>
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="div-input mb-4 d-flex flex-row">
                        <input type="password" class="inputes-login col-11" name="password" id="password" required>
                        <label for="password" class="form-label">Password</label>
                        <div class="div-olho-password">
                            <i id="registo-password" class="olho-password fas fa-eye-slash fa-lg col-1 my-auto"></i>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar">
                        <label class="form-check-label" for="lembrar">Lembrar-me</label>
                    </div>

                    <div class="col mb-4 text-danger" id="loginFormErro"></div>

                    <button type="submit" class="btn-login col-12" id="loginFormLogin">Entrar</button>
                    <p class="text-center mt-5 mb-3">Ainda não tem conta?</p>
                    <button type="button" class="btn-login col-12" id="btnLoginFormRegisto">Criar Conta</button>
                </form>
            </div>
        </div>
    </div>
    <footer id="footer"></footer>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/82445024cd.js" crossorigin="anonymous"></script>
    <script src="../js/principal/app.js"></script>
    <script> console.log("Password: Istec/100"); </script>
</body>

</html>

<?php
    if(isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];

        echo "<script>document.getElementById('email').value = '$email'</script>";
        echo "<script>document.getElementById('password').value = '$password'</script>";
    }
?>