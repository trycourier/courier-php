<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Utm;

/**
 * Metadata such as utm tracking attached with the notification through this channel.
 *
 * @phpstan-type metadata_alias = array{
 *   event?: string|null,
 *   tags?: list<string>|null,
 *   traceID?: string|null,
 *   utm?: Utm|null,
 * }
 */
final class Metadata implements BaseModel
{
    /** @use SdkModel<metadata_alias> */
    use SdkModel;

    /**
     * An arbitrary string to tracks the event that generated this request (e.g. 'signup').
     */
    #[Api(nullable: true, optional: true)]
    public ?string $event;

    /**
     * An array of up to 9 tags you wish to associate with this request (and corresponding messages) for later analysis. Individual tags cannot be more than 30 characters in length.
     *
     * @var list<string>|null $tags
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $tags;

    /**
     * A unique ID used to correlate this request to processing on your servers. Note: Courier does not verify the uniqueness of this ID.
     */
    #[Api('trace_id', nullable: true, optional: true)]
    public ?string $traceID;

    /**
     * Identify the campaign that refers traffic to a specific website, and attributes the browser's website session.
     */
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

    /**
     * An arbitrary string to tracks the event that generated this request (e.g. 'signup').
     */
    public function withEvent(?string $event): self
    {
        $obj = clone $this;
        $obj->event = $event;

        return $obj;
    }

    /**
     * An array of up to 9 tags you wish to associate with this request (and corresponding messages) for later analysis. Individual tags cannot be more than 30 characters in length.
     *
     * @param list<string>|null $tags
     */
    public function withTags(?array $tags): self
    {
        $obj = clone $this;
        $obj->tags = $tags;

        return $obj;
    }

    /**
     * A unique ID used to correlate this request to processing on your servers. Note: Courier does not verify the uniqueness of this ID.
     */
    public function withTraceID(?string $traceID): self
    {
        $obj = clone $this;
        $obj->traceID = $traceID;

        return $obj;
    }

    /**
     * Identify the campaign that refers traffic to a specific website, and attributes the browser's website session.
     */
    public function withUtm(?Utm $utm): self
    {
        $obj = clone $this;
        $obj->utm = $utm;

        return $obj;
    }
}
