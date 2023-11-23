<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    session_start();

    if (!isset($_SESSION["count"])) {
        $_SESSION["count"] = 0;
        $_SESSION["nombre"] = "Pedro";
        $_SESSION["rol"] = "admin";
    } else {
        $_SESSION["count"]++;
    }


    echo "Hola " . $_SESSION["nombre"] . "<br>";
    echo "Contador:" . $_SESSION["count"] . "<br>";
    


    ?>
</body>

</html>