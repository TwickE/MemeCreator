$(document).ready(function () {

    //Altera o text do botão Utilizador se o utilizador estiver logado
    $.ajax({
        type: "POST",
        url: "../verificaLogin.php",
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if(response.status == 1) {
                $("#btn-utlizador").html(`<i style="padding: 8px;" class="fas fa-user fa-lg"></i>${response.nome}`);
            }
        }
    });

    //Ação do botão Utilizador no menu de navegação
    $("#btn-utlizador").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../verificaLogin.php",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response.status == 2) {
                    window.location.href = "paginaLogin.php";
                }else if(response.status == 1) {
                    if(response.admin == 1) {
                        if($('.container-utilizador').css('display') == 'flex'){
                            $(".container-utilizador").css("display", "none");
                        }else {
                            $(".container-utilizador").css("display", "flex");
                            $("#btn-admin").css("display", "block")
                            $("#email-container-utilizador").text(response.email);
                            $("#nome-container-utilizador").text(response.nome);
                            $("#btn-utlizador").html(`<i class="nav-link fas fa-user fa-lg"></i>${response.nome}`);
                        }
                    }else {
                        if($('.container-utilizador').css('display') == 'flex'){
                            $(".container-utilizador").css("display", "none");
                        }else {
                            $(".container-utilizador").css("display", "flex");
                            $("#btn-admin").css("display", "none")
                            $("#email-container-utilizador").text(response.email);
                            $("#nome-container-utilizador").text(response.nome);
                            $(".container-utilizador").css("height", "190px");
                            $("#btn-utlizador").html(`<i class="nav-link fas fa-user fa-lg"></i>${response.nome}`);
                        }
                    }
                }else if(response.status == 0) {
                    window.location.href = "paginaLogin.php";
                }
            }
        });
    });

    //Ação do botão Treminar Sessão no menu do utilizador
    $("#btn-terminar-sessao").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $.ajax({
            type: "POST",
            url: "../logout.php",
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response.online == 0) {
                    $(".container-utilizador").css("display", "none");
                    window.location.href = "paginaLogin.php";
                }
            }
        });
    });

    //Ação do botão Painel de Administração no menu do utilizador
    $("#btn-admin").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        window.location.href = "painelAdministracao.php";
    });

    //Ação do botão Perfil no menu do utilizador
    $("#btn-area-utilizador").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();
        window.location.href = "perfil.php";
    });

    //Sempre que uma página é carregada este código verifica qual 
    //o tema anteriormente aplicado pelo utilizador
    const theme = document.querySelector(".ficheiroCSS");
    if(window.localStorage.getItem('theme') == null) {
        window.localStorage.setItem('theme', 'light');
    }else if((window.localStorage.getItem('theme') == "light")) {
        theme.href = "../css/principal/style.css";

        $("#btn-theme-icon").removeClass('fa-sun');
        $("#btn-theme-icon").addClass('fa-moon');
        $("#btn-theme-icon").css('color', '#f5f5f5');

        $("#btn-theme").removeClass('btn-light');
        $("#btn-theme").addClass('btn-dark');
        $("#btn-theme").css('color', '#f5f5f5');

        $("#menu-theme").removeClass('navbar-dark');
        $("#menu-theme").removeClass('bg-dark');
        $("#menu-theme").addClass('navbar-light');
        $("#menu-theme").addClass('bg-light');

        $("#footer-theme").removeClass('navbar-dark');
        $("#footer-theme").removeClass('bg-dark');
        $("#footer-theme").addClass('navbar-light');
        $("#footer-theme").addClass('bg-light');
    }else {
        theme.href = "../css/principal/styleDark.css";

        $("#btn-theme-icon").removeClass('fa-moon');
        $("#btn-theme-icon").addClass('fa-sun');
        $("#btn-theme-icon").css('color', '#191c1f');

        $("#btn-theme").removeClass('btn-dark');
        $("#btn-theme").addClass('btn-light');
        $("#btn-theme").css('color', '#191c1f');

        $("#menu-theme").removeClass('navbar-light');
        $("#menu-theme").removeClass('bg-light');
        $("#menu-theme").addClass('navbar-dark');
        $("#menu-theme").addClass('bg-dark');

        $("#footer-theme").removeClass('navbar-light');
        $("#footer-theme").removeClass('bg-light');
        $("#footer-theme").addClass('navbar-dark');
        $("#footer-theme").addClass('bg-dark');
    }

    //Ação do botão que alterna entre o tema escuro e claro do site
    $("#btn-theme").click(function(evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if(window.localStorage.getItem('theme') == "light") {
            window.localStorage.setItem('theme', 'dark');
            theme.href = "../css/principal/styleDark.css";

            $("#btn-theme-icon").removeClass('fa-moon');
            $("#btn-theme-icon").addClass('fa-sun');
            $("#btn-theme-icon").css('color', '#191c1f');
            
            $("#btn-theme").removeClass('btn-dark');
            $("#btn-theme").addClass('btn-light');
            $("#btn-theme").css('color', '#191c1f');

            $("#menu-theme").removeClass('navbar-light');
            $("#menu-theme").removeClass('bg-light');
            $("#menu-theme").addClass('navbar-dark');
            $("#menu-theme").addClass('bg-dark');

            $("#footer-theme").removeClass('navbar-light');
            $("#footer-theme").removeClass('bg-light');
            $("#footer-theme").addClass('navbar-dark');
            $("#footer-theme").addClass('bg-dark');
        }else {
            window.localStorage.setItem('theme', 'light');
            theme.href = "../css/principal/style.css";

            $("#btn-theme-icon").removeClass('fa-sun');
            $("#btn-theme-icon").addClass('fa-moon');
            $("#btn-theme-icon").css('color', '#f5f5f5');

            $("#btn-theme").removeClass('btn-light');
            $("#btn-theme").addClass('btn-dark');
            $("#btn-theme").css('color', '#f5f5f5');

            $("#menu-theme").removeClass('navbar-dark');
            $("#menu-theme").removeClass('bg-dark');
            $("#menu-theme").addClass('navbar-light');
            $("#menu-theme").addClass('bg-light');

            $("#footer-theme").removeClass('navbar-dark');
            $("#footer-theme").removeClass('bg-dark');
            $("#footer-theme").addClass('navbar-light');
            $("#footer-theme").addClass('bg-light');
        }
    });
});