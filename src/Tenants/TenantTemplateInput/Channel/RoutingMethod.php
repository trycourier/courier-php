<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantTemplateInput\Channel;

/**
 * Defaults to `single`.
 */
enum RoutingMethod: string
{
    case ALL = 'all';

    case SINGLE = 'single';
}
