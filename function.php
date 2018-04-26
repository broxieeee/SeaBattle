<?php
    $widthSea = 12;
    $heightSea = 12;

    $arr = array(array(),array(),array(),array(),array(),array(),array(),array(),array(),array());

    for( $i = 0; $i < $heightSea; $i++){

        for($j = 0; $j < $widthSea; $j++){

            $arr[$i][$j] = 0;

        }
    }

    //проверка клеток вокруг коробля
        function chSea($kx, $ky, $x, $y, $sea, $fDeck)
    {

        if($x >= 1 && $x <= 11 && $y >= 1 && $y <= 11 ){

            if($sea[$x][$y] == 1) {
                return false;
            }

        if($kx){//вертикаль
            for($i = $x - 1; $i < $x + $fDeck + 1; $i++){ //вертикальная левая линия
                if($sea[$i][$y - 1] != 0){
                    return false;
                }
            }
            for($i = $x - 1; $i < $x + $fDeck + 1; $i++){ //вертикальная правая линия
                if($sea[$i][$y + 1] != 0){
                    return false;
                }
            }
            for($i = $y - 1; $i < $y + 2; $i++){ //горизонтальная верхняя линия
                if($sea[$x - 1][$i] != 0){
                    return false;
                }
            }
            for($i = $y - 1; $i < $y + 2; $i++){ //горизонтальная нижняя линия
                if($sea[$x + $fDeck][$i] != 0){
                    return false;
                }
            }

        }else{ // горизонталь
            for($i = $y - 1; $i < $y + $fDeck  + 1; $i++){ //верхняя линия
                if($sea[$x - 1][$i] != 0){
                    return false;
                }
            }
            for($i = $y - 1; $i < $y + $fDeck + 1; $i++){ //нижняя линия
                if($sea[$x + 1][$i] != 0){
                    return false;
                }
            }
            for($i = $x - 1; $i < $x + 2; $i++){ //левая линия
                if($sea[$i][$y - 1] != 0){
                    return false;
                }
            }
            for($i = $x - 1; $i < $x + 2; $i++){ //правая линия
                if($sea[$i][$y + $fDeck] != 0){
                    return false;
                }
            }
            }
            return true;
        }else{
            return false;
        }
    }

function fourDeck($sea, $sDeck)
    {
        $fDeck = $sDeck;
        $x = 0;
        $y = 0;

        $kx = rand(0, 1); // Направление корабля kx 1 , ky 0 - вертикально, kx 0 , ky 1 - горизонтально
        $ky = ($kx == 0) ?  1 : 0;

        //генерируем начальные координаты
        if($kx){

            $x = rand(1, 10);
            $y =  rand(1, (11 - $fDeck));

        }else{

            $x = rand(1, (11 - $fDeck));
            $y = rand(1, 10);

        }

        if($kx){

            if(chSea($kx, $ky, $x, $y, $sea, $fDeck)){

                for($i = $y; $i < $y + $fDeck; $i++){

                    $sea[$x][$i] = 1;

                }
            }else{

                return fourDeck($sea,$fDeck);

            }
        }else{

            if (chSea($kx, $ky, $x, $y, $sea, $fDeck)){

                for($i = $x; $i < $x + $fDeck; $i++){

                    $sea[$i][$y] = 1;

                }
            }else{
                return fourDeck($sea, $fDeck);
            }
        };

        return $sea;
    }

$arr = fourDeck($arr,4);
$arr = fourDeck($arr,3);
$arr = fourDeck($arr,3);
$arr = fourDeck($arr,2);
$arr = fourDeck($arr,2);
$arr = fourDeck($arr,2);
$arr = fourDeck($arr,1);
$arr = fourDeck($arr,1);
$arr = fourDeck($arr,1);
$arr = fourDeck($arr,1);

    echo "<table>";

    for ($i = 1; $i < 11; $i++){

        echo "<tr>";

        for ($j = 1; $j < 11; $j++){

            if($arr[$i][$j] == 1){

                echo "<td style='background-color: dodgerblue'></td>";

            }else{

                echo "<td></td>";
                }
        }
        echo "</tr>";
    }
    echo "</table>";