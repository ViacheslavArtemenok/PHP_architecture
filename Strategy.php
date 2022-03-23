<?php

namespace arch6\Strategy;

/**
 * Контекст определяет интерфейс, представляющий интерес для клиентов.
 */
class Context
{
    /**
     * @var Strategy Контекст хранит ссылку на один из объектов Стратегии.
     * Контекст не знает конкретного класса стратегии. Он должен работать со
     * всеми стратегиями через интерфейс Стратегии.
     */
    //private $strategy;

    /**
     * Обычно Контекст принимает стратегию через конструктор, а также
     * предоставляет сеттер для её изменения во время выполнения.
     */
    /*public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }*/

    /**
     * Обычно Контекст позволяет заменить объект Стратегии во время выполнения.
     */
    /* public function setStrategy(Strategy $strategy): void
    {
        $this->strategy = $strategy;
    }*/

    /**
     * Вместо того, чтобы самостоятельно реализовывать множественные версии
     * алгоритма, Контекст делегирует некоторую работу объекту Стратегии.
     */
    public function doSomeBusinessLogic(Strategy $strategy): void
    {
        echo "Выбран вариант оплаты через " . $strategy->getType() . "."; ?>
        <br>
        <?php
        echo $strategy->doAlgorithm(); ?>
        <br>
<?php
    }
}

/**
 * Интерфейс Стратегии объявляет операции, общие для всех поддерживаемых версий
 * некоторого алгоритма.
 *
 * Контекст использует этот интерфейс для вызова алгоритма, определённого
 * Конкретными Стратегиями.
 */
interface Strategy
{
    public function getType(): string;
    public function doAlgorithm(): string;
}

/**
 * Конкретные Стратегии реализуют алгоритм, следуя базовому интерфейсу
 * Стратегии. Этот интерфейс делает их взаимозаменяемыми в Контексте.
 */
class Payment_Qiwi implements Strategy
{
    private $type = 'Qiwi';
    public function __construct($sum, $phone)
    {
        $this->sum = $sum;
        $this->phone = $phone;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function doAlgorithm(): string
    {
        return "Платеж через {$this->type} по номеру телефона {$this->phone} на сумму {$this->sum} рублей прошел успешно";
    }
}

class Payment_Yandex implements Strategy
{
    private $type = 'Yandex';
    public function __construct($sum, $phone)
    {
        $this->sum = $sum;
        $this->phone = $phone;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function doAlgorithm(): string
    {
        return "Платеж через {$this->type} по номеру телефона {$this->phone} на сумму {$this->sum} рублей прошел успешно";
    }
}
class Payment_WebMoney implements Strategy
{
    private $type = 'WebMoney';
    public function __construct($sum, $phone)
    {
        $this->sum = $sum;
        $this->phone = $phone;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function doAlgorithm(): string
    {
        return "Платеж через {$this->type} по номеру телефона {$this->phone} на сумму {$this->sum} рублей прошел успешно";
    }
}

/**
 * Клиентский код выбирает конкретную стратегию и передаёт её в контекст. Клиент
 * должен знать о различиях между стратегиями, чтобы сделать правильный выбор.
 */
$context = new Context();
$context->doSomeBusinessLogic(new Payment_Qiwi('300', '89997563238'));

$context->doSomeBusinessLogic(new Payment_Yandex('800', '89997565232'));

$context->doSomeBusinessLogic(new Payment_WebMoney('1200', '89938563233'));
