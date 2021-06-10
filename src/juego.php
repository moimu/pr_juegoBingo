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
<!-- <img class = "imagen" src="./bingo.png"> -->
<button class ='Nuevo' onclick="location.href='./index.html'">Nueva partida</button>
<?php
    // include_once('../vendor/autoload.php');
    // include_once('./clases/Carta.php');
    use Moi\Bingo\Bingo;
    $nombre1=$_POST['nombre1'];
    $nombre2=$_POST['nombre2'];
    $nombre3=$_POST['nombre3'];
    $nombre4=$_POST['nombre4'];
    $ncartones=$_POST['ncartones'];
    include('Bingo/Bingo.php');

    
    $nuevaPartida = new Bingo($nombre1, $nombre2, $nombre3, $nombre4);
    
    $nuevaPartida -> getCartones($ncartones);
    
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