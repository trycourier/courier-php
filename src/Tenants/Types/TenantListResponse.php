<?php

namespace Courier\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class TenantListResponse extends JsonSerializableType
{
    /**
     * @var ?string $cursor A pointer to the next page of results. Defined only when has_more is set to true.
     */
    #[JsonProperty('cursor')]
    public ?string $cursor;

    /**
     * @var bool $hasMore Set to true when there are more pages that can be retrieved.
     */
    #[JsonProperty('has_more')]
    public bool $hasMore;

    /**
     * @var array<Tenant> $items An array of Tenants
     */
    #[JsonProperty('items'), ArrayType([Tenant::class])]
    public array $items;

    /**
     * @var ?string $nextUrl A url that may be used to generate fetch the next set of results.
    Defined only when has_more is set to true
     */
    #[JsonProperty('next_url')]
    public ?string $nextUrl;

    /**
     * @var string $url A url that may be used to generate these results.
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var string $type Always set to "list". Represents the type of this object.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   cursor?: ?string,
     *   hasMore: bool,
     *   items: array<Tenant>,
     *   nextUrl?: ?string,
     *   url: string,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cursor = $values['cursor'] ?? null;
        $this->hasMore = $values['hasMore'];
        $this->items = $values['items'];
        $this->nextUrl = $values['nextUrl'] ?? null;
        $this->url = $values['url'];
        $this->type = $values['type'];
    }
}
