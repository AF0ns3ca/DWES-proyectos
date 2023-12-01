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
    $consulta = $conn->prepare("SELECT id, nombre, ingredientes, precio FROM pizzas");
    $consulta->execute();
    echo "<table border='1'>";
    echo "<tr><th>Pizza</th><th>Ingredientes</th><th>Precio</th><th>Acciones Admin</th></tr>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td>$row[nombre]</td><td>$row[ingredientes]</td><td> $row[precio]€</td>";
        echo "<td class='action-btn'><div class='enlace'><a class='edit-btn'>Editar</a></div>";
        echo "<div class='enlace'><a href=" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?borrarPizza=" . $row["id"] . "id='delete-btn' class='delete-btn'>Borrar</a></div></td>";
        echo "</tr>";
    }
    echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consulta = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES (:nombre, :coste, :precio, :ingredientes)");
    $consulta->bindParam(':nombre', $_POST['nombre']);
    $consulta->bindParam(':coste', $_POST['coste']);
    $consulta->bindParam(':precio', $_POST['precio']);
    $consulta->bindParam(':ingredientes', $_POST['ingredientes']);
    $consulta->execute();
}

function borrarPizza($conn, $id)
{
    $consulta = $conn->prepare('DELETE FROM pizzas WHERE id = :id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();
}

// Lógica para eliminar pizza
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['borrarPizza'])) {
    $id = $_GET['borrarPizza'];

    borrarPizza($conn, $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-admin.css" type="text/css">
    <title>Administrador <?php echo $_SESSION['nombre'] ?></title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <h1>Bienvenido, <?php echo $_SESSION['nombre'] ?></h1>
            <?php
            echo "<div class='head-admin'>";
            echo "<h1>Listado de Pizzas</h1>";
            ?>
            <button id='btn-add-pizza'>Añadir Pizza</button>
            <?php
            echo "</div>";
            listarPizzas($conn);    
            ?>
            <div id="formulario-admin" class="formulario-admin hidden">
                <form method="POST">
                    <div class="form-group">
                        <label for="nombre">Introduzca nombre:</label>
                        <input type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="coste">Introduzca coste:</label>
                        <input type="text" name="coste">
                    </div>
                    <div class="form-group">
                        <label for="precio">Introduzca precio:</label>
                        <input type="text" name="precio">
                    </div>
                    <div class="form-group">
                        <label for="ingredientes">Introduzca ingredientes:</label>
                        <input type="text" name="ingredientes">
                    </div>
                    <button action="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/admin.js"></script>
</body>

</html>