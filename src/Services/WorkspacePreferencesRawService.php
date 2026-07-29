<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferencesRawContract;
use Courier\WorkspacePreferences\PublishPreferencesResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceCreateParams;
use Courier\WorkspacePreferences\WorkspacePreferenceGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceListResponse;
use Courier\WorkspacePreferences\WorkspacePreferencePublishParams;
use Courier\WorkspacePreferences\WorkspacePreferenceReplaceParams;

/**
 * Manage the workspace catalog of subscription topics, the sections that group them, and publishing the preference page.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class WorkspacePreferencesRawService implements WorkspacePreferencesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a workspace preference and returns its generated id. Add subscription topics to it afterwards with the topics endpoint.
     *
     * @param array{
     *   name: string,
     *   description?: string|null,
     *   hasCustomRouting?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|WorkspacePreferenceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WorkspacePreferenceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkspacePreferenceCreateParams::parseRequest(
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
            path: 'preferences/sections',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: WorkspacePreferenceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns one workspace preference by id, including its subscription topics, routing options, and custom routing flag.
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['preferences/sections/%1$s', $sectionID],
            options: $requestOptions,
            convert: WorkspacePreferenceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns the workspace's preferences, each embedding its subscription topics, routing options, and whether custom routing is allowed.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'preferences/sections',
            options: $requestOptions,
            convert: WorkspacePreferenceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a workspace preference. The workspace preference must be empty: delete its topics first, otherwise the request fails with 409.
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['preferences/sections/%1$s', $sectionID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Publishes the workspace preference page, snapshotting every preference and topic, and returns the page id and a preview URL.
     *
     * @param array{
     *   brandID?: string|null,
     *   description?: string|null,
     *   heading?: string|null,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|WorkspacePreferencePublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PublishPreferencesResponse>
     *
     * @throws APIException
     */
    public function publish(
        array|WorkspacePreferencePublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkspacePreferencePublishParams::parseRequest(
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
            path: 'preferences/publish',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: PublishPreferencesResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace a workspace preference. Full document replacement; missing optional fields are cleared. Topics attached to the workspace preference are unaffected.
     *
     * @param string $sectionID id of the workspace preference
     * @param array{
     *   name: string,
     *   description?: string|null,
     *   hasCustomRouting?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     * }|WorkspacePreferenceReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        array|WorkspacePreferenceReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WorkspacePreferenceReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['preferences/sections/%1$s', $sectionID],
            body: (object) $parsed,
            options: $options,
            convert: WorkspacePreferenceGetResponse::class,
        );
    }
}
