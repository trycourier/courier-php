<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettings\Email\Header;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type logo_alias = array{href?: string|null, image?: string|null}
 */
final class Logo implements BaseModel
{
    /** @use SdkModel<logo_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $href;

    #[Api(nullable: true, optional: true)]
    public ?string $image;

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
        ?string $href = null,
        ?string $image = null
    ): self {
        $obj = new self;

        null !== $href && $obj->href = $href;
        null !== $image && $obj->image = $image;

        return $obj;
    }

    public function withHref(?string $href): self
    {
        $obj = clone $this;
        $obj->href = $href;

        return $obj;
    }

    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }
}
