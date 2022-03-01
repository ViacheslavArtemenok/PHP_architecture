<?php

namespace FactoryDir\AbstractFactory;

interface AbstractFactory
{
    public function createDBConnection(): AbstractDBConnection;

    public function createDBRecord(): AbstractDBRecord;

    public function createDBQueryBuilder(): AbstractDBQueryBuilder;
}
/**
 * AbstractFactory
 */

class MySQLFactory implements AbstractFactory
{
    public function createDBConnection(): AbstractDBConnection
    {
        return new ConcreteDBConnectionMySQL();
    }

    public function createDBRecord(): AbstractDBRecord
    {
        return new ConcreteDBRecordMySQL();
    }

    public function createDBQueryBuilder(): AbstractDBQueryBuilder
    {
        return new ConcreteDBQueryBuilderMySQL();
    }
}
/**
 * MySQLFactory
 * 
 */

class PostgreSQLFactory implements AbstractFactory
{
    public function createDBConnection(): AbstractDBConnection
    {
        return new ConcreteDBConnectionPostgreSQL();
    }

    public function createDBRecord(): AbstractDBRecord
    {
        return new ConcreteDBRecordPostgreSQL();
    }

    public function createDBQueryBuilder(): AbstractDBQueryBuilder
    {
        return new ConcreteDBQueryBuilderPostgreSQL();
    }
}
/**
 * PostgreSQLFactory
 * 
 */

class OracleFactory implements AbstractFactory
{
    public function createDBConnection(): AbstractDBConnection
    {
        return new ConcreteDBConnectionOracle();
    }

    public function createDBRecord(): AbstractDBRecord
    {
        return new ConcreteDBRecordOracle();
    }

    public function createDBQueryBuilder(): AbstractDBQueryBuilder
    {
        return new ConcreteDBQueryBuilderOracle();
    }
}
/**
 * OracleFactory
 * 
 */


interface AbstractDBConnection
{
    public function makeDBConnection(): string;
}
/**
 * AbstractDBConnection - абстрактный класс первого метода AbstractFactory
 */

class ConcreteDBConnectionMySQL implements AbstractDBConnection
{
    public function makeDBConnection(): string
    {
        return "Test_message from DBConnection to MySQL DB";
    }
}
/**
 * ConcreteDBConnectionMySQL - конкретная реализация интерфейса AbstractDBConnection для СУБД MySQL
 * 
 */

class ConcreteDBConnectionPostgreSQL implements AbstractDBConnection
{
    public function makeDBConnection(): string
    {
        return "Test_message from DBConnection to PostgreSQL DB";
    }
}
/**
 * ConcreteDBConnectionPostgreSQL - конкретная реализация интерфейса AbstractDBConnection для СУБД PostgreSQL
 * 
 */

class ConcreteDBConnectionOracle implements AbstractDBConnection
{
    public function makeDBConnection(): string
    {
        return "Test_message from DBConnection to Oracle DB";
    }
}
/**
 * ConcreteDBConnectionOracle - конкретная реализация интерфейса AbstractDBConnection для СУБД Oracle
 * 
 */




interface AbstractDBRecord
{
    public function makeDBRecord(): string;
}
/**
 * AbstractDBRecord - абстрактный класс второго метода AbstractFactory
 */

class ConcreteDBRecordMySQL implements AbstractDBRecord
{
    public function makeDBRecord(): string
    {
        return "Test_message from DBRecord to MySQL DB";
    }
}
/**
 * ConcreteDBRecordMySQL - конкретная реализация интерфейса AbstractDBRecord для СУБД MySQL
 * 
 */

class ConcreteDBRecordPostgreSQL implements AbstractDBRecord
{
    public function makeDBRecord(): string
    {
        return "Test_message from DBRecord to PostgreSQL DB";
    }
}
/**
 * ConcreteDBRecordPostgreSQL - конкретная реализация интерфейса AbstractDBRecord для СУБД PostgreSQL
 * 
 */

class ConcreteDBRecordOracle implements AbstractDBRecord
{
    public function makeDBRecord(): string
    {
        return "Test_message from DBRecord to Oracle DB";
    }
}
/**
 * ConcreteDBRecordOracle - конкретная реализация интерфейса AbstractDBRecord для СУБД Oracle
 * 
 */


interface AbstractDBQueryBuilder
{
    public function makeDBQueryBuilder(ProductBuilder $productBuilder): string;
}
/**
 * AbstractDBQueryBuilder - абстрактный класс второго метода AbstractFactory
 */

class ConcreteDBQueryBuilderMySQL implements AbstractDBQueryBuilder
{
    public function makeDBQueryBuilder(ProductBuilder $productBuilder): string
    {
        $productBuilder->setTypeDB("MySQL");
        $productBuilder->addMessage()->addSpace()->addFrom()->addSpace()->addNameOfClass()->addSpace()->addTo()->addSpace()->addTypeDB()->addSpace()->addDb();
        $result = $productBuilder->build();
        return $result;
    }
}
/**
 * ConcreteDBQueryBuilderMySQL - конкретная реализация интерфейса AbstractDBQueryBuilder для СУБД MySQL
 * 
 */

class ConcreteDBQueryBuilderPostgreSQL implements AbstractDBQueryBuilder
{
    public function makeDBQueryBuilder(ProductBuilder $productBuilder): string
    {
        $productBuilder->setTypeDB("PostgreSQL");
        $productBuilder->addMessage()->addSpace()->addFrom()->addSpace()->addNameOfClass()->addSpace()->addTo()->addSpace()->addTypeDB()->addSpace()->addDb();
        $result = $productBuilder->build();
        return $result;
    }
}
/**
 * ConcreteDBQueryBuilderPostgreSQL - конкретная реализация интерфейса AbstractDBQueryBuilder для СУБД PostgreSQL
 * 
 */

class ConcreteDBQueryBuilderOracle implements AbstractDBQueryBuilder
{
    public function makeDBQueryBuilder(ProductBuilder $productBuilder): string
    {
        $productBuilder->setTypeDB("Oracle");
        $productBuilder->addMessage()->addSpace()->addFrom()->addSpace()->addNameOfClass()->addSpace()->addTo()->addSpace()->addTypeDB()->addSpace()->addDb();
        $result = $productBuilder->build();
        return $result;
    }
}
/**
 * ConcreteDBQueryBuilderOracle - конкретная реализация интерфейса AbstractDBQueryBuilder для СУБД Oracle
 * 
 */

class ProductBuilder
{
    private $from = "from";
    private $message = "Test_message";
    private $to = "to";
    private $space = " ";
    private $other = "other";
    private $someText = "some text";
    private $db = "DB";
    private $nameOfClass = "DBQueryBuilder";
    private $typeDB;
    public $arr;

    public function setTypeDB($typeDB)
    {
        $this->typeDB = $typeDB;
        return $this;
    }
    public function addFrom()
    {
        $this->arr[] = $this->from;
        return $this;
    }
    public function addMessage()
    {
        $this->arr[] = $this->message;
        return $this;
    }
    public function addTo()
    {
        $this->arr[] = $this->to;
        return $this;
    }
    public function addSpace()
    {
        $this->arr[] = $this->space;
        return $this;
    }
    public function addOther()
    {
        $this->arr[] = $this->other;
        return $this;
    }
    public function addSomeText()
    {
        $this->arr[] = $this->someText;
        return $this;
    }
    public function addDb()
    {
        $this->arr[] = $this->db;
        return $this;
    }
    public function addNameOfClass()
    {
        $this->arr[] = $this->nameOfClass;
        return $this;
    }
    public function addTypeDB()
    {
        $this->arr[] = $this->typeDB;
        return $this;
    }
    public function build(): string
    {
        return (implode('', $this->arr));
    }
}

class ClientCode
{
    public function __construct(AbstractFactory $factory)
    {
        $this->factory = $factory;
    }
    public function render()
    {
        echo ($this->factory->createDBConnection()->makeDBConnection() . "<br>");
        echo ($this->factory->createDBRecord()->makeDBRecord() . "<br>");
        echo ($this->factory->createDBQueryBuilder()->makeDBQueryBuilder(new ProductBuilder) . "<br>");
    }
}
$dataMySQL = new ClientCode(new MySQLFactory);
$dataPostgreSQL = new ClientCode(new PostgreSQLFactory);
$dataOracle = new ClientCode(new OracleFactory);
?>
<p><?= $dataMySQL->render() ?></p>
<p><?= $dataPostgreSQL->render() ?></p>
<p><?= $dataOracle->render() ?></p>