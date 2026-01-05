<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Channel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Utm;

/**
 * @phpstan-import-type UtmShape from \Courier\Utm
 *
 * @phpstan-type MetadataShape = array{utm?: null|Utm|UtmShape}
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?Utm $utm;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Utm|UtmShape|null $utm
     */
    public static function with(Utm|array|null $utm = null): self
    {
        $self = new self;

        null !== $utm && $self['utm'] = $utm;

        return $self;
    }

    /**
     * @param Utm|UtmShape|null $utm
     */
    public function withUtm(Utm|array|null $utm): self
    {
        $self = clone $this;
        $self['utm'] = $utm;

        return $self;
    }
}
