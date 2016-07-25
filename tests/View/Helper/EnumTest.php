<?php
namespace EnumTest\View\Helper;

use Enum\EnumManager;
use Enum\View\Helper\Enum as EnumHelper;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EnumHelper
     */
    protected $helper;

    public function setUp()
    {
        $this->helper = new EnumHelper();
    }

    /**
     * @return array
     */
    protected function getDataset()
    {
        return array(
            'id'         => 1,
            'short_name' => 'short',
            'long_name'  => 'long',
        );
    }

    public function testGetterWithData()
    {
        $manager = $this->getMockBuilder(EnumManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $manager
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($this->getDataset()));

        $this->helper->setEnumManager($manager);

        $this->assertEquals('long', $this->helper->__invoke(1, 1));
        $this->assertEquals('long', $this->helper->__invoke(1, 1, array('mode' => EnumManager::LONG)));
        $this->assertEquals('short', $this->helper->__invoke(1, 1, array('mode' => EnumManager::SHORT)));
        $this->assertEquals('long', $this->helper->__invoke(1, 1, array('mode' => 'bad_type')));
    }

    public function testGetterWithoutData()
    {
        $manager = $this->getMockBuilder(EnumManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $manager
            ->expects($this->any())
            ->method('get');

        $this->helper->setEnumManager($manager);

        $this->assertNull($this->helper->__invoke(1, 1));
        $this->assertEquals('foo', $this->helper->__invoke(1, 1, array('default' => 'foo')));
    }
}
