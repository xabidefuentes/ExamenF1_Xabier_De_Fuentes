<?php
require_once 'Monoplaza.php';  // Clase padre.

class F1 extends Monoplaza
{
    protected $maxPilotos = 22;
    protected $tablaPuntos = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];
    private $patrocinador;

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos, $patrocinador)
    {
        // Llamamos al constructor del padre
        parent::__construct($piloto, $nacionalidad, $numero, $escuderia, $puntos);
        $this->patrocinador = $patrocinador; 
    }

    public function subirCategoria()
    {
        return null;  // Devolvemos nada porque F1 es lo máximo.
    }
}