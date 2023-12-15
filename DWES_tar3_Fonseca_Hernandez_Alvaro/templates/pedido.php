<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php?redirigido=true");
}

include_once "../conexionDB.php";
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

function pizzasMasCompradas($conn)
{
    $consulta = $conn->prepare("SELECT detalle_pedido FROM pedidos");
    $consulta->execute();
    $pizzasMasVendidas = [];
    $filasMostradas = 0;

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $detalles = explode(", ", $row["detalle_pedido"]);

        foreach ($detalles as $detalle) {
            list($nombrePizza, $cantidad) = explode("x", $detalle);
            if (isset($pizzasMasVendidas[$nombrePizza])) {
                $pizzasMasVendidas[$nombrePizza] += (int) $cantidad;
            } else {
                $pizzasMasVendidas[$nombrePizza] = (int) $cantidad;
            }
        }
    }

    arsort($pizzasMasVendidas);
    echo "<table class='mas-vendidas' border='1'>";
    echo "<tr><th>Pizza</th><th>Cantidad de pedidos</th></tr>";
    foreach ($pizzasMasVendidas as $nombrePizza => $cantidadPedidos) {
        if ($filasMostradas < 4) {
            echo "<tr><td>$$nombrePizza</td><td>$cantidadPedidos</td></tr>";
            $filasMostradas++;
        } else {
            break; // Salir del bucle una vez que se han mostrado 4 filas
        }
    }
    echo "</table>";

}

function ultimosPedidos($conn)
{
    $consulta = $conn->prepare("SELECT pe.fecha_pedido, pe.detalle_pedido, pe.total
    FROM pedidos pe
    WHERE pe.id_cliente = :id_cliente
    ORDER BY pe.fecha_pedido DESC
    LIMIT 3");

    $consulta->bindParam(":id_cliente", $_SESSION["id"]);
    $consulta->execute();
    echo "<table border='1'>";
    echo "<tr><th>Fecha</th><th>Detalle</th><th>Total</th></tr>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr><td>$row[fecha_pedido]</td><td>$row[detalle_pedido]</td><td>$row[total]</td></tr>";
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
// if (isset($_POST["pizza"]) && $_POST["pizza"] != 0) {
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
            $detalle_pedido .= $row["nombre"] . " x " . $cantidades[$key] . " , ";
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
// } else {
//     echo "Error al procesar pedido.";
// }
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
    <link rel="stylesheet" href="../css/styles-pedido.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>Pagina de
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
                        Bienvenido,
                        <?php echo $_SESSION['nombre'] ?>
                    </h1>
                </div>
                <div class="btns">
                    <ul>
                        <li><button class="btn-pedido" id="pedido">Realizar Pedido</button></li>
                        <li>
                            <?php echo "<a class='close-sesion' href='pedido.php?cerrar_sesion=true'>Cerrar Sesion</a>"; ?>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class='head-admin'>
                <img class='banner' src='../assets/imgs/banner.jpg' alt='banner-pizzeria'>
                <div class="user-stadistic">
                    <h1>Las más famosas</h1>
                    <?php pizzasMasCompradas($conn) ?>
                    <h2>Tus ultimos pedidos,
                        <?php echo $_SESSION['nombre'] ?>
                    </h2>
                    <?php ultimosPedidos($conn) ?>

                </div>

            </div>
            <div class='table-pizzas'>
                <?php listarPizzas($conn); ?>
            </div>


            <div class="pedido hide" id="hide-pedido">
                <form method="POST" class="form-pedido" id="form-pedido">
                    <div class="block-pedido">
                        <div id="more-pizzas">
                            <div class="pizzas-pedido" id="pizzas-pedido">
                                <select name="pizza[]" class="select-pizza">
                                    <!-- <option value="0">Seleccione una pizza</option> -->
                                    <?php
                                    $consulta = $conn->prepare("SELECT id, nombre FROM pizzas");
                                    $consulta->execute();
                                    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                        echo "<option value=" . $row["id"] . ">" . $row['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="cantidad">Cantidad</label>
                                <input type="number" min="1" value="1" name="cantidades[]">
                            </div>
                        </div>
                        <button type="button" class="add-pizza-btn" id="add-pizza-pedido">Agregar pizza</button>
                    </div>
                    <button class="pedido-btn" action="submit">Realizar Pedido</button>
                    <button type="button" class="cancel-btn" id="cancel-btn" onclick="cancelar()">Cancelar</button>
                </form>
            </div>
            <div class="pizzas-mas-pedidas">

            </div>


        </div>
    </div>
    <script src="../js/pedido.js"></script>
</body>

</html>