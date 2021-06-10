<?php
/**
 * getCartones($ncartonesporjugador) 
 * obtener n cartones por jugador leidos desde fichero
 * getBola() 
 * obtenernumero en bola bingo, desde array con 90 numeros de formar aleatoria y no repetitiva
 * verifica($bola) 
 * recorre todos los cartones en juego y verifica si numero sacado en bola, existe en ellos (match)
 * getPremio(array $linea)
 * recibe un array que refleja en los numeros de una linea. 
 * si los numeros han salido en bola son borrados, 
 * devolverá LINEA si array parámetro solo tiene 4 posiciones
 * (correspondiendo a 4 casillas vacias por defecto en todos los cartones.)
 */
Interface BingoableInterface{
    
    public function getCartones($ncartonesporjugador);
    public function getBola();
    public function verifica($bola);
    public function getPremio(array $linea);
    
}