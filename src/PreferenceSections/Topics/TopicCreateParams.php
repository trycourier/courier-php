<?php

declare(strict_types=1);

namespace Courier\PreferenceSections\Topics;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceSections\Topics\TopicCreateParams\AllowedPreference;
use Courier\PreferenceSections\Topics\TopicCreateParams\DefaultStatus;

/**
 * Create a subscription preference topic inside a section. Fails with 404 if the section does not exist. The topic id is generated and returned.
 *
 * @see Courier\Services\PreferenceSections\TopicsService::create()
 *
 * @phpstan-type TopicCreateParamsShape = array{
 *   defaultStatus: DefaultStatus|value-of<DefaultStatus>,
 *   name: string,
 *   allowedPreferences?: list<AllowedPreference|value-of<AllowedPreference>>|null,
 *   includeUnsubscribeHeader?: bool|null,
 *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   topicData?: array<string,mixed>|null,
 * }
 */
final class TopicCreateParams implements BaseModel
{
    /** @use SdkModel<TopicCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The default subscription status applied when a recipient has not set their own.
     *
     * @var value-of<DefaultStatus> $defaultStatus
     */
    #[Required('default_status', enum: DefaultStatus::class)]
    public string $defaultStatus;

    /**
     * Human-readable name for the preference topic.
     */
    #[Required]
    public string $name;

    /**
     * Preference controls a recipient may customize for this topic. Defaults to empty if omitted.
     *
     * @var list<value-of<AllowedPreference>>|null $allowedPreferences
     */
    #[Optional(
        'allowed_preferences',
        list: AllowedPreference::class,
        nullable: true
    )]
    public ?array $allowedPreferences;

    /**
     * Whether to include a list-unsubscribe header on emails for this topic.
     */
    #[Optional('include_unsubscribe_header', nullable: true)]
    public ?bool $includeUnsubscribeHeader;

    /**
     * Default channels delivered for this topic. Defaults to empty if omitted.
     *
     * @var list<value-of<ChannelClassification>>|null $routingOptions
     */
    #[Optional(
        'routing_options',
        list: ChannelClassification::class,
        nullable: true
    )]
    public ?array $routingOptions;

    /**
     * Arbitrary metadata associated with the topic.
     *
     * @var array<string,mixed>|null $topicData
     */
    #[Optional('topic_data', map: 'mixed', nullable: true)]
    public ?array $topicData;

    /**
     * `new TopicCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicCreateParams::with(defaultStatus: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicCreateParams)->withDefaultStatus(...)->withName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus
     * @param list<AllowedPreference|value-of<AllowedPreference>>|null $allowedPreferences
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions
     * @param array<string,mixed>|null $topicData
     */
    public static function with(
        DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
    ): self {
        $self = new self;

        $self['defaultStatus'] = $defaultStatus;
        $self['name'] = $name;

        null !== $allowedPreferences && $self['allowedPreferences'] = $allowedPreferences;
        null !== $includeUnsubscribeHeader && $self['includeUnsubscribeHeader'] = $includeUnsubscribeHeader;
        null !== $routingOptions && $self['routingOptions'] = $routingOptions;
        null !== $topicData && $self['topicData'] = $topicData;

        return $self;
    }

    /**
     * The default subscription status applied when a recipient has not set their own.
     *
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus
     */
    public function withDefaultStatus(DefaultStatus|string $defaultStatus): self
    {
        $self = clone $this;
        $self['defaultStatus'] = $defaultStatus;

        return $self;
    }

    /**
     * Human-readable name for the preference topic.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Preference controls a recipient may customize for this topic. Defaults to empty if omitted.
     *
     * @param list<AllowedPreference|value-of<AllowedPreference>>|null $allowedPreferences
     */
    public function withAllowedPreferences(?array $allowedPreferences): self
    {
        $self = clone $this;
        $self['allowedPreferences'] = $allowedPreferences;

        return $self;
    }

    /**
     * Whether to include a list-unsubscribe header on emails for this topic.
     */
    public function withIncludeUnsubscribeHeader(
        ?bool $includeUnsubscribeHeader
    ): self {
        $self = clone $this;
        $self['includeUnsubscribeHeader'] = $includeUnsubscribeHeader;

        return $self;
    }

    /**
     * Default channels delivered for this topic. Defaults to empty if omitted.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions
     */
    public function withRoutingOptions(?array $routingOptions): self
    {
        $self = clone $this;
        $self['routingOptions'] = $routingOptions;

        return $self;
    }

    /**
     * Arbitrary metadata associated with the topic.
     *
     * @param array<string,mixed>|null $topicData
     */
    public function withTopicData(?array $topicData): self
    {
        $self = clone $this;
        $self['topicData'] = $topicData;

        return $self;
    }
}
