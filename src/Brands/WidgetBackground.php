<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type WidgetBackgroundShape = array{
 *   bottomColor?: string|null, topColor?: string|null
 * }
 */
final class WidgetBackground implements BaseModel
{
    /** @use SdkModel<WidgetBackgroundShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $bottomColor;

    #[Optional(nullable: true)]
    public ?string $topColor;

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
        ?string $bottomColor = null,
        ?string $topColor = null
    ): self {
        $self = new self;

        null !== $bottomColor && $self['bottomColor'] = $bottomColor;
        null !== $topColor && $self['topColor'] = $topColor;

        return $self;
    }

    public function withBottomColor(?string $bottomColor): self
    {
        $self = clone $this;
        $self['bottomColor'] = $bottomColor;

        return $self;
    }

    public function withTopColor(?string $topColor): self
    {
        $self = clone $this;
        $self['topColor'] = $topColor;

        return $self;
    }
}
