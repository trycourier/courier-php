<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Brands\Brand;
use Courier\Brands\BrandCreateParams;
use Courier\Brands\BrandListParams;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSnippets;
use Courier\Brands\BrandUpdateParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\BrandsRawContract;

/**
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BrandsRawService implements BrandsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new brand
     *
     * @param array{
     *   name: string,
     *   id?: string|null,
     *   settings?: BrandSettings|BrandSettingsShape|null,
     *   snippets?: BrandSnippets|BrandSnippetsShape|null,
     * }|BrandCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * Fetch a specific brand by brand ID.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['brands/%1$s', $brandID],
            options: $requestOptions,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * Replace an existing brand with the supplied values.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to update
     * @param array{
     *   name: string,
     *   settings?: BrandSettings|BrandSettingsShape|null,
     *   snippets?: BrandSnippets|BrandSnippetsShape|null,
     * }|BrandUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        array|BrandUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['brands/%1$s', $brandID],
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * Get the list of brands.
     *
     * @param array{cursor?: string|null}|BrandListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brands',
            query: $parsed,
            options: $options,
            convert: BrandListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a brand by brand ID.
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['brands/%1$s', $brandID],
            options: $requestOptions,
            convert: null,
        );
    }
}
