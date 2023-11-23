<?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: sesiones_login.php?redirigido=true");
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
    <h1>Bienvenido</h1>
    <?php 
    
    if($_SESSION["rol"] == 1){
        echo "<p>Ooooooh, un administrador</p>";
    } else if($_SESSION["rol"] == "2"){
        echo "<p>Meh, un usuario</p>";
    }
    echo "<p>Bienvenido $_SESSION[usuario]</p>";
    ?>
</body>
</html>