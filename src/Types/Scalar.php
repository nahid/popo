<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Scalar extends Type
{
    protected $name = 'scalar';
    protected $default = 0;

    /**
     * check this given value is scalar(int, float, double) type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return is_scalar($var);
    }
}