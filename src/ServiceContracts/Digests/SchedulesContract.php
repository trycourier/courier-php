<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Digests;

use Courier\Core\Exceptions\APIException;
use Courier\Digests\DigestInstanceListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SchedulesContract
{
    /**
     * @api
     *
     * @param string $scheduleID The ID of the digest schedule, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
     * @param string $cursor a cursor token from a previous response, used to fetch the next page of results
     * @param int $limit The maximum number of digest instances to return. Defaults to 20, with a maximum of 100.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listInstances(
        string $scheduleID,
        ?string $cursor = null,
        int $limit = 20,
        RequestOptions|array|null $requestOptions = null,
    ): DigestInstanceListResponse;

    /**
     * @api
     *
     * @param string $scheduleID The ID of the digest schedule to release, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $scheduleID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
