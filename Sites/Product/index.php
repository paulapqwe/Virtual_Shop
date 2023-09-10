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
    <link rel="stylesheet" href="../../Styles/style.css" />
    <link rel="stylesheet" href="ProductStyle.css" />
    <link rel="stylesheet" href="../ProductList/ProductListStyle.css" />
    <title>Productos</title>
</head>

<body>
    <iframe src="../../Utilitary/nav.php" style="height: 100px; width: 100% ; border:0;" class="iframeNav"></iframe>
    <?php

?>
    <?php

            include_once '../../Database/DbConection.php';    
            include_once '../Login/Session.php';    
            validateSession();
            $id = $_GET['id'];
            $find = "SELECT Id, Nombre, Cantidad, Directorio , ValorUnitario, Descripcion FROM producto as a 
            JOIN MultimediaProducto as b on a.id = b.idProducto
            WHERE Id =$id limit 1";
            $conn = conexion();
            $resultado = mysqli_query($conn, $find);
            $data = mysqli_fetch_assoc($resultado);


            $find = "SELECT  Directorio FROM MultimediaProducto
            WHERE IdProducto =$id";
            $conn = conexion();
            $imagenes = mysqli_query($conn, $find);
            
    ?>

    <div id="contenido">
        <div class="containerProduct">
            <div class="contentProduct">
                <div class="nameProductBig">
                    <h2><?php echo $data["Nombre"] ?></h2>
                </div>
                <div class="imageProductBig" style="background-image: url('<?php echo $data["Directorio"] ?>');"></div>
                <div class="descriptionProdcut">

                    <h3>Descripción</h3>
                    <p><?php echo $data["Descripcion"] ?></p>
                </div>

                <div class="slider">
                    <?php
                while ($fila = mysqli_fetch_assoc($imagenes)) {
                  ?>
                    <div class="imageSlider" style="background-image: url('<?php echo $fila["Directorio"] ?>');"></div>
                    <?php
                }
                ?>


                </div>

                <div class="contentAddCarBig"><button
                        onclick="window.location.href='../CarPay/Index.php?id=<?php echo $data['Id'] ?>'" class="addCar">
                        Añadir al carrito <i class="fa-solid fa-cart-plus"></i></button>
                </div>
            </div>
        </div>
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
                "../ProductList/GetProduct.php?parametro=" + parametro,
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

const image = document.getElementsByClassName("");

$(".imageSlider")
    .hover(function() {
        var newImge = $(this)[0].style.backgroundImage;
        $(".imageProductBig")[0].style.backgroundImage = newImge;

    });
</script>