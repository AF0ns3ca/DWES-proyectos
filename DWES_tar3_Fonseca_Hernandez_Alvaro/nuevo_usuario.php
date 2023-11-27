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
//Esto hace que no se ejecute esto hasta que haya algo del post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['usuario'] && $_POST['nombre'] && $_POST['clave'] && $_POST['email'] !== '') {
        $consulta = $conn->prepare("INSERT INTO usuarios (usuario, nombre, clave, rol, email) VALUES (:usuario, :nombre, :clave, 2, :email)");
        $consulta->bindParam(':usuario', $_POST['usuario']);
        $consulta->bindParam(':nombre', $_POST['nombre']);
        $consulta->bindParam(':clave', $_POST['clave']);
        $consulta->bindParam(':email', $_POST['email']);
        try {
            $consulta->execute();
            session_start();
            $_SESSION["usuario"] = $_POST['usuario'];
            $_SESSION["nombre"] = $_POST['nombre'];
            $_SESSION["rol"] = $_POST['rol'];
            header("Location: pedido.php");
        } catch (PDOException $e) {
            echo 'Error' . $e->getMessage();
        }
    } else {
        $err = TRUE;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-registro.css">
    <title>Registro</title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <h1>REGISTRO</h1>

            <?php
            if (isset($err)) {
                echo "<p class='incorrect'>No puede haber campos vacios</p>";
            }
            ?>

            <form method="POST">
                <div>
                    <label for="usuario">Introduzca nombre usuario:</label>
                    <input type="text" name="usuario" placeholder="Seleccione nombre de usuario...">
                </div>
                <div>
                    <label for="nombre">Introduzca nombre:</label>
                    <input type="text" name="nombre" placeholder="Nombre completo...">
                </div>
                <div>
                    <label for="clave">Introduzca clave:</label>
                    <input type="password" name="clave" placeholder="Contraseña...">
                </div>
                <div>
                    <label for="email">Introduzca email:</label>
                    <input type="text" name="email" placeholder="Introduzca email...">
                </div>
                <button action="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>