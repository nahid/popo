<?php

use Nahid\Popo\Struct;


if (!function_exists('popo_json_struct')) {
    /**
     * @param string $json
     * @param string $struct
     * @return array|Struct
     * @throws ReflectionException
     * @throws \Nahid\Popo\Exceptions\TypeMismatchException
     * @throws \Nahid\Popo\Exceptions\UnknownStructException
     */
    function popo_json_struct(string $json, string $struct)
    {
        $ref_class = new ReflectionClass($struct);

        if (!$ref_class->isSubclassOf(Struct::class)) {
            throw new \Nahid\Popo\Exceptions\UnknownStructException(vsprintf("Unknown struct exception. %s should be inherited from Entity::class.", [$struct]));
        }

        $json_array = json_decode($json, true);

        /**
         * @var Struct $struct_obj
         */
        $struct_obj = $ref_class->newInstance();

        return $struct_obj->generate($json_array);
    }
}


if (!function_exists('popo_struct')) {
    /**
     * @param array $data
     * @param string $entity
     * @return mixed
     * @throws ReflectionException
     * @throws \Nahid\Popo\Exceptions\UnknownStructException
     */
    function popo_struct(array $data, string $entity)
    {
        $ref_class = new ReflectionClass($entity);

        if (!$ref_class->isSubclassOf(Struct::class)) {
            throw new \Nahid\Popo\Exceptions\UnknownStructException(vsprintf("Unknown entity exception. %s should be inherited from Entity::class.", [$entity]));
        }

        $entity_obj = new $entity();

        return $entity_obj->generate($data);
    }
}