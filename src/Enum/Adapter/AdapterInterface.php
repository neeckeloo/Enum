<?php
namespace Enum\Adapter;

interface AdapterInterface
{
    /**
     * @param int $enumId
     * @return array
     */
    public function get($enumId);
}