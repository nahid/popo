<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Integer extends Type
{
    protected $name = 'integer';
    protected $default = 0;

    /**
     * check this given value is integer type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return is_int($var);
    }
}