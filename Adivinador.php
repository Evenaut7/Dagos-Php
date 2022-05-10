<?php

interface Adivinador {
    public function sugerirNumeroSecreto();
    public function elNumeroEraMenor();
    public function elNumeroEraMayor();
}

class Principiante implements Adivinador {
    
    protected $minimo = 1;
    protected $maximo = 1000;
    protected $sugerir = 0;

    public function valores($max,$min) {
        $this->maximo = $max;
        $this->minimo = $min;
    }

    public function sugerirNumeroSecreto() {
        $this->sugerir = (int)rand($this->minimo, $this->maximo);
        return $this->sugerir;
    }
    
    public function elNumeroEraMayor() {
        $this->minimo = $this->sugerir;
    }
 
    public function elNumeroEraMenor() {
        $this->maximo = $this->sugerir;
    }
}

class Profesional implements Adivinador {
    
    protected $minimo = 1;
    protected $maximo = 1000;
    protected $sugerir = 0;

    public function valores($max,$min) {
        $this->maximo = $max;
        $this->minimo = $min;
    }
    
    public function sugerirNumeroSecreto() {
        $this->sugerir = (int)($this->maximo + $this->minimo) / 2;
        return $this->sugerir;
    }
    
    public function elNumeroEraMayor() {
        $this->minimo = $this->sugerir;
    }
 
    public function elNumeroEraMenor() {
        $this->maximo = $this->sugerir;
    }
}


class Juego {
    
    protected $ganador = '';
    protected $rondas = 0;
    public $minimo = 1000;
    public $maximo = 0;
    
    public function __construct($min,$max) {
        $this->minimo = $min;
        $this->maximo = $max;
    }

    public function jugar(Adivinador $jugador1, Adivinador $jugador2) {
    
        $this->rondas = 0;
        $this->ganador = '';
        
        $jugador1->valores($this->maximo,$this->minimo);
        $jugador2->valores($this->maximo,$this->minimo);

        $numSecreto = rand($this->maximo, $this->minimo);
        
        while ($this->ganador == '') {
            $num1 = $jugador1->sugerirNumeroSecreto();
            $num2 = $jugador2->sugerirNumeroSecreto();
            if ($this->hayGanador($numSecreto, $num1, $num2) == false) {
                $this->informarResultado($jugador1, $num1, $numSecreto);
                $this->informarResultado($jugador2, $num2, $numSecreto);
            }
        $this->rondas++;
        }
        return $this->ganador . ' El partido terminó en ' . $this->rondas . " rondas\n";
    }
    
    protected function informarResultado($jugador, $num, $numSecreto) {
        if($num<$numSecreto) {
            $jugador->elNumeroEraMayor();
        }
        else {
            $jugador->elNumeroEraMenor();
        }
    }

    protected function hayGanador($numSecreto, $num1, $num2) {
        if ($num1 == $num2 && $numSecreto == $num1) {
            return $this->ganador = 'Ambos jugadores empataron.';
        }
        if ($num1 == $numSecreto) {
            return $this->ganador = 'Gano el jugador 1.';
        }
        if ($num2 == $numSecreto) {
            return $this->ganador = 'Gano el jugador 2.';
        }
        return $this->ganador != '';
    }

}

$jugador1 = new Profesional;
$jugador2 = new Principiante;
$partidito = new Juego(1,5000);
for($i=0;$i<=5;$i++){
    print("Partido " . $i . ": " . $partidito->jugar($jugador1,$jugador2));
}

// metodo publico: public function jugar
// metodo privado: protected hay ganador
// atributo de clase: protected $ganador = 0
// ejemplo de polimorfirsmo: interface Adivinador
// implementacion de interface: class principiante implements adivinador