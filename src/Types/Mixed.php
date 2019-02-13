<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

class Mixed extends Type
{
    protected $name = 'mixed';
    protected $default = null;

    /**
     * check this given value is mixed(any kind of type) type
     *
     * @param $var
     * @return bool
     */
    public function is($var) : bool
    {
        return true;
    }
}