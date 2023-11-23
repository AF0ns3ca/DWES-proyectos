<?php
// Modelo. Clase libro que se instanciará en la vista y a partir de la cual se generaran los objetos libro
class Libro extends Material{
    private $numPaginas;
    public function __construct($titulo, $autor, $ISBN, $disponible, $numPaginas) {
        parent::__construct($titulo, $autor, $ISBN, $disponible);
        $this->numPaginas = $numPaginas;
    }

    /*Se sobreescribe el metodo toString de la clase padre añadiendo la propiedad disponible donde corresponde*/
    public function __toString() {
        $disponibleStr = $this->isDisponible() ? "Si" : "No";
        return parent::__toString() ." Paginas: $this->numPaginas." . " Disponible: $disponibleStr<br>";
    }
}
?>