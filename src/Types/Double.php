<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Double extends Type
{
    protected $name = 'double';
    protected $default = 0.0;

    /**
     * check this given value is double/float type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return is_float($var) || is_double($var);
    }
}