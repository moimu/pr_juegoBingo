<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    private int $numJugadores;
    private string $nombre1;
    private string $nombre2;
    private string $nombre3;
    private string $nombre4;
    private array $numeros;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        $this-> nombre1 = $nombre1;
        $this-> nombre2 = $nombre2;
        $this-> nombre3 = $nombre3;
        $this-> nombre4 = $nombre4;
        $this-> rand = range (1, 90);
        /*$rand = range (1, 90);
        $this -> numeros = shuffle($rand);
        foreach ($rand as $key => $value) {
            echo $key ."</br>".$value;      }*/
        
    }
    public function getCarton(){
        $fichero = fopen('cartones.dat', 'rb');
        $linea = fgets($fichero);
        $carton[] = explode( ".", $linea );
        
        foreach($carton as $clave => $valor){
            echo "<li> $valor <li>";

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