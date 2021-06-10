<?php

declare(strict_types=1);
// include('interfazBingo.php');
// implements BingoableInterface

namespace Moi\Bingo;
// use DomainException;

class Bingo {
    
    private array $jugadores;
    private array $totalcartones;
    private array $verificartotalcartones;
    private array $rand;
    private int $lineaCantada;
    private int $lineaCompleta;
    private int $linealeida;
    private int $bingoCantado;

    public function __construct(string $nombre1, string $nombre2, string $nombre3, string $nombre4){
        
        $this->jugadores = [$nombre1, $nombre2, $nombre3, $nombre4];
        $this-> lineaCompleta = 0;
        $this-> lineaCantada = 0;
        $this-> bingoCantado = 0;
        $this-> linealeida = 0;
        $this-> rand = range (1, 90);
        $this -> fichero = fopen(__DIR__.'\..\cartones.dat','rb');
    }
    /**
     * Inicia el juego sacando bolas, verificando que existen en cartones,
     * y dando linea y bingo. finaliza al salir bingo
     */
    public function initJuego(){
        // cancela el límite de tiempo de ejecución de php
        set_time_limit(0);
        echo "<div class = 'juego' id = 'juego'>";
        while($this->bingoCantado !=1){
            $bola = $this -> getBola();
            $this -> verifica($bola);
            flush();
            ob_flush();
            sleep(1);
        }
        echo "</div>";
    }
    /**
     * Generará tantos cartones para cada jugador como pasemos por parámetro max 3
     * cada cartón tendrá id cada celda tendrá id siendo = " id_carton / id_celda [1-27] "
     * - Cada carton generado irá dentro de totalcartones[]
     * - copiamos totalcartones en verificartotalcartones es copia exacta de totalcartones
     *   eso se realiza para para poder editarlo y verificar premios.
     */
    public function getCartones($ncartonesporjug){
        $vueltas  = $ncartonesporjug*4;
        $clavejugador = $cont = 0;
        while( $vueltas  != 0){
            $carton = [];
            if( $ncartonesporjug==1 || $ncartonesporjug==2&&$cont%2==0 || $ncartonesporjug==3&&$cont%3==0){
                echo " <section class=sectioncartones1> Propiedad de {$this->jugadores[$clavejugador]} "; 
                $clavejugador++; 
            }
            for($i=0; $i<3; $i++){
                $linea = fgets($this-> fichero);
                $carton []= explode( ".", $linea );                
            }
            $this-> totalcartones[] = $carton;
            echo "<div class=carton>";
            foreach ($carton as $key => $value ) { 
                echo "<div class=cartonfila>";
                foreach  ($carton[$key] as $clave => $valor) {
                    echo "<div class=cartonfilacelda>".$valor."</div>";
                } 
                echo "</div>";
            }                    
            echo "</div>";
            $cont++;
            if( $ncartonesporjug==1 || $ncartonesporjug==2&&$cont%2 ==0 || $ncartonesporjug==3&&$cont%3 ==0 ){
                echo "</section>";
            }
            $vueltas--;
        }
        $this-> verificartotalcartones = [];
        $this-> verificartotalcartones = $this-> totalcartones;  
    }
    /**
     * Saca bola siendo esta un numero al azar contenido en el array rand
     * y borra este numero para so ser repetido
     */
    public function getBola(){
        // $bola será el VALOR contenido en array NO el indice
        if($this->bingoCantado == 0){
            
            $claveazar = array_rand($this-> rand);
            $bola = $this-> rand[$claveazar];
            unset($this -> rand [$claveazar]);
            // var_dump($this-> rand);
            $this->bolaactual = $bola;
            return $bola;
        }
        
    }

    /**
     * Para $key = n su valor será un array con 3 indices 0 1 2, 
     * cada uno de estos contendrá un array con todos los numeros de una linea,
     * el carton lo conformarán estas 3 líneas.
     */
    public function verifica($bola){

        $ncartonesporjug = count($this->totalcartones)/4;
        $clavejugador = $cont = 0;
        foreach ($this->verificartotalcartones as $key => $value) {
            foreach ($this->verificartotalcartones[$key] as $clave => $valor) {
                // var_dump($this->totalcartones[$key]);  echo"<br><br><br><br>";                
                foreach ($this->verificartotalcartones[$key][$clave] as $indi => $caracter) {
                    // var_dump($this->totalcartones[$key][$clave]);  echo"<br><br><br><br>";
                    if($caracter == $bola){
                        // echo "match en carton: $key , Linea: $clave , clave: $indi , idcelda: $celda<br> <hr>";
                        $ndecarton = $key;
                        $ndecarton +=1;
                        $ndelinea = $clave;
                        $ndelinea +=1;
                        
                        echo "Carton : ".$ndecarton." Linea: ".$ndelinea;
                        echo " Numero: $caracter - ¡Match! </br>";
                        
                        unset($this->verificartotalcartones[$key][$clave][$indi]);
                        $this->totalcartones[$key][$clave][$indi] = "X";
                    }
                }
            echo $this->getPremio($this->verificartotalcartones[$key][$clave]);
            }
            echo " <span class='bola1'>$bola</span></br></br> ";
        }
        // -----------------  IMPRIMO CARTONES MATCHEADOS  -------------------
        foreach($this->totalcartones as $key => $value){
            if( $ncartonesporjug==1 || $ncartonesporjug==2&&$cont%2==0 || $ncartonesporjug==3&&$cont%3==0){
                echo " <section class='sectioncartones'> Propiedad de {$this->jugadores[$clavejugador]} "; 
                $clavejugador++; 
            }
            echo "<div class=carton>";
            foreach ($this->totalcartones[$key] as $clave => $valor ) {                    
                echo "<div class=cartonfila>";
                foreach  ($this->totalcartones[$key][$clave] as $in => $numero) {
                    if($numero == "X"){
                        echo "<div class=\"cartonfilacelda celdacolor\">".$numero."</div>";
                    }
                    else{
                        echo "<div class=cartonfilacelda>".$numero."</div>";
                    }
                }
                echo "</div>";
            }
            echo "</div>";
            $cont++;
            if( $ncartonesporjug==1 || $ncartonesporjug==2&&$cont%2 ==0 || $ncartonesporjug==3&&$cont%3 ==0 ){
                echo "</section>";
            }
        }
    } 
    
    /**
     * método para ser incluido en método verifica()
     * comprueba si hay linea o si hay bingo
     */
    public function getPremio(array $linea){   

        if( $this->linealeida == 3 ){
            $this->linealeida = 0;
            $this->lineaCompleta = 0;
        }
        $this->linealeida++;
        $size= count($linea);
        if ($size == 4 ) {
            //  var_dump($linea);
            if($this->lineaCantada == 0){
                $this->lineaCantada = 1;
                $mensaje = "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  LÍNEA  ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡";
                return $mensaje;
            }
            $this->lineaCompleta =  $this->lineaCompleta +1;
            if($this->linealeida == 3 && $this->lineaCompleta == 3 &&  $this-> bingoCantado == 0){
                echo "Cartones Finales: </br>";
                $this-> bingoCantado = 1;
                return $mensaje = "!!!!!!!!!!!!!!!!!!!!!!!   BINGOOOO   ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡";
            }
        }

    }
}