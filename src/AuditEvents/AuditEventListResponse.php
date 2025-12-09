<?php

declare(strict_types=1);

namespace Courier\AuditEvents;

use Courier\AuditEvents\AuditEvent\Actor;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-type AuditEventListResponseShape = array{
 *   paging: Paging, results: list<AuditEvent>
 * }
 */
final class AuditEventListResponse implements BaseModel
{
    /** @use SdkModel<AuditEventListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<AuditEvent> $results */
    #[Required(list: AuditEvent::class)]
    public array $results;

    /**
     * `new AuditEventListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuditEventListResponse::with(paging: ..., results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuditEventListResponse)->withPaging(...)->withResults(...)
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
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     * @param list<AuditEvent|array{
     *   actor: Actor,
     *   auditEventID: string,
     *   source: string,
     *   target: string,
     *   timestamp: string,
     *   type: string,
     * }> $results
     */
    public static function with(Paging|array $paging, array $results): self
    {
        $obj = new self;

        $obj['paging'] = $paging;
        $obj['results'] = $results;

        return $obj;
    }

    /**
     * @param Paging|array{more: bool, cursor?: string|null} $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $obj = clone $this;
        $obj['paging'] = $paging;

        return $obj;
    }

    /**
     * @param list<AuditEvent|array{
     *   actor: Actor,
     *   auditEventID: string,
     *   source: string,
     *   target: string,
     *   timestamp: string,
     *   type: string,
     * }> $results
     */
    public function withResults(array $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }
}
