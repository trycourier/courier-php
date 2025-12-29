<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmailFooterShape = array{
 *   content?: string|null, inheritDefault?: bool|null
 * }
 */
final class EmailFooter implements BaseModel
{
    /** @use SdkModel<EmailFooterShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $content;

    #[Optional(nullable: true)]
    public ?bool $inheritDefault;

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
        ?string $content = null,
        ?bool $inheritDefault = null
    ): self {
        $self = new self;

        null !== $content && $self['content'] = $content;
        null !== $inheritDefault && $self['inheritDefault'] = $inheritDefault;

        return $self;
    }

    public function withContent(?string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $self = clone $this;
        $self['inheritDefault'] = $inheritDefault;

        return $self;
    }
}
