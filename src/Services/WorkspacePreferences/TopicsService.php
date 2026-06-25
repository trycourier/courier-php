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
     * Create a subscription preference topic inside a workspace preference. Fails with 404 if the workspace preference does not exist. The topic id is generated and returned.
     *
     * @param string $sectionID id of the workspace preference to create the topic in
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus the default subscription status applied when a recipient has not set their own
     * @param string $name human-readable name for the preference topic
     * @param list<AllowedPreference|value-of<AllowedPreference>>|null $allowedPreferences Preference controls a recipient may customize for this topic. Defaults to empty if omitted.
     * @param bool|null $includeUnsubscribeHeader whether to include a list-unsubscribe header on emails for this topic
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels delivered for this topic. Defaults to empty if omitted.
     * @param array<string,mixed>|null $topicData arbitrary metadata associated with the topic
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $sectionID,
        DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceTopicGetResponse {
        $params = Util::removeNulls(
            [
                'defaultStatus' => $defaultStatus,
                'name' => $name,
                'allowedPreferences' => $allowedPreferences,
                'includeUnsubscribeHeader' => $includeUnsubscribeHeader,
                'routingOptions' => $routingOptions,
                'topicData' => $topicData,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($sectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a topic within a workspace preference. Returns 404 if the workspace preference does not exist, the topic does not exist, or the topic belongs to a different workspace preference.
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
     * List the topics in a workspace preference.
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
     * Archive a topic and remove it from its workspace preference. Same 404 rules as GET.
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
