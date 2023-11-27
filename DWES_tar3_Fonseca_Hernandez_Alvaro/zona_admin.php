<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?redirigido=true");
}

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
    $consulta = $conn->prepare("SELECT nombre, ingredientes, precio FROM pizzas");
    $consulta->execute();
    echo "<table border='1'>";
    echo "<tr><th>Pizza</th><th>Ingredientes</th><th>Precio</th><th>Acciones Admin</th></tr>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td>$row[nombre]</td><td>$row[ingredientes]</td><td> $row[precio]€</td>";
        echo "<td><button class='edit-btn'>Editar</button>";
        echo "<button class='delete-btn'>Borrar</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Administrador <?php echo $_SESSION['nombre'] ?></title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <h1>Bienvenido, <?php echo $_SESSION['nombre'] ?></h1>
            <?php
            echo "<h1>Listado de Pizzas</h1>";
            listarPizzas($conn);
            ?>
        </div>
    </div>

</body>

</html>