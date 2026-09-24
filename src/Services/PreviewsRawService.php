<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Previews\DeviceSet;
use Courier\Previews\DeviceSetListResponse;
use Courier\Previews\PreviewCreateDeviceSetParams;
use Courier\Previews\PreviewDeviceListResponse;
use Courier\Previews\PreviewUpdateDeviceSetParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\PreviewsRawContract;

/**
 * Render a template's email content on real email clients and read back the screenshots, so you can check how it looks before you send it.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class PreviewsRawService implements PreviewsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Archive a device set. This is a soft delete — the archived set is returned and no longer appears in list results. Runs already created against it keep their own copy of the device list and are unaffected. The Courier-provided default set cannot be archived and returns 409.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['previews/device-sets/%1$s', $deviceSetID],
            options: $requestOptions,
            convert: DeviceSet::class,
        );
    }

    /**
     * @api
     *
     * Create a named, reusable set of preview devices. Every id must be one listed by `GET /previews/devices`; any other is a 422.
     *
     * @param array{
     *   deviceIDs: list<string>, name: string
     * }|PreviewCreateDeviceSetParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSet>
     *
     * @throws APIException
     */
    public function createDeviceSet(
        array|PreviewCreateDeviceSetParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreviewCreateDeviceSetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'previews/device-sets',
            body: (object) $parsed,
            options: $options,
            convert: DeviceSet::class,
        );
    }

    /**
     * @api
     *
     * List the workspace's preview sets. Archived sets are not returned.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DeviceSetListResponse>
     *
     * @throws APIException
     */
    public function listDeviceSets(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'previews/device-sets',
            options: $requestOptions,
            convert: DeviceSetListResponse::class,
        );
    }

    /**
     * @api
     *
     * List the devices a preview can be rendered on. Reference data, identical for every workspace — these ids are what a device set is built from and what a run reports results for.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreviewDeviceListResponse>
     *
     * @throws APIException
     */
    public function listDevices(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'previews/devices',
            options: $requestOptions,
            convert: PreviewDeviceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a preview set by ID. Archived sets return 404.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['previews/device-sets/%1$s', $deviceSetID],
            options: $requestOptions,
            convert: DeviceSet::class,
        );
    }

    /**
     * @api
     *
     * Replace a device set. This is a full replace, not a patch — both the name and the device list are always written. The Courier-provided default set cannot be changed and returns 409.
     *
     * @param string $deviceSetID the preview set to replace
     * @param array{
     *   deviceIDs: list<string>, name: string
     * }|PreviewUpdateDeviceSetParams $params
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
    ): BaseResponse {
        [$parsed, $options] = PreviewUpdateDeviceSetParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['previews/device-sets/%1$s', $deviceSetID],
            body: (object) $parsed,
            options: $options,
            convert: DeviceSet::class,
        );
    }
}
