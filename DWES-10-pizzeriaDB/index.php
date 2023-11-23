<?php

function conectarBD()
{
    //Funcion ue nos conecta a la base de datos, tenemos que mandarle la direccion ip del host, el usuario, la clave y el nombre de la BD
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    try {
        //Se crea el objeto de conexion a la base de datos y se devueve
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectar BD: " . $e->getMessage();
    }
}

function menu_pizza()
{

    //Nos conectamos a la BD y lo igualamos a conn que sera donde se guarde la conexion
    $conn = conectarBD();
    //Otro modo es mandar la query
    $query = $conn->query("SELECT nombre FROM pizzas");
    if ($query->rowCount() > 0) {

        //Mientras haya filas las imprimiria, podriamos meter esos resultados en un array e imprimirlos posteriormente
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>" . $row['nombre'] . "</li>";
        }
    } else
        return FALSE;
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
    <h1>Nuestro Menu</h1>
    <ul>
        <?php
        menu_pizza();
        ?>
    </ul>


</body>

</html>