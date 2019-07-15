<?php namespace WpRestServer\Models;

use JsonSerializable;

/**
 * Entity
 */
abstract class Entity implements JsonSerializable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    function __construct(int $id)
    {
        $this->data = $this->fetch($id);
    }

    /**
     * Fetch data
     */
    abstract protected function fetch(int $id): array;

    /**
     * Getter
     */
    function __get($prop)
    {
        return isset($this->data[$prop]) ? $this->data[$prop] : null;
    }

    /**
     * Setter
     */
    function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    /**
     * Check existence
     */
    function __isset($prop)
    {
        return isset($this->data[$prop]);
    }

    /**
     * Delete a property
     */
    function __unset($prop)
    {
        unset($this->data[$prop]);
    }

    /**
     * @return array
     */
    function toArray(): array
    {
        return $this->data;
    }

    /**
     * JSON encode
     *
     * @throws \JsonException
     */
    function jsonSerialize()
    {
        return json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}
