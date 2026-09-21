<?php

declare(strict_types=1);

namespace Courier\Services\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferences\TopicsContract;
use Courier\WorkspacePreferences\TopicDigestRequest;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\Digest;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
 * @phpstan-import-type DigestShape from \Courier\WorkspacePreferences\Topics\TopicCreateParams\Digest
 * @phpstan-import-type TopicDigestRequestShape from \Courier\WorkspacePreferences\TopicDigestRequest
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TopicsService implements TopicsContract
{
    /**
     * @api
     */
    public TopicsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TopicsRawService($client);
    }

    /**
     * @api
     *
     * Creates a subscription topic inside a workspace preference. The default status sets whether users start opted in, opted out, or required.
     *
     * @param string $sectionID path param: Id of the workspace preference to create the topic in
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus body param: The default subscription status applied when a recipient has not set their own
     * @param string $name body param: Human-readable name for the preference topic
     * @param list<AllowedPreference|value-of<AllowedPreference>>|null $allowedPreferences Body param: Preference controls a recipient may customize for this topic. Defaults to empty if omitted.
     * @param string|null $description body param: Optional description shown under the topic on the hosted preferences page
     * @param Digest|DigestShape|null $digest Body param: A topic's digest, as supplied when the topic itself is created: the template that renders it, the cadences it delivers on, and how collected events are retained.
     *
     * Identical to `TopicDigestRequest`, which a replace uses, except that `schedules` is required — a topic being created has no stored schedules for an absent key to leave alone.
     *
     * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected, because both states are un-deliverable rather than merely off.
     * @param bool|null $includeUnsubscribeHeader body param: Whether to include a list-unsubscribe header on emails for this topic
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Body param: Default channels delivered for this topic. Defaults to empty if omitted.
     * @param array<string,mixed>|null $topicData body param: Arbitrary metadata associated with the topic
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $sectionID,
        DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?string $description = null,
        Digest|array|null $digest = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(
            [
                'defaultStatus' => $defaultStatus,
                'name' => $name,
                'allowedPreferences' => $allowedPreferences,
                'description' => $description,
                'digest' => $digest,
                'includeUnsubscribeHeader' => $includeUnsubscribeHeader,
                'routingOptions' => $routingOptions,
                'topicData' => $topicData,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($sectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns one subscription topic with its default status, routing options, allowed preferences, and unsubscribe header setting.
     *
     * @param string $topicID id of the subscription preference topic
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $topicID,
        string $sectionID,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(['sectionID' => $sectionID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the subscription topics inside a workspace preference, each with its default status and routing options.
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceTopicListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($sectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archives a subscription topic and removes it from its workspace preference, addressed by section id and topic id.
     *
     * @param string $topicID id of the subscription preference topic
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $topicID,
        string $sectionID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['sectionID' => $sectionID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Turn off a topic's digest, leaving the topic itself in place. The template is unlinked and the digest's schedules are removed along with their delivery rules. Equivalent to sending `digest: null` on a topic replace.
     *
     * @param string $topicID the preference topic whose digest to turn off
     * @param string $sectionID the preference section containing the topic
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deleteDigest(
        string $topicID,
        string $sectionID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['sectionID' => $sectionID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deleteDigest($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send one recipient's held digest now, instead of waiting for its schedule. Use it to preview what a digest will look like, or to let someone flush their own.
     *
     * Keyed on the topic because that is how a held digest is stored: one per recipient per topic, with the schedule recorded on it rather than part of its identity. To flush every recipient on a schedule instead, use `POST /digests/schedules/{schedule_id}/trigger`.
     *
     * @param string $topicID path param: The preference topic whose digest to release
     * @param string $sectionID path param: The preference section containing the topic
     * @param string $userID Body param: The recipient whose digest to release. Required: there is no "release everyone on this topic" form, because a whole-schedule flush already has its own endpoint and a body-shaped difference between one recipient and all of them is too easy to get wrong.
     * @param string $tenantID Body param: The recipient's tenant, when they were sent to as part of one -- the same value returned as `tenant_id` on a digest instance and sent as `message.context.tenant_id`. It is part of the held digest's key, so a tenanted recipient cannot be found without it. Omit for an ordinary recipient.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function releaseDigest(
        string $topicID,
        string $sectionID,
        string $userID,
        ?string $tenantID = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['sectionID' => $sectionID, 'userID' => $userID, 'tenantID' => $tenantID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->releaseDigest($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a topic within a workspace preference. Full document replacement; missing optional fields are cleared. Same 404 rules as GET.
     *
     * @param string $topicID path param: Id of the subscription preference topic
     * @param string $sectionID path param: Id of the workspace preference
     * @param \Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus|value-of<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus> $defaultStatus body param: The default subscription status applied when a recipient has not set their own
     * @param string $name body param: Human-readable name for the preference topic
     * @param list<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\AllowedPreference|value-of<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\AllowedPreference>>|null $allowedPreferences Body param: Preference controls a recipient may customize. Omit to clear.
     * @param string|null $description Body param: Optional description shown under the topic on the hosted preferences page. Omit to clear.
     * @param TopicDigestRequest|TopicDigestRequestShape|null $digest Body param: A topic's digest configuration: the template that renders it, the cadences it delivers on, and how collected events are retained.
     *
     * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected, because both states are un-deliverable rather than merely off.
     * @param bool|null $includeUnsubscribeHeader body param: Whether to include a list-unsubscribe header on emails for this topic
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Body param: Default channels delivered for this topic. Omit to clear.
     * @param array<string,mixed>|null $topicData Body param: Arbitrary metadata associated with the topic. Omit to clear.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $topicID,
        string $sectionID,
        \Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?string $description = null,
        TopicDigestRequest|array|null $digest = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(
            [
                'sectionID' => $sectionID,
                'defaultStatus' => $defaultStatus,
                'name' => $name,
                'allowedPreferences' => $allowedPreferences,
                'description' => $description,
                'digest' => $digest,
                'includeUnsubscribeHeader' => $includeUnsubscribeHeader,
                'routingOptions' => $routingOptions,
                'topicData' => $topicData,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($topicID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
