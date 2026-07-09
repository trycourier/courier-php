<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Replace a workspace preference. Full document replacement; missing optional fields are cleared. Topics attached to the workspace preference are unaffected.
 *
 * @see Courier\Services\WorkspacePreferencesService::replace()
 *
 * @phpstan-type WorkspacePreferenceReplaceParamsShape = array{
 *   name: string,
 *   description?: string|null,
 *   hasCustomRouting?: bool|null,
 *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 * }
 */
final class WorkspacePreferenceReplaceParams implements BaseModel
{
    /** @use SdkModel<WorkspacePreferenceReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human-readable name for the workspace preference.
     */
    #[Required]
    public string $name;

    /**
     * Optional description shown under the section on the hosted preferences page. Omit to clear.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Whether the workspace preference defines custom routing for its topics.
     */
    #[Optional('has_custom_routing', nullable: true)]
    public ?bool $hasCustomRouting;

    /**
     * Default channels for the workspace preference. Omit to clear.
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
     * `new WorkspacePreferenceReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkspacePreferenceReplaceParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkspacePreferenceReplaceParams)->withName(...)
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
        ?string $description = null,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null,
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $hasCustomRouting && $self['hasCustomRouting'] = $hasCustomRouting;
        null !== $routingOptions && $self['routingOptions'] = $routingOptions;

        return $self;
    }

    /**
     * Human-readable name for the workspace preference.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional description shown under the section on the hosted preferences page. Omit to clear.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Whether the workspace preference defines custom routing for its topics.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * Default channels for the workspace preference. Omit to clear.
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
