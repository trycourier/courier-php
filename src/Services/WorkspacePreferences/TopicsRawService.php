<?php

declare(strict_types=1);

namespace Courier\Services\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferences\TopicsRawContract;
use Courier\WorkspacePreferences\TopicDigestRequest;
use Courier\WorkspacePreferences\Topics\TopicArchiveParams;
use Courier\WorkspacePreferences\Topics\TopicCreateParams;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\Digest;
use Courier\WorkspacePreferences\Topics\TopicDeleteDigestParams;
use Courier\WorkspacePreferences\Topics\TopicReleaseDigestParams;
use Courier\WorkspacePreferences\Topics\TopicReplaceParams;
use Courier\WorkspacePreferences\Topics\TopicRetrieveParams;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
 * @phpstan-import-type DigestShape from \Courier\WorkspacePreferences\Topics\TopicCreateParams\Digest
 * @phpstan-import-type TopicDigestRequestShape from \Courier\WorkspacePreferences\TopicDigestRequest
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
     * Creates a subscription topic inside a workspace preference. The default status sets whether users start opted in, opted out, or required.
     *
     * @param string $sectionID path param: Id of the workspace preference to create the topic in
     * @param array{
     *   defaultStatus: DefaultStatus|value-of<DefaultStatus>,
     *   name: string,
     *   allowedPreferences?: list<AllowedPreference|value-of<AllowedPreference>>|null,
     *   description?: string|null,
     *   digest?: Digest|DigestShape|null,
     *   includeUnsubscribeHeader?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     *   topicData?: array<string,mixed>|null,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
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
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['preferences/sections/%1$s/topics', $sectionID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: WorkspacePreferenceTopicGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns one subscription topic with its default status, routing options, allowed preferences, and unsubscribe header setting.
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
     * Returns the subscription topics inside a workspace preference, each with its default status and routing options.
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
     * Archives a subscription topic and removes it from its workspace preference, addressed by section id and topic id.
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
     * Turn off a topic's digest, leaving the topic itself in place. The template is unlinked and the digest's schedules are removed along with their delivery rules. Equivalent to sending `digest: null` on a topic replace.
     *
     * @param string $topicID the preference topic whose digest to turn off
     * @param array{sectionID: string}|TopicDeleteDigestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteDigest(
        string $topicID,
        array|TopicDeleteDigestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicDeleteDigestParams::parseRequest(
            $params,
            $requestOptions,
        );
        $sectionID = $parsed['sectionID'];
        unset($parsed['sectionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'preferences/sections/%1$s/topics/%2$s/digest', $sectionID, $topicID,
            ],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Send one recipient's held digest now, instead of waiting for its schedule. Use it to preview what a digest will look like, or to let someone flush their own.
     *
     * Keyed on the topic because that is how a held digest is stored: one per recipient per topic, with the schedule recorded on it rather than part of its identity. To flush every recipient on a schedule instead, use `POST /digests/schedules/{schedule_id}/trigger`.
     *
     * @param string $topicID path param: The preference topic whose digest to release
     * @param array{
     *   sectionID: string, userID: string, tenantID?: string
     * }|TopicReleaseDigestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function releaseDigest(
        string $topicID,
        array|TopicReleaseDigestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TopicReleaseDigestParams::parseRequest(
            $params,
            $requestOptions,
        );
        $sectionID = $parsed['sectionID'];
        unset($parsed['sectionID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'preferences/sections/%1$s/topics/%2$s/digest/release',
                $sectionID,
                $topicID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['sectionID'])),
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
     *   description?: string|null,
     *   digest?: TopicDigestRequest|TopicDigestRequestShape|null,
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
