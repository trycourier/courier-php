<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Auth\AuthIssueTokenResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AuthContract;

final class AuthService implements AuthContract
{
    /**
     * @api
     */
    public AuthRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AuthRawService($client);
    }

    /**
     * @api
     *
     * Returns a new access token.
     *
     * @param string $expiresIn Duration for token expiration. Accepts various time formats:
     * - "2 hours" - 2 hours from now
     * - "1d" - 1 day
     * - "3 days" - 3 days
     * - "10h" - 10 hours
     * - "2.5 hrs" - 2.5 hours
     * - "1m" - 1 minute
     * - "5s" - 5 seconds
     * - "1y" - 1 year
     * @param string $scope Available scopes:
     * - `user_id:<user-id>` - Defines which user the token will be scoped to. Multiple can be listed if needed. Ex `user_id:pigeon user_id:bluebird`.
     * - `read:messages` - Read messages.
     * - `read:user-tokens` - Read user push tokens.
     * - `write:user-tokens` - Write user push tokens.
     * - `read:brands[:<brand_id>]` - Read brands, optionally restricted to a specific brand_id. Examples `read:brands`, `read:brands:my_brand`.
     * - `write:brands[:<brand_id>]` - Write brands, optionally restricted to a specific brand_id. Examples `write:brands`, `write:brands:my_brand`.
     * - `inbox:read:messages` - Read inbox messages.
     * - `inbox:write:events` - Write inbox events, such as mark message as read.
     * - `read:preferences` - Read user preferences.
     * - `write:preferences` - Write user preferences.
     * Example: `user_id:user123 write:user-tokens inbox:read:messages inbox:write:events read:preferences write:preferences read:brands`
     *
     * @throws APIException
     */
    public function issueToken(
        string $expiresIn,
        string $scope,
        ?RequestOptions $requestOptions = null
    ): AuthIssueTokenResponse {
        $params = ['expiresIn' => $expiresIn, 'scope' => $scope];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->issueToken(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
