<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type LogoShape from \Courier\Brands\Logo
 *
 * @phpstan-type EmailHeaderShape = array{
 *   logo: Logo|LogoShape, barColor?: string|null, inheritDefault?: bool|null
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
     * @param Logo|LogoShape $logo
     */
    public static function with(
        Logo|array $logo,
        ?string $barColor = null,
        ?bool $inheritDefault = null
    ): self {
        $self = new self;

        $self['logo'] = $logo;

        null !== $barColor && $self['barColor'] = $barColor;
        null !== $inheritDefault && $self['inheritDefault'] = $inheritDefault;

        return $self;
    }

    /**
     * @param Logo|LogoShape $logo
     */
    public function withLogo(Logo|array $logo): self
    {
        $self = clone $this;
        $self['logo'] = $logo;

        return $self;
    }

    public function withBarColor(?string $barColor): self
    {
        $self = clone $this;
        $self['barColor'] = $barColor;

        return $self;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $self = clone $this;
        $self['inheritDefault'] = $inheritDefault;

        return $self;
    }
}
