<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-import-type PreferenceChangeLogValueShape from \Courier\WorkspacePreferences\PreferenceChangeLogValue
 *
 * @phpstan-type PreferenceChangeLogEntryShape = array{
 *   id: string,
 *   customRouting: list<ChannelClassification|value-of<ChannelClassification>>,
 *   hasCustomRouting: bool,
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 *   timestamp: string,
 *   topicID: string,
 *   topicName: string,
 *   userID: string,
 *   previous?: null|PreferenceChangeLogValue|PreferenceChangeLogValueShape,
 *   tenantID?: string|null,
 * }
 */
final class PreferenceChangeLogEntry implements BaseModel
{
    /** @use SdkModel<PreferenceChangeLogEntryShape> */
    use SdkModel;

    /**
     * Unique identifier for this change.
     */
    #[Required]
    public string $id;

    /**
     * The channels chosen for this topic, present only when has_custom_routing is true. Empty otherwise.
     *
     * @var list<value-of<ChannelClassification>> $customRouting
     */
    #[Required('custom_routing', list: ChannelClassification::class)]
    public array $customRouting;

    /**
     * Whether specific delivery channels were chosen for this topic rather than the topic's default routing.
     */
    #[Required('has_custom_routing')]
    public bool $hasCustomRouting;

    /**
     * The subscription status the change set.
     *
     * @var value-of<PreferenceStatus> $status
     */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * When the change was made, as an ISO-8601 date-time in UTC.
     */
    #[Required]
    public string $timestamp;

    /**
     * The subscription topic the change applies to.
     */
    #[Required('topic_id')]
    public string $topicID;

    /**
     * The display name of that topic when the change was made.
     */
    #[Required('topic_name')]
    public string $topicName;

    /**
     * The user whose preference changed.
     */
    #[Required('user_id')]
    public string $userID;

    /**
     * The value before this change, where it was recorded.
     */
    #[Optional]
    public ?PreferenceChangeLogValue $previous;

    /**
     * The tenant context the change was made in. Absent when the user set the preference outside any tenant.
     */
    #[Optional('tenant_id')]
    public ?string $tenantID;

    /**
     * `new PreferenceChangeLogEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceChangeLogEntry::with(
     *   id: ...,
     *   customRouting: ...,
     *   hasCustomRouting: ...,
     *   status: ...,
     *   timestamp: ...,
     *   topicID: ...,
     *   topicName: ...,
     *   userID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceChangeLogEntry)
     *   ->withID(...)
     *   ->withCustomRouting(...)
     *   ->withHasCustomRouting(...)
     *   ->withStatus(...)
     *   ->withTimestamp(...)
     *   ->withTopicID(...)
     *   ->withTopicName(...)
     *   ->withUserID(...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>> $customRouting
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     * @param PreferenceChangeLogValue|PreferenceChangeLogValueShape|null $previous
     */
    public static function with(
        string $id,
        array $customRouting,
        bool $hasCustomRouting,
        PreferenceStatus|string $status,
        string $timestamp,
        string $topicID,
        string $topicName,
        string $userID,
        PreferenceChangeLogValue|array|null $previous = null,
        ?string $tenantID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['customRouting'] = $customRouting;
        $self['hasCustomRouting'] = $hasCustomRouting;
        $self['status'] = $status;
        $self['timestamp'] = $timestamp;
        $self['topicID'] = $topicID;
        $self['topicName'] = $topicName;
        $self['userID'] = $userID;

        null !== $previous && $self['previous'] = $previous;
        null !== $tenantID && $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Unique identifier for this change.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The channels chosen for this topic, present only when has_custom_routing is true. Empty otherwise.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>> $customRouting
     */
    public function withCustomRouting(array $customRouting): self
    {
        $self = clone $this;
        $self['customRouting'] = $customRouting;

        return $self;
    }

    /**
     * Whether specific delivery channels were chosen for this topic rather than the topic's default routing.
     */
    public function withHasCustomRouting(bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * The subscription status the change set.
     *
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When the change was made, as an ISO-8601 date-time in UTC.
     */
    public function withTimestamp(string $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The subscription topic the change applies to.
     */
    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }

    /**
     * The display name of that topic when the change was made.
     */
    public function withTopicName(string $topicName): self
    {
        $self = clone $this;
        $self['topicName'] = $topicName;

        return $self;
    }

    /**
     * The user whose preference changed.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * The value before this change, where it was recorded.
     *
     * @param PreferenceChangeLogValue|PreferenceChangeLogValueShape $previous
     */
    public function withPrevious(PreferenceChangeLogValue|array $previous): self
    {
        $self = clone $this;
        $self['previous'] = $previous;

        return $self;
    }

    /**
     * The tenant context the change was made in. Absent when the user set the preference outside any tenant.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }
}
