<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\AuditEvents\AuditEvent\Actor;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ActorShape from \Courier\AuditEvents\AuditEvent\Actor
 *
 * @phpstan-type AuditEventShape = array{
 *   actor: Actor|ActorShape,
 *   auditEventID: string,
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

    #[Required('auditEventId')]
    public string $auditEventID;

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
     *
     * @param Actor|ActorShape $actor
     */
    public static function with(
        Actor|array $actor,
        string $auditEventID,
        string $source,
        string $target,
        string $timestamp,
        string $type,
    ): self {
        $self = new self;

        $self['actor'] = $actor;
        $self['auditEventID'] = $auditEventID;
        $self['source'] = $source;
        $self['target'] = $target;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

        return $self;
    }

    /**
     * @param Actor|ActorShape $actor
     */
    public function withActor(Actor|array $actor): self
    {
        $self = clone $this;
        $self['actor'] = $actor;

        return $self;
    }

    public function withAuditEventID(string $auditEventID): self
    {
        $self = clone $this;
        $self['auditEventID'] = $auditEventID;

        return $self;
    }

    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    public function withTarget(string $target): self
    {
        $self = clone $this;
        $self['target'] = $target;

        return $self;
    }

    public function withTimestamp(string $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
