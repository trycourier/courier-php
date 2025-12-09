<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmailHeadShape = array{
 *   inheritDefault: bool, content?: string|null
 * }
 */
final class EmailHead implements BaseModel
{
    /** @use SdkModel<EmailHeadShape> */
    use SdkModel;

    #[Required]
    public bool $inheritDefault;

    #[Optional(nullable: true)]
    public ?string $content;

    /**
     * `new EmailHead()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmailHead::with(inheritDefault: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmailHead)->withInheritDefault(...)
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
     */
    public static function with(
        bool $inheritDefault,
        ?string $content = null
    ): self {
        $self = new self;

        $self['inheritDefault'] = $inheritDefault;

        null !== $content && $self['content'] = $content;

        return $self;
    }

    public function withInheritDefault(bool $inheritDefault): self
    {
        $self = clone $this;
        $self['inheritDefault'] = $inheritDefault;

        return $self;
    }

    public function withContent(?string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }
}
