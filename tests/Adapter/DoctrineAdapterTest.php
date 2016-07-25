<?php
namespace EnumTest\Adapter;

use Enum\Adapter\DoctrineAdapter;
use Enum\Options\DoctrineOptions;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;

class DoctrineAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    protected function getDataset()
    {
        $data = array();
        for ($i = 1; $i <= 3; $i++) {
            $data[] = array(
                'value'      => $i,
                'short_name' => 'short_' . $i,
                'long_name'  => 'long_' . $i,
            );
        }
        return $data;
    }

    public function testGetter()
    {
        $dataset = $this->getDataset();
        $statement = $this->createMock(Statement::class, array(), array(), '', false);
        $statement
            ->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($dataset));

        $connection = $this->createMock(Connection::class, array(), array(), '', false);
        $connection
            ->expects($this->once())
            ->method('executeQuery')
            ->will($this->returnValue($statement));

        $options = $this->createMock(DoctrineOptions::class);
        $options
            ->expects($this->once())
            ->method('getEnumItemTableName');
        $options
            ->expects($this->once())
            ->method('getEnumTableName');
        
        $adapter = new DoctrineAdapter($connection, $options);
        $rowset = $adapter->get(1);

        for ($i = 1; $i <= 3; $i++) {
            $this->assertEquals($dataset[$i - 1]['short_name'], $rowset[$i]['short_name']);
            $this->assertEquals($dataset[$i - 1]['long_name'], $rowset[$i]['long_name']);
        }
    }
}
