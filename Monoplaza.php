<?php

// Esta es la clase "padre"
class Monoplaza
{
    protected $piloto;
    protected $nacionalidad;
    protected $numero;
    protected $escuderia;
    protected $puntos;

    // Cada categoría hija (F1, F2, F3...) puede cambiar estos 3 valores:
    protected $maxPilotos = 0;          
    protected $tablaPuntos = [];  
    protected $puntoVueltaRapida = true; // Si es true, se da un punto extra por vuelta más rápida. false en F3 y F4.

    public function __construct($piloto, $nacionalidad, $numero, $escuderia, $puntos = 0)
    {
        $this->piloto = $piloto;           
        $this->nacionalidad = $nacionalidad;
        $this->numero = $numero;             
        $this->escuderia = $escuderia;    
        $this->puntos = $puntos;          
    }

    public function getPuntos()
    {
        return $this->puntos;  
    }

    // Comprueba si una posición (como 1º, 2º, 3º...) existe en esta categoría.
    public function posicionValida($posicion)
    {
        // La posición debe ser mayor o igual a 1 y menor o igual al máximo de pilotos.
        return $posicion >= 1 && $posicion <= $this->maxPilotos;
    }

    // Da puntos al piloto según la posición en la que llegó y si hizo vuelta rápida.
    public function otorgarPuntos($posicion, $vueltaRapida)
    {
        if (!$this->posicionValida($posicion)) {
            return false;  
        }

        // Restamos 1 para buscar en la lista correcta, si no hay puntos para esa posición, devolvemos 0.
        $this->puntos += $this->tablaPuntos[$posicion - 1] ?? 0;

        // Si hizo vuelta rápida, esta categoría da punto extra y acabó entre los 10 primeros...
        if ($vueltaRapida && $this->puntoVueltaRapida && $posicion <= 10) {
            $this->puntos++;  // Sumamos 1 punto extra.
        }
        return true;
    }
}