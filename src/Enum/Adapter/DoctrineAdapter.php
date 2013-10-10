<?php
namespace Enum\Adapter;

use Doctrine\DBAL\Connection;

class DoctrineAdapter implements AdapterInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var string
     */
    protected $enumTableName;

    /**
     * @var string
     */
    protected $enumItemTableName;

    /**
     * @param Connection $connection
     * @param string $enumTableName
     * @param string $enumItemTableName
     */
    public function __construct(Connection $connection, $enumTableName, $enumItemTableName)
    {
        $this->connection         = $connection;
        $this->enumTableName      = (string) $enumTableName;
        $this->enumItemTableName  = (string) $enumItemTableName;
    }

    /**
     * @param  int $enumId
     * @return array
     */
    public function get($enumId)
    {
        $sql = 'SELECT ei.* FROM ' . $this->enumItemTableName . ' ei
        INNER JOIN ' . $this->enumTableName . ' e ON ei.enum_id = e.id WHERE e.id = ?';
        
        $statement = $this->connection->executeQuery($sql, array($enumId));
        $result = $statement->fetchAll();

        $items = array();
        foreach ($result as $row) {
            $items[$row['id']] = $row['name'];
        }

        return $items;
    }
}