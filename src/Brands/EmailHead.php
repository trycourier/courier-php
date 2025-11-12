<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Api;
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

    #[Api]
    public bool $inheritDefault;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        $obj->inheritDefault = $inheritDefault;

        null !== $content && $obj->content = $content;

        return $obj;
    }

    public function withInheritDefault(bool $inheritDefault): self
    {
        $obj = clone $this;
        $obj->inheritDefault = $inheritDefault;

        return $obj;
    }

    public function withContent(?string $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }
}
