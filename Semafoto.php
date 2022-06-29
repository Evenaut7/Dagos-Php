<?php

class semaforo{
    
    public $intermitente = False;
    public $color;

    public function __construct($colorInicial){
        $this->color = $colorInicial;
    }

    public function pasoDelTiempo($segundos){
        $i1=0;
        if ($this->intermitente){
            if($segundos % 2 == 0){
                $this->color = "Amarillo";
            }
            else{
                $this->color = "Apagado";
            }
        }
        
        else{
            if($this->color == "Rojo"){
                $i1=0;
            }
            if($this->color == "Rojo-Amarillo"){
                $i1=30;
            }
            if($this->color == "Verde"){
                $i1=32;
            }
            if($this->color == "Amarillo"){
                $i1=52;
            }
            
            for ($i=0; $i <= $segundos; $i++) {
                if($i1==30){
                    $this->color = "Rojo-Amarillo";
                }
                if($i1==32){
                    $this->color = "Verde";
                }
                if($i1==52){
                    $this->color = "Amarillo";
                }
                if($i1==54){
                    $this->color = "Rojo";
                    $i1 = -1;
                }
                $i1++;      
            }
                
        }

    }
    public function mostrarColor(){
       print $this->color;
    }
    public function ponerEnIntermitente(){
        $this->intermitente = True;
    }
    public function sacarDeIntermitente(){
        $this->intermitente = False;
    }
}

$semaforochan = new semaforo("Rojo");
$semaforochan->pasoDelTiempo(39);
$semaforochan->mostrarColor();

?>