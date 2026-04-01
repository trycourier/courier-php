<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Providers\Provider;
use Courier\Providers\ProviderCreateParams;
use Courier\Providers\ProviderListParams;
use Courier\Providers\ProviderListResponse;
use Courier\Providers\ProviderUpdateParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ProvidersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProviderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function create(
        array|ProviderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration to update
     * @param array<string,mixed>|ProviderUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProviderUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProviderListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProviderListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProviderListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
