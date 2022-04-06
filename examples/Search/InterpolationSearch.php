<?php

function interpolationSearch($myArray, $num)
{
    $start = 0;
    $end = count($myArray) - 1;
    $n = 0;
    $indeces = [];
    while (($start <= $end) && ($num >= $myArray[$start]) && ($num <= $myArray[$end])) {
        $n++;
        $base = floor(
            $start +
                ($end - $start) / ($myArray[$end] - $myArray[$start])
                * ($num - $myArray[$start])
        );

        //echo "Проверяется элемент с индексом: $base" . PHP_EOL;

        if ($myArray[$base] == $num) {
            echo "Количество итераций: $n искомого числа $num под индексом $base" . PHP_EOL;
            $myArray[$base] = null;
            $start = 0;
            $end = count($myArray) - 1;
            $indeces[] = $base;
        } elseif ($myArray[$base] < $num) {
            $start = $base + 1;
        } else {
            $end = $base - 1;
        }
    }
    if (count($indeces) === 0) {
        echo "ЧИСЛО НЕ НАЙДЕНО! Количество итераций: $n" . PHP_EOL;
        return null;
    } else {
        return "Найдено число $num под индексом " . join(", ", $indeces);
    }
}
