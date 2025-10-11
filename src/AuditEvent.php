<?php

declare(strict_types=1);

namespace Courier;

use Courier\AuditEvent\Actor;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type audit_event = array{
 *   actor: Actor,
 *   auditEventID: string,
 *   source: string,
 *   target: string,
 *   timestamp: string,
 *   type: string,
 * }
 */
final class AuditEvent implements BaseModel
{
    /** @use SdkModel<audit_event> */
    use SdkModel;

    #[Api]
    public Actor $actor;

    #[Api('auditEventId')]
    public string $auditEventID;

    #[Api]
    public string $source;

    #[Api]
    public string $target;

    #[Api]
    public string $timestamp;

    #[Api]
    public string $type;

    /**
     * `new AuditEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuditEvent::with(
     *   actor: ...,
     *   auditEventID: ...,
     *   source: ...,
     *   target: ...,
     *   timestamp: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuditEvent)
     *   ->withActor(...)
     *   ->withAuditEventID(...)
     *   ->withSource(...)
     *   ->withTarget(...)
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
        Actor $actor,
        string $auditEventID,
        string $source,
        string $target,
        string $timestamp,
        string $type,
    ): self {
        $obj = new self;

        $obj->actor = $actor;
        $obj->auditEventID = $auditEventID;
        $obj->source = $source;
        $obj->target = $target;
        $obj->timestamp = $timestamp;
        $obj->type = $type;

        return $obj;
    }

    public function withActor(Actor $actor): self
    {
        $obj = clone $this;
        $obj->actor = $actor;

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

    public function withTarget(string $target): self
    {
        $obj = clone $this;
        $obj->target = $target;

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
}
