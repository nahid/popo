<?php declare(strict_types=1);

namespace Nahid\Popo\Types;

abstract class Type
{
    protected $default = null;
    protected $name = '';

    /**
     * Check the given value is valid for this type
     *
     * @param $var
     * @return bool
     */
    abstract public function is($var) : bool ;

    /**
     * Get default value of this type
     *
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Return string if this object called as a variable
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->name;
    }
}