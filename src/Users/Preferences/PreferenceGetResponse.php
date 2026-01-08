<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type TopicPreferenceShape from \Courier\Users\Preferences\TopicPreference
 * @phpstan-import-type PagingShape from \Courier\Paging
 *
 * @phpstan-type PreferenceGetResponseShape = array{
 *   items: list<TopicPreference|TopicPreferenceShape>, paging: Paging|PagingShape
 * }
 */
final class PreferenceGetResponse implements BaseModel
{
    /** @use SdkModel<PreferenceGetResponseShape> */
    use SdkModel;

    /**
     * The Preferences associated with the user_id.
     *
     * @var list<TopicPreference> $items
     */
    #[Required(list: TopicPreference::class)]
    public array $items;

    /**
     * Deprecated - Paging not implemented on this endpoint.
     */
    #[Required]
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
     * @param list<TopicPreference|TopicPreferenceShape> $items
     * @param Paging|PagingShape $paging
     */
    public static function with(array $items, Paging|array $paging): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * The Preferences associated with the user_id.
     *
     * @param list<TopicPreference|TopicPreferenceShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Deprecated - Paging not implemented on this endpoint.
     *
     * @param Paging|PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }
}
