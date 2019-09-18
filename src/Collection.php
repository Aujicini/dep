<?php declare(strict_types=1);
/**
 * @author Oxuwazet.
 */

namespace Oxuwazet\Collection;

/**
 * A collection object for managing variables more efficiently.
 *
 * @see <https://www.php.net/manual/en/class.arrayaccess.php>.
 */
class Collection implements CollectionInterface, \Traversable, \Serializable, \ArrayAccess
{
    /** @var array $container The container var for storing the collection. */
    private $container = [];

    /**
     * {@inheritDoc}
     */
    public function __construct(array $insert)
    {
        foreach ($insert as $element => $value) {
            $container[$element] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getContainer(): array
    {
        return $this->container;
    }

    /**
     * String representation of object
     *
     * @return string Returns a string representation of object.
     */
    public function serialize(): string
    {
        return \serialize($this->container);
    }
    
    /**
     * Constructs the object.
     *
     * @param string $container The container data for object construction.
     *
     * @return string Returns nothing.
     */
    public function unserialize(string $container): void
    {
        $this->container = \unserialize($container);
    }

    /**
     * Insert a value through the array access feature.
     *
     * @param mixed $element The element for the value.
     * @param mixed $value   The value associated to the element.
     *
     * @return void Returns nothing.
     */
    public function offsetSet($element, $value): void
    {
        if (\is_null($element)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Check to see if the element exists.
     *
     * @param mixed $element The element for the value.
     *
     * @return bool Returns true if the element exsists and false if not.
     */
    public function offsetExists($element): bool
    {
        return isset($this->container[$element]);
    }

    /**
     * Unset the element (Delete the element and its value).
     *
     * @param mixed $element The element for the value.
     *
     * @return void Returns nothing.
     */
    public function offsetUnset($element): void
    {
        unset($this->container[$element]);
    }

    /**
     * Get the value associated with the element.
     *
     * @param mixed $element The element for the value.
     *
     * @return mixed Returns the value associated to the element.
     */
    public function offsetGet($element)
    {
        return isset($this->container[$element]) ? $this->container[$element] : \null;
    }

    /**
     * {@inheritDoc}
     */
    public function flash($element)
    {
        if ($this->offsetExists($element)) {
            $value = $this->container[$element];
            $this->offsetUnset($element);
            return $value;
        }
        return \null;
    }

    /**
     * {@inheritDoc}
     */
    public function last()
    {
        return \end($this->container);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return \key($this->container);
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return \next($this->container);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return \current($this->container);
    }

    /**
     * Clear the container.
     *
     * @return void Returns nothing.
     */
    public function clear(): void
    {
        $this->container = [];
    }
}