<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesContract;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

/**
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $userID,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceGetResponse {
        $params = Util::removeNulls(['tenantID' => $tenantID]);

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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveTopic(
        string $topicID,
        string $userID,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceGetTopicResponse {
        $params = Util::removeNulls(['userID' => $userID, 'tenantID' => $tenantID]);

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
     * @param Topic|TopicShape $topic Body param
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateOrCreateTopic(
        string $topicID,
        string $userID,
        Topic|array $topic,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceUpdateOrNewTopicResponse {
        $params = Util::removeNulls(
            ['userID' => $userID, 'topic' => $topic, 'tenantID' => $tenantID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateOrCreateTopic($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
