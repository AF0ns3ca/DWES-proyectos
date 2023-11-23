<?php

function conectarBD()
{
    //Funcion ue nos conecta a la base de datos, tenemos que mandarle la direccion ip del host, el usuario, la clave y el nombre de la BD
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    try{
        //Se crea el objeto de conexion a la base de datos y se devueve
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectar BD: " . $e->getMessage();
    }
}

function comprobar_usuario($nombre, $clave)
{
    //Nos conectamos a la BD y lo igualamos a conn que sera donde se guarde la conexion
   $conn = conectarBD();
   //preparar la consulta
   //$consulta = $conn->prepare("SELECT usuario, rol FROM usuarios WHERE usuario = $nombre AND clave = $clave");
   //$consulta = $conn->prepare("SELECT usuario, rol FROM usuarios WHERE usuario =:nombre AND clave =:clave");
   //$consulta->bindParam("nombre", $nombre);
   //$consulta->bindParam("clave", $clave);
   //lanzar la consulta
   //$consulta->execute();

   //Otro modo es mandar la query
   $query = $conn->query("SELECT usuario, rol FROM usuarios WHERE usuario = '$nombre' AND clave = '$clave'");

   //comprobamos si lo que devuelve es mayor que cero, si lo es es que ha encontrado
        //if ($consulta->rowCount() > 0) {
            if ($query->rowCount() > 0) {
            //con esto hace un array con elementos de la consulta
            //$row = $consulta->fetch(PDO::FETCH_ASSOC);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            //esto hace que si nos concuerda el usuario, guardaremos en este array los datos que necesitamos
            return array("nombre"=>$row['usuario'], "rol"=>$row['rol']);
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
            $_SESSION['usuario'] = $_POST["usuario"];
            $_SESSION['rol'] = $usu['rol'];
            header("Location: sesiones1-principal.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>

<body>
    <!-- Vamos a aprender a obrar con el _POST -->
    <?php
    if (isset($err)) {
        echo "<p>usuario o contraseña incorrectos</p>";
    }
    ?>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">
        <input value="<?php if (isset($usuario))
                            echo $usuario; ?>" name="usuario">
        <input type="password" name="clave"> <!-- Este tipo nos permite que salgan puntitos para que no se vea -->
        <button action="submit">Enviar</button>
    </form>
</body>

</html>