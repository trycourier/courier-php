<?php

declare(strict_types=1);

namespace Courier\Services\Digests;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Digests\DigestInstanceListResponse;
use Courier\Digests\Schedules\ScheduleListInstancesParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\Digests\SchedulesRawContract;

/**
 * Inspect what has accumulated in a digest schedule and release a digest ahead of its next scheduled delivery.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class SchedulesRawService implements SchedulesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the digest instances for a schedule, one per user, with cursor paging. Use it to see what has accumulated before a digest releases.
     *
     * @param string $scheduleID The ID of the digest schedule, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
     * @param array{cursor?: string, limit?: int}|ScheduleListInstancesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DigestInstanceListResponse>
     *
     * @throws APIException
     */
    public function listInstances(
        string $scheduleID,
        array|ScheduleListInstancesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ScheduleListInstancesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['digests/schedules/%1$s/instances', $scheduleID],
            query: $parsed,
            options: $options,
            convert: DigestInstanceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Send a digest now instead of waiting for its scheduled time, so your users get what they have collected so far right away.
     *
     * @param string $scheduleID The ID of the digest schedule to release. Newer schedules are `sch_01m26xfcn3endt3nxy4e2kx2rh` and need no encoding. Schedules created before that format are `sch/{uuid}` and contain a literal `/`, so those must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`). Both forms remain valid; existing ids are never migrated.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function release(
        string $scheduleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['digests/schedules/%1$s/trigger', $scheduleID],
            options: $requestOptions,
            convert: null,
        );
    }
}
