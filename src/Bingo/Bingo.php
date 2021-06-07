<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    
    public string $nombre1;
    public string $nombre2;
    public string $nombre3;
    public string $nombre4;
    private array $totalcartones;
    private array $verificartotalcartones;
    private array $rand;
    private int $lineaCantada;
    private int $lineaCompleta;
    private int $linealeida;
    private int $bingoCantado;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        
        $this-> nombre1 = $nombre1;
        $this-> nombre2 = $nombre2;
        $this-> nombre3 = $nombre3;
        $this-> nombre4 = $nombre4;
        $this-> lineaCompleta = 0;
        $this-> lineaCantada = 0;
        $this-> bingoCantado = 0;
        $this-> linealeida = 0;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen('cartones.dat','rb');
    }
    /**
     * Generará tantos cartones para cada jugador como pasemos por parámetro max 3
     * cada cartón tendrá id cada celda tendrá id siendo = " id_carton / id_celda [1-27] "
     */
    public function getCarton($ncartonesporjugador){

        $ncartonesporjugador = $ncartonesporjugador*4;
        $contIdCarton = 1;
        
        while( $ncartonesporjugador != 0){
            $carton = [];
            for($i=0; $i<3; $i++){
                $linea = fgets($this-> fichero);
                $carton []= explode( ".", $linea );
            }
            // cada carton generado irá dentro de totalcartones[]
            $this-> totalcartones[] = $carton;
            
            echo "<table id=$contIdCarton border=1px>";
            // var_dump($carton);
            
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
            // clave 1 = id primer carton, dentro de esta clave existe array que
            // para cada valor contiene id de celdas correspondientes al cartón.
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
    }

    public function verifica($bola){

        foreach ($this->verificartotalcartones as $key => $value) {
            $disp = $celda = 0;
            foreach ($this->verificartotalcartones[$key] as $clave => $valor) {
                // echo"<br><br><br><br>";
                // var_dump($this->totalcartones[$key]);
                // echo"<br><br><br><br>";
                // Para $key = n su valor será un array con 3 indices 0 1 2, 
                // cada uno de estos contendrá un array con todos los numeros de una linea,
                // el carton lo conformarán estas 3 líneas.
                
                foreach ($this->verificartotalcartones[$key][$clave] as $indi => $caracter) {
                    // var_dump($this->totalcartones[$key][$clave]);
                    // echo"<br><br><br><br>";
                    // echo "$clave ..... $indi....$caracter...<br>";
                    if($disp == 0){
                        $celda++;
                    }
                    if($caracter == $bola){
                        // echo "En array id: $this->totalcartones[27] match con valor: $valor clave: $clave<br>";
                        unset($this->verificartotalcartones[$key][$clave][$indi]);
                        // var_dump($this-> verificartotalcartones);
                        $disp = 1;
                        echo "match en carton $key $clave $indi $caracter<br>";
                        echo "numero carton :  ".$key."<br>";
                        echo "numero de saltos:  ".$celda."<br>";
                        $this->totalcartones[$key][$clave][$indi] = "X";
                        $string = serialize($this-> totalcartones);
                        file_put_contents('totalcartones.txt',  $string );
                        
                    }
                    //  var_dump($this->verificartotalcartones[$key][$clave]);
                    //   echo"<br><br><br><br>";
                }
                $this->getPremio($this->verificartotalcartones[$key][$clave]);
                // var_dump($this->verificartotalcartones[$key]);
            }
        }
    }
    
    public function getBola(){

        // $bola será el VALOR contenido en array NO el indice
        $claveazar = array_rand($this-> rand);
        $bola = $this-> rand[$claveazar];
        unset($this -> rand [$claveazar]);
        echo "num bola: $bola</br>";
        // var_dump($this-> rand);
        $this->verifica($bola);  

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
                // var_dump($this->totalcartones);
            }
            $this->lineaCompleta =  $this->lineaCompleta +1;
            if($this->linealeida == 3 && $this->lineaCompleta == 3 &&  $this-> bingoCantado == 0){
                echo "!!!!!!!!!!!BINGOOOO¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
                $this-> bingoCantado = 1;
                // var_dump($this->totalcartones);
            }
        }   
    }

}