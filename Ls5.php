<?php
interface INotification
{
    public function getNotice(): string;
}

class NullNotice implements INotification
{
    public function getNotice(): string
    {
        return "Without notification";
    }
}
class Sms implements INotification
{
    public function getNotice(): string
    {
        return "SMS";
    }
}
class Email implements INotification
{
    public function getNotice(): string
    {
        return "Email";
    }
}
class CN implements INotification
{
    public function getNotice(): string
    {
        return "Chrome Notification";
    }
}

class Decorator implements INotification
{
    private $firstNotification;
    private $secondNotification;
    public function __construct(INotification $firstNotification, INotification $secondNotification)
    {
        $this->firstNotification = $firstNotification;
        $this->secondNotification = $secondNotification;
    }
    public function getNotice(): string
    {
        return $this->firstNotification->getNotice() . " + " . $this->secondNotification->getNotice();
    }
}

$nullNot = new NullNotice;
$sms = new Sms;
$email = new Email;
$CN = new CN;
$smsAndEmail = new Decorator(new Sms, new Email);
$smsAndCN = new Decorator(new Sms, new CN);
$emailAndCN = new Decorator(new Email, new CN);
$smsEmailCN = new Decorator(new Sms, new Decorator(new Email, new CN));




class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
    {
        $area = (M_PI * $diagonal ** 2) / 4;

        return $area;
    }
}

class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
    {
        $area = ($diagonal ** 2) / 2;

        return $area;
    }
}

interface ICircle
{
    function circleArea(int $circumference);
}

class Circle implements ICircle
{
    private $circleAreaLib;

    public function __construct(CircleAreaLib $circleAreaLib)
    {
        $this->circleAreaLib = $circleAreaLib;
    }
    public function circleArea(int $circumference): float
    {
        $diameter = $circumference / M_PI;
        return $this->circleAreaLib->getCircleArea($diameter);
    }
}

interface ISquare
{
    function squareArea(int $sideSquare);
}

class Square implements ISquare
{
    private $squareAreaLib;

    public function __construct(SquareAreaLib $squareAreaLib)
    {
        $this->squareAreaLib = $squareAreaLib;
    }
    public function squareArea(int $sideSquare): float
    {
        $diagonal = sqrt(($sideSquare ** 2) + ($sideSquare ** 2));
        return $this->squareAreaLib->getSquareArea($diagonal);
    }
}
$sideOfSquare = 5;
$circumference = 30;
$square = new Square(new SquareAreaLib);
$circle = new Circle(new CircleAreaLib);
?>
<h2>Результаты работы декоратора с подпиской</h2>
<p><?= $nullNot->getNotice() ?></p>
<p><?= $sms->getNotice() ?></p>
<p><?= $email->getNotice() ?></p>
<p><?= $CN->getNotice() ?></p>
<p><?= $smsAndEmail->getNotice() ?></p>
<p><?= $smsAndCN->getNotice() ?></p>
<p><?= $emailAndCN->getNotice() ?></p>
<p><?= $smsEmailCN->getNotice() ?></p>
<hr>
<h2>Площадь квадрата</h2>
<p>Известно, что сторона квадрата равна <?= $sideOfSquare ?> см.</p>
<p>S= <?= round($square->squareArea($sideOfSquare), 0) ?> см2.</p>
<h2>Площадь круга</h2>
<p>Известно, что длина окружности равна <?= $circumference ?> см.</p>
<p>S= <?= round($circle->circleArea($circumference), 0) ?> см2.</p>