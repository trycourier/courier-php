<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Brands\Brand;
use Courier\Brands\BrandCreateParams;
use Courier\Brands\BrandListParams;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandUpdateParams;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface BrandsContract
{
    /**
     * @api
     *
     * @param array<mixed>|BrandCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
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
     * @param array<mixed>|BrandUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $brandID,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param array<mixed>|BrandListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
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
