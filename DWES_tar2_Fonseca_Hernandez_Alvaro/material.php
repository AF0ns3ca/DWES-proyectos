<?php
// Modelo. Clase padre que sera heredada por las clases hijas libro y dvd
class Material {
    private $titulo;
    private $autor;
    private $ISBN;
    private $disponible;

    public function __construct($titulo, $autor, $ISBN, $disponible) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ISBN = $ISBN;
        $this->disponible = $disponible;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getISBN() {
        return $this->ISBN;
    }

    public function setISBN($ISBN) {
        $this->ISBN = $ISBN;
    }

    public function isDisponible() {
        return $this->disponible;
    }

    public function prestar() {
        if ($this->disponible) {
            $this->disponible = false;
            return "El material ha sido prestado correctamente";
        } else {
            return "No se ha podido prestar";
        }
    }

    public function devolver() {
        if ($this->disponible) {
            return "No se puede devolver; no se ha tomado prestado";
        } else {
            $this->disponible = true;
            return "Devuelto correctamente";
        }
    }
    
    public function __toString() {
        return "$this->titulo. $this->autor. ($this->ISBN). ";
    }
}
?>