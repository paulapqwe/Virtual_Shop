<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:wght@300&family=Jost:wght@300&family=Roboto:wght@100;300&display=swap"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2943493a50.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="ProductListStyle.css" />
    <link rel="stylesheet" href="../../Styles/style.css" />
    <title>Productos</title>
</head>

<body>
    <iframe src="../../Utilitary/nav.php" style="height: 100px; width: 100% ; border:0;" class="iframeNav"></iframe>
    <?php

          include_once 'GetProduct.php';
          include_once '../Login/Session.php';    
          validateSession();
?>
    <div id="contenido">
        <?php
          echo listProduct("");
    ?>
    </div>
</body>

</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var iframe = document.querySelector(".iframeNav");
    iframe.addEventListener("load", function() {
        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
        var boton = iframeDoc.getElementById("buttonSearch");

        boton.addEventListener("click", function() {
            var parametro = iframeDoc.getElementById("inputSearch").value;
            var xhr = new XMLHttpRequest();
            xhr.open(
                "GET",
                "getProduct.php?parametro=" + parametro,
                true
            );
            xhr.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var respuesta = xhr.responseText;
                    console.log(respuesta);
                    $("#contenido").empty();
                    $("#contenido").append(respuesta);
                }
            };
            var parametros = "parametro=" + parametro;
            xhr.send(parametros);
        });
    });
});
</script>

<footer>
    <div class="footer"></div>
</footer>