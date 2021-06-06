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
        $this->lineaCantada = 0;
        $this-> bingoCantado = 0;
        $this->linealeida = 0;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen('cartones.dat','rb');
    }

    public function getCarton($ncartonesporjugador){

        $ncartonesporjugador = $ncartonesporjugador*4;
        while( $ncartonesporjugador != 0){
            $carton = [];
            for($i=0; $i<3; $i++){
                $linea = fgets($this-> fichero);
                $carton []= explode( ".", $linea );
            }
            $this-> totalcartones[] = $carton;
            echo "<table border=1px>";
            // var_dump($carton);
            foreach ($carton as $key => $value ) {                    
                echo "<tr>";
                foreach  ($carton[$key] as $clave => $valor) {
                    echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            $ncartonesporjugador--;
        }
        // var_dump($this-> totalcartones);
        $this-> verificartotalcartones = [];
        $this-> verificartotalcartones = $this-> totalcartones;
    }

    public function verifica($bola){

        foreach ($this->totalcartones as $key => $value) {
            
            foreach ($this->totalcartones[$key] as $clave => $valor) {
                // echo"<br><br><br><br>";
                // var_dump($this->totalcartones[$key]);
                // echo"<br><br><br><br>";
                // Para $key = n su valor será un array con 3 indices 0 1 2, 
                // cada uno de estos contendrá un array con todos los numeros de una linea,
                // el carton lo conformarán estas 3 líneas.
                
                foreach ($this->totalcartones[$key][$clave] as $indi => $caracter) {
                    // var_dump($this->totalcartones[$key][$clave]);
                    // echo"<br><br><br><br>";
                    // echo "$clave ..... $indi....$caracter...<br>";
                    if($caracter == $bola){
                        // echo "En array id: $this->totalcartones[27] match con valor: $valor clave: $clave<br>";
                        // $this->totalcartones[$key] = $valor." ";
                        echo "match en carton $key $clave $indi $caracter<br>";
                        unset($this->verificartotalcartones[$key][$clave][$indi]);
                        // var_dump($this-> verificartotalcartones);
                    }
                    $this->getLinea($this->verificartotalcartones[$key][$clave]);
                    //  var_dump($this->verificartotalcartones[$key][$clave]);
                    //   echo"<br><br><br><br>";
                }
                
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

    public function getLinea(array $linea){
        if( $this->linealeida == 3 ){
            $this->linealeida = 0;
            $this->lineaCompleta = 0;
        }
        $this->linealeida++;

        $size= count($linea);
        if ($size <= 4 ) {
            if($this->lineaCantada == 0){
                echo " !!!  Linea  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
                $this->lineaCantada = 1;
            }
            $this->lineaCompleta =  $this->lineaCompleta +1;
            if($this->linealeida == 3 && $this->lineaCompleta == 3 &&  $this-> bingoCantado == 0){
                echo "!!!!!!!!!!!BINGOOOO¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
                $this-> bingoCantado = 1;
                var_dump($this->verificartotalcartones);
            }
        }
            
    }

    // public function getBingo(array $fila1, array $fila2, array $fila3){
       
    //     if($this->bingoCantado == 0){
    //         $size1= count($fila1);
    //         $size2= count($fila2);
    //         $size3= count($fila3);
    //         if ($size1 && $size2 && $size3 <= 4) {
    //             var_dump($fila1,$fila2,$fila3);
    //             echo "!!!!!!!!!!!BINGOOOO¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ </br>";
    //             $this-> bingoCantado = 1;
    //         }
          
    //     }

    // }

}