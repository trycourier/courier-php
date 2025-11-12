<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\AuditEvents\AuditEvent\Actor;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type AuditEventShape = array{
 *   actor: Actor,
 *   auditEventId: string,
 *   source: string,
 *   target: string,
 *   timestamp: string,
 *   type: string,
 * }
 */
final class AuditEvent implements BaseModel, ResponseConverter
{
    /** @use SdkModel<AuditEventShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public Actor $actor;

    #[Api]
    public string $auditEventId;

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
     *   auditEventId: ...,
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
        string $auditEventId,
        string $source,
        string $target,
        string $timestamp,
        string $type,
    ): self {
        $obj = new self;

        $obj->actor = $actor;
        $obj->auditEventId = $auditEventId;
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
        $obj->auditEventId = $auditEventID;

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
