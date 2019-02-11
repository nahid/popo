<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Double extends Type
{
    protected $name = 'double';
    protected $default = 0.0;

    public function is($var) : bool
    {
        return is_float($var);
    }
}