<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Integer extends Type
{
    protected $name = 'integer';
    protected $default = 0;

    public function is($var) : bool
    {
        return is_int($var);
    }
}