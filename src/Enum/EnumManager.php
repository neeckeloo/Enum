<?php
namespace Enum;

use Enum\Adapter\AdapterInterface;

class EnumManager
{
    const LONG = 'longName';
    const SHORT = 'shortName';

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param  int $enumId
     * @param  null|string $field
     * @return array
     */
    public function getList($enumId, $field = null)
    {
        $enumeration = $this->adapter->get($enumId);
        if (count($enumeration) == 0) {
            throw new \RuntimeException(sprintf(
                'Enumeration "%d" does not exists.',
                $enumId
            ));
        }

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
     * @return type
     */
    public function get($enumId, $value)
    {
        $items = $this->getList($enumId);
        $value = (int) $value;

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
        if ($type !== self::SHORT && $type !== self::LONG) {
            throw new \InvalidArgumentException(sprintf(
                'The type "%s" is invalid; "short_name" or "long_name" expected.',
                $type
            ));
        }

        $enum = $this->get($enumId, $value);
        if (null === $enum) {
            return $value;
        }

        $fields = $enum->toArray();

        return $fields[$type];
    }
}