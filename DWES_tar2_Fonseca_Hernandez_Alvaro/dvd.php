<?php
// Modelo. Clase DVD que se instanciará en la vista y a partir de la cual se generaran los objetos DVD
class DVD extends Material{
    private $duracion;
    private $genero;
    public function __construct($titulo, $autor, $ISBN, $disponible, $duracion, $genero) {
        parent::__construct($titulo, $autor, $ISBN, $disponible);
        $this->duracion = $duracion;
        $this->genero = $genero;
    }

    /*Se sobreescribe el metodo toString de la clase padre añadiendo la propiedad disponible donde corresponde*/
    public function __toString() {
        $disponibleStr = $this->isDisponible() ? "Si" : "No";        
        return parent::__toString() ." Duracion: $this->duracion min." . " Genero: $this->genero." . " Disponible: $disponibleStr<br>";
    }
}
?>