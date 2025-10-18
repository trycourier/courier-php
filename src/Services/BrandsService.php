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
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\BrandsContract;

use const Courier\Core\OMIT as omit;

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
     * @param string $name
     * @param string|null $id
     * @param BrandSettings|null $settings
     * @param BrandSnippets|null $snippets
     *
     * @throws APIException
     */
    public function create(
        $name,
        $id = omit,
        $settings = omit,
        $snippets = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        $params = [
            'name' => $name,
            'id' => $id,
            'settings' => $settings,
            'snippets' => $snippets,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): Brand {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): Brand {
        // @phpstan-ignore-next-line;
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
     * @param string $name the name of the brand
     * @param BrandSettings|null $settings
     * @param BrandSnippets|null $snippets
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        $name,
        $settings = omit,
        $snippets = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        $params = [
            'name' => $name, 'settings' => $settings, 'snippets' => $snippets,
        ];

        return $this->updateRaw($brandID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $brandID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): Brand {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        $params = ['cursor' => $cursor];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        [$parsed, $options] = BrandListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['brands/%1$s', $brandID],
            options: $requestOptions,
            convert: null,
        );
    }
}
