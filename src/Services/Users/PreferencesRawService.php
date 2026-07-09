<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesRawContract;
use Courier\Users\Preferences\PreferenceBulkReplaceParams;
use Courier\Users\Preferences\PreferenceBulkReplaceResponse;
use Courier\Users\Preferences\PreferenceBulkUpdateParams;
use Courier\Users\Preferences\PreferenceBulkUpdateResponse;
use Courier\Users\Preferences\PreferenceDeleteTopicParams;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

/**
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic as TopicShape1
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic as TopicShape2
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class PreferencesRawService implements PreferencesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch all user preferences.
     *
     * @param string $userID a unique identifier associated with the user whose preferences you wish to retrieve
     * @param array{tenantID?: string|null}|PreferenceRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|PreferenceRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences', $userID],
            query: Util::array_transform_keys($parsed, ['tenantID' => 'tenant_id']),
            options: $options,
            convert: PreferenceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace a user's complete set of preference overrides in a single request. The topics in the request body become the recipient's entire set of overrides: listed topics are created or updated, and every existing override that is not included in the body is reset to its topic default. Submitting an empty `topics` array is a valid clear-all that resets every existing override.
     *
     * This operation is validation-atomic (all-or-nothing): structural validation fails fast with a single `400`, and if any topic is semantically invalid (an unknown topic, a `REQUIRED` topic that cannot be opted out, or a custom routing request that is not available on the workspace's plan) the request returns a single `400` aggregating every failure in `errors` and writes nothing. On success it returns `200` with `items` (the complete resulting override set) and `deleted` (the ids of the overrides that were reset to default).
     *
     * Every `topic_id` in the response — in `items`, `deleted`, and any `errors` — is returned in Courier's canonical topic id form, regardless of the form supplied in the request.
     *
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to update
     * @param array{
     *   topics: list<PreferenceBulkReplaceParams\Topic|TopicShape1>,
     *   tenantID?: string|null,
     * }|PreferenceBulkReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceBulkReplaceResponse>
     *
     * @throws APIException
     */
    public function bulkReplace(
        string $userID,
        array|PreferenceBulkReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceBulkReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/preferences', $userID],
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['tenantID' => 'tenant_id']
            ),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: PreferenceBulkReplaceResponse::class,
        );
    }

    /**
     * @api
     *
     * Additively create or update a user's preferences for one or more subscription topics in a single request. Only the topics included in the request body are created or updated; any existing overrides for topics not listed are left untouched.
     *
     * Structural validation of the request body fails fast with a single `400`. Beyond that, each topic is processed independently (partial-success, not all-or-nothing): valid topics are written and returned in `items`, while topics that cannot be applied are collected in `errors` with a per-topic `reason` (for example an unknown topic, a `REQUIRED` topic that cannot be opted out, a custom routing request that is not available on the workspace's plan, or a write failure). The request therefore returns `200` with both lists whenever the body is structurally valid.
     *
     * Every `topic_id` in the response — in both `items` and `errors` — is returned in Courier's canonical topic id form, regardless of the form supplied in the request.
     *
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to update
     * @param array{
     *   topics: list<PreferenceBulkUpdateParams\Topic|TopicShape2>,
     *   tenantID?: string|null,
     * }|PreferenceBulkUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceBulkUpdateResponse>
     *
     * @throws APIException
     */
    public function bulkUpdate(
        string $userID,
        array|PreferenceBulkUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceBulkUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['users/%1$s/preferences', $userID],
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['tenantID' => 'tenant_id']
            ),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: PreferenceBulkUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Remove a user's preferences for a specific subscription topic, resetting the topic to its effective default. This operation is idempotent: deleting a preference that does not exist succeeds with no error.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param array{
     *   userID: string, tenantID?: string|null
     * }|PreferenceDeleteTopicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deleteTopic(
        string $topicID,
        array|PreferenceDeleteTopicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceDeleteTopicParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: Util::array_transform_keys($parsed, ['tenantID' => 'tenant_id']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Fetch user preferences for a specific subscription topic.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param array{
     *   userID: string, tenantID?: string|null
     * }|PreferenceRetrieveTopicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceGetTopicResponse>
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        array|PreferenceRetrieveTopicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceRetrieveTopicParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: Util::array_transform_keys($parsed, ['tenantID' => 'tenant_id']),
            options: $options,
            convert: PreferenceGetTopicResponse::class,
        );
    }

    /**
     * @api
     *
     * Update or Create user preferences for a specific subscription topic.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param array{
     *   userID: string, topic: Topic|TopicShape, tenantID?: string|null
     * }|PreferenceUpdateOrCreateTopicParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceUpdateOrNewTopicResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        array|PreferenceUpdateOrCreateTopicParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceUpdateOrCreateTopicParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);
        $query_params = array_flip(['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['tenantID' => 'tenant_id']
            ),
            body: (object) array_diff_key(
                array_diff_key($parsed, $query_params),
                array_flip(['userID'])
            ),
            options: $options,
            convert: PreferenceUpdateOrNewTopicResponse::class,
        );
    }
}
