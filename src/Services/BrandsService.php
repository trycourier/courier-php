<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Brands\Brand;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSnippets;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\BrandsContract;

/**
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BrandsService implements BrandsContract
{
    /**
     * @api
     */
    public BrandsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BrandsRawService($client);
    }

    /**
     * @api
     *
     * Creates a brand from a name and settings, including primary and secondary colors. Brands supply the logo, colors, and styling that templates render with.
     *
     * @param string $name Body param
     * @param BrandSettings|BrandSettingsShape $settings Body param
     * @param string|null $id Body param
     * @param BrandSnippets|BrandSnippetsShape|null $snippets Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        BrandSettings|array $settings,
        ?string $id = null,
        BrandSnippets|array|null $snippets = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'settings' => $settings,
                'id' => $id,
                'snippets' => $snippets,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns one brand by id, including its colors, logo and styling settings, Handlebars snippets, and published version.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): Brand {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($brandID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces a brand with the values you supply, so send the complete settings and snippets rather than only the fields you want changed.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to update
     * @param string $name the name of the brand
     * @param BrandSettings|BrandSettingsShape|null $settings
     * @param BrandSnippets|BrandSnippetsShape|null $snippets
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        string $name,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            ['name' => $name, 'settings' => $settings, 'snippets' => $snippets]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($brandID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists the workspace's brands. Every entry carries its name, styling settings, snippets, and published version.
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): BrandListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes a brand by id. Reassign any template or tenant that references it before deleting to keep their styling intact.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($brandID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
