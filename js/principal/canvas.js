$(document).ready(function () {
    //Ação do botão Usar Template no Cartão de Template
    $("[name = 'usar']").click(function (evt) {
        var imagem = new Image();
        imagem.src = ".." + $(evt.target).data('imagem');
        
        var imagemUrl = imagem.src = ".." + $(evt.target).data('imagem');
        var this_w = $(evt.target).data('width');
        var this_h = $(evt.target).data('height');

        var max_w = 390;
        var max_h = 1000;
        if (this_w / this_h < max_w / max_h) {
            var h = max_h;
            var w = Math.ceil(max_h / this_h * this_w);
        } else {
            var w = max_w;
            var h = Math.ceil(max_w / this_w * this_h);
        }
        $("#ImageMeme").css({ height: h, width: w });

        $("#ImageMeme").css("background-image", "url(" + imagemUrl + ")");

        $('.box').css('visibility','visible');

        let id = $(this).data("id")
        $('#idTemplate').text(id);

        $('html,body').animate({
            scrollTop: $("#scroll1").offset().top
        },'slow');
    });

    //Chama a funcção isTouchScreendevice()
    if (isTouchScreendevice()) {
        $(".touch").attr("style", "display: none !important");
    } else {
        $(".noTouch").attr("style", "display: none !important");
    }

    //Clique no Input de Texto1
    $("[name = 'texto1']").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($('#ImageMeme').css('background-image') == 'none') {

            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        }
    });

    //Clique no Input de Texto2
    $("[name = 'texto2']").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($('#ImageMeme').css('background-image') == 'none') {

            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        }
    });

    //Clique no botão Settings do Input de Texto1
    $('#containerTextoMemeSettings1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            if ($('#containerSettings1').css('display') == 'none') {
                $('#containerSettings1').css("display", "flex");
            } else {
                $('#containerSettings1').css("display", "none");
            }
        }
    });

    //Clique no botão Settings do Input de Texto2
    $('#containerTextoMemeSettings2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            if ($('#containerSettings2').css('display') == 'none') {
                $('#containerSettings2').css("display", "flex");
            } else {
                $('#containerSettings2').css("display", "none");
            }
        }
    });

    //Passa o valor do Input de Texto1 para a Caixa de Texto1
    $("#texto1").keyup(function () {
        var txt1 = $("#texto1").val();
        $("#texto1S").text(txt1);
    });

    //Passa o valor do Input de Texto2 para a Caixa de Texto2
    $("#texto2").keyup(function () {
        var txt2 = $("#texto2").val();
        $("#texto2S").text(txt2);
    });

    var text1 = document.getElementById("texto1S");

    var text2 = document.getElementById("texto2S");

    var containerTextoMemeCorP1 = document.getElementById("containerTextoMemeCorP1");

    var containerTextoMemeCorP2 = document.getElementById("containerTextoMemeCorP2");

    //Mudar a cor do Texto1
    containerTextoMemeCorP1.addEventListener('click', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text1.style.color = this.value;
        }
    });
    //Mudar a cor do Texto1
    containerTextoMemeCorP1.addEventListener('change', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text1.style.color = this.value;
        }
    });

    //Mudar a cor do Texto2
    containerTextoMemeCorP2.addEventListener('click', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text2.style.color = this.value;
        }
    });

    //Mudar a cor do Texto2
    containerTextoMemeCorP2.addEventListener('change', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text2.style.color = this.value;
        }
    });

    var containerTextoMemeCorS1 = document.getElementById("containerTextoMemeCorS1");

    var containerTextoMemeCorS2 = document.getElementById("containerTextoMemeCorS2");

    //Mudar a cor da sombra do Texto1
    containerTextoMemeCorS1.addEventListener('click', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text1.style.textShadow = "0px 0px 3px " + this.value;
            $('#shadowCheck1').prop('checked', true);
        }
    });

    //Mudar a cor da sombra do Texto1
    containerTextoMemeCorS1.addEventListener('change', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text1.style.textShadow = "0px 0px 3px " + this.value;
        }
    });

    //Mudar a cor da sombra do Texto2
    containerTextoMemeCorS2.addEventListener('click', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text2.style.textShadow = "0px 0px 3px " + this.value;
            $('#shadowCheck2').prop('checked', true);
        }
    });

    //Mudar a cor da sombra do Texto2
    containerTextoMemeCorS2.addEventListener('change', function () {
        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        } else {
            text2.style.textShadow = "0px 0px 3px " + this.value;
        }
    });
    
    let cor = "#FFFFFF";
    if(window.localStorage.getItem('theme') == "light") {
        cor = "#FFFFFF";
    }else if((window.localStorage.getItem('theme') == "dark")) {
        cor = "#242424"
    }

    $("#alignCenter1").css("background-color", "#0D6EFD");
    $("#alignCenter2").css("background-color", "#0D6EFD");

    //Mudar o alinhamento do Texto1 para a esquerda
    $('#alignLeft1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft1").css("background-color", "#0D6EFD");
        $("#alignCenter1").css("background-color", cor);
        $("#alignRight1").css("background-color", cor);

        $("#texto1S").css("text-align", "left");
    });

    //Mudar o alinhamento do Texto2 para a esquerda
    $('#alignLeft2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft2").css("background-color", "#0D6EFD");
        $("#alignCenter2").css("background-color", cor);
        $("#alignRight2").css("background-color", cor);

        $("#texto2S").css("text-align", "left");
    });

    //Mudar o alinhamento do Texto1 para o centro
    $('#alignCenter1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft1").css("background-color", cor);
        $("#alignCenter1").css("background-color", "#0D6EFD");
        $("#alignRight1").css("background-color", cor);

        $("#texto1S").css("text-align", "center");
    });

    //Mudar o alinhamento do Texto2 para o centro
    $('#alignCenter2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft2").css("background-color", cor);
        $("#alignCenter2").css("background-color", "#0D6EFD");
        $("#alignRight2").css("background-color", cor);

        $("#texto2S").css("text-align", "center");
    });

    //Mudar o alinhamento do Texto1 para a direita
    $('#alignRight1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft1").css("background-color", cor);
        $("#alignCenter1").css("background-color", cor);
        $("#alignRight1").css("background-color", "#0D6EFD");

        $("#texto1S").css("text-align", "right");
    });

    //Mudar o alinhamento do Texto2 para a direita
    $('#alignRight2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        $("#alignLeft2").css("background-color", cor);
        $("#alignCenter2").css("background-color", cor);
        $("#alignRight2").css("background-color", "#0D6EFD");

        $("#texto2S").css("text-align", "right");
    });

    //Mudar o Texto1 para a bold
    $('#bold1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const t = document.getElementById("texto1S");
        if (t.style.fontWeight == "bold") {
            $("#texto1S").css("font-weight", "normal");
            $("#bold1").css("background-color", cor);
        } else {
            $("#texto1S").css("font-weight", "bold");
            $("#bold1").css("background-color", "#0D6EFD");
        }
    });

    //Mudar o Texto2 para a bold
    $('#bold2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const t = document.getElementById("texto2S");
        if (t.style.fontWeight == "bold") {
            $("#texto2S").css("font-weight", "normal");
            $("#bold2").css("background-color", cor);
        } else {
            $("#texto2S").css("font-weight", "bold");
            $("#bold2").css("background-color", "#0D6EFD");
        }
    });

    //Mudar o Texto1 para a italic
    $('#italic1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($("#texto1S").css("font-style") == "italic") {
            $("#texto1S").css("font-style", "normal");
            $("#italic1").css("background-color", cor);
        } else {
            $("#texto1S").css("font-style", "italic");
            $("#italic1").css("background-color", "#0D6EFD");
        }
    });

    //Mudar o Texto1 para a italic
    $('#italic2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($("#texto2S").css("font-style") == "italic") {
            $("#texto2S").css("font-style", "normal");
            $("#italic2").css("background-color", cor);
        } else {
            $("#texto2S").css("font-style", "italic");
            $("#italic2").css("background-color", "#0D6EFD");
        }
    });

    //Sublinha o Texto1
    $('#underline1').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const t = document.getElementById("texto1S");
        if (t.style.textDecoration == "underline") {
            $("#texto1S").css("text-decoration", "none");
            $("#underline1").css("background-color", cor);
        } else {
            $("#texto1S").css("text-decoration", "underline");
            $("#underline1").css("background-color", "#0D6EFD");
        }
    });

    //Sublinha o Texto2
    $('#underline2').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        const t = document.getElementById("texto2S");
        if (t.style.textDecoration == "underline") {
            $("#texto2S").css("text-decoration", "none");
            $("#underline2").css("background-color", cor);
        } else {
            $("#texto2S").css("text-decoration", "underline");
            $("#underline2").css("background-color", "#0D6EFD");
        }
    });

    //Muda o tamanho da font do Texto1
    $("#fontSize1").change(function () {
        var fontSize1 = $(this).val();
        $("#texto1S").css({ "font-size": fontSize1 + "px" });
    });

    //Muda o tamanho da font do Texto2
    $("#fontSize2").change(function () {
        var fontSize2 = $(this).val();
        $("#texto2S").css({ "font-size": fontSize2 + "px" });
    });

    //Desablita a sombra na font do Texto1
    $("#shadowCheck1").change(function () {
        if ($("#shadowCheck1").is(':checked')) {
            text1.style.textShadow = "0px 0px 3px " + containerTextoMemeCorS1.value;
        } else {
            text1.style.textShadow = "0px 0px 0px ";
        }
    });

    //Desablita a sombra na font do Texto2
    $("#shadowCheck2").change(function () {
        if ($("#shadowCheck2").is(':checked')) {
            text2.style.textShadow = "0px 0px 3px " + containerTextoMemeCorS1.value;
        } else {
            text2.style.textShadow = "0px 0px 0px ";
        }
    });

    //Muda o Texto1 para letras maiúsculas
    $("#capsCheck1").change(function () {
        if ($("#capsCheck1").is(':checked')) {
            text1.style.textTransform = "uppercase";
        } else {
            text1.style.textTransform = "none";
        }
    });

    //Muda o Texto1 para letras maiúsculas
    $("#capsCheck2").change(function () {
        if ($("#capsCheck2").is(':checked')) {
            text2.style.textTransform = "uppercase";
        } else {
            text2.style.textTransform = "none";
        }
    });

    //Torana a caixa de texto do Texto1 movível
    $("#caixaTexto1").draggable({
        start: function() {
            $("#caixaTexto1").css("margin", "0");
        },
        containment: "parent"
    });
    //Torana a caixa de texto do Texto1 ajustável
    $("#caixaTexto1").resizable({
        containment: "parent",
        minWidth: 50,
        handles: "n, e, s, w"
    });
    //Torana a caixa de texto do Texto1 rodável
    $("#caixaTexto1").rotatable();

    //Torana a caixa de texto do Texto2 movível
    $("#caixaTexto2").draggable({
        start: function() {
            $("#caixaTexto2").css("margin", "0");
        },
        containment: "parent"
    });

    //Torana a caixa de texto do Texto2 ajustável
    $("#caixaTexto2").resizable({
        containment: "parent",
        minWidth: 50,
        handles: "n, e, s, w"
    });
    //Torana a caixa de texto do Texto2 rodável
    $("#caixaTexto2").rotatable();

    //Ação do botão Continuar
    $('#continuar').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        if ($('#ImageMeme').css('background-image') == 'none') {
            $("#alertatemplateAmarelo").css("display", "flex");
            setTimeout(function () {
                $("#alertatemplateAmarelo").css("display", "none");
            }, 1500);
        }else {
            $(".box").css("border", "3px dashed transparent");
            $("div").removeClass("ui-rotatable-handle")
            $("#caixaTexto1").draggable("disable");
            $("#caixaTexto2").draggable("disable");
            $("#caixaTexto1").resizable("disable");
            $("#caixaTexto2").resizable("disable");
            $("#caixaTexto1").rotatable("disable");
            $("#caixaTexto2").rotatable("disable");
            $(".box").css("cursor", "default");
            $(".visivel").css("display", "block");
            $('#continuar').prop("disabled", true);
            $("[name = 'usar']").prop("disabled", true);

            const meme = document.querySelector("#ImageMeme");

            html2canvas(meme).then(function (canvas) {
                document.querySelector("#memeResult").append(canvas);
                let cvs = document.querySelector("canvas");
                let btnDownload = document.querySelector("#transferirMeme");
                btnDownload.download = "Meme.png";
                btnDownload.href = cvs.toDataURL();
            });

            $('html,body').animate({
                scrollTop: $("#scroll").offset().top
            },'slow');
        }
    });

    //Ação do Guardar Meme
    $('#guardarMeme').click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        let canvas = document.querySelector("canvas");
        let dataUrl = canvas.toDataURL();
        let idTemplate = $("#idTemplate").text();

        $.ajax({
            url: "../inserirMeme.php",
            method: 'post',
            dataType: 'json',
            data: {
                image: dataUrl,
                idTemplate: idTemplate
            },
            success: function(response) {
                if(response.status == 2) {
                    $("#alertatemplateVerde").css("display", "flex");
                    setTimeout( function() {
                        $("#alertatemplateVerde").css("display", "none");
                        setTimeout( function() {
                            window.location.href = "criarMeme.php";
                        }, 500);
                    }, 1500);
                }
            }
        });
    });

    //Clique no botão Transferir Meme no scrolling-wrapper dos memes do utilizador
    $("[name = 'transferir']").click(function (evt) {
        evt = evt ? evt : window.event;
        evt.preventDefault();

        let id = $(this).attr("data-idMeme");
        let imagem = document.getElementById("Meme"+id);
        const dataUrl = getDataUrl(imagem);
        
        let btnDownload = document.querySelector("#transferirMeme");
        btnDownload.download = "Meme.png";
        btnDownload.href = dataUrl;
        btnDownload.click();
    });

    //Clique no botão Apagar Meme no scrolling-wrapper dos memes do utilizador
    $("[name = 'apagarMeme']").click(function (evt) {
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
                            window.location.href = "criarMeme.php";
                        }, 500);
                    }, 1500);
                }
            }
        });
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

    //Verifica se o dispositivo é touch
    function isTouchScreendevice() {
        return 'ontouchstart' in window || navigator.maxTouchPoints;
    };
});