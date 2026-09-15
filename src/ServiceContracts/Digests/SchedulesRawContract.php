<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Digests;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Digests\DigestInstanceListResponse;
use Courier\Digests\Schedules\ScheduleListInstancesParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SchedulesRawContract
{
    /**
     * @api
     *
     * @param string $scheduleID The ID of the digest schedule, in the form `sch/{uuid}`. The value must be URL-encoded (e.g. `sch%2F00000000-0000-0000-0000-000000000000`).
     * @param array<string,mixed>|ScheduleListInstancesParams $params
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
