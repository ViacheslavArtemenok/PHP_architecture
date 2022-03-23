<?php

namespace arch6\Command;

/**
 * Интерфейс Команды объявляет метод для выполнения команд.
 */
interface Command
{
    public function execute(): void;
}

/**
 * Некоторые команды способны выполнять простые операции самостоятельно.
 */

/**
 * Но есть и команды, которые делегируют более сложные операции другим объектам,
 * называемым «получателями».
 */
class Render implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct(Receiver $receiver, string $a)
    {
        $this->receiver = $receiver;
        $this->a = $a;
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute(): void
    {
        $this->receiver->doRender($this->a);
    }
}
class Copier implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    private $b;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct(Receiver $receiver, string $a)
    {
        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $a;
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute(): void
    {
        $this->receiver->doCopy($this->a, $this->b);
    }
}
class Cuter implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    private $b;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct(Receiver $receiver, string $a)
    {
        $this->receiver = $receiver;
        $this->b = $a;
        $this->a = '';
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute(): void
    {
        $this->receiver->doCute($this->a);
    }
}
class Paster implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    private $b;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct(Receiver $receiver, string $a)
    {
        $this->receiver = $receiver;
        $this->b = $a;
        $this->a = '';
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute(): void
    {
        $this->receiver->doPaste($this->a, $this->b);
    }
}
class Canceler implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    private $b;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct(Receiver $receiver, string $b)
    {
        $this->receiver = $receiver;
        $this->a = $b;
        $this->b = '';
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute(): void
    {
        $this->receiver->doCancel($this->a, $this->b);
    }
}

/**
 * Классы Получателей содержат некую важную бизнес-логику. Они умеют выполнять
 * все виды операций, связанных с выполнением запроса. Фактически, любой класс
 * может выступать Получателем.
 */
class Receiver
{
    public function doRender(string $a): void
    {
        echo $a;
    }
    public function doCopy(string $a, string $b): void
    {
        echo $a; ?>
        <br>
        <br>
    <?php
        echo $b;
    }
    public function doCute(string $a): void
    {
        echo $a; ?>
        <br>
        <br>
        <br>
    <?php

    }
    public function doPaste(string $a, string $b): void
    {
        echo $a; ?>
        <br>
        <br>
        <br>
    <?php
        echo $b;
    }
    public function doCancel(string $a, string $b): void
    {
        echo $a; ?>
        <br>
        <br>
<?php
        echo $b;
    }
}

/**
 * Отправитель связан с одной или несколькими командами. Он отправляет запрос
 * команде.
 */
class Invoker
{
    /**
     * Инициализация команд.
     */
    public function makeOnStart(Command $command): void
    {
        $command->execute();
    }


    /**
     * Отправитель не зависит от классов конкретных команд и получателей.
     * Отправитель передаёт запрос получателю косвенно, выполняя команду.
     */
}

/**
 * Клиентский код может параметризовать отправителя любыми командами.
 */
$TEXT = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. 
Voluptates, ducimus! Tempore rerum adipisci nostrum a minima voluptatum et aliquid commodi maiores eligendi ipsa voluptas, 
laboriosam autem. Dicta, rerum autem. Libero fuga ipsam vitae commodi, itaque impedit odio, nam nisi labore iusto pariatur cupiditate qui vero voluptatem reiciendis, 
possimus corporis veniam consectetur. Tempora corrupti excepturi quisquam. 
Accusamus tempore eligendi quas asperiores veritatis hic quisquam explicabo expedita autem dolores optio vel fuga, fugit dolore odio vitae dolorum esse exercitationem ex nesciunt ab. 
Quis unde adipisci voluptatem delectus aspernatur ut. Adipisci quod, laboriosam eveniet voluptatibus earum, sed perspiciatis, optio vitae dolores libero aliquid.';
$invoker = new Invoker();
if ($_GET['action'] == 'copy') {
    $invoker->makeOnStart(new Copier(new Receiver, $TEXT));
} elseif ($_GET['action'] == 'cute') {
    $invoker->makeOnStart(new Cuter(new Receiver, $TEXT));
} elseif ($_GET['action'] == 'paste') {
    $invoker->makeOnStart(new Paster(new Receiver, $TEXT));
} elseif ($_GET['action'] == 'cancel') {
    $invoker->makeOnStart(new Canceler(new Receiver, $TEXT));
} else {
    $invoker->makeOnStart(new Render(new Receiver, $TEXT));
}
?>
<br>
<a href="Command.php?action=copy">Копировать</a>
<a href="Command.php?action=cute">Вырезать</a>
<a href="Command.php?action=paste">Вставить</a>
<a href="Command.php?action=cancel">Отменить</a>