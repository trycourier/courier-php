<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
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
     * @param string $topicID path param: Id of the subscription preference topic
     * @param string $sectionID path param: Id of the workspace preference
     * @param \Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus|value-of<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus> $defaultStatus body param: The default subscription status applied when a recipient has not set their own
     * @param string $name body param: Human-readable name for the preference topic
     * @param list<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\AllowedPreference|value-of<\Courier\WorkspacePreferences\Topics\TopicReplaceParams\AllowedPreference>>|null $allowedPreferences Body param: Preference controls a recipient may customize. Omit to clear.
     * @param string|null $description Body param: Optional description shown under the topic on the hosted preferences page. Omit to clear.
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
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse;
}
