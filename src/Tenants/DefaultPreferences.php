<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Item;
use Courier\Tenants\SubscriptionTopicNew\Status;

/**
 * @phpstan-type DefaultPreferencesShape = array{items?: list<Item>|null}
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
     * @param list<Item|array{
     *   status: value-of<Status>,
     *   custom_routing?: list<value-of<ChannelClassification>>|null,
     *   has_custom_routing?: bool|null,
     *   id: string,
     * }>|null $items
     */
    public static function with(?array $items = null): self
    {
        $obj = new self;

        null !== $items && $obj['items'] = $items;

        return $obj;
    }

    /**
     * @param list<Item|array{
     *   status: value-of<Status>,
     *   custom_routing?: list<value-of<ChannelClassification>>|null,
     *   has_custom_routing?: bool|null,
     *   id: string,
     * }>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }
}
