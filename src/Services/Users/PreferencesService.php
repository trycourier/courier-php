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
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

final class PreferencesService implements PreferencesContract
{
    /**
     * @api
     */
    public PreferencesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreferencesRawService($client);
    }

    /**
     * @api
     *
     * Fetch all user preferences.
     *
     * @param string $userID a unique identifier associated with the user whose preferences you wish to retrieve
     * @param string|null $tenantID query the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetResponse {
        $params = ['tenantID' => $tenantID];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch user preferences for a specific subscription topic.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to retrieve
     * @param string|null $tenantID query param: Query the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        string $userID,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceGetTopicResponse {
        $params = ['userID' => $userID, 'tenantID' => $tenantID];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveTopic($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update or Create user preferences for a specific subscription topic.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to retrieve
     * @param array{
     *   status: 'OPTED_IN'|'OPTED_OUT'|'REQUIRED'|PreferenceStatus,
     *   customRouting?: list<'direct_message'|'email'|'push'|'sms'|'webhook'|'inbox'|ChannelClassification>|null,
     *   hasCustomRouting?: bool|null,
     * } $topic Body param:
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        string $userID,
        array $topic,
        ?string $tenantID = null,
        ?RequestOptions $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse {
        $params = ['userID' => $userID, 'topic' => $topic, 'tenantID' => $tenantID];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateOrCreateTopic($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
