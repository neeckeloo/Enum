<?php
namespace EnumTest\Adapter;

use Enum\Adapter\DoctrineAdapter;

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
                'id'         => $i,
                'short_name' => 'short_' . $i,
                'long_name'  => 'long_' . $i,
            );
        }
        return $data;
    }

    public function testGetter()
    {
        $dataset = $this->getDataset();
        $statement = $this->getMock('Doctrine\DBAL\Statement', array(), array(), '', false);
        $statement
            ->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($dataset));

        $connection = $this->getMock('Doctrine\DBAL\Connection', array(), array(), '', false);
        $connection
            ->expects($this->once())
            ->method('executeQuery')
            ->will($this->returnValue($statement));

        $options = $this->getMock('Enum\Options\DoctrineOptions');
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