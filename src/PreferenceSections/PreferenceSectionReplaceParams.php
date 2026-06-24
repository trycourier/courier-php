<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Replace a preference section. Full document replacement; missing optional fields are cleared. Topics attached to the section are unaffected.
 *
 * @see Courier\Services\PreferenceSectionsService::replace()
 *
 * @phpstan-type PreferenceSectionReplaceParamsShape = array{
 *   name: string,
 *   hasCustomRouting?: bool|null,
 *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 * }
 */
final class PreferenceSectionReplaceParams implements BaseModel
{
    /** @use SdkModel<PreferenceSectionReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human-readable name for the section.
     */
    #[Required]
    public string $name;

    /**
     * Whether the section defines custom routing for its topics.
     */
    #[Optional('has_custom_routing', nullable: true)]
    public ?bool $hasCustomRouting;

    /**
     * Default channels for the section. Omit to clear.
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
     * `new PreferenceSectionReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceSectionReplaceParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceSectionReplaceParams)->withName(...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions
     */
    public static function with(
        string $name,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $hasCustomRouting && $self['hasCustomRouting'] = $hasCustomRouting;
        null !== $routingOptions && $self['routingOptions'] = $routingOptions;

        return $self;
    }

    /**
     * Human-readable name for the section.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Whether the section defines custom routing for its topics.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * Default channels for the section. Omit to clear.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions
     */
    public function withRoutingOptions(?array $routingOptions): self
    {
        $self = clone $this;
        $self['routingOptions'] = $routingOptions;

        return $self;
    }
}
