<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection;

use ArrayAccess;
use SplObjectStorage;

use function sprintf;

/**
 * This class is a basic dependency injection architect that gets passed to the
 * PSR-11 container for management.
 *
 * This class implements ArrayAccess so you are able to treat this object
 * like an array.
 *
 * @class      Architect.
 * @implements ArchitectInterface.
 * @implements ArrayAccess.
 */
class Architect implements ArchitectInterface, ArrayAccess
{

    /**
     * @var SplObjectStorage $factory The object stoarge.
     * @var SplObjectStorage $protect The object stoarge.
     */
    private $factory;
    private $protect;

    /**
     * @var array $keys   An array of keys.
     * @var array $frozen An array of frozen values.
     * @var array $values An array of values.
     * @var array $raw    An array of raw values.
     * @var array $extend An array of extended values.
     * @var array $lazy   An array of lazy values.
     */
    private $keys   = [];
    private $frozen = [];
    private $values = [];
    private $raw    = [];
    private $extend = [];
    private $lazy   = [];

    /**
     * Initialize a new dependency injection architect.
     *
     * This constructor primarily sets up the object storage so we can start injecting
     * objects into the object stoarge.
     *
     * @param array $values An array of values to inject.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function __construct(array $values = array())
    {
        $this->factory = new SplObjectStorage();
        $this->protect = new SplObjectStorage();
        foreach ($values as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Add something to this architect.
     *
     * Using a key that already exists and is ot frozen will be 
     * altered to the new desired value.
     *
     * @param string $key   The unique key to identify the object or specific value.
     * @param mixed  $value Entry value.
     *
     * @throws Exception\FrozenException **this** key is frozen and cannot be altered.
     *
     * @return void Returns nothing.
     */
    public function offsetSet($key, $value)
    {
        if (isset($this->frozen[$key])) {
            throw new Exception\FrozenException(sprintf('`%s` key is frozen and cannot be altered or retrived.', $key));
        }
        $this->values[$key] = $value;
        $this->keys[$key] = $key;
    }

    /**
     * Check to see if it exists in this architect.
     *
     * @param string $key The unique key to identify the object or specific value.
     *
     * @return bool Returns TRUE if the unique key exists and FALSE if it does not.
     */
    public function offsetExists($key)
    {
        return isset($this->keys[$key]);
    }

    /**
     * Gets a value based on the unique key provided.
     *
     * @param string $key The unique key to identify the object or specific value.
     *
     * @throws Exception\FrozenException     **this** key is frozen and cannot be altered.
     * @throws Exception\IdentifierException No entry was found for **this** identifier.
     *
     * @return mixed The value of the parameter or an object
     */
    public function offsetGet($key)
    {
        if (isset($this->frozen[$key])) {
            throw new Exception\FrozenException(sprintf('`%s` key is frozen and cannot be altered or retrived.', $key));
        } elseif (!isset($this->offsetExists($key))) {
            throw new Exception\IdentifierException(sprintf('No entry was found for `%s` identifier.', $key));
        }
        
    }
}
