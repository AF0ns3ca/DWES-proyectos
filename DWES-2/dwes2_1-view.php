<!DOCTYPE html>
<!-- Nuestra Primera instruccion en PHP -->

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>
        <?php echo "Hello World" ?>
    </h1>
    <!-- <p>
        <?php
        $saludo = "Bienvenido";
        $nombre = "Pepe";
        //se concatena con el punto
        echo $saludo . " " . $nombre;
        ?>
    </p> -->

    <!-- <p>
        <?php

        if (print "hola") {
            echo " caracola";
        }
        ?>
    </p> -->
    <!-- <p>
        <?php
        $mientero = 15;
        $mientero2 = 015; //octal
        $mientero3 = 0x15; //hexadecimal
        echo $mientero . "<br>";
        echo $mientero2 . "<br>";
        echo $mientero3 . "<br>";

        ?>
    </p> -->
    <!-- <p>
        <?php
        $a = 5;
        //$b = $a + 1;
        $b = $a++;
        $c = ++$a;
        echo "a = " . $a . "<br>";
        echo "b = " . $b . "<br>";
        echo "c = " . $c . "<br>";
        ?>
    </p> -->

    <!-- <p>
        <?php
        $a = $b = "3.14159265";
        echo "a vale $a y es de tipo " . gettype($a) . "<br>";

        settype($b, 'double');
        echo "b vale $b y es de tipo " . gettype($b) . "<br>";
        ?>
    </p> -->

    <p>
        <?php
        //$books = ['Harry Potter', 'The Lord of the Rings', 'Do Androids dream of Electric Sheep?'];
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

        //convierte una coleccion a una cadena 
        var_dump($books);
        echo "<br>";
        $libros2 = [
            0 => 'Harry Potter',
            1 => 'The Lord of the Rings',
            2 => 'Do Androids dream of Electric Sheep?'
        ];
        var_dump($libros2);
        ?>

    </p>
    <!-- <ul>
        <?php
        foreach ($books as $book) {
            //echo "<li>" . $book . "</li>";
            //echo "<li>$book</li>";
            echo "<li>";
            echo "$book[titulo] <br>";
            echo "$book[autor] <br>";
            //echo "<a href="$book[url]">$book[url]</a>";
            echo "</li>";
        };
        ?>


        <?php foreach ($books as $book) : ?>
            <li><?php echo $book['titulo'] ?></li>
            <li><a href="<?php echo $book['url'] ?>"><?php echo $book['titulo'] ?></a></li>
        <?php endforeach ?>
    </ul> -->

    <p>
        <?php
        foreach ($books as $book) {
            echo "$book[titulo] ($book[fecha])<br>";
        };
        ?>
    </p>

    <p>
        <?php
        foreach ($books as $book) : ?>
            <?php if ($book['autor'] == 'Brandon Sanderson') : ?>
                <a href=<?php $book['url']; ?>>
                <?php echo $book['titulo'] ?> (<?php echo $book['fecha']?>),
                por <?php echo $book['autor'] ?>
            
            </a>;
            <?php endif ?>
        <?php endforeach ?>
    </p>

</body>

</html>