<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferencesRawContract;
use Courier\WorkspacePreferences\PublishPreferencesResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceCreateParams;
use Courier\WorkspacePreferences\WorkspacePreferenceGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceListResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceReplaceParams;

/**
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
     * Create a workspace preference. The workspace preference id is generated and returned. Topics are created inside a workspace preference via POST /preferences/sections/{section_id}/topics.
     *
     * @param array{
     *   name: string,
     *   hasCustomRouting?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'preferences/sections',
            body: (object) $parsed,
            options: $options,
            convert: WorkspacePreferenceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a workspace preference by id, including its topics.
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
     * List the workspace's preferences. Each workspace preference embeds its topics. Scoped to the workspace of the API key.
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
     * Publish the workspace's preferences page. Takes a snapshot of every workspace preference with its topics under a new published version, making the current state visible on the hosted preferences page (non-draft).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PublishPreferencesResponse>
     *
     * @throws APIException
     */
    public function publish(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'preferences/publish',
            options: $requestOptions,
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
