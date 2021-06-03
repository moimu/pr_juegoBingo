<?php

include('interfazBingo.php');

class Bingo implements BingoableInterface{
    private int $numJugadores;
    private string $nombre1;
    private string $nombre2;
    private string $nombre3;
    private string $nombre4;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        $this-> nombre1 = $nombre1;
        $this-> nombre2 = $nombre2;
        $this-> nombre3 = $nombre3;
        $this-> nombre4 = $nombre4;
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

    }
    public function setCarton(){

    }
    public function getLineaBingo(){

    }
    public function getJugadores(){
        heloo;
    }

}