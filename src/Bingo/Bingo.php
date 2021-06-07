<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    
    private array $jugadores;
    private array $totalcartones;
    private array $verificartotalcartones;
    private array $rand;
    private int $lineaCantada;
    private int $lineaCompleta;
    private int $linealeida;
    private int $bingoCantado;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        
        $this->jugadores = [$nombre1, $nombre2, $nombre3, $nombre4];
        $this-> lineaCompleta = 0;
        $this-> lineaCantada = 0;
        $this-> bingoCantado = 0;
        $this-> linealeida = 0;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen('cartones.dat','rb');
    }
    /**
     * Si existen cartones generados, es decir existe fichero totalcartones.txt
     * estamos en una partida no hacemos getCartones, regeneramos el fichero para
     * obtener el array totalcartones ya matcheado con las bolas que han salido
     * e imprimir los cartones con colores en las celdas matcheadas... 
     *   -________ PRUEBA __--______
     */
    public function printtotalcartones(){

        $fichero = fopen('totalcartones.txt','rb');
        $string = "";
        while($linea = fgets($fichero)){
            $string .= $linea;
        }
        $totalcartonesregenerado = unserialize( $string );
        // colvemos a asignar valor a verificartotalcartones
        $this-> verificartotalcartones = $totalcartonesregenerado;
        // var_dump($totalcartonesregenerado);
        
    }
    /**
     * Generará tantos cartones para cada jugador como pasemos por parámetro max 3
     * cada cartón tendrá id cada celda tendrá id siendo = " id_carton / id_celda [1-27] "
     * - Cada carton generado irá dentro de totalcartones[]
     * - totalIds[] clave 1 = id primer carton, dentro de esta clave existe array que
     *   para cada valor contiene id de celdas correspondientes al cartón.
     */
    public function getCartones($ncartonesporjugador){
        
        $ncartonesporjugador = $ncartonesporjugador*4;
        $contIdCarton = 0;
        $contador = 0;
        while( $ncartonesporjugador != 0){
            $carton = [];
            echo "<fieldset> carton : $contIdCarton";
            if($contIdCarton%3==0){
                echo " ".$this->jugadores[$contador];
                $contador++;
                echo "<hr>";
            }
            for($i=0; $i<3; $i++){
                $linea = fgets($this-> fichero);
                $carton []= explode( ".", $linea );                
            }
            $this-> totalcartones[] = $carton;
            echo "<table class = c"."$contIdCarton id=$contIdCarton border=1px>";
            $idceldas=[];
            $contIdCelda = 1;
            foreach ($carton as $key => $value ) {                    
                echo "<tr>";
                foreach  ($carton[$key] as $clave => $valor) {
                    echo "<td id=$contIdCarton$contIdCelda>".$valor."</td>";
                    $idceldas[] = "$contIdCarton$contIdCelda";
                    $contIdCelda++;
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "</fieldset>";
            $this-> totalIds[] = $idceldas;
            $ncartonesporjugador--;
            $contIdCarton++;
        }
        // var_dump($this-> totalcartones);
        $this-> verificartotalcartones = [];
        // copiamos totalcartones en verificartotalcartones
        // para poder editarlo y verificar premios
        $this-> verificartotalcartones = $this-> totalcartones;
        // var_dump( $this-> totalIds);
        
        // clave 1 = id primer carton, dentro de esta clave existe array que
        // para cada valor contiene id de celdas correspondientes al cartón.
        $this-> totalIds[] = $idceldas;
        $ncartonesporjugador--;
        $contIdCarton++;
         
    }
    /**
     * Para $key = n su valor será un array con 3 indices 0 1 2, 
     * cada uno de estos contendrá un array con todos los numeros de una linea,
     * el carton lo conformarán estas 3 líneas.
     */
    public function verifica($bola){
        foreach ($this->verificartotalcartones as $key => $value) {
            $disp = $celda = 0;
            foreach ($this->verificartotalcartones[$key] as $clave => $valor) {
                // var_dump($this->totalcartones[$key]);  echo"<br><br><br><br>";                
                foreach ($this->verificartotalcartones[$key][$clave] as $indi => $caracter) {
                    // var_dump($this->totalcartones[$key][$clave]);  echo"<br><br><br><br>";
                    if($disp == 0){
                        $celda++;
                    }
                    if($caracter == $bola){
                        echo "match en carton: $key , Linea: $clave , clave: $indi , idcelda: $celda<br> <hr>";
                        $idcartonmatch = $key;
                        $idceldamatch = $celda;
                        unset($this->verificartotalcartones[$key][$clave][$indi]);
                        $this->totalcartones[$key][$clave][$indi] = "X";
                        //  ---------    PRUEBA  ---------
                        // $string1 = serialize($this-> totalcartones);
                        // file_put_contents('totalcartones.txt',  $string1 );
                        // $string2 = serialize($this-> verificartotalcartones);
                        // file_put_contents('verificartotalcartones.txt',  $string2 );
                        $disp = 1;
                    }
                    //  var_dump($this->verificartotalcartones[$key][$clave]);  echo"<br><br><br><br>";
                }
            $this->getPremio($this->verificartotalcartones[$key][$clave]);
            }
        }
        if(isset($idcartonmatch)){
            return "$idcartonmatch"."$idceldamatch";
        }
        
    } 
    
    public function getBola(){
        // $bola será el VALOR contenido en array NO el indice
        $claveazar = array_rand($this-> rand);
        $bola = $this-> rand[$claveazar];
        unset($this -> rand [$claveazar]);
        echo "num bola: $bola</br>";
        // var_dump($this-> rand);
        return $bola;
    }

    public function getPremio(array $linea){      
        if( $this->linealeida == 3 ){
            $this->linealeida = 0;
            $this->lineaCompleta = 0;
        }
        $this->linealeida++;
        $size= count($linea);
        if ($size == 4 ) {
            if($this->lineaCantada == 0){
                echo " !!!  Linea  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
                $this->lineaCantada = 1;
            }
            $this->lineaCompleta =  $this->lineaCompleta +1;
            if($this->linealeida == 3 && $this->lineaCompleta == 3 &&  $this-> bingoCantado == 0){
                echo "!!!!!!!!!!!BINGOOOO¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
                $this-> bingoCantado = 1;
            }
        }
    }

    // public function getJuego(){
    //     echo "<div>";
    //     while($this->bingoCantado !=1){
    //         $this->getBola();
    //     }
    //     echo "</div>";
    // }

}