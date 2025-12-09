<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmailHeaderShape = array{
 *   logo: Logo, barColor?: string|null, inheritDefault?: bool|null
 * }
 */
final class EmailHeader implements BaseModel
{
    /** @use SdkModel<EmailHeaderShape> */
    use SdkModel;

    #[Required]
    public Logo $logo;

    #[Optional(nullable: true)]
    public ?string $barColor;

    #[Optional(nullable: true)]
    public ?bool $inheritDefault;

    /**
     * `new EmailHeader()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmailHeader::with(logo: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmailHeader)->withLogo(...)
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
     *
     * @param Logo|array{href?: string|null, image?: string|null} $logo
     */
    public static function with(
        Logo|array $logo,
        ?string $barColor = null,
        ?bool $inheritDefault = null
    ): self {
        $obj = new self;

        $obj['logo'] = $logo;

        null !== $barColor && $obj['barColor'] = $barColor;
        null !== $inheritDefault && $obj['inheritDefault'] = $inheritDefault;

        return $obj;
    }

    /**
     * @param Logo|array{href?: string|null, image?: string|null} $logo
     */
    public function withLogo(Logo|array $logo): self
    {
        $obj = clone $this;
        $obj['logo'] = $logo;

        return $obj;
    }

    public function withBarColor(?string $barColor): self
    {
        $obj = clone $this;
        $obj['barColor'] = $barColor;

        return $obj;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $obj = clone $this;
        $obj['inheritDefault'] = $inheritDefault;

        return $obj;
    }
}
