<?php
include_once "conexionDB.php";

function comprobar_usuario($usuario, $clave)
{
    //Nos conectamos a la BD y lo igualamos a conn que sera donde se guarde la conexion
    $conn = conectarBD();
    //preparar la consulta
    $consulta = $conn->prepare("SELECT id, usuario, nombre, rol FROM usuarios WHERE usuario =:usuario AND clave =:clave");
    $consulta->bindParam("usuario", $usuario);
    $consulta->bindParam("clave", $clave);
    //lanzar la consulta
    $consulta->execute();


    if ($consulta->rowCount() > 0) {
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return array("id" => $row['id'], "usuario" => $row['usuario'], "nombre" => $row['nombre'], "rol" => $row['rol']);
    } else
        return FALSE;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usu = comprobar_usuario($_POST["usuario"], $_POST["clave"]);
    if ($usu == FALSE) {
        $err = TRUE;
        $usuario = $_POST["usuario"];
    } else {
        session_start();
        $_SESSION['id'] = $usu['id'];
        $_SESSION['usuario'] = $_POST["usuario"];
        $_SESSION['nombre'] = $usu['nombre'];
        $_SESSION['rol'] = $usu['rol'];
        if ($usu['rol'] == '1') {
            header("Location: ./templates/zona_admin.php");
        } else if ($usu['rol'] == '2') {
            header("Location: ./templates/pedido.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-index.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>PHPizza</title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <img src="assets/imgs/logo.png" alt="">
            <h1>Iniciar Sesion</h1>

            <?php
            if (isset($err)) {
                echo "<p class='incorrect'>usuario o contraseña incorrectos</p>";
            }
            ?>

            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
                <div>
                    <label for="usuario">Usuario: </label>
                    <input value="<?php if (isset($usuario)) echo $usuario; ?>" name="usuario" placeholder="Usuario...">
                </div>
                <div>
                    <label for="clave">Contraseña: </label>
                    <input type="password" name="clave" placeholder="Contraseña..."> <!-- Este tipo nos permite que salgan puntitos para que no se vea -->
                </div>

                <button action="submit">Enviar</button>
            </form>
            <a href="./templates/nuevo_usuario.php">¿No tienes cuenta? Registrate</a>
        </div>
    </div>

</body>

</html>