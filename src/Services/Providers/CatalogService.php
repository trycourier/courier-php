<?php

declare(strict_types=1);

namespace Courier\Services\Providers;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Providers\Catalog\CatalogListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Providers\CatalogContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class CatalogService implements CatalogContract
{
    /**
     * @api
     */
    public CatalogRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CatalogRawService($client);
    }

    /**
     * @api
     *
     * Returns the catalog of available provider types with their display names, descriptions, and configuration schema fields (snake_case, with `type` and `required`). Providers with no configurable schema return only `provider`, `name`, and `description`.
     *
     * @param string $channel Exact match (case-insensitive) against the provider channel taxonomy (e.g. `email`, `sms`, `push`).
     * @param string $keys Comma-separated provider keys to filter by (e.g. `sendgrid,twilio`).
     * @param string $name case-insensitive substring match against the provider display name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $channel = null,
        ?string $keys = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): CatalogListResponse {
        $params = Util::removeNulls(
            ['channel' => $channel, 'keys' => $keys, 'name' => $name]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
