<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Audiences\Paging;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type preference_get_response = array{
 *   items: list<TopicPreference>, paging: Paging
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class PreferenceGetResponse implements BaseModel
{
    /** @use SdkModel<preference_get_response> */
    use SdkModel;

    /**
     * The Preferences associated with the user_id.
     *
     * @var list<TopicPreference> $items
     */
    #[Api(list: TopicPreference::class)]
    public array $items;

    /**
     * Deprecated - Paging not implemented on this endpoint.
     */
    #[Api]
    public Paging $paging;

    /**
     * `new PreferenceGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceGetResponse::with(items: ..., paging: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceGetResponse)->withItems(...)->withPaging(...)
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
     * @param list<TopicPreference> $items
     */
    public static function with(array $items, Paging $paging): self
    {
        $obj = new self;

        $obj->items = $items;
        $obj->paging = $paging;

        return $obj;
    }

    /**
     * The Preferences associated with the user_id.
     *
     * @param list<TopicPreference> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * Deprecated - Paging not implemented on this endpoint.
     */
    public function withPaging(Paging $paging): self
    {
        $obj = clone $this;
        $obj->paging = $paging;

        return $obj;
    }
}
