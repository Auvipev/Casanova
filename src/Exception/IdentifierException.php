<?php
declare(strict_types=1);
/**
 * Casanova - A PSR-11 compliant dependency injection container library.
 */

namespace Casanova\DependencyInjection\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * @class      IdentifierException.
 * @implements ExceptionInterface.
 * @implements NotFoundExceptionInterface.
 */
class IdentifierException implements ExceptionInterface, NotFoundExceptionInterface
{
}
