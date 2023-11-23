<?php
//Controlador
include "material.php";
include "libro.php";
include "dvd.php";
$libro1 = new Libro("Mistborn", "Brandon Sanderson", "9780544003", true, 672);
$libro2 = new Libro("Harry Potter and the Philosopher's Stone", "J.K. Rowling", "9687214536", true, 264);
$dvd1 = new DVD("Oppenheimer", "Christopher Nolan", "5987424563", true, 182, "Suspense");
$dvd2 = new DVD("Origen", "Christopher Nolan", "4321098765", true, 148, "Ciencia Ficcion");
$materiales = [$libro1, $dvd1, $libro2, $dvd2];
include "index-view.php";
