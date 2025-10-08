<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Brand;
use Courier\Brands\BrandListResponse;
use Courier\BrandSettings;
use Courier\BrandSnippets;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface BrandsContract
{
    /**
     * @api
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
    ): Brand;

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
    ): Brand;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @api
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
    ): Brand;

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
    ): Brand;

    /**
     * @api
     *
     * @param string|null $cursor a unique identifier that allows for fetching the next set of brands
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): BrandListResponse;

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
    ): BrandListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $brandID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
