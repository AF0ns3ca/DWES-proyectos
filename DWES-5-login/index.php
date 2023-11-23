<?php 

    if($_SERVER["REQUEST_METHOD"] =="POST"){
        if($_POST["usuario"] == "pepe" and $_POST["clave"] == "1234"){
            // header("Location:bienvenido.html");
            header("Location:cookies.php");
        } else {
            $usuario = $_POST["usuario"];
            $err = true;
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        if (isset($err)){
            echo "<p>Usuario o contraseña incorrectos</p>";
            /*
            < &lt
            > &gt
            &
            "
            */
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input value="<?php if(isset($usuario)) echo $usuario?>" type="text" name="usuario">
        <input type="password" name="clave">
        <input type="submit">
    </form>
</body>

</html>