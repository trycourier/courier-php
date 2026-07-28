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
     * Returns a user's preference overrides with paging, one entry per subscription topic they have set a choice for.
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
     * Replaces a user's entire set of preference overrides. Any topic you leave out is reset to its default, so send the full set rather than a subset.
     *
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to update
     * @param list<\Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic|TopicShape1> $topics Body param: The complete set of topic overrides for the user. Up to 50 topics may be provided. Any existing override not listed here is reset to its topic default; an empty array resets every existing override.
     * @param string|null $tenantID query param: Replace the preferences of a user for this specific tenant context
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
     * Adds or updates a user's preferences for several subscription topics at once. Topics you leave out keep whatever they were set to before.
     *
     * @param string $userID path param: A unique identifier associated with the user whose preferences you wish to update
     * @param list<\Courier\Users\Preferences\PreferenceBulkUpdateParams\Topic|TopicShape2> $topics Body param: The topics to create or update. Between 1 and 50 topics may be provided in a single request.
     * @param string|null $tenantID query param: Update the preferences of a user for this specific tenant context
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function bulkUpdate(
        string $userID,
        array $topics,
        ?string $tenantID = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceBulkUpdateResponse {
        $params = Util::removeNulls(
            [
                'topics' => $topics,
                'tenantID' => $tenantID,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->bulkUpdate($userID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Removes a user's override for one subscription topic, resetting it to the effective default from the tenant or workspace.
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
     * Returns a user's opt-in status and channel choices for one subscription topic, or the effective default if they have set no override.
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
     * Sets a user's opt-in status and channel choices for one subscription topic, overriding the tenant default for that topic only.
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
