<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantListResponse;

/**
 * Always set to "list". Represents the type of this object.
 */
enum Type: string
{
    case LIST = 'list';
}
