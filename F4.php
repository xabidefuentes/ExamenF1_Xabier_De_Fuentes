<?php
require_once 'Monoplaza.php'; 

class F4 extends Monoplaza
{
    protected $maxPilotos = 30;
    protected $tablaPuntos = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];
    protected $puntoVueltaRapida = false;
    private $pais;

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos, $pais)
    {
        // Llamamos al constructor del padre
        parent::__construct($piloto, $nacionalidad, $numero, $escuderia, $puntos);
        $this->pais = $pais; 
    }

    public function subirCategoria($escuderia, $academia)
    {
        // Devolvemos un objeto F3 con los mismos datos pero 0 puntos y la academia nueva.
        return new F3($this->piloto, $this->nacionalidad, $this->numero, $escuderia, 0, $academia);
    }
}