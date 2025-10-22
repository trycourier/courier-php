<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch the list of audit events.
 *
 * @see Courier\AuditEvents->list
 *
 * @phpstan-type audit_event_list_params = array{cursor?: string|null}
 */
final class AuditEventListParams implements BaseModel
{
    /** @use SdkModel<audit_event_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier that allows for fetching the next set of audit events.
     */
    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $cursor && $obj->cursor = $cursor;

        return $obj;
    }

    /**
     * A unique identifier that allows for fetching the next set of audit events.
     */
    public function withCursor(?string $cursor): self
    {
        $obj = clone $this;
        $obj->cursor = $cursor;

        return $obj;
    }
}
