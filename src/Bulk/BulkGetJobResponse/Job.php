<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkGetJobResponse;

use Courier\Bulk\BulkGetJobResponse\Job\Status;
use Courier\Bulk\InboundBulkMessage\InboundBulkContentMessage;
use Courier\Bulk\InboundBulkMessage\InboundBulkTemplateMessage;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\ElementalContentSugar;

/**
 * @phpstan-type JobShape = array{
 *   definition: InboundBulkTemplateMessage|InboundBulkContentMessage,
 *   enqueued: int,
 *   failures: int,
 *   received: int,
 *   status: value-of<Status>,
 * }
 */
final class Job implements BaseModel
{
    /** @use SdkModel<JobShape> */
    use SdkModel;

    #[Required]
    public InboundBulkTemplateMessage|InboundBulkContentMessage $definition;

    #[Required]
    public int $enqueued;

    #[Required]
    public int $failures;

    #[Required]
    public int $received;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new Job()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Job::with(
     *   definition: ..., enqueued: ..., failures: ..., received: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Job)
     *   ->withDefinition(...)
     *   ->withEnqueued(...)
     *   ->withFailures(...)
     *   ->withReceived(...)
     *   ->withStatus(...)
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
     * @param InboundBulkTemplateMessage|array{
     *   template: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * }|InboundBulkContentMessage|array{
     *   content: ElementalContentSugar|ElementalContent,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * } $definition
     * @param Status|value-of<Status> $status
     */
    public static function with(
        InboundBulkTemplateMessage|array|InboundBulkContentMessage $definition,
        int $enqueued,
        int $failures,
        int $received,
        Status|string $status,
    ): self {
        $self = new self;

        $self['definition'] = $definition;
        $self['enqueued'] = $enqueued;
        $self['failures'] = $failures;
        $self['received'] = $received;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param InboundBulkTemplateMessage|array{
     *   template: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * }|InboundBulkContentMessage|array{
     *   content: ElementalContentSugar|ElementalContent,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   event?: string|null,
     *   locale?: array<string,array<string,mixed>>|null,
     *   override?: array<string,mixed>|null,
     * } $definition
     */
    public function withDefinition(
        InboundBulkTemplateMessage|array|InboundBulkContentMessage $definition
    ): self {
        $self = clone $this;
        $self['definition'] = $definition;

        return $self;
    }

    public function withEnqueued(int $enqueued): self
    {
        $self = clone $this;
        $self['enqueued'] = $enqueued;

        return $self;
    }

    public function withFailures(int $failures): self
    {
        $self = clone $this;
        $self['failures'] = $failures;

        return $self;
    }

    public function withReceived(int $received): self
    {
        $self = clone $this;
        $self['received'] = $received;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
