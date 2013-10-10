<?php
namespace EnumTest\Options;

use Enum\Options\DoctrineOptions;

class DoctrineOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DoctrineOptions
     */
    protected $options;

    public function setUp()
    {
        $this->options = new DoctrineOptions();
    }

    public function testSetAndGetConnection()
    {
        $connection = 'foo';
        $this->options->setConnection($connection);
        $this->assertEquals($connection, $this->options->getConnection());
    }

    public function testSetAndGetEnumTableName()
    {
        $enumTableName = 'foo';
        $this->options->setEnumTableName($enumTableName);
        $this->assertEquals($enumTableName, $this->options->getEnumTableName());
    }

    public function testSetAndGetEnumItemTableName()
    {
        $enumItemTableName = 'foo';
        $this->options->setEnumItemTableName($enumItemTableName);
        $this->assertEquals($enumItemTableName, $this->options->getEnumItemTableName());
    }
}