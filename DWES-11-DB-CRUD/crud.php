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

function listarPizzas($conn){
    $consulta = $conn->prepare("SELECT nombre, precio FROM pizzas");
    $consulta->execute();
    
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo $row["nombre"] . " - " . $row["precio"] . "€ <br>";
    }

    // foreach($consulta as $row){
    //     echo $row["nombre"] . " - " . $row["precio"] . "€ <br>";
    // }
}

echo "<h1>Nuestras Pizzas</h1>";
listarPizzas($conn);

////////////////////
// Insertar Pizza //
////////////////////

//Datos de la nueva Pizza
$nombrePizza = "Pizza Misteriosa";
$costePizza = 5.00;
$precioPizza = 10.00;
$ingredientesPizza = "Tomate, Mozzarela, Albahaca, Jamon, Parmesano";

//$insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES ('$nombrePizza', '$costePizza', '$precioPizza', '$ingredientesPizza')");
$insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES (:nombre, :coste, :precio, :ingredientes)");
$insertar->bindParam(':nombre', $nombrePizza);
$insertar->bindParam(':coste', $costePizza);
$insertar->bindParam(':precio', $precioPizza);
$insertar->bindParam(':ingredientes', $ingredientesPizza);
$insertar->execute();


//////////////////////
// Modificar Pizza //
////////////////////

//Proceso para modificar una entrada de la base de datos, ya hemos añadido una pizza ahora podremos modificarla.

//Datos de Pizza a Modificar
$nombrePizza = "Pizza Modificada";
$costePizza = 6.00;
$precioPizza = 11.00;
$ingredientesPizza = "Tomate, Mozzarela, Albahaca, Champiñones";
$nombreOriginal = "Pizza Misteriosa";

$modificar = $conn->prepare("UPDATE pizzas SET nombre = :nombre, coste = :coste, precio = :precio, ingredientes = :ingredientes WHERE nombre = :nombreOriginal");
$modificar->bindParam(':nombre', $nombrePizza);
$modificar->bindParam(':coste', $costePizza);
$modificar->bindParam(':precio', $precioPizza);
$modificar->bindParam(':ingredientes', $ingredientesPizza);
$modificar->bindParam(':nombreOriginal', $nombreOriginal);

$modificar->execute();

echo "<h1>Pizzas actualizadas</h1>";
listarPizzas($conn);

///////////////////
// Borrar Pizza //
/////////////////
$nombrePizza = "Pizza Modificada"; 

$eliminar = $conn->prepare("DELETE FROM pizzas WHERE nombre = :nombre");
$eliminar->bindParam(':nombre', $nombrePizza);

$eliminar->execute();

echo "<h1>Pizzas tras borrar</h1>";
listarPizzas($conn);
?>

