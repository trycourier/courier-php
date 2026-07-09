<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BulkPreferenceTopicShape from \Courier\Users\Preferences\BulkPreferenceTopic
 *
 * @phpstan-type PreferenceBulkReplaceResponseShape = array{
 *   deleted: list<string>,
 *   items: list<BulkPreferenceTopic|BulkPreferenceTopicShape>,
 * }
 */
final class PreferenceBulkReplaceResponse implements BaseModel
{
    /** @use SdkModel<PreferenceBulkReplaceResponseShape> */
    use SdkModel;

    /**
     * The ids of the overrides that were reset to their topic default.
     *
     * @var list<string> $deleted
     */
    #[Required(list: 'string')]
    public array $deleted;

    /**
     * The complete resulting set of topic overrides for the user.
     *
     * @var list<BulkPreferenceTopic> $items
     */
    #[Required(list: BulkPreferenceTopic::class)]
    public array $items;

    /**
     * `new PreferenceBulkReplaceResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceBulkReplaceResponse::with(deleted: ..., items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceBulkReplaceResponse)->withDeleted(...)->withItems(...)
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
     * @param list<string> $deleted
     * @param list<BulkPreferenceTopic|BulkPreferenceTopicShape> $items
     */
    public static function with(array $deleted, array $items): self
    {
        $self = new self;

        $self['deleted'] = $deleted;
        $self['items'] = $items;

        return $self;
    }

    /**
     * The ids of the overrides that were reset to their topic default.
     *
     * @param list<string> $deleted
     */
    public function withDeleted(array $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

        return $self;
    }

    /**
     * The complete resulting set of topic overrides for the user.
     *
     * @param list<BulkPreferenceTopic|BulkPreferenceTopicShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
