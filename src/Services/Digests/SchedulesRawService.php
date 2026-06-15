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
     * List the digest instances for a schedule. Each instance represents the events accumulated for a single user against the schedule, and can be used to monitor digest accumulation before the digest is released.
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
     * @param string $scheduleID The ID of the digest schedule to release, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
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
