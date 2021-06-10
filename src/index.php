<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BINGO </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<img class = "imagen" src="./bingo.png">
<?php
    include('Bingo/Bingo.php');

    $nuevaPartida = new Bingo('Manu', 'Samuel', 'Albert', 'Moi');

    $nuevaPartida -> getCartones(1);
    
     $nuevaPartida -> initJuego();
     
    // $bola = $nuevaPartida -> getBola();
    // $nuevaPartida -> verifica($bola);

    // $bola = $nuevaPartida -> getBola();
    // $nuevaPartida -> verifica($bola);

    // $bola = $nuevaPartida -> getBola();
    // $nuevaPartida -> verifica($bola);
 
    echo " <script src=js/bingo.js language=javascript type=text/javascript></script>";

?>

</body>
</html>