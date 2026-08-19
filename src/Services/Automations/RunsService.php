<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationRunListResponse;
use Courier\Automations\AutomationRunStepsResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\RunsContract;

/**
 * Invoke a stored automation template or an ad hoc automation defined in the request.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RunsService implements RunsContract
{
    /**
     * @api
     */
    public RunsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RunsRawService($client);
    }

    /**
     * @api
     *
     * List runs of the workspace's v2 Automations, newest first, filtered by status, Template, or date range and paged by cursor. Journey (v3) runs are listed by `GET /journeys/runs` instead — the two surfaces never return each other's runs. Runs are retained for 95 days.
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
    ): AutomationRunListResponse {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'endDate' => $endDate,
                'limit' => $limit,
                'startDate' => $startDate,
                'status' => $status,
                'templateID' => $templateID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the per-step state of one Automation run, in full — this endpoint is not paginated. `message_id` is present on send steps that produced a message; follow it to `GET /messages/{message_id}` for delivery status. A send to a List or an Audience yields one `message_id` for the request, not one per recipient.
     *
     * @param string $id a unique identifier representing the Automation run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listSteps(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AutomationRunStepsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listSteps($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
