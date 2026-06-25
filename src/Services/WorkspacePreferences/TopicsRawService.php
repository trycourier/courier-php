<?php

declare(strict_types=1);

namespace Courier\Services\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferences\TopicsRawContract;
use Courier\WorkspacePreferences\Topics\TopicArchiveParams;
use Courier\WorkspacePreferences\Topics\TopicCreateParams;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\Topics\TopicReplaceParams;
use Courier\WorkspacePreferences\Topics\TopicRetrieveParams;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TopicsRawService implements TopicsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a subscription preference topic inside a workspace preference. Fails with 404 if the workspace preference does not exist. The topic id is generated and returned.
     *
     * @param string $sectionID id of the workspace preference to create the topic in
     * @param array{
     *   defaultStatus: DefaultStatus|value-of<DefaultStatus>,
     *   name: string,
     *   allowedPreferences?: list<AllowedPreference|value-of<AllowedPreference>>|null,
     *   includeUnsubscribeHeader?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     *   topicData?: array<string,mixed>|null,
     * }|TopicCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function create(
        string $sectionID,
        array|TopicCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['preferences/sections/%1$s/topics', $sectionID],
            body: (object) $parsed,
            options: $options,
            convert: WorkspacePreferenceTopicGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a topic within a workspace preference. Returns 404 if the workspace preference does not exist, the topic does not exist, or the topic belongs to a different workspace preference.
     *
     * @param string $topicID id of the subscription preference topic
     * @param array{sectionID: string}|TopicRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $topicID,
        array|TopicRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $sectionID = $parsed['sectionID'];
        unset($parsed['sectionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['preferences/sections/%1$s/topics/%2$s', $sectionID, $topicID],
            options: $options,
            convert: WorkspacePreferenceTopicGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List the topics in a workspace preference.
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['preferences/sections/%1$s/topics', $sectionID],
            options: $requestOptions,
            convert: WorkspacePreferenceTopicListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a topic and remove it from its workspace preference. Same 404 rules as GET.
     *
     * @param string $topicID id of the subscription preference topic
     * @param array{sectionID: string}|TopicArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $topicID,
        array|TopicArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicArchiveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $sectionID = $parsed['sectionID'];
        unset($parsed['sectionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['preferences/sections/%1$s/topics/%2$s', $sectionID, $topicID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Replace a topic within a workspace preference. Full document replacement; missing optional fields are cleared. Same 404 rules as GET.
     *
     * @param string $topicID path param: Id of the subscription preference topic
     * @param array{
     *   sectionID: string,
     *   defaultStatus: TopicReplaceParams\DefaultStatus|value-of<TopicReplaceParams\DefaultStatus>,
     *   name: string,
     *   allowedPreferences?: list<TopicReplaceParams\AllowedPreference|value-of<TopicReplaceParams\AllowedPreference>>|null,
     *   includeUnsubscribeHeader?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     *   topicData?: array<string,mixed>|null,
     * }|TopicReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WorkspacePreferenceTopicGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $topicID,
        array|TopicReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );
        $sectionID = $parsed['sectionID'];
        unset($parsed['sectionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['preferences/sections/%1$s/topics/%2$s', $sectionID, $topicID],
            body: (object) array_diff_key($parsed, array_flip(['sectionID'])),
            options: $options,
            convert: WorkspacePreferenceTopicGetResponse::class,
        );
    }
}
