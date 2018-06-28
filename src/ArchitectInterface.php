<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection;

/**
 * This class is a basic dependency injection architect that gets passed to the
 * PSR-11 container for management.
 *
 * @interface ArchitectInterface.
 */
interface ArchitectInterface
{

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
    public function __construct(array $values = array());
}
