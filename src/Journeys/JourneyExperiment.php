<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A/B experiment config for a send node. The recipient is deterministically bucketed by `bucketingKey` and routed to one of the `variants` in proportion to its `weight`. Present on a send node INSTEAD OF `message.template`.
 *
 * @phpstan-import-type JourneyExperimentVariantShape from \Courier\Journeys\JourneyExperimentVariant
 *
 * @phpstan-type JourneyExperimentShape = array{
 *   bucketingKey: string,
 *   variants: list<JourneyExperimentVariant|JourneyExperimentVariantShape>,
 *   id?: string|null,
 *   name?: string|null,
 * }
 */
final class JourneyExperiment implements BaseModel
{
    /** @use SdkModel<JourneyExperimentShape> */
    use SdkModel;

    /**
     * The value used to deterministically assign a recipient to a variant. Must be non-empty with no leading or trailing whitespace.
     */
    #[Required]
    public string $bucketingKey;

    /**
     * Between 2 and 10 weighted template variants.
     *
     * @var list<JourneyExperimentVariant> $variants
     */
    #[Required(list: JourneyExperimentVariant::class)]
    public array $variants;

    /**
     * Server-authoritative experiment id (prefixed `exp_`). Omit to have the server mint one; when supplied it must be a valid `exp_` id.
     */
    #[Optional]
    public ?string $id;

    /**
     * Optional, cosmetic display name for the experiment.
     */
    #[Optional]
    public ?string $name;

    /**
     * `new JourneyExperiment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyExperiment::with(bucketingKey: ..., variants: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyExperiment)->withBucketingKey(...)->withVariants(...)
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
     * @param list<JourneyExperimentVariant|JourneyExperimentVariantShape> $variants
     */
    public static function with(
        string $bucketingKey,
        array $variants,
        ?string $id = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['bucketingKey'] = $bucketingKey;
        $self['variants'] = $variants;

        null !== $id && $self['id'] = $id;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The value used to deterministically assign a recipient to a variant. Must be non-empty with no leading or trailing whitespace.
     */
    public function withBucketingKey(string $bucketingKey): self
    {
        $self = clone $this;
        $self['bucketingKey'] = $bucketingKey;

        return $self;
    }

    /**
     * Between 2 and 10 weighted template variants.
     *
     * @param list<JourneyExperimentVariant|JourneyExperimentVariantShape> $variants
     */
    public function withVariants(array $variants): self
    {
        $self = clone $this;
        $self['variants'] = $variants;

        return $self;
    }

    /**
     * Server-authoritative experiment id (prefixed `exp_`). Omit to have the server mint one; when supplied it must be a valid `exp_` id.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Optional, cosmetic display name for the experiment.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
