<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\PreferenceStatus;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesContract;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

final class PreferencesService implements PreferencesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch all user preferences.
     *
     * @param array{tenantID?: string|null}|PreferenceRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        array|PreferenceRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetResponse {
        [$parsed, $options] = PreferenceRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<PreferenceGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences', $userID],
            query: Util::array_transform_keys($parsed, ['tenantID' => 'tenant_id']),
            options: $options,
            convert: PreferenceGetResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch user preferences for a specific subscription topic.
     *
     * @param array{
     *   userID: string, tenantID?: string|null
     * }|PreferenceRetrieveTopicParams $params
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        array|PreferenceRetrieveTopicParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse {
        [$parsed, $options] = PreferenceRetrieveTopicParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

        /** @var BaseResponse<PreferenceGetTopicResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: Util::array_transform_keys($parsed, ['tenantID' => 'tenant_id']),
            options: $options,
            convert: PreferenceGetTopicResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Update or Create user preferences for a specific subscription topic.
     *
     * @param array{
     *   userID: string,
     *   topic: array{
     *     status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *     customRouting?: list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null,
     *     hasCustomRouting?: bool|null,
     *   },
     *   tenantID?: string|null,
     * }|PreferenceUpdateOrCreateTopicParams $params
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        array|PreferenceUpdateOrCreateTopicParams $params,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse {
        [$parsed, $options] = PreferenceUpdateOrCreateTopicParams::parseRequest(
            $params,
            $requestOptions,
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);
        $query_params = ['tenant_id'];

        /** @var BaseResponse<PreferenceUpdateOrNewTopicResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: Util::array_transform_keys(
                array_diff_key($parsed, $query_params),
                ['tenantID' => 'tenant_id']
            ),
            body: (object) array_diff_key(
                array_diff_key($parsed, $query_params),
                ['userID']
            ),
            options: $options,
            convert: PreferenceUpdateOrNewTopicResponse::class,
        );

        return $response->parse();
    }
}
