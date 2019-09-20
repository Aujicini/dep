namespace Oxuwazet\DependencyInjection;

/**
 * A collection object for managing variables more efficiently.
 *
 * @class Collection.
 */
interface CollectionInterface
{
    /**
     *  Construct a new collection.
     *
     * @param array $insert Data to insert into the collection.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $insert)
    {
        foreach ($insert as $element => $value) {
            $container[$element] = $value;
        }
    }

    /**
     * Get the containers instance.
     *
     * @return array Returns the containers instance.
     */
    public function getContainer(): array
    {
        return $this->container;
    }

    /**
     * Check to see if the element exists.
     *
     * @param mixed $element The element for the value.
     *
     * @return bool Returns true if the element exists and false if not.
     */
    public function has($element): bool
    {
        return $this->offsetExists($element);
    }

    /**
     * Remove a value.
     *
     * @param mixed $element The element for the value.
     *
     * @return void Returns nothing.
     */
    public function remove($element): void
    {
        $this->offsetUnset($element);
    }

    /**
     * Get a value.
     *
     * @param mixed $element The element for the value.
     *
     * @return mixed Returns the value associated to the element.
     */
    public function get($element)
    {
        return $this->offsetGet($element);
    }

    /**
     * Insert a value.
     *
     * @param mixed $element The element for the value.
     * @param mixed $value   The value associated to the element.
     *
     * @return void Returns nothing.
     */
    public function set($element, $value)
    {
        $this->offsetSet($element, $value);
    }

    /**
     * Flash a value.
     *
     * @param mixed $element The element for the value.
     *
     * @return mixed Returns the value associated to the element.
     */
    public function flash($element)
    {
        $value = $this->offsetGet($element);
        if ($this->offsetExists($element)) {
            $this->offsetUnset($element);
        }
        return $value;
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
