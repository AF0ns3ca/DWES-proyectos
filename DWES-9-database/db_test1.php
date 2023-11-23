<?php
$cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
$usuario = "root";
$clave = "";

try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    echo "Conexion realizada con exito";

    // $sq1 = "SELECT usuario FROM usuarios";
    // $sq2 = "SELECT clave FROM usuarios";
    // $sq3 = "SELECT email FROM usuarios";
    $query = "SELECT * FROM usuarios";
    echo "<br>";
    //lanzamos la query a la base de datos para obtener los datos
    // $usuarios = $bd->query($sq1);
    // $claves = $bd->query($sq2);
    // $correos = $bd->query($sq3);

    $elementos = $bd->query($query);
    //$resultados = $elementos->fetchAll(PDO::FETCH_ASSOC);
    //print_r($resultados);

    foreach($elementos as $item){
        print_r("ID: " . $item["id"] . "<br>");
        print_r("Usuario: " . $item["usuario"] . "<br>");
        print_r("Contraseña: " . $item["clave"] . "<br>");
        print_r("Rol: " . $item["rol"] . "<br>");
        print_r("Correo: " . $item["email"] . "<br>");
        echo "<br>";
    }
    // foreach ($usuarios as $user) {
    //     foreach ($claves as $pass) {
    //         foreach ($correos as $email) {
    //             //echo $row["usuario "] . "<br>";
    //             //print_r($row); 
    //             print_r("Usuario: " . $user["usuario"] . "<br>"); 
    //             print_r("Clave: " . $pass["clave"] . "<br>");            
    //             print_r("Correo: " . $email["email"] . "<br>");
    //             echo "<br>";
    //         }
    //     }
    // }
} catch (PDOException $e) {
    echo "Error conectado a la base de datos: " . $e->getMessage();
}
