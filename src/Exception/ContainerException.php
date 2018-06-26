<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * @class      ContainerException.
 * @extends    Exception.
 * @implements ExceptionInterface.
 * @implements ContainerExceptionInterface.
 */
class ContainerException extends Exception implements ExceptionInterface, ContainerExceptionInterface
{
}
