<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Automations;

use Courier\Automations\AutomationRunListResponse;
use Courier\Automations\AutomationRunStepsResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RunsContract
{
    /**
     * @api
     *
     * @param string $cursor A cursor token for pagination. Use the `next_cursor` from the previous response to fetch the next page of results. Treat it as opaque.
     * @param string $endDate an inclusive upper bound on `created_at`, in the same format as `start_date`
     * @param string $limit The number of runs to return per page, between `1` and `50`. Defaults to `20`. Values outside the range are clamped, and a non-numeric value falls back to `20`.
     * @param string $startDate An inclusive lower bound on `created_at`, as an ISO 8601 date or timestamp (e.g. `2026-08-18` or `2026-08-18T20:06:36.259Z`). Any other format returns `400`.
     * @param string $status A comma-separated list of run statuses to filter on, e.g. `PROCESSED,ERROR`.
     * @param string $templateID a comma-separated list of Automation Template ids to filter on
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $endDate = null,
        ?string $limit = null,
        ?string $startDate = null,
        ?string $status = null,
        ?string $templateID = null,
        RequestOptions|array|null $requestOptions = null,
    ): AutomationRunListResponse;

    /**
     * @api
     *
     * @param string $id a unique identifier representing the Automation run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listSteps(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AutomationRunStepsResponse;
}
