<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Filter configuration for audience membership containing an array of filter rules.
 *
 * @phpstan-type AudienceFilterConfigShape = array{filters: list<mixed>}
 */
final class AudienceFilterConfig implements BaseModel
{
    /** @use SdkModel<AudienceFilterConfigShape> */
    use SdkModel;

    /**
     * Array of filter rules (single conditions or nested groups).
     *
     * @var list<mixed> $filters
     */
    #[Required(list: FilterConfig::class)]
    public array $filters;

    /**
     * `new AudienceFilterConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AudienceFilterConfig::with(filters: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AudienceFilterConfig)->withFilters(...)
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
     * @param list<mixed> $filters
     */
    public static function with(array $filters): self
    {
        $self = new self;

        $self['filters'] = $filters;

        return $self;
    }

    /**
     * Array of filter rules (single conditions or nested groups).
     *
     * @param list<mixed> $filters
     */
    public function withFilters(array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }
}
