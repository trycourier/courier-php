<?php

namespace Courier\Users;

use Courier\Users\Preferences\PreferencesClient;
use Courier\Users\Tenants\TenantsClient;
use Courier\Users\Tokens\TokensClient;
use GuzzleHttp\ClientInterface;
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
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
        $this->preferences = new PreferencesClient($this->client, $this->options);
        $this->tenants = new TenantsClient($this->client, $this->options);
        $this->tokens = new TokensClient($this->client, $this->options);
    }
}
