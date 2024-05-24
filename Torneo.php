<?php 
/**Implementar la clase Torneo que contiene la colección de partidos
 *  y un importe que será parte del premio. Cuando un Torneo es creado
 * la colección de partidos debe ser creada como una colección vacía. 
 */
class Torneo{
    private $objColPartidos;
    private $Premios;
public function __construct($objColPartidos,$Premio){
$this->objColPartidos=$objColPartidos=array($objColPartidos);
$this->Premios=$Premio;
}

    public function getObjColPartidos(){
        return $this->objColPartidos;
    }
    public function setObjColPartidos($objColPartidos){
        $this->objColPartidos = $objColPartidos;
    }
    public function getPremios(){
        return $this->Premios;
    }
    public function setPremios($Premios){
        $this->Premios = $Premios;
    }

/**Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido)
 * en la  clase Torneo el cual recibe por parámetro 2 equipos, la fecha en la que se realizará 
 * el partido y si se rata de un partido de futbol o basquetbol . El método debe crear y retornar
 *  la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo.
 *  Se debe chequear que los 2 equipos tengan la misma categoría e igual cantidad de jugadores, caso contrario
 *  no podrá ser registrado ese partido en el torneo.  
 */
public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido) {
    $partido=null;
    $idpartido=-1;
    $cantGolesE1=0;
    $cantGolesE2=0;
    $coeficienteMenores=-1;
    $coeficienteJuveniles=-1;
    $coeficienteMayores=-1;
    $coeficienteDamas=-1;
    $coeficienteVarones=-1;
    if ($objEquipo1->getCategoria() == $objEquipo2->getCategoria() && $objEquipo1->getCantidadJugadores() == $objEquipo2->getCantidadJugadores()) {
        $partido = null;
        if ($tipoPartido == 'Fotbool') {
            $partido = new Fotbool($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$coeficienteMenores,$coeficienteJuveniles,$coeficienteMayores);
        } elseif ($tipoPartido == 'Basket') {
            $partido = new Basket($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$coeficienteDamas,$coeficienteVarones);
        }
        $this->setObjColPartidos($partido);
     
    return $partido;
    }
}


/**Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de un partido
 *  de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos ganadores ( equipo con mayor
 *  cantidad de goles). El método retorna una colección con los objetos de los equipos encontrados */
public function darGanadores($deporte) {
    $ganadores = array();
    foreach ($this->getObjColPartidos() as $partido) {
        if ($partido instanceof Fotbool && $deporte == 'Fotbool') {
            $ganador = $partido->darEquipoGanador();
            if ($ganador) {
                $ganadores[] = $ganador;
            }
        } elseif ($partido instanceof Basket && $deporte == 'Basket') {
            $ganador = $partido->darEquipoGanador();
            if ($ganador) {
                $ganadores[] = $ganador;
            }
        }
    }
    return $ganadores;
}

 /**Implementar el método calcularPremioPartido($OBJPartido)
 *  que debe retornar un arreglo asociativo donde una de sus claves es ‘equipoGanador’
 *   y contiene la referencia al equipo ganador; y la otra clave es ‘premioPartido’ que 
 * contiene el valor obtenido del coeficiente del Partido por el importe configurado para el torneo. 
(premioPartido = Coef_partido * ImportePremio)
 */
public function calcularPremioPartido($partido) {
    $coeficiente = $partido->coeficientePartido();
    $premioPartido = $coeficiente * $this->getPremios();
    $premio= array('equipoGanador' => $partido->darEquipoGanador(), 'premioPartido' => $premioPartido);
    return $premio;
}


private function arregloString($array) {
    $cadena = '';
    if (is_array($array)) {
        foreach ($array as $elemento) {
            if (is_array($elemento)) {
                $cadena .= $this->arregloString($elemento);
            } else {
                $cadena .= $elemento . "\n";
            }
        }
    }
    return $cadena; 
}

    public function __toString(){
        $partidos=$this->arregloString($this->getObjColPartidos());
        $torneo="Información del Partido! .\n". 
        "Partidos: ". $partidos."\n".
        "Premios: ".$this->getPremios() ."\n";
        return $torneo;
    }
}
?>