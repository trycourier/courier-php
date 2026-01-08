<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesRawContract;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

/**
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
