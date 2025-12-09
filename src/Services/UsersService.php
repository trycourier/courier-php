<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\UsersContract;
use Courier\Services\Users\PreferencesService;
use Courier\Services\Users\TenantsService;
use Courier\Services\Users\TokensService;

final class UsersService implements UsersContract
{
    /**
     * @api
     */
    public UsersRawService $raw;

    /**
     * @api
     */
    public PreferencesService $preferences;

    /**
     * @api
     */
    public TenantsService $tenants;

    /**
     * @api
     */
    public TokensService $tokens;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new UsersRawService($client);
        $this->preferences = new PreferencesService($client);
        $this->tenants = new TenantsService($client);
        $this->tokens = new TokensService($client);
    }
}
