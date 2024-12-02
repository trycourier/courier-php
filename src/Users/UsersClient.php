<?php

namespace Courier\Users;

use Courier\Users\Preferences\PreferencesClient;
use Courier\Users\Tenants\TenantsClient;
use Courier\Users\Tokens\TokensClient;
use Courier\Core\Client\RawClient;

class UsersClient
{
    /**
     * @var PreferencesClient $preferences
     */
    public PreferencesClient $preferences;

    /**
     * @var TenantsClient $tenants
     */
    public TenantsClient $tenants;

    /**
     * @var TokensClient $tokens
     */
    public TokensClient $tokens;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     */
    public function __construct(
        RawClient $client,
    ) {
        $this->client = $client;
        $this->preferences = new PreferencesClient($this->client);
        $this->tenants = new TenantsClient($this->client);
        $this->tokens = new TokensClient($this->client);
    }
}
