<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch the list of audit events.
 *
 * @see Courier\Services\AuditEventsService::list()
 *
 * @phpstan-type AuditEventListParamsShape = array{cursor?: string|null}
 */
final class AuditEventListParams implements BaseModel
{
    /** @use SdkModel<AuditEventListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of audit events.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $cursor = null): self
    {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * A unique identifier that allows for fetching the next set of audit events.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }
}
