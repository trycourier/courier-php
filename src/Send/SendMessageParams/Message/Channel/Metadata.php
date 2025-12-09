<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Channel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Utm;

/**
 * @phpstan-type MetadataShape = array{utm?: Utm|null}
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
     * @param Utm|array{
     *   campaign?: string|null,
     *   content?: string|null,
     *   medium?: string|null,
     *   source?: string|null,
     *   term?: string|null,
     * }|null $utm
     */
    public static function with(Utm|array|null $utm = null): self
    {
        $obj = new self;

        null !== $utm && $obj['utm'] = $utm;

        return $obj;
    }

    /**
     * @param Utm|array{
     *   campaign?: string|null,
     *   content?: string|null,
     *   medium?: string|null,
     *   source?: string|null,
     *   term?: string|null,
     * }|null $utm
     */
    public function withUtm(Utm|array|null $utm): self
    {
        $obj = clone $this;
        $obj['utm'] = $utm;

        return $obj;
    }
}
