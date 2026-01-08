<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Item;

/**
 * @phpstan-import-type ItemShape from \Courier\Tenants\DefaultPreferences\Item
 *
 * @phpstan-type DefaultPreferencesShape = array{items?: list<Item|ItemShape>|null}
 */
final class DefaultPreferences implements BaseModel
{
    /** @use SdkModel<DefaultPreferencesShape> */
    use SdkModel;

    /** @var list<Item>|null $items */
    #[Optional(list: Item::class, nullable: true)]
    public ?array $items;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Item|ItemShape>|null $items
     */
    public static function with(?array $items = null): self
    {
        $self = new self;

        null !== $items && $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<Item|ItemShape>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
