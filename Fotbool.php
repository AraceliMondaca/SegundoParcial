<?php
class Fotbool extends Partido{
    private $coeficienteMenores;
    private $coeficienteJuveniles;
    private $coeficienteMayores;
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coeficienteMenores = 0.6;
        $this->coeficienteJuveniles = 0.7;
        $this->coeficienteMayores = 0.8;
    }
    
    public function getCoeficienteMenores()
    {
        return $this->coeficienteMenores;
    }
    public function setCoeficienteMenores($coeficienteMenores){
        $this->coeficienteMenores = $coeficienteMenores;

    }
    public function getCoeficienteJuveniles()
    {
        return $this->coeficienteJuveniles;
    }
    public function setCoeficienteJuveniles($coeficienteJuveniles){
        $this->coeficienteJuveniles = $coeficienteJuveniles;

    }
    public function getCoeficienteMayores()
    {
        return $this->coeficienteMayores;
    }

    public function setCoeficienteMayores($coeficienteMayores){
        $this->coeficienteMayores = $coeficienteMayores;
    }




    public function coeficientePartido() {
        $coeficiente = parent::coeficientePartido();
        if ($this->getObjEquipo1()->getCategoria() == 'Menores') {
            $coeficiente *= $this->coeficienteMenores;
        } elseif ($this->getObjEquipo1()->getCategoria() == 'Juveniles') {
            $coeficiente *= $this->coeficienteJuveniles;
        } elseif ($this->getObjEquipo1()->getCategoria() == 'Mayores') {
            $coeficiente *= $this->coeficienteMayores;
        }
        return $coeficiente;
    }

public function __toString(){
    $fotbool= parent::__toString(). "\n".
    "\ncoeficienteMenores: ".$this->getCoeficienteMenores().
    "\ncoeficienteJuveniles: ".$this->getCoeficienteJuveniles().
    "\ncoeficienteMayores: ".$this->getCoeficienteMayores();
    return $fotbool;

}

}
?>