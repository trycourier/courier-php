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
     * Create a new brand
     *
     * @param BrandSettings|BrandSettingsShape|null $settings
     * @param BrandSnippets|BrandSnippetsShape|null $snippets
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $id = null,
        BrandSettings|array|null $settings = null,
        BrandSnippets|array|null $snippets = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'id' => $id,
                'settings' => $settings,
                'snippets' => $snippets,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a specific brand by brand ID.
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
     * Replace an existing brand with the supplied values.
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
     * Get the list of brands.
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
     * Delete a brand by brand ID.
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
