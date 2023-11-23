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
$conn = conectarBD();

function listarPizzas($conn)
{
    $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas");
    $consulta->execute();

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row["nombre"] . " - " . $row["precio"] . "€ <br>";
    }
}

function insertarPizzas($conn)
{
    //Esto hace que no se ejecute esto hasta que haya algo del post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $consulta = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES (:nombre, :coste, :precio, :ingredientes)");
        $consulta->bindParam(':nombre', $_POST['nombre']);
        $consulta->bindParam(':coste', $_POST['coste']);
        $consulta->bindParam(':precio', $_POST['precio']);
        $consulta->bindParam(':ingredientes', $_POST['ingredientes']);
        $consulta->execute();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="width: 100%;">
    <form method="POST" style="width:20%; display: flex; flex-direction:column; gap:10px;">
        <label for="nombre">Introduzca nombre:</label>
        <input type="text" name="nombre">
        <label for="coste">Introduzca coste:</label>
        <input type="text" name="coste">
        <label for="precio">Introduzca precio:</label>
        <input type="text" name="precio">
        <label for="ingredientes">Introduzca ingredientes:</label>
        <input type="text" name="ingredientes">
        <button action="submit">Enviar</button>
    </form>

    <?php
    echo "<h1>Pizzas</h1>";
    insertarPizzas($conn);
    listarPizzas($conn);
    ?>

</body>

</html>