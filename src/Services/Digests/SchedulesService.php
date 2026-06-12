<?php

declare(strict_types=1);

namespace Courier\Services\Digests;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Digests\DigestInstanceListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Digests\SchedulesContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class SchedulesService implements SchedulesContract
{
    /**
     * @api
     */
    public SchedulesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SchedulesRawService($client);
    }

    /**
     * @api
     *
     * List the digest instances for a schedule. Each instance represents the events accumulated for a single user against the schedule, and can be used to monitor digest accumulation before the digest is released.
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
    ): DigestInstanceListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listInstances($scheduleID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a digest now instead of waiting for its scheduled time, so your users get what they have collected so far right away.
     *
     * @param string $scheduleID The ID of the digest schedule to release, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function release(
        string $scheduleID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->release($scheduleID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
