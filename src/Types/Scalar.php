<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Scalar extends Type
{
    protected $name = 'scalar';
    protected $default = 0;

    public function is($var) : bool
    {
        return is_scalar($var);
    }
}