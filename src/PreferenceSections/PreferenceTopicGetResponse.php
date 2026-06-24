<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceSections\PreferenceTopicGetResponse\AllowedPreference;
use Courier\PreferenceSections\PreferenceTopicGetResponse\DefaultStatus;

/**
 * A subscription preference topic in your workspace.
 *
 * @phpstan-type PreferenceTopicGetResponseShape = array{
 *   id: string,
 *   allowedPreferences: list<AllowedPreference|value-of<AllowedPreference>>,
 *   created: string,
 *   defaultStatus: DefaultStatus|value-of<DefaultStatus>,
 *   includeUnsubscribeHeader: bool,
 *   name: string,
 *   routingOptions: list<ChannelClassification|value-of<ChannelClassification>>,
 *   topicData: array<string,mixed>,
 *   updated: string,
 *   creator?: string|null,
 *   updater?: string|null,
 * }
 */
final class PreferenceTopicGetResponse implements BaseModel
{
    /** @use SdkModel<PreferenceTopicGetResponseShape> */
    use SdkModel;

    /**
     * The preference topic id.
     */
    #[Required]
    public string $id;

    /**
     * Preference controls a recipient may customize. May be empty.
     *
     * @var list<value-of<AllowedPreference>> $allowedPreferences
     */
    #[Required('allowed_preferences', list: AllowedPreference::class)]
    public array $allowedPreferences;

    /**
     * ISO-8601 timestamp of when the topic was created.
     */
    #[Required]
    public string $created;

    /**
     * The default subscription status applied when a recipient has not set their own.
     *
     * @var value-of<DefaultStatus> $defaultStatus
     */
    #[Required('default_status', enum: DefaultStatus::class)]
    public string $defaultStatus;

    /**
     * Whether a list-unsubscribe header is included on emails for this topic.
     */
    #[Required('include_unsubscribe_header')]
    public bool $includeUnsubscribeHeader;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * Default channels delivered for this topic. May be empty.
     *
     * @var list<value-of<ChannelClassification>> $routingOptions
     */
    #[Required('routing_options', list: ChannelClassification::class)]
    public array $routingOptions;

    /**
     * Arbitrary metadata associated with the topic.
     *
     * @var array<string,mixed> $topicData
     */
    #[Required('topic_data', map: 'mixed')]
    public array $topicData;

    /**
     * ISO-8601 timestamp of the last update.
     */
    #[Required]
    public string $updated;

    /**
     * Id of the creator.
     */
    #[Optional(nullable: true)]
    public ?string $creator;

    /**
     * Id of the last updater.
     */
    #[Optional(nullable: true)]
    public ?string $updater;

    /**
     * `new PreferenceTopicGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceTopicGetResponse::with(
     *   id: ...,
     *   allowedPreferences: ...,
     *   created: ...,
     *   defaultStatus: ...,
     *   includeUnsubscribeHeader: ...,
     *   name: ...,
     *   routingOptions: ...,
     *   topicData: ...,
     *   updated: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceTopicGetResponse)
     *   ->withID(...)
     *   ->withAllowedPreferences(...)
     *   ->withCreated(...)
     *   ->withDefaultStatus(...)
     *   ->withIncludeUnsubscribeHeader(...)
     *   ->withName(...)
     *   ->withRoutingOptions(...)
     *   ->withTopicData(...)
     *   ->withUpdated(...)
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
     * @param list<AllowedPreference|value-of<AllowedPreference>> $allowedPreferences
     * @param DefaultStatus|value-of<DefaultStatus> $defaultStatus
     * @param list<ChannelClassification|value-of<ChannelClassification>> $routingOptions
     * @param array<string,mixed> $topicData
     */
    public static function with(
        string $id,
        array $allowedPreferences,
        string $created,
        DefaultStatus|string $defaultStatus,
        bool $includeUnsubscribeHeader,
        string $name,
        array $routingOptions,
        array $topicData,
        string $updated,
        ?string $creator = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['allowedPreferences'] = $allowedPreferences;
        $self['created'] = $created;
        $self['defaultStatus'] = $defaultStatus;
        $self['includeUnsubscribeHeader'] = $includeUnsubscribeHeader;
        $self['name'] = $name;
        $self['routingOptions'] = $routingOptions;
        $self['topicData'] = $topicData;
        $self['updated'] = $updated;

        null !== $creator && $self['creator'] = $creator;
        null !== $updater && $self['updater'] = $updater;

        return $self;
    }

    /**
     * The preference topic id.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Preference controls a recipient may customize. May be empty.
     *
     * @param list<AllowedPreference|value-of<AllowedPreference>> $allowedPreferences
     */
    public function withAllowedPreferences(array $allowedPreferences): self
    {
        $self = clone $this;
        $self['allowedPreferences'] = $allowedPreferences;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the topic was created.
     */
    public function withCreated(string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

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
     * Whether a list-unsubscribe header is included on emails for this topic.
     */
    public function withIncludeUnsubscribeHeader(
        bool $includeUnsubscribeHeader
    ): self {
        $self = clone $this;
        $self['includeUnsubscribeHeader'] = $includeUnsubscribeHeader;

        return $self;
    }

    /**
     * Human-readable name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Default channels delivered for this topic. May be empty.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>> $routingOptions
     */
    public function withRoutingOptions(array $routingOptions): self
    {
        $self = clone $this;
        $self['routingOptions'] = $routingOptions;

        return $self;
    }

    /**
     * Arbitrary metadata associated with the topic.
     *
     * @param array<string,mixed> $topicData
     */
    public function withTopicData(array $topicData): self
    {
        $self = clone $this;
        $self['topicData'] = $topicData;

        return $self;
    }

    /**
     * ISO-8601 timestamp of the last update.
     */
    public function withUpdated(string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * Id of the creator.
     */
    public function withCreator(?string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    /**
     * Id of the last updater.
     */
    public function withUpdater(?string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
