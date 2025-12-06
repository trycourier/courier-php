<?php

declare(strict_types=1);

namespace Courier\Tenants\DefaultPreferences;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\SubscriptionTopicNew\Status;

/**
 * @phpstan-type ItemShape = array{
 *   status: value-of<Status>,
 *   custom_routing?: list<value-of<ChannelClassification>>|null,
 *   has_custom_routing?: bool|null,
 *   id: string,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @var list<value-of<ChannelClassification>>|null $custom_routing
     */
    #[Api(list: ChannelClassification::class, nullable: true, optional: true)]
    public ?array $custom_routing;

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $has_custom_routing;

    /**
     * Topic ID.
     */
    #[Api]
    public string $id;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(status: ..., id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withStatus(...)->withID(...)
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
     * @param Status|value-of<Status> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $custom_routing
     */
    public static function with(
        Status|string $status,
        string $id,
        ?array $custom_routing = null,
        ?bool $has_custom_routing = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;
        $obj['id'] = $id;

        null !== $custom_routing && $obj['custom_routing'] = $custom_routing;
        null !== $has_custom_routing && $obj['has_custom_routing'] = $has_custom_routing;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $obj = clone $this;
        $obj['custom_routing'] = $customRouting;

        return $obj;
    }

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj['has_custom_routing'] = $hasCustomRouting;

        return $obj;
    }

    /**
     * Topic ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }
}
