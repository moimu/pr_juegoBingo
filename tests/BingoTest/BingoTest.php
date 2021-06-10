<?php

declare(strict_types=1);

namespace Moi\Tests\Bingo;
use Moi\Bingo\Bingo;
use PHPUnit\Framework\TestCase;
use DomainException;

class BingoTests extends TestCase{

    /**
     * @return void
     * @covers ::getBola()
     */
    public function testDevuelveVerdaderoSiBolaEsNumeroEntero(){
        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        // when
        $resultado = $nuevojuego -> getBola();
        // then
        $this->assertIsInt($resultado);
    }

    /**
     * @return void
     * @covers ::getBola()
     */
    public function testDevuelveVerdaderoSiBolaEsMayorOIgualA1(){

        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        // when
        $resultado = $nuevojuego -> getBola();
        // then
        $this->assertGreaterThanOrEqual(1,$resultado);

    }

     /**
     * @return void
     * @covers ::getBola()
     */
    public function testDevuelveVerdaderoSiBolaEsMenorOIgualA90(){

        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        // when
        $resultado = $nuevojuego -> getBola();
        // then
        $this->assertLessThanOrEqual(90,$resultado);

    }

    /**
     * @return void
     * @covers ::getPremio()
     */
   
    public function testDevuelveVerdaderoSiRecibeArrayDe4PosicionesDevuelveStringLINEA(){

        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        $linea =['*','*','*','*'];
        // when
        $resultado = $nuevojuego -> getPremio($linea);
        $esperado = "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  LÍNEA  ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡";
        // then
        $this->assertEquals( $resultado, $esperado);

    }

    /**
     * @return void
     * @covers ::getPremio()
     */
   
    public function testDevuelveVerdaderoSiRecibe3ArraysDe4PosicionesDevuelveStringBINGO(){

        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        $linea1 = $linea2 = $linea3 =['*','*','*','*'];
        
        // when
        $nuevojuego -> getPremio($linea1);
        $nuevojuego -> getPremio($linea2);
        $resultado = $nuevojuego -> getPremio($linea3);

        $esperado = "!!!!!!!!!!!!!!!!!!!!!!!   BINGOOOO   ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡";
        // then
        $this->assertEquals( $resultado, $esperado);

    }

    /**
     * @return void
     * @covers ::getCartones()
     */
    public function testDevuelveDomainExceptionSiCartonesSon0PorJugador(){

        $this -> expectException(DomainException::class);
        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        
        // when then
        $nuevojuego -> getCartones(0);
    
    }

    /**
     * @return void
     * @covers ::getCartones()
     */
    public function testDevuelveDomainExceptionSiCartonesSon4PorJugador(){

        $this -> expectException(DomainException::class);
        //given
        $nuevojuego = new Bingo('pepe','juan','pedro','moi');
        
        // when then
        $nuevojuego -> getCartones(4);
    
    }

}