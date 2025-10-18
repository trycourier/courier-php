<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Item;

/**
 * @phpstan-type default_preferences = array{items?: list<Item>|null}
 */
final class DefaultPreferences implements BaseModel
{
    /** @use SdkModel<default_preferences> */
    use SdkModel;

    /** @var list<Item>|null $items */
    #[Api(list: Item::class, nullable: true, optional: true)]
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
     * @param list<Item>|null $items
     */
    public static function with(?array $items = null): self
    {
        $obj = new self;

        null !== $items && $obj->items = $items;

        return $obj;
    }

    /**
     * @param list<Item>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }
}
