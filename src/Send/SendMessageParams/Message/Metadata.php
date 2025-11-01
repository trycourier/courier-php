<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Utm;

/**
 * @phpstan-type MetadataShape = array{
 *   event?: string|null,
 *   tags?: list<string>|null,
 *   traceID?: string|null,
 *   utm?: Utm|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $event;

    /** @var list<string>|null $tags */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $tags;

    #[Api('trace_id', nullable: true, optional: true)]
    public ?string $traceID;

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
     *
     * @param list<string>|null $tags
     */
    public static function with(
        ?string $event = null,
        ?array $tags = null,
        ?string $traceID = null,
        ?Utm $utm = null,
    ): self {
        $obj = new self;

        null !== $event && $obj->event = $event;
        null !== $tags && $obj->tags = $tags;
        null !== $traceID && $obj->traceID = $traceID;
        null !== $utm && $obj->utm = $utm;

        return $obj;
    }

    public function withEvent(?string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    public function withTraceID(?string $traceID): self
    {
        $obj = clone $this;
        $obj->traceID = $traceID;

        return $obj;
    }

    public function withUtm(?Utm $utm): self
    {
        $obj = clone $this;
        $obj->utm = $utm;

        return $obj;
    }
}
