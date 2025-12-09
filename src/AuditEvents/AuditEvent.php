<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\AuditEvents\AuditEvent\Actor;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

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
final class AuditEvent implements BaseModel
{
    /** @use SdkModel<AuditEventShape> */
    use SdkModel;

    #[Required]
    public Actor $actor;

    #[Required]
    public string $auditEventId;

    #[Required]
    public string $source;

    #[Required]
    public string $target;

    #[Required]
    public string $timestamp;

    #[Required]
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
     *
     * @param Actor|array{id: string, email?: string|null} $actor
     */
    public static function with(
        Actor|array $actor,
        string $auditEventId,
        string $source,
        string $target,
        string $timestamp,
        string $type,
    ): self {
        $obj = new self;

        $obj['actor'] = $actor;
        $obj['auditEventId'] = $auditEventId;
        $obj['source'] = $source;
        $obj['target'] = $target;
        $obj['timestamp'] = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * @param Actor|array{id: string, email?: string|null} $actor
     */
    public function withActor(Actor|array $actor): self
    {
        $obj = clone $this;
        $obj['actor'] = $actor;

        return $obj;
    }

    public function withAuditEventID(string $auditEventID): self
    {
        $obj = clone $this;
        $obj['auditEventId'] = $auditEventID;

        return $obj;
    }

    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj['source'] = $source;

        return $obj;
    }

    public function withTarget(string $target): self
    {
        $obj = clone $this;
        $obj['target'] = $target;

        return $obj;
    }

    public function withTimestamp(string $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }

    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
