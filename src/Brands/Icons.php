<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type IconsShape = array{bell?: string|null, message?: string|null}
 */
final class Icons implements BaseModel
{
    /** @use SdkModel<IconsShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $bell;

    #[Optional(nullable: true)]
    public ?string $message;

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
        ?string $bell = null,
        ?string $message = null
    ): self {
        $self = new self;

        null !== $bell && $self['bell'] = $bell;
        null !== $message && $self['message'] = $message;

        return $self;
    }

    public function withBell(?string $bell): self
    {
        $self = clone $this;
        $self['bell'] = $bell;

        return $self;
    }

    public function withMessage(?string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
