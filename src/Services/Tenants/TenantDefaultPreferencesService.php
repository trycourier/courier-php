<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\ServiceContracts\Tenants\TenantDefaultPreferencesContract;
use Courier\Services\Tenants\TenantDefaultPreferences\ItemsService;

final class TenantDefaultPreferencesService implements TenantDefaultPreferencesContract
{
    /**
     * @@api
     */
    public ItemsService $items;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->items = new ItemsService($client);
    }
}
