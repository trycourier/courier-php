<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Channel;

use Courier\Core\Attributes\Api;
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

    #[Api(nullable: true, optional: true)]
    public ?Utm $utm;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?Utm $utm = null): self
    {
        $obj = new self;

        null !== $utm && $obj->utm = $utm;

        return $obj;
    }

    public function withUtm(?Utm $utm): self
    {
        $obj = clone $this;
        $obj->utm = $utm;

        return $obj;
    }
}
