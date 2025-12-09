<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandColorsShape = array{
 *   primary?: string|null, secondary?: string|null
 * }
 */
final class BrandColors implements BaseModel
{
    /** @use SdkModel<BrandColorsShape> */
    use SdkModel;

    #[Optional]
    public ?string $primary;

    #[Optional]
    public ?string $secondary;

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
        ?string $primary = null,
        ?string $secondary = null
    ): self {
        $self = new self;

        null !== $primary && $self['primary'] = $primary;
        null !== $secondary && $self['secondary'] = $secondary;

        return $self;
    }

    public function withPrimary(string $primary): self
    {
        $self = clone $this;
        $self['primary'] = $primary;

        return $self;
    }

    public function withSecondary(string $secondary): self
    {
        $self = clone $this;
        $self['secondary'] = $secondary;

        return $self;
    }
}
