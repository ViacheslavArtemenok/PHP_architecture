<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity\IEntity;

class IdentityMap
{
    private $identityMap = [];
    public function add(IEntity $obj, $tailKey)
    {
        $key = $this->getGlobalKey(get_class($obj), $tailKey);
        $this->identityMap[$key] = $obj;
    }
    public function get(string $classname, $tailKey)
    {
        $key = $this->getGlobalKey($classname, $tailKey);
        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        } else return null;
    }
    private function getGlobalKey(string $classname, $tailKey)
    {
        return sprintf('%s.%d', $classname, $tailKey);
    }
}
