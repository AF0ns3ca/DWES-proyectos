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

function listarPizzas($conn){
    $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas");
    $consulta->execute();
    
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row["nombre"] . " - " . $row["precio"] . "€ <br>";
    }
}
function listarPizzasPrecio($conn)
{
    listarPizzas($conn);
    $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas WHERE precio = :precio");
    $consulta->bindParam(':precio', $_POST["precio"]);

    $consulta->execute();

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row["nombre"] . " - " . $row["precio"] . "€ <br>";
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

<body>
    <form method="POST">
        <label for="precio">Introduzca Precio</label>
        <input type="text" name="precio">
        <button action="submit">Enviar</button>
    </form>

    <?php
    echo "<h1>Pizzas</h1>";
    
    echo "<h2>Coincidencias de precio</h2>";
    listarPizzasPrecio($conn);
    ?>

</body>

</html>