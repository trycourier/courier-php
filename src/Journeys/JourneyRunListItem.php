<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A Journey run as it appears in a list response, without `updated_at`.
 *
 * @phpstan-type JourneyRunListItemShape = array{
 *   runID: string,
 *   source: list<string>,
 *   createdAt?: string|null,
 *   status?: string|null,
 *   templateID?: string|null,
 * }
 */
final class JourneyRunListItem implements BaseModel
{
    /** @use SdkModel<JourneyRunListItemShape> */
    use SdkModel;

    /**
     * A unique identifier representing the run.
     */
    #[Required('run_id')]
    public string $runID;

    /**
     * Internal provenance strings describing what started the run. Diagnostic only.
     *
     * @var list<string> $source
     */
    #[Required(list: 'string')]
    public array $source;

    /**
     * When the run started, as an ISO 8601 timestamp.
     */
    #[Optional('created_at')]
    public ?string $createdAt;

    /**
     * The state of the run. See `JourneyRun.status` for the values it takes.
     */
    #[Optional]
    public ?string $status;

    /**
     * The id of the Journey this run belongs to.
     */
    #[Optional('template_id')]
    public ?string $templateID;

    /**
     * `new JourneyRunListItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyRunListItem::with(runID: ..., source: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyRunListItem)->withRunID(...)->withSource(...)
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
     * @param list<string> $source
     */
    public static function with(
        string $runID,
        array $source,
        ?string $createdAt = null,
        ?string $status = null,
        ?string $templateID = null,
    ): self {
        $self = new self;

        $self['runID'] = $runID;
        $self['source'] = $source;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $status && $self['status'] = $status;
        null !== $templateID && $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * A unique identifier representing the run.
     */
    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }

    /**
     * Internal provenance strings describing what started the run. Diagnostic only.
     *
     * @param list<string> $source
     */
    public function withSource(array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * When the run started, as an ISO 8601 timestamp.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The state of the run. See `JourneyRun.status` for the values it takes.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The id of the Journey this run belongs to.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }
}
