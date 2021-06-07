<?php
/**
 * getCarton() obtener carton
 * getBola() obtener bola bingo
 */
Interface BingoableInterface{
    
    public function getCartones($ncartonesporjugador);
    public function getBola();
    public function verifica($bola);
    public function getPremio(array $linea);
    
}