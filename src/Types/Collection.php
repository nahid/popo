<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Collection extends Type
{
    protected $name = 'collection';
    protected $default = [];

    public function is($var) : bool
    {
        return is_array($var);
    }
}