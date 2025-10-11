<?php

declare(strict_types=1);

namespace Courier\Core\Conversion\Contracts;

use Courier\Core\Conversion\CoerceState;
use Courier\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
