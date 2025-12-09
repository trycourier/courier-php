<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type LogoShape = array{href?: string|null, image?: string|null}
 */
final class Logo implements BaseModel
{
    /** @use SdkModel<LogoShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $href;

    #[Optional(nullable: true)]
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
        $self = new self;

        null !== $href && $self['href'] = $href;
        null !== $image && $self['image'] = $image;

        return $self;
    }

    public function withHref(?string $href): self
    {
        $self = clone $this;
        $self['href'] = $href;

        return $self;
    }

    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }
}
