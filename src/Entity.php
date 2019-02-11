<?php declare(strict_types=1);

namespace Nahid\Popo;

use Nahid\Popo\Exceptions\TypeMismatchException;
use Nahid\Popo\Types\Type;

class Entity
{
    /**
     * @var \ReflectionClass
     */
    protected $_class;

    public function __construct($data = [])
    {
        $this->_class = new \ReflectionClass($this);
        if (count($data) > 0) {
            $this->parse($data);
        }

    }

    /**
     * @param $data
     * @return $this
     * @throws TypeMismatchException
     */
    protected function parse($data) : Entity
    {

        $props = $this->_class->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            $type = $prop->getValue($this);
            $key = $this->toUnserscore($prop->getName());
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
                        throw new TypeMismatchException();
                    }

                    //$value = $typeInstance->generate($value);
                }

                if ($obj->isSubclassOf(Entity::class)) {
                    if (!is_null($value)) {
                        $value = (new $type())->generate($value);
                    }
                }

                setProp : $prop->setValue($this, $value);

                unset($obj);
                unset($typeInstance);
                unset($this->_class);

            }
        }

        return $this;
    }

    public function generate($entities)
    {
        if (!$this->isAssoc($entities)) {
            $data = [];
            foreach ($entities as $entity) {
                $data[] = (new static())->parse($entity);
            }

            return $data;
        }

        return $this->parse($entities);
    }

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

    protected function toUnserscore(string $string) : string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    protected function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }


}