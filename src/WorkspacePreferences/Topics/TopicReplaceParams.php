<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\Topics;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\WorkspacePreferences\TopicDigestRequest;
use Courier\WorkspacePreferences\Topics\TopicReplaceParams\AllowedPreference;
use Courier\WorkspacePreferences\Topics\TopicReplaceParams\DefaultStatus;

/**
 * Replace a topic within a workspace preference. Full document replacement; missing optional fields are cleared. Same 404 rules as GET.
 *
 * @see Courier\Services\WorkspacePreferences\TopicsService::replace()
 *
 * @phpstan-import-type TopicDigestRequestShape from \Courier\WorkspacePreferences\TopicDigestRequest
 *
 * @phpstan-type TopicReplaceParamsShape = array{
 *   sectionID: string,
 *   defaultStatus: DefaultStatus|value-of<DefaultStatus>,
 *   name: string,
 *   allowedPreferences?: list<AllowedPreference|value-of<AllowedPreference>>|null,
 *   description?: string|null,
 *   digest?: null|TopicDigestRequest|TopicDigestRequestShape,
 *   includeUnsubscribeHeader?: bool|null,
 *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   topicData?: array<string,mixed>|null,
 * }
 */
final class TopicReplaceParams implements BaseModel
{
    /** @use SdkModel<TopicReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $sectionID;

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
     * Preference controls a recipient may customize. Omit to clear.
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
     * Optional description shown under the topic on the hosted preferences page. Omit to clear.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * A topic's digest configuration: the template that renders it, the cadences it delivers on, and how collected events are retained.
     *
     * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected, because both states are un-deliverable rather than merely off.
     */
    #[Optional(nullable: true)]
    public ?TopicDigestRequest $digest;

    /**
     * Whether to include a list-unsubscribe header on emails for this topic.
     */
    #[Optional('include_unsubscribe_header', nullable: true)]
    public ?bool $includeUnsubscribeHeader;

    /**
     * Default channels delivered for this topic. Omit to clear.
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
     * Arbitrary metadata associated with the topic. Omit to clear.
     *
     * @var array<string,mixed>|null $topicData
     */
    #[Optional('topic_data', map: 'mixed', nullable: true)]
    public ?array $topicData;

    /**
     * `new TopicReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicReplaceParams::with(sectionID: ..., defaultStatus: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicReplaceParams)
     *   ->withSectionID(...)
     *   ->withDefaultStatus(...)
     *   ->withName(...)
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
     * @param TopicDigestRequest|TopicDigestRequestShape|null $digest
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions
     * @param array<string,mixed>|null $topicData
     */
    public static function with(
        string $sectionID,
        DefaultStatus|string $defaultStatus,
        string $name,
        ?array $allowedPreferences = null,
        ?string $description = null,
        TopicDigestRequest|array|null $digest = null,
        ?bool $includeUnsubscribeHeader = null,
        ?array $routingOptions = null,
        ?array $topicData = null,
    ): self {
        $self = new self;

        $self['sectionID'] = $sectionID;
        $self['defaultStatus'] = $defaultStatus;
        $self['name'] = $name;

        null !== $allowedPreferences && $self['allowedPreferences'] = $allowedPreferences;
        null !== $description && $self['description'] = $description;
        null !== $digest && $self['digest'] = $digest;
        null !== $includeUnsubscribeHeader && $self['includeUnsubscribeHeader'] = $includeUnsubscribeHeader;
        null !== $routingOptions && $self['routingOptions'] = $routingOptions;
        null !== $topicData && $self['topicData'] = $topicData;

        return $self;
    }

    public function withSectionID(string $sectionID): self
    {
        $self = clone $this;
        $self['sectionID'] = $sectionID;

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
     * Preference controls a recipient may customize. Omit to clear.
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
     * Optional description shown under the topic on the hosted preferences page. Omit to clear.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * A topic's digest configuration: the template that renders it, the cadences it delivers on, and how collected events are retained.
     *
     * Send `null` for the whole object to turn a digest off, which unlinks the template and removes its schedules. There is no `enabled` flag, and `schedules: []` is rejected, because both states are un-deliverable rather than merely off.
     *
     * @param TopicDigestRequest|TopicDigestRequestShape|null $digest
     */
    public function withDigest(TopicDigestRequest|array|null $digest): self
    {
        $self = clone $this;
        $self['digest'] = $digest;

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
     * Default channels delivered for this topic. Omit to clear.
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
     * Arbitrary metadata associated with the topic. Omit to clear.
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
