<?php

declare(strict_types=1);

namespace Courier\Services\Journeys;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Journeys\JourneyRunListResponse;
use Courier\Journeys\JourneyRunResponse;
use Courier\Journeys\JourneyRunStepsResponse;
use Courier\Journeys\Runs\RunListParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\Journeys\RunsRawContract;

/**
 * Build, version, publish, invoke, and cancel multi-step notification workflows, along with the templates scoped to them.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RunsRawService implements RunsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch one Journey run by id. Returns `404` for an unknown run, a run belonging to another workspace, a run past the 95-day retention window, or an Automation run id — the same body in every case, so the response never reveals whether a run exists elsewhere.
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/runs/%1$s', $runID],
            options: $requestOptions,
            convert: JourneyRunResponse::class,
        );
    }

    /**
     * @api
     *
     * List runs of the workspace's Journeys, newest first, filtered by status, Journey, or date range and paged by cursor. Runs of v2 Automations are listed by `GET /automations/runs` instead — the two surfaces never return each other's runs. Runs are retained for 95 days.
     *
     * @param array{
     *   cursor?: string,
     *   endDate?: string,
     *   limit?: string,
     *   startDate?: string,
     *   status?: string,
     *   templateID?: string,
     * }|RunListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RunListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'journeys/runs',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'endDate' => 'end_date',
                    'startDate' => 'start_date',
                    'templateID' => 'template_id',
                ],
            ),
            options: $options,
            convert: JourneyRunListResponse::class,
        );
    }

    /**
     * @api
     *
     * List the per-node state of one Journey run, in full — this endpoint is not paginated. Each step's `node_id` is the id of the node in the published Journey, so a step maps directly onto the Journey graph. `message_id` is present on send steps that produced a message; follow it to `GET /messages/{message_id}` for delivery status.
     *
     * @param string $runID a unique identifier representing the Journey run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyRunStepsResponse>
     *
     * @throws APIException
     */
    public function listSteps(
        string $runID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/runs/%1$s/steps', $runID],
            options: $requestOptions,
            convert: JourneyRunStepsResponse::class,
        );
    }
}
