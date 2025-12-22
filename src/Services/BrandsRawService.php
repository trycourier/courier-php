<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Brands\Brand;
use Courier\Brands\BrandColors;
use Courier\Brands\BrandCreateParams;
use Courier\Brands\BrandListParams;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSettingsEmail;
use Courier\Brands\BrandSettingsInApp;
use Courier\Brands\BrandSnippet;
use Courier\Brands\BrandSnippets;
use Courier\Brands\BrandUpdateParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\BrandsRawContract;

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
     *   settings?: array{
     *     colors?: array<string,mixed>|BrandColors|null,
     *     email?: array<string,mixed>|BrandSettingsEmail|null,
     *     inapp?: array<string,mixed>|BrandSettingsInApp|null,
     *   }|BrandSettings|null,
     *   snippets?: array{
     *     items?: list<array<string,mixed>|BrandSnippet>|null
     *   }|BrandSnippets|null,
     * }|BrandCreateParams $params
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
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
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
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
     *   settings?: array{
     *     colors?: array<string,mixed>|BrandColors|null,
     *     email?: array<string,mixed>|BrandSettingsEmail|null,
     *     inapp?: array<string,mixed>|BrandSettingsInApp|null,
     *   }|BrandSettings|null,
     *   snippets?: array{
     *     items?: list<array<string,mixed>|BrandSnippet>|null
     *   }|BrandSnippets|null,
     * }|BrandUpdateParams $params
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
     *
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        ?RequestOptions $requestOptions = null
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
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
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
