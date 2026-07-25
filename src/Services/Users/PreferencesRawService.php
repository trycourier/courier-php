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
     * Returns a user's preference overrides with paging, one entry per subscription topic they have set a choice for.
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
     * Replaces a user's entire set of preference overrides. Any topic you leave out is reset to its default, so send the full set rather than a subset.
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
     * Adds or updates a user's preferences for several subscription topics at once. Topics you leave out keep whatever they were set to before.
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
     * Removes a user's override for one subscription topic, resetting it to the effective default from the tenant or workspace.
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
     * Returns a user's opt-in status and channel choices for one subscription topic, or the effective default if they have set no override.
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
     * Sets a user's opt-in status and channel choices for one subscription topic, overriding the tenant default for that topic only.
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
