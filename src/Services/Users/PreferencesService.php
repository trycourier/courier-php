<?php

declare(strict_types=1);

namespace Courier\Services\Users;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Users\PreferencesContract;
use Courier\Users\Preferences\PreferenceBulkReplaceResponse;
use Courier\Users\Preferences\PreferenceBulkUpdateResponse;
use Courier\Users\Preferences\PreferenceGetResponse;
use Courier\Users\Preferences\PreferenceGetTopicResponse;
use Courier\Users\Preferences\PreferenceUpdateOrCreateTopicParams\Topic;
use Courier\Users\Preferences\PreferenceUpdateOrNewTopicResponse;

/**
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic as TopicShape1
 * @phpstan-import-type TopicShape from \Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic as TopicShape2
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
     * Replace a user's complete set of preference overrides in a single request. The topics in the request body become the recipient's entire set of overrides: listed topics are created or updated, and every existing override that is not included in the body is reset to its topic default. Submitting an empty `topics` array is a valid clear-all that resets every existing override.
     *
     * This operation is validation-atomic (all-or-nothing): structural validation fails fast with a single `400`, and if any topic is semantically invalid (an unknown topic, a `REQUIRED` topic that cannot be opted out, or a custom routing request that is not available on the workspace's plan) the request returns a single `400` aggregating every failure in `errors` and writes nothing. On success it returns `200` with `items` (the complete resulting override set) and `deleted` (the ids of the overrides that were reset to default).
     *
     * Every `topic_id` in the response — in `items`, `deleted`, and any `errors` — is returned in Courier's canonical topic id form, regardless of the form supplied in the request.
     *
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to update
     * @param list<\Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic|TopicShape1> $topics Body param: The complete set of topic overrides for the user. Up to 50 topics may be provided. Any existing override not listed here is reset to its topic default; an empty array resets every existing override.
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function bulkReplace(
        string $userID,
        array $topics,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceBulkReplaceResponse {
        $params = Util::removeNulls(['topics' => $topics, 'tenantID' => $tenantID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->bulkReplace($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param list<\Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic|TopicShape2> $topics Body param: The topics to create or update. Between 1 and 50 topics may be provided in a single request.
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function bulkUpdate(
        string $userID,
        array $topics,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceBulkUpdateResponse {
        $params = Util::removeNulls(['topics' => $topics, 'tenantID' => $tenantID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->bulkUpdate($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a user's preferences for a specific subscription topic, resetting the topic to its effective default. This operation is idempotent: deleting a preference that does not exist succeeds with no error.
     *
     * @param string $topicID path param: A unique identifier associated with a subscription topic
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to delete
     * @param string|null $tenantID query param: Delete the preferences of a user for this specific tenant context
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteTopic(
        string $topicID,
        string $userID,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['userID' => $userID, 'tenantID' => $tenantID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteTopic($topicID, params: $params, requestOptions: $requestOptions);

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
