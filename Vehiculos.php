<?php

interface vehiculo { 
    public function mover(int $tiempo);
    public function posicion();
    public function reiniciarPosicion();
}

class auto implements vehiculo {
    public $distancia = 0;
    public $velocidad = 40;

    public function __construct($velocidadAuto){
        $this->velocidad = $velocidadAuto;
    }
    
    public function mover($tiempo){
        $this->distancia = $this->distancia + $tiempo * $this->velocidad;       
    }
    public function posicion(){
        return $this->distancia;
    }
    public function reiniciarPosicion(){
        $this->distancia = 0;
    }
}

class bicicleta implements vehiculo {
    public $distancia = 0;
    public $velocidad = 10;
    
    public function mover($tiempo){
        $this->distancia = $this->distancia + $tiempo * $this->velocidad;       
    }
    public function posicion(){
        return $this->distancia;
    }
    public function reiniciarPosicion(){
        $this->distancia = 0;
    }
}

class camion implements vehiculo {
    public $distancia = 0;
    public $velocidad = 30;
    
    public function mover($tiempo){
        $this->distancia = $this->distancia + $tiempo * $this->velocidad;       
    }
    public function posicion(){
        return $this->distancia;
    }
    public function reiniciarPosicion(){
        $this->distancia = 0;
    }
}

class carrera {
    
    public $vehiculo1;
    public $vehiculo2;

    public function __construct(vehiculo $vehiculos1, vehiculo $vehiculos2) {
        $this->vehiculo1 = $vehiculos1;
        $this->vehiculo2 = $vehiculos2;
    }

    public function iniciarCarrera($segundos) {
        $this->vehiculo1->reiniciarPosicion();
        $this->vehiculo2->reiniciarPosicion();
        $this->vehiculo1->mover($segundos);
        $this->vehiculo2->mover($segundos);
        return "Vehiculo 1: " . $this->vehiculo1->posicion() . "\nVehiculo 2: " . $this->vehiculo2->posicion();
    }
}


$fiat = new Auto(45);
$bici = new Bicicleta();
$camion = new Camion();
$bici->mover(20); 
print($bici->posicion() . "\n"); 
$bici->mover(10); 
print($bici->posicion() . "\n");


$carrerita = new carrera($fiat,$bici);
printf($carrerita->iniciarCarrera(30));

?>