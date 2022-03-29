<?php
class SomeIterator
{
    private $directory;
    private $iterator;
    public function __construct($path)
    {
        $this->path = $path;
    }
    public function getFiles()
    {
        $this->directory = new RecursiveDirectoryIterator($this->path);
        $this->iterator = new RecursiveIteratorIterator($this->directory);
        foreach ($this->iterator as $info) {
            echo $info->getPathname();
?>
            <br>
<?php
        }
    }
}
$path = 'C:\openserver\domains\arch8\test';
$someIterator = new SomeIterator($path);
$someIterator->getFiles();
/*
C:\openserver\domains\arch8\test\.
C:\openserver\domains\arch8\test\..
C:\openserver\domains\arch8\test\some1.txt
C:\openserver\domains\arch8\test\some2.txt
C:\openserver\domains\arch8\test\test1\.
C:\openserver\domains\arch8\test\test1\..
C:\openserver\domains\arch8\test\test1\some1_1.txt
C:\openserver\domains\arch8\test\test1\some1_2.txt
C:\openserver\domains\arch8\test\test1\test1_1\.
C:\openserver\domains\arch8\test\test1\test1_1\..
C:\openserver\domains\arch8\test\test1\test1_1\some3.txt
C:\openserver\domains\arch8\test\test1\test1_1\some4.txt
C:\openserver\domains\arch8\test\test1\test1_1\someAll\.
C:\openserver\domains\arch8\test\test1\test1_1\someAll\..
C:\openserver\domains\arch8\test\test1\test1_1\someAll\someAll3.txt
C:\openserver\domains\arch8\test\test1\test1_1\someAll\someAll4.txt
*/
/*

2. Определить сложность следующих алгоритмов:

* поиск элемента массива с известным индексом - O(N), 
т.к. для каждого элемента выполняется одна операция сравнения индекса элемента с заданным индексом

* дублирование массива через foreach - O(N), 
т.к. здесь каждый элемент один раз добавляется в новый массив

3.
*/
$n = 100;
$array[] = [];
for ($i = 0; $i < $n; $i++) {
    for ($j = 1; $j < $n; $j *= 2) {
        $array[$i][$j] = true;
    }
}
/*
O(2 + f(N) x g(N)) - где f(N) = 100, а g(N) = 7
Ответ: 702 итерации
*/
$n = 100;
$array[] = [];

for ($i = 0; $i < $n; $i += 2) {
    for ($j = $i; $j < $n; $j++) {
        $array[$i][$j] = true;
    }
}
/*
O(f(N)/2 x g((N) - (i+2)))
Ответ: 2552 итерации
*/