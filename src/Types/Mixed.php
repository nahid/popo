<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Mixed extends Type
{
    protected $name = 'mixed';
    protected $default = null;

    public function is($var) : bool
    {
        return true;
    }
}