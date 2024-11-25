<?php

namespace Courier\Tenants\Traits;

use Courier\Tenants\Types\SubscriptionTopicStatus;
use Courier\Core\Json\JsonProperty;
use Courier\Commons\Types\ChannelClassification;
use Courier\Core\Types\ArrayType;

trait SubscriptionTopicNew
{
    /**
     * @var value-of<SubscriptionTopicStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?bool $hasCustomRouting Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences
     */
    #[JsonProperty('has_custom_routing')]
    public ?bool $hasCustomRouting;

    /**
     * @var ?array<value-of<ChannelClassification>> $customRouting The default channels to send to this tenant when has_custom_routing is enabled
     */
    #[JsonProperty('custom_routing'), ArrayType(['string'])]
    public ?array $customRouting;
}
