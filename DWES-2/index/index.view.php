<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Filtro</h1>
    <p>
        <h1>Por autor</h1>
        <?php foreach ($listaAutor as $book) : ?>
            <a href="<?php $book['url']; ?>">
                <?php echo $book['titulo'] ?> (<?php echo $book['fecha'] ?>),
                por <?php echo $book['autor'] ?>
                <br>
            </a>
        <?php endforeach; ?>
    </p>
    <p>
        <h1>Libros entre 1950 y 2000</h1>
        <?php foreach ($listaAnio as $book) : ?>
            <a href="<?php $book['url']; ?>">
                <?php echo $book['titulo'] ?> (<?php echo $book['fecha'] ?>),
                por <?php echo $book['autor'] ?>
                <br>
            </a>
        <?php endforeach; ?>
    </p>
</body>
</html>