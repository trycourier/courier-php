<?php

declare(strict_types=1);

namespace Courier\Tenants\DefaultPreferences\Items;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\DefaultPreferences\Items\SubscriptionTopicNew\Status;

/**
 * @phpstan-type subscription_topic_new = array{
 *   status: value-of<Status>,
 *   customRouting?: list<value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class SubscriptionTopicNew implements BaseModel
{
    /** @use SdkModel<subscription_topic_new> */
    use SdkModel;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Api(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true,
        optional: true,
    )]
    public ?array $customRouting;

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    #[Api('has_custom_routing', nullable: true, optional: true)]
    public ?bool $hasCustomRouting;

    /**
     * `new SubscriptionTopicNew()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionTopicNew::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionTopicNew)->withStatus(...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        Status|string $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $customRouting && $obj['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $obj->hasCustomRouting = $hasCustomRouting;

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
        $obj['customRouting'] = $customRouting;

        return $obj;
    }

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }
}
