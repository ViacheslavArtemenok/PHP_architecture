<?php

class Main
{
    // массив объектов дерева
    private $arNode = [];
    // расчет значения с учетом параметров
    public function calc(int $x, int $y, int $z)
    {

        if ($x) {
            foreach ($this->arNode as $obj) {
                if ($obj->const == "x") {
                    $obj->var = $x;
                    break;
                }
            }
        }

        if ($y) {
            foreach ($this->arNode as $obj) {
                if ($obj->const == "y") {
                    $obj->var = $y;
                    break;
                }
            }
        }

        if ($z) {
            foreach ($this->arNode as $obj) {
                if ($obj->const == "z") {
                    $obj->var = $z;
                    break;
                }
            }
        }

        foreach ($this->arNode as $obj) {
            if (!$obj->parent) {
                return $obj->calc();
            }
        }
    }


    // реализация строительства дерева классов
    public function builder(string $str, Builder $builder)
    {
        $arLec = $builder->parse($str);
        // первая тройка дерева
        $topN = $builder->inflPoint($arLec);
        $topP = $arLec[$topN];
        $leftLec = array_slice($arLec, 0, $topN);
        if ($leftLec[0] == "(" && $leftLec[count($leftLec) - 1] == ")") {
            array_shift($leftLec);
            array_pop($leftLec);
        }
        $rightLec = array_slice($arLec, $topN + 1);
        if ($rightLec[0] == "(" && $rightLec[count($rightLec) - 1] == ")") {
            array_shift($rightLec);
            array_pop($rightLec);
        }
        $leftN = $builder->inflPoint($leftLec);
        $leftP = $leftLec[$leftN];
        $rightN = $builder->inflPoint($rightLec);
        $rightP = $rightLec[$rightN];
        $trio = $builder->trioBuilder($arLec, $leftLec, $rightLec, $topP, $leftP, $rightP, NULL);
        $this->arNode = $trio;

        // все последующие тройки дерева
        while (!$builder->stopBuild($this->arNode)) {
            $topTrio = $builder->searchObj($this->arNode);
            $arLec = $topTrio->lec;
            $topN = $builder->inflPoint($arLec);
            $leftLec = array_slice($arLec, 0, $topN);
            if ($leftLec[0] == "(" && $leftLec[count($leftLec) - 1] == ")") {
                array_shift($leftLec);
                array_pop($leftLec);
            }
            $rightLec = array_slice($arLec, $topN + 1);
            if ($rightLec[0] == "(" && $rightLec[count($rightLec) - 1] == ")") {
                array_shift($rightLec);
                array_pop($rightLec);
            }
            $leftN = $builder->inflPoint($leftLec);
            $leftP = $leftLec[$leftN];
            $rightN = $builder->inflPoint($rightLec);
            $rightP = $rightLec[$rightN];
            $duo = $builder->trioBuilder(NULL, $leftLec, $rightLec, NULL, $leftP, $rightP, $topTrio);
            $this->arNode = array_merge($this->arNode, $duo);
        }
    }
}
