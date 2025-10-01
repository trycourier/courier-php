<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\AuditEvents\AuditEvent\Actor;
use Courier\AuditEvents\AuditEvent\Target;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type audit_event = array{
 *   auditEventID: string,
 *   source: string,
 *   timestamp: string,
 *   type: string,
 *   actor?: Actor|null,
 *   target?: Target|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class AuditEvent implements BaseModel
{
    /** @use SdkModel<audit_event> */
    use SdkModel;

    #[Api('auditEventId')]
    public string $auditEventID;

    #[Api]
    public string $source;

    #[Api]
    public string $timestamp;

    #[Api]
    public string $type;

    #[Api(nullable: true, optional: true)]
    public ?Actor $actor;

    #[Api(nullable: true, optional: true)]
    public ?Target $target;

    /**
     * `new AuditEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuditEvent::with(auditEventID: ..., source: ..., timestamp: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuditEvent)
     *   ->withAuditEventID(...)
     *   ->withSource(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
     * ```
     */
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
        string $auditEventID,
        string $source,
        string $timestamp,
        string $type,
        ?Actor $actor = null,
        ?Target $target = null,
    ): self {
        $obj = new self;

        $obj->auditEventID = $auditEventID;
        $obj->source = $source;
        $obj->timestamp = $timestamp;
        $obj->type = $type;

        null !== $actor && $obj->actor = $actor;
        null !== $target && $obj->target = $target;

        return $obj;
    }

    public function withAuditEventID(string $auditEventID): self
    {
        $obj = clone $this;
        $obj->auditEventID = $auditEventID;

        return $obj;
    }

    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }

    public function withTimestamp(string $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    public function withActor(?Actor $actor): self
    {
        $obj = clone $this;
        $obj->actor = $actor;

        return $obj;
    }

    public function withTarget(?Target $target): self
    {
        $obj = clone $this;
        $obj->target = $target;

        return $obj;
    }
}
