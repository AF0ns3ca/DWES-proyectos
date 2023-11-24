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
        return array("id"=>$row['id'], "usuario" => $row['usuario'], "nombre" => $row['nombre'], "rol" => $row['rol']);
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
            header("Location: zona_admin.php");
        } else if($usu['rol'] == '2'){
            header("Location: pedido.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPizza</title>
</head>

<body>
    <?php
    if (isset($err)) {
        echo "<p>usuario o contraseña incorrectos</p>";
    }
    ?>
    <a href="nuevo_usuario.php">¿No tienes cuenta? Registrate</a>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
        <input value="<?php if (isset($usuario))
                            echo $usuario; ?>" name="usuario">
        <input type="password" name="clave"> <!-- Este tipo nos permite que salgan puntitos para que no se vea -->
        <button action="submit">Enviar</button>
    </form>
    
</body>

</html>