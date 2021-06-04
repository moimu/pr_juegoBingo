<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    private int $numJugadores;
    private string $nombre1;
    private string $nombre2;
    private string $nombre3;
    private string $nombre4;
    private array $totalcartones;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        $this-> nombre1 = $nombre1;
        $this-> nombre2 = $nombre2;
        $this-> nombre3 = $nombre3;
        $this-> nombre4 = $nombre4;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen('cartones.dat','rb');
        
        
    }
    public function getCarton(){
        $linea = fgets($this-> fichero);
        $carton = [];
        $carton = explode( ".", $linea );
        $this-> totalcartones[] = $carton;
        echo "<table border=1px> <tr>";
        $cont = 0;
        var_dump($carton);
        foreach( $carton as $clave => $valor ){
            if($valor == "_"){
                echo "<td>"." "."</td>";
            }
            else{
                echo "<td>".$valor."</td>";
            }
            if($cont==8 || $cont==17){
                echo "</tr><tr>";
            }
            $cont++;
        }
        echo "</tr></table>";
    }

    public function verifica($bola){
        $numeroGetBola = 22;
        foreach ($this->totalcartones as $key => $value) {
        
            foreach ($this->totalcartones[$key] as $key => $value) {
                
                if($value == $bola){
                    echo " este carton contiene este nuemro";
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
        
        //echo"<div><button id='1'>Nuevo numero</button> </div>";
        

        
    }
    public function setCarton(){

    }
    public function getLineaBingo(){

    }
    public function getJugadores(){
       
    }

}