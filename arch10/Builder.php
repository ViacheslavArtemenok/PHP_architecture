<?php
include 'Term.php';
class Builder
{
    // предварительные операции с входной строкой
    public function parse($str)
    {

        // подготовка входного выражения к парсингу
        $str = mb_strtolower($str, 'UTF-8');
        $str = str_replace(" ", "", $str);
        $n = mb_strlen($str, 'UTF-8');
        $arStr = preg_split('/(?!^)(?=.)/u', $str);

        echo '<pre>';
        echo print_r($arStr);
        echo '</pre>';

        // преобразуем массив символов в массив лексем
        $j = 0;
        $accum = $arStr[0];
        $arLec = [];
        for ($i = 1; $i < $n + 1; ++$i) {

            if ($i == $n + 1) {
                $arLec[$j] = $accum;
                break;
            }

            if ($accum == "-" && $i == 1) {
                if (preg_match("/\d/", $arStr[$i])) {
                    $accum = $accum . $arStr[$i];
                }
                if ($arStr[$i] == "(") {
                    $arLec[$j] = "0";
                    $arLec[++$j] = "-";
                    ++$j;
                    $accum = $arStr[$i];
                }
                continue;
            }

            if ($accum == "-" && $arLec[$j - 1] == "(") {
                $accum = $accum . $arStr[$i];
                continue;
            }

            if (preg_match("/^[\d.]/", $accum) && preg_match("/^[\d.]/", $arStr[$i])) {
                $accum = $accum . $arStr[$i];
            } else {
                $arLec[$j] = $accum;
                ++$j;
                $accum = $arStr[$i];
            }
        }
        /*
         $j = 0;                    
         if($arStr[0]=="-"){
             $accum = $arStr[0];
         }else{
             $accum = $arStr[0];
         }
         
         for ($i=1; $i<$n+1; ++$i){                    
             if ($i==$n+1){
                 $arLec[$j] = $accum;
                 continue;
             }
             if (preg_match("/^[\d.]/", $accum)&&preg_match("/^[\d.]/", $arStr[$i])){
                 $accum = $accum.$arStr[$i];
             }else{
                 $arLec[$j] = $accum;
                 ++$j;
                 $accum = $arStr[$i];
             } 
         }
          * 
          */

        echo '<pre>';
        echo print_r($arLec);
        echo '</pre>';

        return $arLec;
    }

    // построение одного объекта
    public function objBuilder($point)
    {

        $arNumNode = [
            "addition" => 1,
            "subtraction" => 1,
            "exponentiation" => 1,
            "multiplication" => 1,
            "division" => 1,
            "number" => 1,
            "constant" => 1
        ];

        switch ($point) {

            case "+":
                $name = "Plus" . $arNumNode["addition"];
                $node = new Plus($name);
                ++$arNumNode["addition"];
                break;

            case "-":
                $name = "Minus" . $arNumNode["subtraction"];
                $node = new Minus($name);
                ++$arNumNode["subtraction"];
                break;

            case "*":
                $name = "Multiply" . $arNumNode["multiplication"];
                $node = new Multiply($name);
                ++$arNumNode["multiplication"];
                break;

            case "/":
                $name = "Fission" . $arNumNode["division"];
                $node = new Fission($name);
                ++$arNumNode["division"];
                break;

            case "^":
                $name = "Exponent" . $arNumNode["exponentiation"];
                $node = new Exponent($name);
                ++$arNumNode["exponentiation"];
                break;

            case "x":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "x";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            case "y":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "y";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            case "z":
                $name = "Constant" . $arNumNode["constant"];
                $node = new Constant($name);
                $node->const = "z";
                $node->var = 0;
                ++$arNumNode["constant"];
                break;

            default:
                $name = "Variable" . $arNumNode["number"];
                $node = new Variable($name);
                $node->var = $point;
                ++$arNumNode["number"];
        }
        return $node;
    }

    // строительство тройки объектов дерева
    public function trioBuilder($topLec, $leftLec, $rightLec, $topP, $leftP, $rightP, $topObj)
    {

        // вершина тройки
        if (!$topObj) {
            $topTrio = $this->objBuilder($topP);
            $topTrio->lec = $topLec;
        } else {
            $topTrio = $topObj;
        }

        // левая ветвь тройки
        $leftTrio = $this->objBuilder($leftP);
        $leftTrio->lec = $leftLec;

        // правая ветвь тройки
        $rightTrio = $this->objBuilder($rightP);
        $rightTrio->lec = $rightLec;

        // формирование тройки из объектов
        $topTrio->childrenLeft = $leftTrio;
        $topTrio->childrenRight = $rightTrio;
        $leftTrio->parent = $topTrio;
        $rightTrio->parent = $topTrio;
        if (!$topObj) {
            $trio = [$topTrio, $leftTrio, $rightTrio];
            return $trio;
        } else {
            $duo = [$leftTrio, $rightTrio];
            return $duo;
        }
    }

    // проверка на полное построение дерева
    public function stopBuild($arNode)
    {
        foreach ($arNode as $obj) {
            if ($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight) {
                return FALSE;
            }
        }
        return TRUE;
    }

    // поиск вершины для следующей тройки
    public function searchObj($arNode)
    {
        foreach ($arNode as $obj) {
            if ($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight) {
                return $obj;
            }
        }
    }

    // определение точки перегиба выражения
    public function inflPoint($lec)
    {
        $infl = 0;
        $max = 0;
        $br = 0;
        $arPrioritet = [
            "+" => 3,
            "-" => 3,
            "*" => 2,
            "/" => 2,
            "^" => 1
        ];

        foreach ($lec as $key => $value) {
            if (preg_match("/^[\d.]/", $value)) {
                continue;
            }
            if ($value == "(") {
                ++$br;
                continue;
            }
            if ($value == ")") {
                --$br;
                continue;
            }
            if ($arPrioritet[$value] - 3 * $br >= $max) {
                $max = $arPrioritet[$value] - 3 * $br;
                $infl = $key;
            }
        }
        return $infl;
    }
}
