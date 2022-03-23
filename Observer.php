<?php

namespace arch6\Observer;

/**
 * PHP имеет несколько встроенных интерфейсов, связанных с паттерном
 * Наблюдатель.
 *
 * Вот как выглядит интерфейс Издателя:
 *
 * @link http://php.net/manual/ru/class.splsubject.php
 *
 *     interface SplSubject
 *     {
 *         // Присоединяет наблюдателя к издателю.
 *         public function attach(SplObserver $observer);
 *
 *         // Отсоединяет наблюдателя от издателя.
 *         public function detach(SplObserver $observer);
 *
 *         // Уведомляет всех наблюдателей о событии.
 *         public function notify();
 *     }
 *
 * Также имеется встроенный интерфейс для Наблюдателей:
 *
 * @link http://php.net/manual/ru/class.splobserver.php
 *
 *     interface SplObserver
 *     {
 *         public function update(SplSubject $subject);
 *     }
 */

/**
 * Издатель владеет некоторым важным состоянием и оповещает наблюдателей о его
 * изменениях.
 */
class Subject_Vacancy implements \SplSubject
{
    /**
     * @var int Для удобства в этой переменной хранится состояние Издателя,
     * необходимое всем подписчикам.
     */
    public $state;
    public $vacancies = ['РНР-программист', 'JAVA-программист', 'C#-программист'];
    /**
     * @var \SplObjectStorage Список подписчиков. В реальной жизни список
     * подписчиков может храниться в более подробном виде (классифицируется по
     * типу события и т.д.)
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(\SplObserver $observer): void
    {
        echo "Subject: " . join(", ", $observer->userData) . " подписан на Subject_Vacancy.";
        $this->observers->attach($observer); ?>
        <br>
    <?php
    }

    public function detach(\SplObserver $observer): void
    {
        echo "Subject: " . join(", ", $observer->userData) . " отписан от Subject_Vacancy.";
        $this->observers->detach($observer); ?>
        <br>
    <?php
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify(): void
    {
        echo "Subject: Notifying observers..."; ?>
        <br>
        <?php
        foreach ($this->observers as $observer) {
            echo "Пользователь " . $observer->userData['name'] . " получил уведомление о вакансии: {$this->state}."; ?>
            <br>
        <?php
            $observer->update($this);
        }
    }

    /**
     * Обычно логика подписки – только часть того, что делает Издатель. Издатели
     * часто содержат некоторую важную бизнес-логику, которая запускает метод
     * уведомления всякий раз, когда должно произойти что-то важное (или после
     * этого).
     */
    public function someBusinessLogic(): void
    {
        echo "Обновление списка вакансий на сайте HandHunter.gb ...."; ?>
        <br>
        <?php
        $this->state = $this->vacancies[rand(0, 2)];

        echo "Subject: найдена новая вакансия на должность: {$this->state}"; ?>
        <br>
        <?php
        $this->notify();
    }
}

/**
 * Конкретные Наблюдатели реагируют на обновления, выпущенные Издателем, к
 * которому они прикреплены.
 */
class ConcreteObserverA implements \SplObserver
{
    public $userData = ['name' => 'Иван Петров', 'email' => 'ivanpetrov1988@mail.ru', 'experience' => '8 лет опыта'];

    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 'РНР-программист') {
            echo "ConcreteObserverA: " . $this->userData['name'] . " откликнулся на вакансию: {$subject->state}."; ?>
            <br>
        <?php
        }
    }
}

class ConcreteObserverB implements \SplObserver
{
    public $userData = ['name' => 'Илья Соколов', 'email' => 'sokolovI3000@mail.ru', 'experience' => '5 лет опыта'];

    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 'JAVA-программист') {
            echo "ConcreteObserverB: " . $this->userData['name'] . " откликнулся на вакансию: {$subject->state}."; ?>
            <br>
        <?php
        }
    }
}
class ConcreteObserverC implements \SplObserver
{
    public $userData = ['name' => 'Виктор Крылов', 'email' => 'vikkril1972@mail.ru', 'experience' => '15 лет опыта'];

    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 'C#-программист') {
            echo "ConcreteObserverC: " . $this->userData['name'] . " откликнулся на вакансию: {$subject->state}."; ?>
            <br>
<?php
        }
    }
}

/**
 * Клиентский код.
 */

$subject = new Subject_Vacancy();

$o1 = new ConcreteObserverA();
$subject->attach($o1);

$o2 = new ConcreteObserverB();
$subject->attach($o2);

$o3 = new ConcreteObserverC();
$subject->attach($o3);

$subject->someBusinessLogic();

$subject->detach($o2);
$subject->someBusinessLogic();
