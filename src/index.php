<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BINGO </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body onclick="myFunction()">

<?php
    include('Bingo/Bingo.php');

    $nuevaPartida = new Bingo('manu', 'samuel', 'albert', 'moi');

    $nuevaPartida -> getCartones(1);

    $nuevaPartida -> initJuego();
   
 
    echo " <script src=js/bingo.js language=javascript type=text/javascript></script>";

?>

</body>
</html>