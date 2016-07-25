<?php
namespace EnumTest;

use Enum\EnumManager;

class EnumManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    protected function getDataset()
    {
        $data = array();
        for ($i = 1; $i <= 3; $i++) {
            $data[$i] = array(
                'id'         => $i,
                'short_name' => 'short_' . $i,
                'long_name'  => 'long_' . $i,
            );
        }
        return $data;
    }

    public function testGetListWithoutField()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        $list = $manager->getList(1);

        $this->assertCount(3, $list);
        for ($i = 1; $i <= 3; $i++) {
            $this->assertEquals('short_' . $i, $list[$i]['short_name']);
            $this->assertEquals('long_' . $i, $list[$i]['long_name']);
        }
    }

    public function testGetListWithField()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        $list = $manager->getList(1, 'long_name');

        $this->assertCount(3, $list);
        for ($i = 1; $i <= 3; $i++) {
            $this->assertEquals('long_' . $i, $list[$i]);
        }
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetEmptyList()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue(array()));
        $manager = new EnumManager($adapter);

        $manager->getList(1);
    }

    public function testGetter()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        for ($i = 1; $i <= 3; $i++) {
            $item = $manager->get(1, $i);
            $this->assertEquals($i, $item['id']);
        }
    }

    public function testGetShortName()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        for ($i = 1; $i <= 3; $i++) {
            $shortName = $manager->getShortName(1, $i);
            $this->assertEquals('short_' . $i, $shortName);
        }
    }

    public function testGetLongName()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        for ($i = 1; $i <= 3; $i++) {
            $shortName = $manager->getLongName(1, $i);
            $this->assertEquals('long_' . $i, $shortName);
        }
    }

    public function testGetLongNameFromEnumDoesNotExists()
    {
        $adapter = $this->createMock('Enum\Adapter\AdapterInterface');
        $adapter
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));
        $manager = new EnumManager($adapter);

        $this->assertEquals(4, $manager->getLongName(1, 4));
    }
}
