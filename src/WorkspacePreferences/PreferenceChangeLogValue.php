<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\PreferenceStatus;

/**
 * @phpstan-type PreferenceChangeLogValueShape = array{
 *   customRouting: list<ChannelClassification|value-of<ChannelClassification>>,
 *   hasCustomRouting: bool,
 *   status: PreferenceStatus|value-of<PreferenceStatus>,
 * }
 */
final class PreferenceChangeLogValue implements BaseModel
{
    /** @use SdkModel<PreferenceChangeLogValueShape> */
    use SdkModel;

    /**
     * The channels chosen before the change.
     *
     * @var list<value-of<ChannelClassification>> $customRouting
     */
    #[Required('custom_routing', list: ChannelClassification::class)]
    public array $customRouting;

    /**
     * Whether custom routing was in effect before the change.
     */
    #[Required('has_custom_routing')]
    public bool $hasCustomRouting;

    /**
     * The subscription status before the change.
     *
     * @var value-of<PreferenceStatus> $status
     */
    #[Required(enum: PreferenceStatus::class)]
    public string $status;

    /**
     * `new PreferenceChangeLogValue()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceChangeLogValue::with(
     *   customRouting: ..., hasCustomRouting: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceChangeLogValue)
     *   ->withCustomRouting(...)
     *   ->withHasCustomRouting(...)
     *   ->withStatus(...)
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
     */
    public static function with(
        array $customRouting,
        bool $hasCustomRouting,
        PreferenceStatus|string $status,
    ): self {
        $self = new self;

        $self['customRouting'] = $customRouting;
        $self['hasCustomRouting'] = $hasCustomRouting;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The channels chosen before the change.
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
     * Whether custom routing was in effect before the change.
     */
    public function withHasCustomRouting(bool $hasCustomRouting): self
    {
        $self = clone $this;
        $self['hasCustomRouting'] = $hasCustomRouting;

        return $self;
    }

    /**
     * The subscription status before the change.
     *
     * @param PreferenceStatus|value-of<PreferenceStatus> $status
     */
    public function withStatus(PreferenceStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
