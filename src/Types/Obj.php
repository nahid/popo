<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Obj extends Type
{
    protected $name = 'object';
    protected $default = null;

    /**
     * check this given value is object type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return is_object($var);
    }
}