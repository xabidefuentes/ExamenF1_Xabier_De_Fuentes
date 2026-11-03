<?php
require_once 'Monoplaza.php';
require_once 'F2.php';        

class F3 extends Monoplaza
{
    protected $maxPilotos = 30;
    protected $tablaPuntos = [10, 8, 7, 6, 5, 4, 3, 2, 1];
    protected $puntoVueltaRapida = false;
    private $academia;

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos, $academia)
    {
        // Llamamos al constructor del padre
        parent::__construct($piloto, $nacionalidad, $numero, $escuderia, $puntos);
        $this->academia = $academia; 
    }

    public function subirCategoria($escuderia, $superlicencia)
    {
        // Devolvemos un objeto F2 nuevo con 0 puntos y la superlicencia indicada.
        return new F2($this->piloto, $this->nacionalidad, $this->numero, $escuderia, 0, $superlicencia);
    }
}