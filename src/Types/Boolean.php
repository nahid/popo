<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Boolean extends Type
{
    protected $name = 'boolean';
    protected $default = false;

    public function is($var) : bool
    {
        return is_bool($var);
    }
}