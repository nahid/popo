<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Str extends Type
{
    protected $name = 'string';
    protected $default = null;

    public function is($var) : bool
    {
        return is_string($var);
    }
}