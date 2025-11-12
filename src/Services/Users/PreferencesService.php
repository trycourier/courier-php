<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
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
     * @param array{tenant_id?: string|null}|PreferenceRetrieveParams $params
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

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences', $userID],
            query: $parsed,
            options: $options,
            convert: PreferenceGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Fetch user preferences for a specific subscription topic.
     *
     * @param array{
     *   user_id: string, tenant_id?: string|null
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
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: $parsed,
            options: $options,
            convert: PreferenceGetTopicResponse::class,
        );
    }

    /**
     * @api
     *
     * Update or Create user preferences for a specific subscription topic.
     *
     * @param array{
     *   user_id: string,
     *   topic: array{
     *     status: "OPTED_IN"|"OPTED_OUT"|"REQUIRED"|PreferenceStatus,
     *     custom_routing?: list<"direct_message"|"email"|"push"|"sms"|"webhook"|"inbox"|ChannelClassification>|null,
     *     has_custom_routing?: bool|null,
     *   },
     *   tenant_id?: string|null,
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
        $userID = $parsed['user_id'];
        unset($parsed['user_id']);
        $query_params = ['tenant_id'];

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: array_diff_key($parsed, $query_params),
            body: (object) array_diff_key(
                array_diff_key($parsed, $query_params),
                ['user_id']
            ),
            options: $options,
            convert: PreferenceUpdateOrNewTopicResponse::class,
        );
    }
}
