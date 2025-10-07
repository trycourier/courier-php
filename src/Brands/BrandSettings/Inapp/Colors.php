<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettings\Inapp;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type colors_alias = array{
 *   primary?: string|null, secondary?: string|null
 * }
 */
final class Colors implements BaseModel
{
    /** @use SdkModel<colors_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $primary;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $primary && $obj->primary = $primary;
        null !== $secondary && $obj->secondary = $secondary;

        return $obj;
    }

    public function withPrimary(?string $primary): self
    {
        $obj = clone $this;
        $obj->primary = $primary;

        return $obj;
    }

    public function withSecondary(?string $secondary): self
    {
        $obj = clone $this;
        $obj->secondary = $secondary;

        return $obj;
    }
}
