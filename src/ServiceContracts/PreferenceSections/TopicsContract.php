<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceSections\PreferenceTopicGetResponse;
use Courier\PreferenceSections\PreferenceTopicListResponse;
use Courier\PreferenceSections\Topics\TopicCreateParams\AllowedPreference;
use Courier\PreferenceSections\Topics\TopicCreateParams\DefaultStatus;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TopicsContract
{
    /**
     * @api
     *
     * @param string $sectionID id of the preference section to create the topic in
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
    ): PreferenceTopicGetResponse;

    /**
     * @api
     *
     * @param string $topicID id of the subscription preference topic
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $topicID,
        string $sectionID,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceTopicGetResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): PreferenceTopicListResponse;

    /**
     * @api
     *
     * @param string $topicID id of the subscription preference topic
     * @param string $sectionID id of the preference section
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
     * @param string $sectionID path param: Id of the preference section
     * @param \Courier\PreferenceSections\Topics\TopicReplaceParams\DefaultStatus|value-of<\Courier\PreferenceSections\Topics\TopicReplaceParams\DefaultStatus> $defaultStatus body param: The default subscription status applied when a recipient has not set their own
     * @param string $name body param: Human-readable name for the preference topic
     * @param list<\Courier\PreferenceSections\Topics\TopicReplaceParams\AllowedPreference|value-of<\Courier\PreferenceSections\Topics\TopicReplaceParams\AllowedPreference>>|null $allowedPreferences Body param: Preference controls a recipient may customize. Omit to clear.
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
        \Courier\PreferenceSections\Topics\TopicReplaceParams\DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceTopicGetResponse;
}
