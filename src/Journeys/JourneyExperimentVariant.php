<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A single weighted arm of an experiment. Variant ids must be unique within the experiment and the sum of all variant weights must be greater than 0. Weights are relative (no sum-to-100 requirement) — routing normalizes them proportionally.
 *
 * @phpstan-type JourneyExperimentVariantShape = array{
 *   id: string, templateID: string, weight: float, name?: string|null
 * }
 */
final class JourneyExperimentVariant implements BaseModel
{
    /** @use SdkModel<JourneyExperimentVariantShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /**
     * The notification template sent for this variant.
     */
    #[Required('templateId')]
    public string $templateID;

    /**
     * Relative routing weight. Must be non-negative.
     */
    #[Required]
    public float $weight;

    /**
     * Optional, cosmetic display name for the variant.
     */
    #[Optional]
    public ?string $name;

    /**
     * `new JourneyExperimentVariant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyExperimentVariant::with(id: ..., templateID: ..., weight: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyExperimentVariant)
     *   ->withID(...)
     *   ->withTemplateID(...)
     *   ->withWeight(...)
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
     */
    public static function with(
        string $id,
        string $templateID,
        float $weight,
        ?string $name = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['templateID'] = $templateID;
        $self['weight'] = $weight;

        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The notification template sent for this variant.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * Relative routing weight. Must be non-negative.
     */
    public function withWeight(float $weight): self
    {
        $self = clone $this;
        $self['weight'] = $weight;

        return $self;
    }

    /**
     * Optional, cosmetic display name for the variant.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
