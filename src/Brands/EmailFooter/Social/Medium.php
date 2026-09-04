<?php

declare(strict_types=1);

namespace Courier\Brands\EmailFooter\Social;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type MediumShape = array{url?: string|null}
 */
final class Medium implements BaseModel
{
    /** @use SdkModel<MediumShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $url = null): self
    {
        $self = new self;

        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
