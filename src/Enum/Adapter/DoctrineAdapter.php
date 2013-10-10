<?php
namespace Enum\Adapter;

use Doctrine\DBAL\Connection;
use Enum\Options\DoctrineOptions;

class DoctrineAdapter implements AdapterInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var DoctrineOptions
     */
    protected $options;

    /**
     * @param Connection $connection
     * @param DoctrineOptions $options
     */
    public function __construct(Connection $connection, DoctrineOptions $options)
    {
        $this->connection = $connection;
        $this->options    = $options;
    }

    /**
     * @param  int $enumId
     * @return array
     */
    public function get($enumId)
    {
        $sql = 'SELECT ei.* FROM ' . $this->options->getEnumItemTableName() . ' ei
        INNER JOIN ' . $this->options->getEnumTableName() . ' e ON ei.enum_id = e.id WHERE e.id = ?';
        
        $statement = $this->connection->executeQuery($sql, array($enumId));
        $result = $statement->fetchAll();

        $items = array();
        foreach ($result as $row) {
            $items[$row['id']] = $row;
        }

        return $items;
    }
}