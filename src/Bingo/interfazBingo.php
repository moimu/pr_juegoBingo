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
    public function getLineaBingo();
    public function getJugadores();
    
}