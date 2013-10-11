<?php
namespace Enum\View\Helper;

use Enum\EnumManager;
use Enum\EnumManagerAwareInterface;
use Zend\View\Helper\AbstractHelper;

class Enum extends AbstractHelper implements EnumManagerAwareInterface
{
    /**
     * @var array
     */
    protected $validMode = array(EnumManager::LONG, EnumManager::SHORT);

    /**
     * @var EnumManager
     */
    protected $enumManager;

    /**
     * @param EnumManager $manager
     */
    public function setEnumManager(EnumManager $manager)
    {
        $this->enumManager = $manager;
    }

    /**
     * @param  string $value
     * @param  int $enumCode
     * @param  array $options
     * @return string
     */
    public function __invoke($value, $enumCode, array $options = null)
    {
        $enumCode = (int) $enumCode;

        $row = $this->enumManager->get($enumCode, $value);
        if (null === $row) {
            if (isset($options['default'])) {
                return $options['default'];
            }

            return null;
        }

        $mode = EnumManager::LONG;
        if (isset($options['mode']) && in_array($options['mode'], $this->validMode)) {
            $mode = (string) $options['mode'];
        }

        return $row[$mode];
    }
}