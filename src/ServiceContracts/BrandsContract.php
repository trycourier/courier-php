<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Brands\Brand;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandSettings;
use Courier\Brands\BrandSnippets;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface BrandsContract
{
    /**
     * @api
     *
     * @param string $name the name of the brand
     * @param BrandSettings $settings
     * @param string|null $id
     * @param BrandSnippets|null $snippets
     *
     * @return Brand<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $name,
        $settings,
        $id = omit,
        $snippets = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return Brand<HasRawResponse>
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
     * @return Brand<HasRawResponse>
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
     * @return Brand<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $brandID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @api
     *
     * @param string $name the name of the brand
     * @param BrandSettings|null $settings
     * @param BrandSnippets|null $snippets
     *
     * @return Brand<HasRawResponse>
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
     * @return Brand<HasRawResponse>
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
     * @return BrandListResponse<HasRawResponse>
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
     * @return BrandListResponse<HasRawResponse>
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

    /**
     * @api
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $brandID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
