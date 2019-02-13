<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Arr extends Type
{
    protected $name = 'array';
    protected $default = [];

    /**
     * check this given value is array type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return is_array($var);
    }
}