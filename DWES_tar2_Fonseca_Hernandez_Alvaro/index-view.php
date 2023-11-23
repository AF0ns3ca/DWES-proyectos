<!-- Vista -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Babel. Vista.</title>
</head>

<body>
    <h1>Biblioteca Babel</h1>
    <?php
    echo "<h2>Materiales antes de ser prestados</h2>";
    echo $materiales[0]; //ejemplo de libro.
    echo $materiales[3]; //ejemplo de DVD.
    echo "<h2>Prestamos el libro</h2>";
    echo $materiales[0]->prestar();
    echo "<br>";
    echo $materiales[0];
    echo "<h2>Prestamos el DVD</h2>";
    echo $materiales[3]->prestar();
    echo "<br>";
    echo $materiales[3];
    echo "<h2>Intentamos volver a tomar prestado el mismo DVD</h2>";
    echo $materiales[3]->prestar();
    echo "<br>";
    echo $materiales[3];
    echo "<h2>Devolvemos los materiales</h2>";
    echo $materiales[0]->devolver();
    echo "<br>";
    echo $materiales[0];
    echo "<br>";
    echo $materiales[3]->devolver();
    echo "<br>";
    echo $materiales[3];
    echo "<h2>Intentamos devolver material no prestado</h2>";
    echo $materiales[2]->devolver();
    echo "<br>";
    echo $materiales[2];
    echo "<br>";
    echo $materiales[1]->devolver();
    echo "<br>";
    echo $materiales[1];
    ?>
</body>

</html>