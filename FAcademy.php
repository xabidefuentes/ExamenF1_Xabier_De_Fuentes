<?php
require_once 'Monoplaza.php';  // Clase padre.

class FAcademy extends Monoplaza
{
    protected $maxPilotos = 18;
    // Puntos que se dan según la posición en FAcademy.
    protected $tablaPuntos = [18, 15, 12, 10, 8, 6, 4, 2, 1];
    private $potencia;

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos, $potencia)
    {
        // Llamamos al constructor del padre
        parent::__construct($piloto, $nacionalidad, $numero, $escuderia, $puntos);
        $this->potencia = $potencia;  
    }

    public function subirCategoria()
    {
        return null;  // No puede subir a otra categoría.
    }
}