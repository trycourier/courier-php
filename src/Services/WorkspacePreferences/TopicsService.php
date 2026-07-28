<?php

declare(strict_types=1);

namespace Courier\Services\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferences\TopicsContract;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicCreateParams\DefaultStatus;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceTopicListResponse;

/**
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
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(
            [
                'defaultStatus' => $defaultStatus,
                'name' => $name,
                'allowedPreferences' => $allowedPreferences,
                'description' => $description,
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
     * Replace a topic within a workspace preference. Full document replacement; missing optional fields are cleared. Same 404 rules as GET.
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
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(
            [
                'sectionID' => $sectionID,
                'defaultStatus' => $defaultStatus,
                'name' => $name,
                'allowedPreferences' => $allowedPreferences,
                'description' => $description,
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
