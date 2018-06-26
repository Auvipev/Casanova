<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * @class      ContainerException.
 * @implements ExceptionInterface.
 * @implements ContainerExceptionInterface.
 */
class ContainerException implements ExceptionInterface, ContainerExceptionInterface
{
}
