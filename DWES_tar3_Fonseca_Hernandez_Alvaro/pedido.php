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
    echo "<tr><th>Pizza</th><th>Ingredientes</th><th>Precio</th></tr>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr><td>$row[nombre]</td><td>$row[ingredientes]</td><td> $row[precio]€</td></tr>";
    }
    echo "</table>";
}

// FUNCIÓN PARA AGREGAR PIZZAS A PEDIDOS
function pedido($conn, $id_cliente, $fecha_pedido, $detalle_pedido, $total)
{
    try {
        $consulta = $conn->prepare("INSERT INTO pedidos (id_cliente, fecha_pedido, detalle_pedido, total) VALUES (:id_cliente, :fecha_pedido, :detalle_pedido, :total)");
        $consulta->bindParam(":id_cliente", $id_cliente);
        $consulta->bindParam(":fecha_pedido", $fecha_pedido);
        $consulta->bindParam(":detalle_pedido", $detalle_pedido);
        $consulta->bindParam(":total", $total);
        $consulta->execute();
        header("Location: gracias.php");
    } catch (Exception $e) {
        echo "Error al agregar el pedido: " . $e->getMessage();
    }
}

// Lógica para agregar pedido
if (isset($_POST["pizza"]) && isset($_POST["cantidades"])) {
    $id_cliente = $_SESSION["id"];
    $fecha_pedido = date("Y-m-d H:i:s");
    $detalle_pedido = "";
    $total = 0;

    $pizzas = $_POST["pizza"];
    $cantidades = $_POST["cantidades"];

    // Verificar que las arrays tengan la misma longitud
    if (count($pizzas) === count($cantidades)) {
        foreach ($pizzas as $key => $pizza_id) {
            $consulta = $conn->prepare("SELECT id, nombre, precio FROM pizzas WHERE id = :id");
            $consulta->bindParam(":id", $pizza_id);
            $consulta->execute();
            $row = $consulta->fetch(PDO::FETCH_ASSOC);

            // Detalle pedido: id_pizza x cantidad
            $detalle_pedido .= $row["nombre"] . " [" . $cantidades[$key] . " uds], ";
            $total += $row["precio"] * $cantidades[$key];
        }

        // Eliminar la última coma y espacio en blanco
        $detalle_pedido = rtrim($detalle_pedido, ", ");

        pedido($conn, $id_cliente, $fecha_pedido, $detalle_pedido, $total);
        header("Location: gracias.php");
    } else {
        echo "Error al procesar pedido.";
    }
}
function cerrarSesion()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
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
    <link rel="stylesheet" href="css/styles-pedido.css">
    <title>Pagina de
        <?php echo $_SESSION['nombre'] ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="header">
                <?php
                echo "<h1>Bienvenido, $_SESSION[nombre]</h1>";
                echo "<a class='close-sesion' href='pedido.php?cerrar_sesion=true'>Cerrar Sesion</a>";
                echo "<h2>Estas son nuestras pizzas:</h2><br>";
                listarPizzas($conn);
                ?>
            </div>

            <div>
                <button id="pedido">Realizar Pedido</button>
            </div>
            <div class="pedido hide" id="hide-pedido">
                <form method="POST" id="form-pedido">
                    <div>
                        <div id="pizzas-a-pedir">
                            <div class="pizzas-pedido">
                                <select name="pizza[]" class="select-pizza">
                                    <option value="0">Seleccione una pizza</option>
                                    <?php
                                    $consulta = $conn->prepare("SELECT id, nombre FROM pizzas");
                                    $consulta->execute();
                                    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                        echo "<option value=" . $row["id"] . ">" . $row['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="cantidad"></label>
                                <input type="number" min="1" value="1" name="cantidades[]">
                            </div>
                        </div>

                        <button type="button" id="add-pizza-pedido">Agregar pizza</button>
                    </div>
                    <button action="submit">Añadir a pedido</button>
                    <button type="button" id="cancel-btn" onclick="cancelar()">Cancelar</button>
                </form>
            </div>
            <div class="resumen-pedido">
                <p>Tus ultimos pedidos,
                    <?php echo $_SESSION['nombre'] ?>
                </p>
            </div>
        </div>
    </div>
    <script src="js/pedido.js"></script>
</body>

</html>