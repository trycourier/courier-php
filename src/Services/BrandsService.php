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
use Courier\ServiceContracts\BrandsContract;

final class BrandsService implements BrandsContract
{
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
     *     colors?: array<mixed>|BrandColors|null,
     *     email?: array<mixed>|BrandSettingsEmail|null,
     *     inapp?: array<mixed>|BrandSettingsInApp|null,
     *   }|BrandSettings|null,
     *   snippets?: array{
     *     items?: list<array<mixed>|BrandSnippet>|null
     *   }|BrandSnippets|null,
     * }|BrandCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Brand {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a specific brand by brand ID.
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): Brand {
        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'get',
            path: ['brands/%1$s', $brandID],
            options: $requestOptions,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace an existing brand with the supplied values.
     *
     * @param array{
     *   name: string,
     *   settings?: array{
     *     colors?: array<mixed>|BrandColors|null,
     *     email?: array<mixed>|BrandSettingsEmail|null,
     *     inapp?: array<mixed>|BrandSettingsInApp|null,
     *   }|BrandSettings|null,
     *   snippets?: array{
     *     items?: list<array<mixed>|BrandSnippet>|null
     *   }|BrandSnippets|null,
     * }|BrandUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'put',
            path: ['brands/%1$s', $brandID],
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the list of brands.
     *
     * @param array{cursor?: string|null}|BrandListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        [$parsed, $options] = BrandListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<BrandListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'brands',
            query: $parsed,
            options: $options,
            convert: BrandListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a brand by brand ID.
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['brands/%1$s', $brandID],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }
}
