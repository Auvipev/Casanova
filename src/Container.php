<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection;

use Psr\Container\ContainerInterface;

use function sprintf;

/**
 * A PSR-11 compliant container.
 *
 * @class      Container.
 * @implements ContainerInterface.
 */
class Container implements ContainerInterface
{

    /**
     * @var Architect $architect The container architect.
     */
    private $architect;

    /**
     * Bind the architect to the PSR-11 container.
     *
     * @param Architect $architect The container architect.
     *
     * @return void Returns nothing.
     *
     * @codeCoverageIgnore.
     */
    public function __construct(ArchitectInterface $architect)
    {
        $this->architect = $architect;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws Exception\IdentifierException No entry was found for **this** identifier.
     * @throws Exception\ValueException      Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if ($this->has($id)) {
            /** $this->architect[$id] Possibly throws Exception\ValueException */
            return $this->architect[$id];
        }
        throw new Exception\IdentifierException(sprintf('No entry was found for `%s` identifier.', $id));
    }

    /**
     * Checks to see if any given identifier exists.
     *
     * has($id) returning true does not mean that get($id) will not throw an exception.
     * It does however mean that get($id) will not throw a Exception\IdentifierException.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool Returns TRUE if the container can return an entry for the given identifier
     *              and returns FALSE otherwise.
     */
    public function has($id)
    {
        return isset($this->architect[$id]);
    }
}
