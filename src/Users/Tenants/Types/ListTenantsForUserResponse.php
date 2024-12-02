<?php

namespace Courier\Users\Tenants\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Commons\Types\UserTenantAssociation;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class ListTenantsForUserResponse extends JsonSerializableType
{
    /**
     * @var ?array<UserTenantAssociation> $items
     */
    #[JsonProperty('items'), ArrayType([UserTenantAssociation::class])]
    public ?array $items;

    /**
     * @var bool $hasMore Set to true when there are more pages that can be retrieved.
     */
    #[JsonProperty('has_more')]
    public bool $hasMore;

    /**
     * @var string $url A url that may be used to generate these results.
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var ?string $nextUrl A url that may be used to generate fetch the next set of results.
    Defined only when `has_more` is set to true
     */
    #[JsonProperty('next_url')]
    public ?string $nextUrl;

    /**
     * @var ?string $cursor A pointer to the next page of results. Defined
    only when `has_more` is set to true
     */
    #[JsonProperty('cursor')]
    public ?string $cursor;

    /**
     * @var string $type Always set to `list`. Represents the type of this object.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @param array{
     *   items?: ?array<UserTenantAssociation>,
     *   hasMore: bool,
     *   url: string,
     *   nextUrl?: ?string,
     *   cursor?: ?string,
     *   type: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'] ?? null;
        $this->hasMore = $values['hasMore'];
        $this->url = $values['url'];
        $this->nextUrl = $values['nextUrl'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
        $this->type = $values['type'];
    }
}
