<?php
function factorial($num)
{
    $fact = 1;
    if ($num < 0) {
        return -1;
    } else {
        for ($i = 1; $i <= $num; $i++) {
            $fact *= $i;
        }
        return $fact;
    }
   
}

//Funcion recursiva que devuelve el factorial
function factorialRecursivo($numero)
{
    if($numero<0){
        return -1;
    } else{
        if($numero >= 2){
            return ($numero * factorial($numero - 1));
        }else{
            return true;
        }
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
    <p>
    <h1>Ejercicio 2.1</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="number">Numero:</label>
        <input type="number" id="number" name="number">
        <button type="submit">Factorial</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the data from the input field
        $number = $_POST['number'];
        
        echo (factorial($number)===-1) ? "Debes introducir un valor mayor que 0" : "El factorial de $number es " .  factorial($number);
        echo '<br>';
        echo (factorialRecursivo($number)===-1) ? "Debes introducir un valor mayor que 0" : "El factorial de $number es " .  factorialRecursivo($number);
        /*echo "El factorial de $number es " .  factorial($number);
        echo '<br>';
        echo "El factorial de $number es " .  factorialRecursivo($number);*/
    }
    ?>
    </p>
    <p>
        <h1>Ejercicio 2.3</h1>
    </p>

</body>

</html>