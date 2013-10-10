<?php
namespace Enum\View\Helper;

use Enum\EnumManager;
use Enum\EnumManagerAwareInterface;
use Zend\View\Helper\AbstractHelper;

class Enum extends AbstractHelper implements EnumManagerAwareInterface
{
    const LONG = 'longName';
    const SHORT = 'shortName';

    /**
     * @var array
     */
    protected static $validMode = array(self::LONG, self::SHORT);

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

        $object = $this->enumManager->get($enumCode, $value);
        if (null === $object) {
            if (isset($options['default'])) {
                return $options['default'];
            }

            return null;
        }

        $mode = self::LONG;
        if (isset($options['mode']) && in_array($options['mode'], self::$validMode)) {
            $mode = (string) $options['mode'];
        }

        $method = 'get' . ucfirst($mode);

        return call_user_func(array($object, $method));
    }
}