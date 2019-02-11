<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Obj extends Type
{
    protected $name = 'object';
    protected $default = null;

    public function is($var) : bool
    {
        return is_object($var);
    }
}