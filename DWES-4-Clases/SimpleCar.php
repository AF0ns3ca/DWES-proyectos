<?php

class SimpleCar
{
    private $marca;
    private $modelo;
    private $nBas;

    public function __construct($marca, $modelo, $nBas)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->nBas = $nBas;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function getNBas()
    {
        return $this->nBas;
    }

    public function setNBas($nBas)
    {
        $this->nBas = $nBas;
    }
}

class Coche extends SimpleCar
{
    private $añoLanz;
    private $color;
    private $claxon;

    public function __construct($marca, $modelo, $nBas, $añoLanz, $color, $claxon)
    {
        parent::__construct($marca, $modelo, $nBas);
        $this->añoLanz = $añoLanz;
        $this->color = $color;
        $this->claxon = $claxon;
    }

    public function getAñoLanz()
    {
        return $this->añoLanz;
    }

    public function setAñoLanz($añoLanz)
    {
        $this->añoLanz = $añoLanz;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getClaxon()
    {
        return $this->claxon;
    }

    public function setClaxon($claxon)
    {
        $this->claxon = $claxon;
    }

    public function sonarClaxon()
    {
        echo "Sonido del Claxon: " . $this->claxon . "<br>";
    }
}


$renaultKoleos = new Coche("Renault", "Koleos", "1234567890", 2015, "blanco", "SonidoDelClaxonOriginal");

echo "Marca: " . $renaultKoleos->getMarca() . "<br>";
echo "Modelo: " . $renaultKoleos->getModelo() . "<br>";
echo "Año de Lanzamiento: " . $renaultKoleos->getAñoLanz() . "<br>";
echo "Color: " . $renaultKoleos->getColor() . "<br>";

$renaultKoleos->setColor("negro");
echo "Color después de pintarlo de negro: " . $renaultKoleos->getColor() . "<br>";

$renaultKoleos->sonarClaxon();
