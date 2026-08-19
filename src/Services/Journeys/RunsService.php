<?php

declare(strict_types=1);

namespace Courier\Services\Journeys;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Journeys\JourneyRunListResponse;
use Courier\Journeys\JourneyRunResponse;
use Courier\Journeys\JourneyRunStepsResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Journeys\RunsContract;

/**
 * Build, version, publish, invoke, and cancel multi-step notification workflows, along with the templates scoped to them.
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
     * Fetch one Journey run by id. Returns `404` for an unknown run, a run belonging to another workspace, a run past the 95-day retention window, or an Automation run id — the same body in every case, so the response never reveals whether a run exists elsewhere.
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): JourneyRunResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($runID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List runs of the workspace's Journeys, newest first, filtered by status, Journey, or date range and paged by cursor. Runs of v2 Automations are listed by `GET /automations/runs` instead — the two surfaces never return each other's runs. Runs are retained for 95 days.
     *
     * @param string $cursor A cursor token for pagination. Use the `next_cursor` from the previous response to fetch the next page of results. Treat it as opaque.
     * @param string $endDate an inclusive upper bound on `created_at`, in the same format as `start_date`
     * @param string $limit The number of runs to return per page, between `1` and `50`. Defaults to `20`. Values outside the range are clamped, and a non-numeric value falls back to `20`.
     * @param string $startDate An inclusive lower bound on `created_at`, as an ISO 8601 date or timestamp (e.g. `2026-08-18` or `2026-08-18T20:06:36.259Z`). Any other format returns `400`.
     * @param string $status A comma-separated list of run statuses to filter on, e.g. `PROCESSED,ERROR`.
     * @param string $templateID a comma-separated list of Journey ids to filter on
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
    ): JourneyRunListResponse {
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
     * List the per-node state of one Journey run, in full — this endpoint is not paginated. Each step's `node_id` is the id of the node in the published Journey, so a step maps directly onto the Journey graph. `message_id` is present on send steps that produced a message; follow it to `GET /messages/{message_id}` for delivery status.
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listSteps(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): JourneyRunStepsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listSteps($runID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
