<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class Channel extends JsonSerializableType
{
    /**
     * Id of the brand that should be used for rendering the message.
     * If not specified, the brand configured as default brand will be used.
     *
     * @var ?string $brandId
     */
    #[JsonProperty('brand_id')]
    public ?string $brandId;

    /**
     * A list of providers enabled for this channel. Courier will select
     * one provider to send through unless routing_method is set to all.
     *
     * @var ?array<string> $providers
     */
    #[JsonProperty('providers'), ArrayType(['string'])]
    public ?array $providers;

    /**
     * The method for selecting the providers to send the message with.
     * Single will send to one of the available providers for this channel,
     * all will send the message through all channels. Defaults to `single`.
     *
     * @var ?value-of<RoutingMethod> $routingMethod
     */
    #[JsonProperty('routing_method')]
    public ?string $routingMethod;

    /**
     * A JavaScript conditional expression to determine if the message should
     * be sent through the channel. Has access to the data and profile object.
     * Only applies when a custom routing strategy is defined.
     * For example, `data.name === profile.name`
     *
     * @var ?string $if
     */
    #[JsonProperty('if')]
    public ?string $if;

    /**
     * @var ?Timeouts $timeouts
     */
    #[JsonProperty('timeouts')]
    public ?Timeouts $timeouts;

    /**
     * @var ?array<string, mixed> $override Channel specific overrides.
     */
    #[JsonProperty('override'), ArrayType(['string' => 'mixed'])]
    public ?array $override;

    /**
     * @var ?ChannelMetadata $metadata
     */
    #[JsonProperty('metadata')]
    public ?ChannelMetadata $metadata;

    /**
     * @param array{
     *   brandId?: ?string,
     *   providers?: ?array<string>,
     *   routingMethod?: ?value-of<RoutingMethod>,
     *   if?: ?string,
     *   timeouts?: ?Timeouts,
     *   override?: ?array<string, mixed>,
     *   metadata?: ?ChannelMetadata,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->brandId = $values['brandId'] ?? null;
        $this->providers = $values['providers'] ?? null;
        $this->routingMethod = $values['routingMethod'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->timeouts = $values['timeouts'] ?? null;
        $this->override = $values['override'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
