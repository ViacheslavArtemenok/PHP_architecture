<?php
class Controller
{
    public function __construct($str, $x, $y, $z)
    {
        $this->str = $str;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
    // задаем исходное математическое выражение
    public function render(Main $parse)
    {
        // строительство дерева классов
        $parse->builder($this->str, new Builder);

        //echo '<pre>';
        //echo print_r($parse->arNode);
        //echo '</pre>';


        echo $this->str . " = " . $parse->calc($this->x, $this->y, $this->z);

        echo " при: x=" . $this->x . "; y=" . $this->y . "; z=" . $this->z;
    }
};
