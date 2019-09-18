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
interface CollectionInterface
{
    /**
     * Construct a new collection instance.
     *
     * @param array $insert Insert elements and values into the collection.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $insert);

    /**
     * Get the collection container.
     *
     * @return array Returns the collection container.
     */
    public function getContainer(): array;

    /**
     * Get the value associated with the element after unset the element.
     *
     * @param mixed $element The element for the value.
     *
     * @return mixed Returns the value associated to the element.
     */
    public function flash($element);

    /**
     * Clear the container.
     *
     * @return void Returns nothing.
     */
    public function clear(): void;
}
