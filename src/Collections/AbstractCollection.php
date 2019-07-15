<?php namespace WpRestServer\Collections;

use Countable;
use JsonSerializable;

/**
 * AbstractCollection
 */
abstract class AbstractCollection implements Countable, JsonSerializable
{
    /**
     * @var array
     */
    protected $items;

    /**
     * Constructor
     */
    function __construct(array $args)
    {
        $this->items = $this->fetch($args);
    }

    /**
     * Fetch items
     */
    abstract protected function fetch(array $args): array;

    /**
     * Count items
     */
    function count(): int
    {
        return count($this->items);
    }

    /**
     * Return a shalow copy of this collection.
     */
    function copy()
    {
        return $this;
    }

    /**
     * Clear all items
     */
    function clear()
    {
        $this->items = [];
    }

    /**
     * Check if items list is empty
     */
    function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Return a copy of items
     */
    function toArray(): array
    {
        return $this->items;
    }

    /**
     * JSON encode items
     *
     * @throws \JsonException
     */
    function jsonSerialize(): string
    {
        return json_encode($this->items, JSON_THROW_ON_ERROR);
    }
}
