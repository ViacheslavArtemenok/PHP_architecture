<?php

function linearSearch($myArray, $num)
{

    $arrCount = count($myArray);
    $indeces = [];
    for ($i = 0; $i < $arrCount; $i++) {

        //echo "Проверяется число с индексом: $i".PHP_EOL;

        if ($myArray[$i] == $num) {
            echo "ЧИСЛО НАЙДЕНО! Индекс $i" . PHP_EOL;
            $indeces[] = $i;
            $myArray[$i] = null;
        }
    }
    if (count($indeces) === 0) {
        echo "ЧИСЛО НЕ НАЙДЕНО! Количество итераций: $arrCount" . PHP_EOL;
        return null;
    } else {
        return "Найдено число $num под индексом " . join(", ", $indeces);
    }
}
