<?php
spl_autoload_register(function ($class) {
    include $class . '.php';
});
const STR = "(x+42)^2+7*y-z";
const X = 2;
const Y = 6;
const Z = 3;

$c = new Controller(STR, X, Y, Z);
$c->render(new Main);
