<?php
namespace Enum;

use Enum\Adapter\AdapterInterface;

class EnumManager
{
    const LONG = 'long_name';
    const SHORT = 'short_name';

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var array
     */
    protected $persistence = [];

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    private function getEnumeration($enumId)
    {
        if (
            array_key_exists($enumId, $this->persistence)
            && !empty($this->persistence[$enumId])
        ) {
            return $this->persistence[$enumId];
        }

        $enumeration = $this->adapter->get($enumId);
        if (empty($enumeration)) {
            throw new \RuntimeException(sprintf(
                'Enumeration "%d" does not exists.',
                $enumId
            ));
        }

        $this->persistence[$enumId] = $enumeration;

        return $enumeration;
    }

    /**
     * @param  int $enumId
     * @param  null|string $field
     * @return array
     */
    public function getList($enumId, $field = null)
    {
        $enumeration = $this->getEnumeration($enumId);

        if (null === $field) {
            return $enumeration;
        }

        $items = array();
        foreach ($enumeration as $key => $item) {
            $items[$key] = $item[$field];
        }

        return $items;
    }

    /**
     * @param  int $enumId
     * @param  int $value
     * @return string|int
     */
    public function get($enumId, $value)
    {
        $items = $this->getList($enumId);

        if (!array_key_exists($value, $items) || empty($items[$value])) {
            return null;
        }

        return $items[$value];
    }

    /**
     * @param  int $enumId
     * @param  int $value
     * @return string
     */
    public function getShortName($enumId, $value)
    {
        return $this->getName(self::SHORT, $enumId, $value);
    }

    /**
     * @param  int $enumId
     * @param  int $value
     * @return string
     */
    public function getLongName($enumId, $value)
    {
        return $this->getName(self::LONG, $enumId, $value);
    }

    /**
     * @param  string $type
     * @param  int $enumId
     * @param  int $value
     * @return string
     */
    protected function getName($type, $enumId, $value)
    {
        $type = (string) $type;

        $enum = $this->get($enumId, $value);
        if (null === $enum) {
            return $value;
        }

        return $enum[$type];
    }
}