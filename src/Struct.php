<?php declare(strict_types=1);

namespace Nahid\Popo;

use Nahid\Popo\Exceptions\TypeMismatchException;
use Nahid\Popo\Types\Type;

class Struct
{
    /**
     * @var \ReflectionClass
     */
    protected $_class;

    public function __construct($data = [])
    {
        $this->_class = new \ReflectionClass($this);
        if (count($data) > 0) {
            $this->generate($this->parse($data));
        }

    }

    /**
     * migrate data with class properties
     *
     * @param $data
     * @return $this
     * @throws TypeMismatchException
     */
    public function parse($data) : Struct
    {

        $props = $this->_class->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            $type = $prop->getValue($this);
            $name = $prop->getName();
            $key = $this->toUnderscore($name);
            $value = $data[$key] ?? null;

            if (class_exists($type)) {
                $obj = new \ReflectionClass($type);
                $typeInstance = '';

                if ($obj->isSubclassOf(Type::class)) {
                    /**
                     * @var Type $typeInstance
                     */
                    $typeInstance = new $type();
                    if (is_null($value)) {
                        $value = $typeInstance->getDefault();
                        goto setProp;
                    }

                    if (!$typeInstance->is($value)) {
                        throw new TypeMismatchException(vsprintf("Type mismatch exception! %s required is type %s.", [$key, $typeInstance]));
                    }

                    $method = 'change' . ucfirst($name);

                    if (method_exists($this, $method)) {
                        $value = call_user_func_array([$this, $method], [$value]);
                    }

                    //$value = $typeInstance->generate($value);
                }

                if ($obj->isSubclassOf(Struct::class)) {
                    if (is_null($value)) {
                        $value = (new $type())->parse([]);
                    }

                    if (!is_null($value)) {
                        $value = (new $type())->generate($value);
                    }
                }

                setProp : $prop->setValue($this, $value);

                unset($obj);
                unset($typeInstance);

            }
        }

        unset($this->_class);

        return $this;
    }

    /**
     * Generate data to parse POPO compatible
     *
     * @param $entities
     * @return array|Struct
     * @throws TypeMismatchException
     */
    public function generate($entities)
    {
        if (is_object($entities)) {
            return $entities;
        }

        if (is_array($entities) && !$this->isAssoc($entities)) {
            $data = [];
            foreach ($entities as $struct) {
                $data[] = (new static())->parse($struct);
            }

            return $data;
        }

        return $this->parse($entities);
    }

    /**
     * Make given text as camelCase
     *
     * @param string $string
     * @return string
     */
    protected function toCamelCase(string $string) : string
    {
        $words = explode('_', $string);
        $camelCase = '';
        $first = true;

        foreach ($words as $word) {
            if (!$first) {
                $camelCase .= ucfirst(strtolower($word));
            } else {
                $camelCase .= strtolower($word);
            }
        }

        return $camelCase;
    }

    /**
     * Make given text as under_score
     *
     * @param string $string
     * @return string
     */
    protected function toUnderscore(string $string) : string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * Check is given value is associative array
     *
     * @param $arr
     * @return bool
     */
    protected function isAssoc($arr) : bool
    {
        if (!is_array($arr)) return false;
        if (array() === $arr) return false;

        return array_keys($arr) !== range(0, count($arr) - 1);
    }


}