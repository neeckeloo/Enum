<?php
namespace Enum\Options;

use Zend\Stdlib\AbstractOptions;

class DoctrineOptions extends AbstractOptions
{
    /**
     * Name of the doctrine connection service
     *
     * @var string
     */
    protected $connection;

    /**
     * Table name which should be used to store enumerations
     *
     * @var string
     */
    protected $enumTableName;

    /**
     * Table name which should be used to store enumeration items
     *
     * @var string
     */
    protected $enumItemTableName;

    /**
     * @param  string $connection
     * @return self
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }

    /**
     * @return string
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param  string $tableName
     * @return self
     */
    public function setEnumTableName($tableName)
    {
        $this->enumTableName = $tableName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnumTableName()
    {
        return $this->enumTableName;
    }

    /**
     * @param  string $tableName
     * @return self
     */
    public function setEnumItemTableName($tableName)
    {
        $this->enumItemTableName = $tableName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnumItemTableName()
    {
        return $this->enumItemTableName;
    }
}