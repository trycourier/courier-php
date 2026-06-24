<?php

declare(strict_types=1);

namespace Courier\Services\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceSections\PreferenceTopicGetResponse;
use Courier\PreferenceSections\PreferenceTopicListResponse;
use Courier\PreferenceSections\Topics\TopicArchiveParams;
use Courier\PreferenceSections\Topics\TopicCreateParams;
use Courier\PreferenceSections\Topics\TopicCreateParams\AllowedPreference;
use Courier\PreferenceSections\Topics\TopicCreateParams\DefaultStatus;
use Courier\PreferenceSections\Topics\TopicReplaceParams;
use Courier\PreferenceSections\Topics\TopicRetrieveParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\PreferenceSections\TopicsRawContract;

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
     * Create a subscription preference topic inside a section. Fails with 404 if the section does not exist. The topic id is generated and returned.
     *
     * @param string $sectionID id of the preference section to create the topic in
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
     * @return BaseResponse<PreferenceTopicGetResponse>
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
            convert: PreferenceTopicGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a topic within a section. Returns 404 if the section does not exist, the topic does not exist, or the topic belongs to a different section.
     *
     * @param string $topicID id of the subscription preference topic
     * @param array{sectionID: string}|TopicRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicGetResponse>
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
            convert: PreferenceTopicGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List the topics in a preference section.
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceTopicListResponse>
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
            convert: PreferenceTopicListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a topic and remove it from its section. Same 404 rules as GET.
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
     * Replace a topic within a section. Full document replacement; missing optional fields are cleared. Same 404 rules as GET.
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
     * @return BaseResponse<PreferenceTopicGetResponse>
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
            convert: PreferenceTopicGetResponse::class,
        );
    }
}
