<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>
        <?php

        $books = [[
            'titulo' => 'Harry Potter',
            'autor' => 'J.K. Rowling',
            'fecha' => '1997',
            'url' => 'http://ejemplo.com'
        ], [
            'titulo' => 'The Lord od the Rings',
            'autor' => 'J.R.R. Tolkien',
            'fecha' => '1953',
            'url' => 'http://ejemplo.com'
        ], [
            'titulo' => 'Do Androids dream of Electric Sheep',
            'autor' => 'Philip K. Dick',
            'fecha' => '1968',
            'url' => 'http://ejemplo.com'
        ], [
            'titulo' => 'Mistborn',
            'autor' => 'Brandon Sanderson',
            'fecha' => '2006',
            'url' => 'http://ejemplo.com'
        ], [
            'titulo' => 'The Eye of the World',
            'autor' => 'Robert Jordan',
            'fecha' => '1990',
            'url' => 'http://ejemplo.com'
        ], [
            'titulo' => 'The Way of Kings',
            'autor' => 'Brandon Sanderson',
            'fecha' => '2010',
            'url' => 'http://ejemplo.com'
        ]];

        ?>
    </p>

    <p>
        <?php
        foreach ($books as $book) : ?>
            <?php if ($book['autor'] == 'Brandon Sanderson') : ?>
                <a href=<?php $book['url']; ?>>
                    <?php echo $book['titulo'] ?> (<?php echo $book['fecha'] ?>),
                    por <?php echo $book['autor'] ?>
                    <br>
                </a>
            <?php endif ?>
        <?php endforeach ?>
    </p>

    <?php
    function filtrarPorAutor($books, $autor)
    {
        $sortedBooks = [];
        foreach ($books as $book) {
            if ($book['autor'] == $autor) {
                $sortedBooks[]  = $book;
            }
        }
        return $sortedBooks;
    }

    ?>

    <?php
    
    /*$filtro =  function ($items, $key, $sort) {
        $sortedItems = [];
        foreach ($items as $item) {
            if ($item[$key] > $sort) {
                $sortedItems[]  = $item;
            }
        }
        return $sortedItems;
    };*/
    
    function filtro ($items, $fn) {
        $sortedItems = [];
        foreach ($items as $item) {
            if ($fn($item)) {
                $sortedItems[]  = $item;
            }
        }
        return $sortedItems;
    };

    $nuevalListas = filtro($books, function($book){
        return $book['autor'] === 'Brandon Sanderson';
    });
    $nuevalListas = array_filter($books, function($book){
        return $book['autor'] === 'Brandon Sanderson';
    });

    ?>

    <p>
        <?php
        foreach (filtrarPorAutor($books, 'Brandon Sanderson') as $sortedBook) {
            echo "$sortedBook[titulo] ($sortedBook[fecha])<br>";
        };
        ?>

    </p>

    <!-- <p>
        <?php
        foreach ($filtro($books, 'fecha', '2008') as $sortedBook) {
            echo "$sortedBook[titulo] ($sortedBook[fecha])<br>";
        };
        ?>

    </p> -->
        

</body>

</html>