<?php

declare(strict_types=1);

namespace Courier\Services\Providers;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Providers\Catalog\CatalogListParams;
use Courier\Providers\Catalog\CatalogListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Providers\CatalogRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class CatalogRawService implements CatalogRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the catalog of available provider types with their display names, descriptions, and configuration schema fields (snake_case, with `type` and `required`). Providers with no configurable schema return only `provider`, `name`, and `description`.
     *
     * @param array{
     *   channel?: string, keys?: string, name?: string
     * }|CatalogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CatalogListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CatalogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CatalogListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'providers/catalog',
            query: $parsed,
            options: $options,
            convert: CatalogListResponse::class,
        );
    }
}
