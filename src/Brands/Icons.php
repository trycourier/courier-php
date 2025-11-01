<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type IconsShape = array{bell?: string|null, message?: string|null}
 */
final class Icons implements BaseModel
{
    /** @use SdkModel<IconsShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $bell;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $bell && $obj->bell = $bell;
        null !== $message && $obj->message = $message;

        return $obj;
    }

    public function withBell(?string $bell): self
    {
        $obj = clone $this;
        $obj->bell = $bell;

        return $obj;
    }

    public function withMessage(?string $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }
}
