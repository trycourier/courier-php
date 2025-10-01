<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesContract;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceRetrieveParams;
use Courier\Users\Preferences\PreferenceRetrieveTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

use const Courier\Core\OMIT as omit;

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
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @return PreferenceGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetResponse {
        $params = ['tenantID' => $tenantID];

        return $this->retrieveRaw($userID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $userID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetResponse {
        [$parsed, $options] = PreferenceRetrieveParams::parseRequest(
            $params,
            $requestOptions
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
     * @param string $userID
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @return PreferenceGetTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        $userID,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse {
        $params = ['userID' => $userID, 'tenantID' => $tenantID];

        return $this->retrieveTopicRaw($topicID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceGetTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveTopicRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceGetTopicResponse {
        [$parsed, $options] = PreferenceRetrieveTopicParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);

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
     * @param string $userID
     * @param Topic $topic
     * @param string|null $tenantID update the preferences of a user for this specific tenant context
     *
     * @return PreferenceUpdateOrNewTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        $userID,
        $topic,
        $tenantID = omit,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse {
        $params = ['userID' => $userID, 'topic' => $topic, 'tenantID' => $tenantID];

        return $this->updateOrCreateTopicRaw($topicID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return PreferenceUpdateOrNewTopicResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateOrCreateTopicRaw(
        string $topicID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): PreferenceUpdateOrNewTopicResponse {
        [$parsed, $options] = PreferenceUpdateOrCreateTopicParams::parseRequest(
            $params,
            $requestOptions
        );
        $userID = $parsed['userID'];
        unset($parsed['userID']);
        $query_params = array_flip(['tenant_id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['users/%1$s/preferences/%2$s', $userID, $topicID],
            query: array_diff_key($parsed, $query_params),
            body: (object) array_diff_key(
                array_diff_key($parsed, $query_params),
                array_flip(['userID'])
            ),
            options: $options,
            convert: PreferenceUpdateOrNewTopicResponse::class,
        );
    }
}
