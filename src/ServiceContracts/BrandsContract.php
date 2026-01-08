<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Brands\Brand;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSnippets;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type BrandSettingsShape from \Courier\Brands\BrandSettings
 * @phpstan-import-type BrandSnippetsShape from \Courier\Brands\BrandSnippets
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BrandsContract
{
    /**
     * @api
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
    ): Brand;

    /**
     * @api
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): Brand;

    /**
     * @api
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
    ): Brand;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): BrandListResponse;

    /**
     * @api
     *
     * @param string $brandID a unique identifier associated with the brand you wish to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
