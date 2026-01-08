<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Brands\Brand;
use Courier\Brands\BrandCreateParams;
use Courier\Brands\BrandListParams;
use Courier\Brands\BrandListResponse;
use Courier\Brands\BrandUpdateParams;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BrandsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BrandCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $brandID a unique identifier associated with the brand you wish to update
     * @param array<string,mixed>|BrandUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
