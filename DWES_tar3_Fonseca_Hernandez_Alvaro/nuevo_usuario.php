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
        $consulta = $conn->prepare("INSERT INTO usuarios (usuario, nombre, clave, rol, email) VALUES (:usuario, :nombre, :clave, 2, :email)");
        $consulta->bindParam(':usuario', $_POST['usuario']);
        $consulta->bindParam(':nombre', $_POST['nombre']);
        $consulta->bindParam(':clave', $_POST['clave']);
        $consulta->bindParam(':email', $_POST['email']);
        try{
            $consulta->execute();
            session_start();
            $_SESSION["usuario"] = $_POST['usuario'];
            $_SESSION["nombre"] = $_POST['nombre'];
            $_SESSION["rol"] = $_POST['rol'];
            header("Location: pedido.php");
        } catch (PDOException $e) {
            echo 'Error'. $e->getMessage();
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <h1>REGISTRO</h1>
    <form method="POST" style="width:20%; display: flex; flex-direction:column; gap:10px;">
        <label for="usuario">Introduzca nombre usuario:</label>
        <input type="text" name="usuario">
        <label for="nombre">Introduzca nombre:</label>
        <input type="text" name="nombre">
        <label for="clave">Introduzca clave:</label>
        <input type="password" name="clave">
        <label for="email">Introduzca email:</label>
        <input type="text" name="email">
        <button action="submit">Enviar</button>
    </form>

</body>

</html>