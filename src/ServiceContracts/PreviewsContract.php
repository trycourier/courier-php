<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Previews\DeviceSet;
use Courier\Previews\DeviceSetListResponse;
use Courier\Previews\PreviewDeviceListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface PreviewsContract
{
    /**
     * @api
     *
     * @param string $deviceSetID the preview set to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archiveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): DeviceSet;

    /**
     * @api
     *
     * @param list<string> $deviceIDs The devices the set contains, by `PreviewDevice.id`. At least one is required.
     * @param string $name human-readable name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDeviceSet(
        array $deviceIDs,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceSet;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDeviceSets(
        RequestOptions|array|null $requestOptions = null
    ): DeviceSetListResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDevices(
        RequestOptions|array|null $requestOptions = null
    ): PreviewDeviceListResponse;

    /**
     * @api
     *
     * @param string $deviceSetID the preview set to retrieve, identified by the `id` returned when it was created
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): DeviceSet;

    /**
     * @api
     *
     * @param string $deviceSetID the preview set to replace
     * @param list<string> $deviceIDs The devices the set contains, by `PreviewDevice.id`. At least one is required.
     * @param string $name human-readable name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateDeviceSet(
        string $deviceSetID,
        array $deviceIDs,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): DeviceSet;
}
