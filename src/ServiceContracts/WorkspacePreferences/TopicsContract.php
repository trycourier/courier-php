<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\WorkspacePreferences\TopicDigestRequest;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
 * @phpstan-import-type TopicDigestRequestShape from \Courier\WorkspacePreferences\TopicDigestRequest
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TopicsContract
{
    /**
     * @api
     *
     * @param string $sectionID path param: Id of the workspace preference to create the topic in
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus body param: The default subscription status applied when a recipient has not set their own
     * @param string $name body param: Human-readable name for the preference topic
     * @param list<AllowedPreference|value-of<AllowedPreference>>|null $allowedPreferences Body param: Preference controls a recipient may customize for this topic. Defaults to empty if omitted.
     * @param string|null $description body param: Optional description shown under the topic on the hosted preferences page
     * @param TopicDigestRequest|TopicDigestRequestShape|null $digest Body param: A topic's digest configuration: the template that renders it, the cadences it delivers on, and how collected events are retained.
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
        TopicDigestRequest|array|null $digest = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse;

    /**
     * @api
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
    ): WorkspacePreferenceTopicGetResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceTopicListResponse;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): WorkspacePreferenceTopicGetResponse;
}
