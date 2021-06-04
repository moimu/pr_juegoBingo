<?php
/**
 * getCarton() obtener carton
 * getBola() obtener bola bingo
 * setCarton() colocar carton
 * getLineaBingo() devuelve linea ganadora
 * getJugadores() devuelve numero de jugadores
 */
Interface BingoableInterface{
    
    public function getCarton($cartonesporjugador);
    public function getBola();
    public function getLineaBingo(array $linea1,array $linea2, array $linea3);
    public function getJugadores();
    
}