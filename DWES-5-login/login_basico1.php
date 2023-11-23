<?php 
    if($_POST["usuario"] == "pepe" and $_POST["clave"] == "1234"){
        header("Location:bienvenido.html");
    } else {
        header("Location:error.html");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "Usuario Introducido: " . $_POST["usuario"] . "<br>";
        echo "Clave Introducida: " . $_POST["clave"] . "<br>";
        echo $_POST;
        print_r($_SERVER["REQUEST_METHOD"]);
    ?>
</body>
</html>