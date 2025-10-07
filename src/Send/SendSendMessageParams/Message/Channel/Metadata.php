<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message\Channel;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Utm;

/**
 * @phpstan-type metadata_alias = array{utm?: Utm|null}
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<metadata_alias> */
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
