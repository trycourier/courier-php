<?php

declare(strict_types=1);

namespace Courier\Send\Recipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\Recipient\UnionMember1\Filter;

/**
 * @phpstan-type union_member1 = array{
 *   data?: array<string, mixed>|null,
 *   filters?: list<Filter>|null,
 *   listID?: string|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<union_member1> */
    use SdkModel;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var list<Filter>|null $filters */
    #[Api(list: Filter::class, nullable: true, optional: true)]
    public ?array $filters;

    #[Api('list_id', nullable: true, optional: true)]
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
     * @param array<string, mixed>|null $data
     * @param list<Filter>|null $filters
     */
    public static function with(
        ?array $data = null,
        ?array $filters = null,
        ?string $listID = null
    ): self {
        $obj = new self;

        null !== $data && $obj->data = $data;
        null !== $filters && $obj->filters = $filters;
        null !== $listID && $obj->listID = $listID;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * @param list<Filter>|null $filters
     */
    public function withFilters(?array $filters): self
    {
        $obj = clone $this;
        $obj->filters = $filters;

        return $obj;
    }

    public function withListID(?string $listID): self
    {
        $obj = clone $this;
        $obj->listID = $listID;

        return $obj;
    }
}
