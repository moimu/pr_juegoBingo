<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include('Bingo/Bingo.php');
    
    $linea1= array(33,62,70);
    $linea2= array("_",16,"_");
    $linea3= array(7,"_",21,22,22,22);

    $nuevaPartida = new Bingo('manu', 'samuel', 'albert', 'moi');
    $nuevaPartida -> getCarton(1);
    
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    $nuevaPartida -> getBola();
    /*$nuevaPartida -> getCarton();
    $nuevaPartida -> getCarton();

    $nuevaPartida -> getBola();*/
    $nuevaPartida -> getLineaBingo($linea1,$linea2,$linea3);

?>

</body>
</html>
