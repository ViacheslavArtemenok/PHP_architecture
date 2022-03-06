<?php
interface IBuildAuto
{
    public function getAuto(): string;
}

class BaseAuto implements IBuildAuto
{
    public function __construct($marka, $model, $complectation)
    {
        $this->marka = $marka;
        $this->model = $model;
        $this->complectation = $complectation;
    }
    public function getAuto(): string
    {
        return "Ваш автомобиль: " . $this->marka . " " . $this->model . ", Комплектация: " . $this->complectation . ".";
    }
}

class PackageDecorator implements IBuildAuto
{
    public function __construct(IBuildAuto $car, $package)
    {
        $this->car = $car;
        $this->package = $package;
    }
    public function getAuto(): string
    {
        return "Ваш автомобиль: " .
            $this->car->marka . " " .
            $this->car->model . ", Комплектация: " .
            $this->car->complectation . ", доп. пакет: " .
            $this->package . ".";
    }
}

class GiftDecorator implements IBuildAuto
{
    public function __construct(IBuildAuto $carWithPackage, $gift)
    {
        $this->carWithPackage = $carWithPackage;
        $this->gift = $gift;
    }
    public function getAuto(): string
    {
        return "Ваш автомобиль: " .
            $this->carWithPackage->car->marka . " " .
            $this->carWithPackage->car->model . ", Комплектация: " .
            $this->carWithPackage->car->complectation . ", доп. пакет: " .
            $this->carWithPackage->package . ". " .
            $this->gift . " в подарок!!!";
    }
}
//params
$marka = "Audi";
$model = "Q5";
$complectation = "Business";
$package = "Off-Road";
$gift = "Зимняя резина и коврики";
$yourCar1 = new BaseAuto($marka, $model, $complectation);
$yourCar2 = new PackageDecorator(
    new BaseAuto($marka, $model, $complectation),
    $package
);
$yourCar3 = new GiftDecorator(
    new PackageDecorator(
        new BaseAuto($marka, $model, $complectation),
        $package
    ),
    $gift
);



?>
<h2>Результаты работы декоратора с автомобилем</h2>
<p><?= $yourCar1->getAuto() ?></p>
<p><?= $yourCar2->getAuto() ?></p>
<p><?= $yourCar3->getAuto() ?></p>