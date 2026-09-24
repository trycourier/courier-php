<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Previews\DeviceSet;
use Courier\Previews\DeviceSetListResponse;
use Courier\Previews\PreviewCreateDeviceSetParams;
use Courier\Previews\PreviewDeviceListResponse;
use Courier\Previews\PreviewUpdateDeviceSetParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface PreviewsRawContract
{
    /**
     * @api
     *
     * @param string $deviceSetID the preview set to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSet>
     *
     * @throws APIException
     */
    public function archiveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PreviewCreateDeviceSetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSet>
     *
     * @throws APIException
     */
    public function createDeviceSet(
        array|PreviewCreateDeviceSetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSetListResponse>
     *
     * @throws APIException
     */
    public function listDeviceSets(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreviewDeviceListResponse>
     *
     * @throws APIException
     */
    public function listDevices(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $deviceSetID the preview set to retrieve, identified by the `id` returned when it was created
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSet>
     *
     * @throws APIException
     */
    public function retrieveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $deviceSetID the preview set to replace
     * @param array<string,mixed>|PreviewUpdateDeviceSetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSet>
     *
     * @throws APIException
     */
    public function updateDeviceSet(
        string $deviceSetID,
        array|PreviewUpdateDeviceSetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
