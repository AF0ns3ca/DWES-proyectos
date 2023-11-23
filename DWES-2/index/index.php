<?php

$books = [[
    'titulo' => 'Harry Potter',
    'autor' => 'J.K. Rowling',
    'fecha' => '1997',
    'url' => 'https://pekeleke.es/wp-content/uploads/2020/11/harry-potter-piedra-filosofal-minalima-portada.jpg'
], [
    'titulo' => 'The Lord od the Rings',
    'autor' => 'J.R.R. Tolkien',
    'fecha' => '1953',
    'url' => 'https://medios.lamarmota.es/senor-de-los-anillos.jpeg'
], [
    'titulo' => 'Do Androids dream of Electric Sheep',
    'autor' => 'Philip K. Dick',
    'fecha' => '1968',
    'url' => 'https://m.media-amazon.com/images/I/71uN5sUHXiL._AC_UF1000,1000_QL80_.jpg'
], [
    'titulo' => 'Mistborn',
    'autor' => 'Brandon Sanderson',
    'fecha' => '2006',
    'url' => 'https://m.media-amazon.com/images/I/510Jr2WDIPL.jpg'
], [
    'titulo' => 'The Eye of the World',
    'autor' => 'Robert Jordan',
    'fecha' => '1990',
    'url' => 'https://m.media-amazon.com/images/I/91BrzYTawmL._AC_UF1000,1000_QL80_.jpg'
], [
    'titulo' => 'The Way of Kings',
    'autor' => 'Brandon Sanderson',
    'fecha' => '2010',
    'url' => "https://m.media-amazon.com/images/I/51Qh9KpS2CL.jpg"
]];

$listaAutor = array_filter($books, function ($book) {
    return $book['autor'] === 'Brandon Sanderson';
});

$listaAnio = array_filter($books, function ($book) {
    return ($book['fecha']>=1950 && $book['fecha']<=2000);
});

require "index.view.php"
?>

