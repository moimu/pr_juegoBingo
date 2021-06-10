<?php

declare(strict_types=1);

namespace Moi\Tests\Bingo;

use Moi\Bingo\Bingo;
use PHPUnit\Framework\TestCase;
// use DomainException;

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

    //  /**
    //  * @return void
    //  * @covers ::getPremio()
    //  */
    // public function testDevuelveVerdaderoSiRecibeArrayde4PosicionesYCantaLinea(){
    //     //given
    //     $nuevojuego = new Bingo('pepe','juan','pedro','moi');
    //     $array =['*','*','*','*'];
    //     // when
    //     $resultado = $nuevojuego -> getPremio($array);
    //     // echo "$resultado";
    //     $esperado = "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  LÍNEA  ¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡";
    //     // echo "$esperado";
    //     // then
    //     $this->assertEquals(string $esperado, string $resultado);
    // }



}