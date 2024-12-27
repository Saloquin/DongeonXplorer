<?php
function rollDice($numberOfDice)
{
    $sum = 0;
    for ($i = 0; $i < $numberOfDice; $i++) {
        $result = rand(1, 6);
        $sum += $result;
    }
    return $result;
}

