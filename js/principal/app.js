$(document).ready(function () {
    //Carrega o menu na página
    $("#menu").load("menu.html");
    $("#footer").load("footer.html");

    //Ação do botão Criar Conta no formulário de Login
    $("#loginForm").on('submit', function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../login.php",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $("#loginFormErro").css("display", "block");
                if(response.status == 1) {
                    //Limpa o form
                    $("#loginForm")[0].reset();
                    $("#loginFormErro").html(response.message);
                }else {
                    $("#loginFormErro").css("display", "block");
                    $("#loginFormErro").html(response.message);
                }
            }
        });
    });

    //Ação do botão Criar Conta no formulário de Login
    $("#btnLoginFormRegisto").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        window.location.href = "paginaRegisto.html";
    });

    //Ação do botão Login no formulário de Registo
    $("#btnRegistoFormLogin").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        window.location.href = "paginaLogin.php";
    });

    //Ação do botão Ciar Conta no formulário de Registo
    $("#registoForm").on('submit', function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../registo.php",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $("#registoFormErro").css("display", "block");
                if(response.status == 1) {
                    //Limpa o form
                    $("#registoForm")[0].reset();
                    $("#registoFormErro").css("display", "none");
                    window.location.href = "paginaLogin.php";
                }else {
                    $("#registoFormErro").css("display", "block");
                    $("#registoFormErro").html(response.message);
                }
            }
        });
    });

    //Ação do botão Criar Template no formulário de Criar Template
    $("#criarTemplateForm").on('submit', function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../uploadTemplate.php",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                 if(response.status == 1) {
                     $("#inserirTemplateFormErro").text(response.message);
                }else if(response.status == 2) {
                    $("#inserirTemplateFormErro").css("display", "none");
                    $("#alertatemplateVerde").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateVerde").css("display", "none");
                        setTimeout( function() {
                            window.location.href = "painelAdministracao.php";
                        }, 500);
                    }, 1500);
                    $("#criarTemplateForm")[0].reset();
                }
            }
        });
    });

    //Ação do botão Apagar Template no Cartão de Template
    $("[name = 'del']").click(function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            url: "../apagarTemplate.php",
            method: 'post',
            dataType: 'json',
            data: {
                id: $(evt.target).data('id')
            },
            success: function(response) {
                if(response.status == 2) {
                    $("#alertatemplateVermelho").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateVermelho").css("display", "none");
                        setTimeout( function() {
                            window.location.href = "painelAdministracao.php";
                        }, 500);
                    }, 1500);
                }
            }
        });
    });

    //Ação do botão Guardar Alterações no formulário de Perfil
    $("#perfilForm").on('submit', function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../updatePerfil.php",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                 if(response.status == 1) {
                    $("#perfilFormErro").css("display", "block");
                     $("#perfilFormErro").html(response.message);
                }else if(response.status == 2) {
                    $("#perfilFormErro").css("display", "none");
                    $("#alertatemplateVerde").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateVerde").css("display", "none");
                        setTimeout( function() {
                            window.location.href = "perfil.php";
                        }, 500);
                    }, 1500);
                }
            }
        });
    });

    //Ação do botão Criar Meme na página inicial
    $("#btnCriarMeme").click(function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            url: "../verificaLogin.php",
            method: 'post',
            dataType: 'json',
            success: function(response) {
                if(response.status == 1) {
                    window.location.href = "criarMeme.php";
                }else{
                    $("#alertatemplateAmarelo").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateAmarelo").css("display", "none");
                    }, 2000);
                }
            }
        });
    });

    //Ação do botão Mais Informações sobre o meme na página inicial
    $("[name = 'informacoes']").click(function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        var myStr = $(evt.target).data('nometemplate');
        var newStr = myStr.replace(/_/g, " ");
        
        $('#modalAutor').html("<b>Autor:</b> " + $(evt.target).data('autormeme'));
        $('#modalImagem').attr("src", ".." + $(evt.target).data('imagemmeme'));
        $('#exampleModalLabel').text(newStr);
    });

    //Clique no botão Transferir Meme no scrolling-wrapper dos memes do utilizador
    $("#modalTransferir").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        
        let imagem = document.getElementById("modalImagem");
        
        let dataUrl = getDataUrl(imagem);
        let myElm = document.createElement("a");
        
        myElm.setAttribute("id", "download");
        myElm.download = "Meme.png";
        myElm.href = dataUrl;
        myElm.click();
    });

    //Clique no botão Transferir Meme no scrolling-wrapper dos memes do utilizador
    $("[name = 'transferirMemePerfil']").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        let id = $(this).attr("data-idMeme");
        let imagem = document.getElementById("Meme"+id);
        const dataUrl = getDataUrl(imagem);

        let myElm = document.createElement("a");
        
        myElm.setAttribute("id", "download");
        myElm.download = "Meme.png";
        myElm.href = dataUrl;
        myElm.click();
    });

    //Clique no botão Apagar Meme no scrolling-wrapper dos memes do utilizador
    $("[name = 'apagarMemePerfil']").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            url: "../apagarMeme.php",
            method: 'post',
            dataType: 'json',
            data: {
                idMeme: $(evt.target).data('idmeme'),
                imagemMeme: $(evt.target).data('imagemmeme')
            },
            success: function(response) {
                if(response.status == 2) {
                    $("#alertatemplateVerde1").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateVerde1").css("display", "none");
                        setTimeout( function() {
                            window.location.href = "perfil.php";
                        }, 500);
                    }, 1500);
                }
            }
        });
    });

    //Clique no botão do olho para ver ou não ver a password na página de registo
    $("#registo-password").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if($("#registo-password").hasClass('fa-eye-slash')) {
            $("#registo-password").removeClass('fa-eye-slash');
            $("#registo-password").addClass('fa-eye');

            var pass = document.getElementById('password');
            pass.type = 'text';
        }else {
            $("#registo-password").removeClass('fa-eye');
            $("#registo-password").addClass('fa-eye-slash');

            var pass = document.getElementById('password');
            pass.type = 'password';
        }
    });

    //Clique no botão do olho para ver ou não ver a password na página de registo
    $("#registo-password-confirmar").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if($("#registo-password-confirmar").hasClass('fa-eye-slash')) {
            $("#registo-password-confirmar").removeClass('fa-eye-slash');
            $("#registo-password-confirmar").addClass('fa-eye');

            var pass = document.getElementById('confirmarPassword');
            pass.type = 'text';
        }else {
            $("#registo-password-confirmar").removeClass('fa-eye');
            $("#registo-password-confirmar").addClass('fa-eye-slash');

            var pass = document.getElementById('confirmarPassword');
            pass.type = 'password';
        }
    });

    //Quando um administrador escolhe uma imagem para template
    $("#image").change(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const file = evt.target.files[0];
        const  fileType = file['type'];
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            $("#inserirTemplateFormErro").html("Faça upload de um ficheiro .png, .jpg ou .jpeg");
        }else {
            let url = URL.createObjectURL(file);
            document.querySelector("#imagePreviewTemplate").src = url;
            $("#inserirTemplateFormErro").html("");
        }
    });

    //Quando um utilizador escolhe uma imagem de perfil
    $("#imagePerfil").change(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const file = evt.target.files[0];
        const  fileType = file['type'];
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(fileType)) {
            $("#perfilFormErro").html("Faça upload de um ficheiro .png, .jpg ou .jpeg");
        }else {
            let url = URL.createObjectURL(file);
            document.querySelector("#imagemPerfil").src = url;
            $("#perfilFormErro").html("");
        }
    });

    //Codifica uma imagem para base64
    function getDataUrl(img) {
        // Create canvas
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        // Set width and height
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        // Draw the image
        ctx.drawImage(img, 0, 0);
        return canvas.toDataURL('image/png');
     }
});
