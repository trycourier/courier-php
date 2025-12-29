<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Utm;

/**
 * @phpstan-import-type UtmShape from \Courier\Utm
 *
 * @phpstan-type MetadataShape = array{
 *   event?: string|null,
 *   tags?: list<string>|null,
 *   traceID?: string|null,
 *   utm?: null|Utm|UtmShape,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<MetadataShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $event;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string', nullable: true)]
    public ?array $tags;

    #[Optional('trace_id', nullable: true)]
    public ?string $traceID;

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
     * @param list<string>|null $tags
     * @param Utm|UtmShape|null $utm
     */
    public static function with(
        ?string $event = null,
        ?array $tags = null,
        ?string $traceID = null,
        Utm|array|null $utm = null,
    ): self {
        $self = new self;

        null !== $event && $self['event'] = $event;
        null !== $tags && $self['tags'] = $tags;
        null !== $traceID && $self['traceID'] = $traceID;
        null !== $utm && $self['utm'] = $utm;

        return $self;
    }

    public function withEvent(?string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withTraceID(?string $traceID): self
    {
        $self = clone $this;
        $self['traceID'] = $traceID;

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
