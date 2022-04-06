<?php

include 'QuickSort.php';
include '08QuickSort.php';
include '06Bubble.php';
include 'randArray.php';
include 'Heapsort.php';
include 'insertSort.php';
include 'PigeonholeSort.php';
include 'MergeSort.php';
include 'InsertSortSPL.php';
include 'HeapSplSort.php';
include 'DualSelectSort.php';
include 'CombSort.php';

function getArr(): array
{
	return _randArray(100000);
}

$arr = getArr();
$lastIndex = count($arr) - 1;

//print_r($arr);

$start = microtime(true);
bubbleSort($arr);
echo "Сортировка пузырьком: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
insertion_sort($arr);
echo "Сортировка вставками: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
combSort($arr);
echo "Сортировка расческой: " . (microtime(true) - $start) . PHP_EOL;

//$start = microtime(true);
//insertion_sort($arr);
//echo "Сортировка вставками сорт. массива: ".( microtime(true) - $start).PHP_EOL;


$arr = getArr();
$start = microtime(true);
mergeSort($arr);
echo "Сортировка слиянием: " . (microtime(true) - $start) . PHP_EOL;


$arr = getArr();
$start = microtime(true);
heapSort($arr);
echo "Сортировка пирамидальная: " . (microtime(true) - $start) . PHP_EOL;


$arr = getArr();
$start = microtime(true);
treeSort($arr);
echo "Сортировка пирамидальная SPL: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
quickSortLesson($arr);
echo "Сортировка быстрая наша: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
quickSort($arr, 0, $lastIndex);
echo "Сортировка быстрая чужая: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
sort($arr);
echo "Сортировка из PHP: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
dualSelectSort($arr);
echo "Сортировка выбором: " . (microtime(true) - $start) . PHP_EOL;

$arr = getArr();
$start = microtime(true);
pigeonholeSort($arr);
echo "Сортировка голубиная: " . (microtime(true) - $start) . PHP_EOL;


/*
(100)
Сортировка пузырьком: 0.00019097328186035
Сортировка вставками: 0.00034093856811523
Сортировка расческой: 9.2029571533203E-5
Сортировка слиянием: 7.1048736572266E-5
Сортировка пирамидальная: 0.00010108947753906
Сортировка пирамидальная SPL: 4.2915344238281E-5
Сортировка быстрая наша: 6.1988830566406E-5
Сортировка быстрая чужая: 3.814697265625E-5
Сортировка из PHP: 1.1205673217773E-5
Сортировка выбором: 0.00010585784912109
Сортировка голубиная: 4.9114227294922E-5

(1000)
Сортировка пузырьком: 0.020401954650879
Сортировка вставками: 0.041918039321899
Сортировка расческой: 0.0014660358428955
Сортировка слиянием: 0.00092101097106934
Сортировка пирамидальная: 0.0018699169158936
Сортировка пирамидальная SPL: 0.00057291984558105
Сортировка быстрая наша: 0.00068092346191406
Сортировка быстрая чужая: 0.00045514106750488
Сортировка из PHP: 0.00010800361633301
Сортировка выбором: 0.0099999904632568
Сортировка голубиная: 0.00022387504577637

(10000)
Сортировка пузырьком: 2.3783910274506
Сортировка вставками: 6.1319940090179
Сортировка расческой: 0.018193006515503
Сортировка слиянием: 0.027960062026978
Сортировка пирамидальная: 0.019815921783447
Сортировка пирамидальная SPL: 0.0038940906524658
Сортировка быстрая наша: 0.0093419551849365
Сортировка быстрая чужая: 0.0058870315551758
Сортировка из PHP: 0.0012459754943848
Сортировка выбором: 0.9466290473938
Сортировка голубиная: 0.0010471343994141

(100000)
Сортировка пузырьком: 235.67759919167
Сортировка вставками: 436.97323298454
Сортировка расческой: 0.34187984466553
Сортировка слиянием: 3.3280289173126
Сортировка пирамидальная: 0.29662394523621
Сортировка пирамидальная SPL: 0.045161008834839
Сортировка быстрая наша: 0.15588593482971
Сортировка быстрая чужая: 0.091705083847046
Сортировка из PHP: 0.027698993682861
Сортировка выбором: 111.80049300194
Сортировка голубиная: 0.041779041290283

*/