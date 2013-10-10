<?php
namespace Enum;

interface EnumManagerAwareInterface
{
    /**
     * @param EnumManager $manager
     */
    public function setEnumManager(EnumManager $manager);
}