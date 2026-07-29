<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Journeys\CancelJourneyResponse;
use Courier\Journeys\CancelJourneyResponse\RunIDBranch;
use Courier\Journeys\CancelJourneyResponse\TokenBranch;
use Courier\Journeys\JourneyCancelParams;
use Courier\Journeys\JourneyCreateParams;
use Courier\Journeys\JourneyInvokeParams;
use Courier\Journeys\JourneyListParams;
use Courier\Journeys\JourneyListParams\Version;
use Courier\Journeys\JourneyPublishParams;
use Courier\Journeys\JourneyReplaceParams;
use Courier\Journeys\JourneyResponse;
use Courier\Journeys\JourneyRetrieveParams;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\Journeys\JourneyState;
use Courier\Journeys\JourneyVersionsListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\JourneysRawContract;

/**
 * Build, version, publish, invoke, and cancel multi-step notification workflows, along with the templates scoped to them.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class JourneysRawService implements JourneysRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a journey from a set of nodes, in draft state unless you pass a published state. Send nodes cannot be included until their templates exist.
     *
     * @param array{
     *   name: string,
     *   nodes: list<mixed>,
     *   enabled?: bool,
     *   state?: JourneyState|value-of<JourneyState>,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|JourneyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function create(
        array|JourneyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'journeys',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: JourneyResponse::class,
        );
    }

    /**
     * @api
     *
     * Fetch a journey by id. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` to retrieve a historical version.
     *
     * @param string $templateID Journey id
     * @param array{version?: string}|JourneyRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        array|JourneyRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/%1$s', $templateID],
            query: $parsed,
            options: $options,
            convert: JourneyResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists the workspace's journeys, each carrying a name, state, and enabled flag. Paged by cursor.
     *
     * @param array{
     *   cursor?: string, version?: Version|value-of<Version>
     * }|JourneyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|JourneyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'journeys',
            query: $parsed,
            options: $options,
            convert: JourneysListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archives a journey so it can no longer be invoked. Runs already in flight continue to completion, so archiving never strands a user mid-sequence.
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['journeys/%1$s', $templateID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Cancels in-flight journey runs, either every run sharing a cancelation token or one run by id. Use it to stop a sequence when the event resolves.
     *
     * @param array{
     *   cancelationToken: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     *   runID: string,
     * }|JourneyCancelParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TokenBranch|RunIDBranch>
     *
     * @throws APIException
     */
    public function cancel(
        array|JourneyCancelParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyCancelParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'journeys/cancel',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: CancelJourneyResponse::class,
        );
    }

    /**
     * @api
     *
     * Starts a journey run for one user and returns a runId. Runs execute asynchronously, so the response arrives before any message is sent.
     *
     * @param string $templateID Path param: A unique identifier representing the journey to be invoked. Accepts a Journey ID or Journey Alias.
     * @param array{
     *   data?: array<string,mixed>,
     *   profile?: array<string,mixed>,
     *   userID?: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|JourneyInvokeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneysInvokeResponse>
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        array|JourneyInvokeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyInvokeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/invoke', $templateID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: JourneysInvokeResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists a journey's published versions, most recent first, so you have a version id to roll back to. Paged by cursor.
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyVersionsListResponse>
     *
     * @throws APIException
     */
    public function listVersions(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['journeys/%1$s/versions', $templateID],
            options: $requestOptions,
            convert: JourneyVersionsListResponse::class,
        );
    }

    /**
     * @api
     *
     * Publishes a journey's current draft as a new version, making it live for new runs. Pass a version instead to roll back to an earlier one.
     *
     * @param string $templateID Path param: Journey id
     * @param array{
     *   version?: string, idempotencyKey?: string, xIdempotencyExpiration?: string
     * }|JourneyPublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        array|JourneyPublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyPublishParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/publish', $templateID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: JourneyResponse::class,
        );
    }

    /**
     * @api
     *
     * Replaces a journey's working draft, leaving the published version live until you publish. Reach for this when editing a journey already running.
     *
     * @param string $templateID Journey id
     * @param array{
     *   name: string,
     *   nodes: list<mixed>,
     *   enabled?: bool,
     *   state?: JourneyState|value-of<JourneyState>,
     * }|JourneyReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<JourneyResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        array|JourneyReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = JourneyReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['journeys/%1$s', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: JourneyResponse::class,
        );
    }
}
