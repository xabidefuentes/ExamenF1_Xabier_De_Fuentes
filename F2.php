<?php
require_once 'Monoplaza.php';  // Clase padre.
require_once 'F1.php';         // Clase F1 porque F2 puede subir a F1.

class F2 extends Monoplaza
{
    protected $maxPilotos = 24;
    protected $tablaPuntos = [10, 8, 7, 6, 5, 4, 3, 2, 1];
    private $superlicencia;

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos, $superlicencia)
    {
        // Llamamos al constructor del padre
        parent::__construct($piloto, $nacionalidad, $numero, $escuderia, $puntos);
        $this->superlicencia = $superlicencia; 
    }

    public function subirCategoria($escuderia, $patrocinador)
    {
        // Si NO tiene superlicencia, no puede subir y devolvemos null.
        if (!$this->superlicencia) {
            return null;
        }
        // Si tiene superlicencia, creamos un objeto F1 nuevo empezando con 0 puntos.
        return new F1($this->piloto, $this->nacionalidad, $this->numero, $escuderia, 0, $patrocinador);
    }
}