<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

abstract class Type
{
    protected $default = null;
    protected $name = '';

    abstract public function is($var) : bool ;

    public function getDefault()
    {
        return $this->default;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}