<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send to all users in a specific list.
 *
 * @phpstan-import-type ListFilterShape from \Courier\ListFilter
 *
 * @phpstan-type ListRecipientShape = array{
 *   data?: array<string,mixed>|null,
 *   filters?: list<ListFilter|ListFilterShape>|null,
 *   listID?: string|null,
 * }
 */
final class ListRecipient implements BaseModel
{
    /** @use SdkModel<ListRecipientShape> */
    use SdkModel;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /** @var list<ListFilter>|null $filters */
    #[Optional(list: ListFilter::class, nullable: true)]
    public ?array $filters;

    #[Optional('list_id', nullable: true)]
    public ?string $listID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $data
     * @param list<ListFilter|ListFilterShape>|null $filters
     */
    public static function with(
        ?array $data = null,
        ?array $filters = null,
        ?string $listID = null
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $filters && $self['filters'] = $filters;
        null !== $listID && $self['listID'] = $listID;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<ListFilter|ListFilterShape>|null $filters
     */
    public function withFilters(?array $filters): self
    {
        $self = clone $this;
        $self['filters'] = $filters;

        return $self;
    }

    public function withListID(?string $listID): self
    {
        $self = clone $this;
        $self['listID'] = $listID;

        return $self;
    }
}
