

<?php 

if (!isset($_COOKIE["visitas"])) {
    $visitas = 1;
} else {
    $visitas = $_COOKIE["visitas"];
    $visitas++;
}


if(isset($_POST["eliminar_cookies"])){
    setcookie("visitas",$visitas=0,time() - 1, "/");
    header("Refresh:0");
};

setcookie("visitas", $visitas, time() + (3600 * 24));
    echo "Numero de visitas: " . $_COOKIE["visitas"];
    echo "<br/>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contador de visitas</title>
</head>

<body>
    <form method="post">
        <button type="submit" value="borrar" name="eliminar_cookies">Borrar Cookies</button>
    </form>
</body>

</html>