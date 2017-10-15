<?php
namespace AppBundle\Entity;

abstract class Entity {

    public function get(string $key)
    {
        return $this->{$key};
    }

    public function set(string $key, $value)
    {
        $this->{$key} = $value;
        return $this->{$key};
    }
}
