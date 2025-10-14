<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantDefaultPreferences\Items\ItemUpdateParams;

enum Status: string
{
    case OPTED_OUT = 'OPTED_OUT';

    case OPTED_IN = 'OPTED_IN';

    case REQUIRED = 'REQUIRED';
}
