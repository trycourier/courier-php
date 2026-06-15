<?php

declare(strict_types=1);

namespace Courier\Digests\DigestInstanceListResponse;

/**
 * Always `list` for a paginated list response.
 */
enum Type: string
{
    case LIST = 'list';
}
