<?php

declare(strict_types=1);

namespace Courier\Digests\DigestCategory;

/**
 * Which events to keep when the number of events exceeds the retention limit for the category.
 */
enum Retain: string
{
    case FIRST = 'first';

    case LAST = 'last';

    case HIGHEST = 'highest';

    case LOWEST = 'lowest';

    case NONE = 'none';
}
