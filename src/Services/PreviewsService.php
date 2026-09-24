<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Previews\DeviceSet;
use Courier\Previews\DeviceSetListResponse;
use Courier\Previews\PreviewDeviceListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\PreviewsContract;

/**
 * Render a template's email content on real email clients and read back the screenshots, so you can check how it looks before you send it.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class PreviewsService implements PreviewsContract
{
    /**
     * @api
     */
    public PreviewsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreviewsRawService($client);
    }

    /**
     * @api
     *
     * Archive a device set. This is a soft delete — the archived set is returned and no longer appears in list results. Runs already created against it keep their own copy of the device list and are unaffected. The Courier-provided default set cannot be archived and returns 409.
     *
     * @param string $deviceSetID the preview set to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archiveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): DeviceSet {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archiveDeviceSet($deviceSetID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a named, reusable set of preview devices. Every id must be one listed by `GET /previews/devices`; any other is a 422.
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
    ): DeviceSet {
        $params = Util::removeNulls(['deviceIDs' => $deviceIDs, 'name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDeviceSet(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the workspace's preview sets. Archived sets are not returned.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDeviceSets(
        RequestOptions|array|null $requestOptions = null
    ): DeviceSetListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDeviceSets(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the devices a preview can be rendered on. Reference data, identical for every workspace — these ids are what a device set is built from and what a run reports results for.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listDevices(
        RequestOptions|array|null $requestOptions = null
    ): PreviewDeviceListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listDevices(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a preview set by ID. Archived sets return 404.
     *
     * @param string $deviceSetID the preview set to retrieve, identified by the `id` returned when it was created
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveDeviceSet(
        string $deviceSetID,
        RequestOptions|array|null $requestOptions = null
    ): DeviceSet {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveDeviceSet($deviceSetID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a device set. This is a full replace, not a patch — both the name and the device list are always written. The Courier-provided default set cannot be changed and returns 409.
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
    ): DeviceSet {
        $params = Util::removeNulls(['deviceIDs' => $deviceIDs, 'name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateDeviceSet($deviceSetID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
