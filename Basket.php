<?php 
class Basket extends Partido{
    private $coeficienteDamas;
    private $coeficienteVarones;
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coeficienteDamas = 0.7;
        $this->coeficienteVarones = 0.8;
    }
    public function getCoeficienteDamas(){
        return $this->coeficienteDamas;
    }

    public function setCoeficienteDamas($coeficienteDamas){
        $this->coeficienteDamas = $coeficienteDamas;
    }

    public function getCoeficienteVarones()
    {
        return $this->coeficienteVarones;
    }

    public function setCoeficienteVarones($coeficienteVarones){
        $this->coeficienteVarones = $coeficienteVarones;
    }

    public function coeficientePartido() {

        $coeficiente = parent::coeficientePartido();
        if ($this->getObjEquipo1()->getCategoria() == 'Damas') {
            $coeficiente *= $this->coeficienteDamas;
        } elseif ($this->getObjEquipo1()->getCategoria() == 'Varones') {
            $coeficiente *= $this->coeficienteVarones;
        }
        return $coeficiente;
    }
   
    

    public function __toString(){
        $basket= parent::__toString(). "\n".
       "coeficienteDamas: ".$this->getCoeficienteDamas()."\n".
       "coeficienteVarones: ".$this->getCoeficienteVarones()."\n";
       return $basket;
    }
}
?>