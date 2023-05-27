<?php

namespace Core\Helpers\Dto;

trait Constructable
{
    public function __construct(array $params)
    {
        $properties = get_class_vars($this::class);
        $properties = array_keys($properties);

        foreach ($properties as $property) {
            $this->$property = array_key_exists($property, $params)
                ? $params[$property]
                : null;
        }
    }
}
