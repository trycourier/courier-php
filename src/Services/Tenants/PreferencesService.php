<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\ServiceContracts\Tenants\PreferencesContract;
use Courier\Services\Tenants\Preferences\ItemsService;

final class PreferencesService implements PreferencesContract
{
    /**
     * @api
     */
    public PreferencesRawService $raw;

    /**
     * @api
     */
    public ItemsService $items;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreferencesRawService($client);
        $this->items = new ItemsService($client);
    }
}
