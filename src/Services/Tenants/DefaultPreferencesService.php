<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\ServiceContracts\Tenants\DefaultPreferencesContract;
use Courier\Services\Tenants\DefaultPreferences\ItemsService;

final class DefaultPreferencesService implements DefaultPreferencesContract
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
