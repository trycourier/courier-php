<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type email_header = array{
 *   logo: Logo, barColor?: string|null, inheritDefault?: bool|null
 * }
 */
final class EmailHeader implements BaseModel
{
    /** @use SdkModel<email_header> */
    use SdkModel;

    #[Api]
    public Logo $logo;

    #[Api(nullable: true, optional: true)]
    public ?string $barColor;

    #[Api(nullable: true, optional: true)]
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
     */
    public static function with(
        Logo $logo,
        ?string $barColor = null,
        ?bool $inheritDefault = null
    ): self {
        $obj = new self;

        $obj->logo = $logo;

        null !== $barColor && $obj->barColor = $barColor;
        null !== $inheritDefault && $obj->inheritDefault = $inheritDefault;

        return $obj;
    }

    public function withLogo(Logo $logo): self
    {
        $obj = clone $this;
        $obj->logo = $logo;

        return $obj;
    }

    public function withBarColor(?string $barColor): self
    {
        $obj = clone $this;
        $obj->barColor = $barColor;

        return $obj;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $obj = clone $this;
        $obj->inheritDefault = $inheritDefault;

        return $obj;
    }
}
