<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
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
     * Create a new journey. The journey is created in DRAFT state. Use POST /journeys/{templateId}/publish to make it live.
     *
     * @param array{
     *   name: string,
     *   nodes: list<mixed>,
     *   enabled?: bool,
     *   state?: JourneyState|value-of<JourneyState>,
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'journeys',
            body: (object) $parsed,
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
     * Get the list of journeys.
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
     * Archive a journey. Archived journeys cannot be invoked. Existing journey runs continue to completion.
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
     * Invoke a journey run from a journey template.
     *
     * @param string $templateID A unique identifier representing the journey template to be invoked. This could be the Journey Template ID or the Journey Template Alias.
     * @param array{
     *   data?: array<string,mixed>, profile?: array<string,mixed>, userID?: string
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/invoke', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: JourneysInvokeResponse::class,
        );
    }

    /**
     * @api
     *
     * List published versions of a journey, ordered most recent first.
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
     * Publish the current draft as a new version. Optionally rollback to a prior version by passing `{ version: 'vN' }`.
     *
     * @param string $templateID Journey id
     * @param array{version?: string}|JourneyPublishParams $params
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['journeys/%1$s/publish', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: JourneyResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace the journey draft. Updates the working draft only; call POST /journeys/{templateId}/publish to make it live.
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
