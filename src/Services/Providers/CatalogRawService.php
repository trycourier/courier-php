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
 * Configure the channel providers Courier delivers through, and browse the provider types it supports.
 *
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
     * Returns the provider types Courier supports, each with a display name, description, and the configuration fields it requires.
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
