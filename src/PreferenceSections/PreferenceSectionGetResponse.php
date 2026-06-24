<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A preference section in your workspace, including its topics.
 *
 * @phpstan-import-type PreferenceTopicGetResponseShape from \Courier\PreferenceSections\PreferenceTopicGetResponse
 *
 * @phpstan-type PreferenceSectionGetResponseShape = array{
 *   id: string,
 *   created: string,
 *   hasCustomRouting: bool,
 *   name: string,
 *   routingOptions: list<ChannelClassification|value-of<ChannelClassification>>,
 *   topics: list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape>,
 *   creator?: string|null,
 *   updated?: string|null,
 *   updater?: string|null,
 * }
 */
final class PreferenceSectionGetResponse implements BaseModel
{
    /** @use SdkModel<PreferenceSectionGetResponseShape> */
    use SdkModel;

    /**
     * The preference section id.
     */
    #[Required]
    public string $id;

    /**
     * ISO-8601 timestamp of when the section was created.
     */
    #[Required]
    public string $created;

    /**
     * Whether the section defines custom routing for its topics.
     */
    #[Required('has_custom_routing')]
    public bool $hasCustomRouting;

    /**
     * Human-readable name.
     */
    #[Required]
    public string $name;

    /**
     * Default channels for the section. May be empty.
     *
     * @var list<value-of<ChannelClassification>> $routingOptions
     */
    #[Required('routing_options', list: ChannelClassification::class)]
    public array $routingOptions;

    /**
     * The topics contained in this section.
     *
     * @var list<PreferenceTopicGetResponse> $topics
     */
    #[Required(list: PreferenceTopicGetResponse::class)]
    public array $topics;

    /**
     * Id of the creator.
     */
    #[Optional(nullable: true)]
    public ?string $creator;

    /**
     * ISO-8601 timestamp of the last update.
     */
    #[Optional(nullable: true)]
    public ?string $updated;

    /**
     * Id of the last updater.
     */
    #[Optional(nullable: true)]
    public ?string $updater;

    /**
     * `new PreferenceSectionGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceSectionGetResponse::with(
     *   id: ...,
     *   created: ...,
     *   hasCustomRouting: ...,
     *   name: ...,
     *   routingOptions: ...,
     *   topics: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceSectionGetResponse)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withHasCustomRouting(...)
     *   ->withName(...)
     *   ->withRoutingOptions(...)
     *   ->withTopics(...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>> $routingOptions
     * @param list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape> $topics
     */
    public static function with(
        string $id,
        string $created,
        bool $hasCustomRouting,
        string $name,
        array $routingOptions,
        array $topics,
        ?string $creator = null,
        ?string $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['created'] = $created;
        $self['hasCustomRouting'] = $hasCustomRouting;
        $self['name'] = $name;
        $self['routingOptions'] = $routingOptions;
        $self['topics'] = $topics;

        null !== $creator && $self['creator'] = $creator;
        null !== $updated && $self['updated'] = $updated;
        null !== $updater && $self['updater'] = $updater;

        return $self;
    }

    /**
     * The preference section id.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the section was created.
     */
    public function withCreated(string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Whether the section defines custom routing for its topics.
     */
    public function withHasCustomRouting(bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

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
     * Default channels for the section. May be empty.
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
     * The topics contained in this section.
     *
     * @param list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape> $topics
     */
    public function withTopics(array $topics): self
    {
        $self = clone $this;
        $self['topics'] = $topics;

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
     * ISO-8601 timestamp of the last update.
     */
    public function withUpdated(?string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

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
