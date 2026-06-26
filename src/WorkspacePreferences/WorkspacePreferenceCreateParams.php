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
 * Create a workspace preference. The workspace preference id is generated and returned. Topics are created inside a workspace preference via POST /preferences/sections/{section_id}/topics.
 *
 * @see Courier\Services\WorkspacePreferencesService::create()
 *
 * @phpstan-type WorkspacePreferenceCreateParamsShape = array{
 *   name: string,
 *   hasCustomRouting?: bool|null,
 *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 * }
 */
final class WorkspacePreferenceCreateParams implements BaseModel
{
    /** @use SdkModel<WorkspacePreferenceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Human-readable name for the workspace preference.
     */
    #[Required]
    public string $name;

    /**
     * Whether the workspace preference defines custom routing for its topics.
     */
    #[Optional('has_custom_routing', nullable: true)]
    public ?bool $hasCustomRouting;

    /**
     * Default channels for the workspace preference. Defaults to empty if omitted.
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
     * `new WorkspacePreferenceCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkspacePreferenceCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkspacePreferenceCreateParams)->withName(...)
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
     * Human-readable name for the workspace preference.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
     * Default channels for the workspace preference. Defaults to empty if omitted.
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
