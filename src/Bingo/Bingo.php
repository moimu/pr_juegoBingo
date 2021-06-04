<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    private int $numJugadores;
    public string $nombre1;
    public string $nombre2;
    public string $nombre3;
    public string $nombre4;
    private array $totalcartones;
    private array $verificartotalcartones;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        $this-> nombre1 = $nombre1;
        $this-> nombre2 = $nombre2;
        $this-> nombre3 = $nombre3;
        $this-> nombre4 = $nombre4;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen('cartones.dat','rb');
    }

    public function getCarton($cartonesporjugador){

        $cartonesporjugador = $cartonesporjugador*4;
        while( $cartonesporjugador != 0){
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
            $cartonesporjugador--;
        }
        var_dump($this-> totalcartones);
        $this-> verificartotalcartones = [];
        $this-> verificartotalcartones = $this-> totalcartones;
    }

    public function verifica($bola){
        foreach ($this->totalcartones as $key => $value) {
            foreach ($this->totalcartones[$key] as $clave => $valor) {
                foreach ($this->totalcartones[$key][$clave] as $indi => $caracter) {
                    if($caracter == $bola){
                        // echo "En array id: $this->totalcartones[27] match con valor: $valor clave: $clave<br>";
                        // $this->totalcartones[$key] = $valor." ";
                        echo "match en carton ";
                    }
                }
            }
        }
    }
    
    public function getBola(){
        //$rand = range (1, 90);
        $bola = array_rand($this-> rand);
        if ($bola != 0) {
            $a=$bola-1;
        }
        else {
            $a=$bola;
        }
        unset($this -> rand [$a]);
        echo $bola."</br>";
        self::verifica($bola);
        /*var_dump($this -> rand);
        echo "</br>";*/
        
        echo"<div><button id='1'>Nuevo numero</button> </div>";
        

        
    }
    public function getLineaBingo(array $linea1,array $linea2, array $linea3){
        $linea1;
        $linea2;
        $linea3;

        $li1= count($linea1);
        $li2= count($linea2);
        $li3= count($linea3);
        echo $li1."</br>";
        echo $li2."</br>";
        echo $li3."</br>";
        
        if ($li1 && $li2 && $li3 <= 4) {
            echo "!!!!!!!!!!!BINGOOOO¡¡¡¡¡¡¡¡¡¡¡ </br>";
        }
        elseif ($li1 || $li2 || $li3 <= 4 ) {
            echo "!!!Linea¡¡¡ </br>";
            

        }

    }
    public function getJugadores(){
       
    }

}