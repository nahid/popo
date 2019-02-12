<?php

use Nahid\Popo\Entity;


if (!function_exists('popo_json_parse')) {
    function popo_json_parse(string $json, string $entity)
    {
        $ref_class = new ReflectionClass($entity);

        if (!$ref_class->isSubclassOf(Entity::class)) {
            throw new \Nahid\Popo\Exceptions\UnknownEntityException(vsprintf("Unknown entity exception. %s should be inherited from Entity::class.", [$entity]));
        }

        $json_array = json_decode($json, true);

        $entity_obj = new $entity($json_array);

        return $entity_obj;
    }
}


if (!function_exists('popo_enity')) {
    function popo_enity(array $data, string $entity)
    {
        $ref_class = new ReflectionClass($entity);

        if (!$ref_class->isSubclassOf(Entity::class)) {
            throw new \Nahid\Popo\Exceptions\UnknownEntityException(vsprintf("Unknown entity exception. %s should be inherited from Entity::class.", [$entity]));
        }

        $entity_obj = new $entity($data);

        return $entity_obj;
    }
}