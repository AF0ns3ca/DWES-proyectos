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

// function pedido($conn){
//     $hoy = getdate();
//     $consulta = $conn->prepare("INSERT INTO pedidos id_cliente, fecha_pedido, detalle_pedido, total VALUES id_cliente=:id_cliente, fecha_pedido=:fecha_pedido, detalle_pedido=:detalle_pedido, total=:total");
//     $consulta->bindParam("id_cliente", $_SESSION['id']);
//     $consulta->bindParam("fecha_pedido", $hoy);
//     $consulta->bindParam("detalle_pedido", $detalle_pedido);
//     $consulta->bindParam("total", $total);
//     $consulta->execute();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('./assets/wallpaper.jpg');
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
        }

        .wrapper {
            width: 60%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            border-radius: 5px;
        }

        .table {
            align-items: center;
        }

        table {
            border-collapse: collapse;
        }

        th {
            padding: 5px;
        }

        button {
            width: auto;
            margin: 10px;
        }

        .pedido {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pizzas-pedido {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 5px;
        }

        .hide {
            display: none;
        }
    </style>
    <title>Pagina de <?php echo $_SESSION['nombre'] ?></title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="table">
                <?php
                echo "<h1>Bienvenido, $_SESSION[nombre]</h1>";
                echo "<h2>Estas son nuestras pizzas:</h2><br>";
                listarPizzas($conn);
                ?>
            </div>

            <div>
                <button id="pedido">Realizar Pedido</button>
            </div>
            <div class="pedido hide" id="form-pedido">
                <form method="POST">
                    <div class="pizzas-pedido">
                        <label for="pizza">Seleccione una pizza</label>
                        <select name="pizza">
                            <option value="0">Seleccione una pizza</option>
                            <?php
                            $consulta = $conn->prepare("SELECT nombre FROM pizzas");
                            $consulta->execute();
                            foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                echo "<option value=" . $row["nombre"] . ">" . $row['nombre'] . "</option>";
                            }
                            ?>
                            <label for="cantidad"></label>
                            <input type="number">
                    </div>
                    </select>
                    <button action="submit">Añadir a pedido</button>
                </form>
            </div>
            <div class="resumen-pedido">
                <p>Resumen de tu pedido, <?php echo $_SESSION['nombre'] ?></p>
            </div>
        </div>
    </div>
    <script>
        btnPedido = document.getElementById('pedido');
        formPedido = document.getElementById('form-pedido');
        btnPedido.addEventListener('click', function() {
            formPedido.classList.toggle('hide');
            btnPedido.classList.toggle('hide');
        });
    </script>
</body>

</html>