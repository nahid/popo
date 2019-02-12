<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Collection extends Type
{
    protected $name = 'collection';
    protected $default = [];

    public function is($var) : bool
    {
        return $this->isCollection($var);
    }

    private function isCollection(array $arr) : bool
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}