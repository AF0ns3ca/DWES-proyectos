<?php
function dividir($num1, $num2)
{
    if($num2 == 0){
        throw new Exception("No es posible dividir entre 0");
    }
        return $num1 / $num2;
    
}

function square($num){
    if($num<0){
        throw new Exception("No se pueden introducir numeros negativos");
    }
    return sqrt($num);
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
    echo "<h1>Inicio Programa</h1>";
    
    
    // try {
    //     echo dividir(10, 2);
    //     echo "<br>";
    //     echo dividir(10, 0);
    //     echo "<br>";
    //     echo dividir(20,4);
    // } catch (Exception $e) {
    //     echo "Ha ocurrido un error: " . $e->getMessage() . "<br>";
    // } finally{
    //     echo "Siempre se ejecuta el finally";
    // }

    // try{
    //     echo dividir(20,4);
    // }catch (Exception $e) {
    //     echo "Ha ocurrido un error: " . $e->getMessage() . "<br>";
    // }

    try{
        echo square(25);
        echo "<br>";
        echo square(144);
        echo "<br>";
        echo square(-25);
        echo "</br>";
    } catch (Exception $e) {
        echo "ERROR FATAL INCREIBLEMENTE MALO POR DIOS " . $e->getMessage() . "<br>";

    } finally{
        echo "Bueno no era para tanto la verdad";
    }
    ?>
</body>

</html>