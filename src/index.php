<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="9999">

<?php
    include('Bingo/Bingo.php');

    $nuevaPartida = new Bingo('manu', 'samuel', 'albert', 'moi');
    $nuevaPartida -> getCarton(4);
    
    // echo "<div> <button classid='1'> Nuevo numero </button> </div>";

    // cancela el límite de tiempo de ejecución de php
    set_time_limit(0);
    // for($i=0; $i<90; $i++){
        // Genera nueva bola y verifica linea cada 2 segundos
        $nuevaPartida -> getJuego();
        // flush();
        // ob_flush();
        // sleep(2);
    // }
   

    echo " <script src=js/bingo.js language=javascript type=text/javascript></script>";

    echo " <script src=js/bingo.js language=javascript type=text/javascript></script>";
    if(file_exists('totalcartones.txt')){
        $fich = fopen('totalcartones.txt','rb');
        $string = "";
        while($linea = fgets($fich)){
            $string .= $linea;
        }
        $totalcartonesregenerado = unserialize( $string );
        // var_dump($totalcartonesregenerado);
    }
    $nuevaPartida -> getCarton(4);
?>

</body>
</html>
