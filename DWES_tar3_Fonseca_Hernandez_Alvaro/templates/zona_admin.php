<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php?redirigido=true");
}
include_once "../conexionDB.php";
$conn = conectarBD();

function listarPizzas($conn)
{
    $consulta = $conn->prepare("SELECT id, nombre, ingredientes, coste, precio FROM pizzas");
    $consulta->execute();
    echo "<table id='tabla-pizzas'>";
    echo "<tr><th>Pizza</th><th>Ingredientes</th><th>Coste</th><th>Precio</th><th>Acciones Admin</th></tr>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td class= 'hidden'>$row[id]</td><td>$row[nombre]</td><td>$row[ingredientes]</td><td> $row[coste]€</td><td> $row[precio]€</td>";
        echo "<td class='action-btn'><div class='enlace editarBtn'><a class='edit-btn'>Editar</a></div>";
        echo "<div class='enlace deleteBtn'><a href=" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?borrarPizza=" . $row["id"] . "id='delete-btn' class='delete-btn'>Borrar</a></div></td>";
        echo "</tr>";
    }
    echo "</table>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor del campo "accion"
    $accion = $_POST['accion'];

    // Realizar acciones según el valor de "accion"
    switch ($accion) {
        case 'edit':
            // Lógica para editar
            $consulta = $conn->prepare("UPDATE pizzas SET nombre=:nombre, coste=:coste, precio=:precio,  ingredientes=:ingredientes WHERE id=:id");
            $consulta->bindParam(':id', $_POST['id']);
            $consulta->bindParam(':nombre', $_POST['nombre']);
            $consulta->bindParam(':coste', $_POST['coste']);
            $consulta->bindParam(':precio', $_POST['precio']);
            $consulta->bindParam(':ingredientes', $_POST['ingredientes']);
            $consulta->execute();
            break;
        case 'add':
            // Lógica para añadir
            $consulta = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES (:nombre, :coste, :precio, :ingredientes)");
            $consulta->bindParam(':nombre', $_POST['nombre']);
            $consulta->bindParam(':coste', $_POST['coste']);
            $consulta->bindParam(':precio', $_POST['precio']);
            $consulta->bindParam(':ingredientes', $_POST['ingredientes']);
            $consulta->execute();
            break;
        default:
            // Acción por defecto o manejar error
            break;
    }
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

function cerrarSesion()
{
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}

// Lógica para cerrar sesion
if (isset($_GET["cerrar_sesion"])) {
    cerrarSesion();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-admin.css" type="text/css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>Administrador
        <?php echo $_SESSION['nombre'] ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <nav>
                <div class="header">
                    <img src="../assets/imgs/logo.png" alt="">
                    <h1>
                        <?php echo $_SESSION['nombre'] ?>
                    </h1>
                </div>
                <div class="btns">
                    <ul>
                        <li><button id='btn-add-pizza' class="btn-add-pizza">Añadir Pizza</button></li>
                        <li>
                            <?php echo "<a class='close-sesion' href='pedido.php?cerrar_sesion=true'>Cerrar Sesion</a>" ?>
                        </li>
                    </ul>
                </div>
            </nav>

            <?php
            echo "<div class='head-admin'>";
            echo "<h1>Listado de Pizzas</h1>";
            echo "<div class='head-btns'>"
                ?>


            <?php
            ;
            echo "</div></div>";
            listarPizzas($conn);
            ?>

            <div id="formulario-admin" class="formulario-admin hidden">
                <h2>Editar Inventario</h2>
                <form id="formulario" method="POST">
                    <input type="hidden" name="accion" id="accion" value="add">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="nombre">Introduzca nombre:</label>
                        <input id="nombre" type="text" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="coste">Introduzca coste:</label>
                        <input id="coste" type="text" name="coste">
                    </div>
                    <div class="form-group">
                        <label for="precio">Introduzca precio:</label>
                        <input id="precio" type="text" name="precio">
                    </div>
                    <div class="form-group">
                        <label for="ingredientes">Introduzca ingredientes:</label>
                        <input id="ingredientes" type="text" name="ingredientes">
                    </div>
                    <div class="btn-space">
                        <button id="form-btn" class="form-btn" action="submit">Añadir</button>
                        <button class="btn-cancel" type="button" onclick="cancelarFormulario()">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>

</html>