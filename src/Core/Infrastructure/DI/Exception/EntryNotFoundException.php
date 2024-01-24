<?php

declare(strict_types=1);

namespace Phractico\Core\Infrastructure\DI\Exception;

use Psr\Container\NotFoundExceptionInterface;

class EntryNotFoundException extends \OutOfBoundsException implements NotFoundExceptionInterface
{
}
