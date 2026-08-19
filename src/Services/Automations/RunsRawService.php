<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationRunListResponse;
use Courier\Automations\AutomationRunStepsResponse;
use Courier\Automations\Runs\RunListParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\RunsRawContract;

/**
 * Invoke a stored automation template or an ad hoc automation defined in the request.
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
     * List runs of the workspace's v2 Automations, newest first, filtered by status, Template, or date range and paged by cursor. Journey (v3) runs are listed by `GET /journeys/runs` instead — the two surfaces never return each other's runs. Runs are retained for 95 days.
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
     * @return BaseResponse<AutomationRunListResponse>
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
            path: 'automations/runs',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'endDate' => 'end_date',
                    'startDate' => 'start_date',
                    'templateID' => 'template_id',
                ],
            ),
            options: $options,
            convert: AutomationRunListResponse::class,
        );
    }

    /**
     * @api
     *
     * List the per-step state of one Automation run, in full — this endpoint is not paginated. `message_id` is present on send steps that produced a message; follow it to `GET /messages/{message_id}` for delivery status. A send to a List or an Audience yields one `message_id` for the request, not one per recipient.
     *
     * @param string $id a unique identifier representing the Automation run
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationRunStepsResponse>
     *
     * @throws APIException
     */
    public function listSteps(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['automations/runs/%1$s/steps', $id],
            options: $requestOptions,
            convert: AutomationRunStepsResponse::class,
        );
    }
}
